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

        // 画像保存
        $path = $request->file('image')->store('lost_items', 'public');

        // DB保存
        LostItem::create([
            'name'          => $data['name'],
            'category'      => $data['category'],
            'color'         => $data['color'] ?? null,
            'found_place'   => $data['found_place'],
            'found_date'    => $data['found_date'],
            'image_path'    => $path,
            'description'   => $data['description'] ?? null,
            'status'        => '保管中',
        ]);

        return redirect()
            ->route('items.index')
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

        // 1. バリデーション
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

        // 2. ファイル以外のデータを更新用配列として準備
        // 'image' キーはファイルオブジェクトなので、これを除外した配列を作る
        $updateData = $request->except('image');

        // 3. 画像の更新処理
        if ($request->hasFile('image')) {
            // 古い画像があれば削除
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            // 新しい画像を保存し、パスを更新用配列に追加
            $path = $request->file('image')->store('lost_items', 'public');
            $updateData['image_path'] = $path;
        }

        // 4. DBを更新
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
     * 削除処理（画像も削除）
     */
    public function destroy($id)
    {
        $item = LostItem::findOrFail($id);

        // 画像削除
        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', '削除しました');
    }
}