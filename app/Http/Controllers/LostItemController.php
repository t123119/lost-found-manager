<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    /**
     * 一覧表示
     */
    public function index()
    {
        $items = LostItem::orderBy('found_date', 'desc')->get();
        return view('items.index', compact('items'));
    }

    /**
     * 新規登録フォーム表示
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * 新規登録処理（画像アップロード含む）
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'color'         => 'nullable|string|max:255',
            'found_place'   => 'required|string|max:255',
            'found_date'    => 'required|date',
            'image'         => 'nullable|image|max:2048',
            'description'   => 'nullable|string',
        ]);

        // 画像がアップロードされた場合のみ保存処理を行う
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('lost_items', 'public');
        }

        // DB保存
        LostItem::create([
            'name'          => $data['name'],
            'category'      => $data['category'],
            'color'         => $data['color'] ?? null,
            'found_place'   => $data['found_place'],
            'found_date'    => $data['found_date'],
            'image_path'    => $path, // 画像がない場合はnullが入る
            'description'   => $data['description'] ?? null,
            'status'        => '保管中',
        ]);

        // 完了画面（items.complete）へリダイレクト
        return redirect()
            ->route('items.complete')
            ->with('success', '落とし物を登録しました');
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $item = LostItem::findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * 編集フォーム表示
     */
    public function edit($id)
    {
        $item = LostItem::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $item = LostItem::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'color'       => 'nullable|string|max:255',
            'found_place' => 'required|string|max:255',
            'found_date'  => 'required|date',
            'image'       => 'nullable|image|max:2048', 
            'description' => 'nullable|string',
            'status'      => 'required|string|in:保管中,返却済,破棄済',
        ]);

        $updateData = $request->except('image');

        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $path = $request->file('image')->store('lost_items', 'public');
            $updateData['image_path'] = $path;
        }

        $item->update($updateData);

        return redirect()
            ->route('items.show', $item->id)
            ->with('success', '落とし物情報を更新しました');
    }

    /**
     * 検索処理
     */
    public function search(Request $request)
    {
        $query = LostItem::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('found_date')) {
            $query->whereDate('found_date', $request->found_date);
        }

        $items = $query->orderBy('found_date', 'desc')->get();

        return view('items.search', compact('items'));
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $item = LostItem::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', '削除しました');
    }
}