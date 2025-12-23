@extends('layouts.app')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0; color: #2a4d8f;">🔍 落とし物の詳細</h2>
    <a href="{{ route('items.index') }}" class="btn-cancel" style="padding: 8px 16px;">一覧に戻る</a>
</div>

<div class="create-card" style="display: flex; gap: 30px; flex-wrap: wrap;">
    
    {{-- 左側：画像セクション --}}
    <div style="flex: 1; min-width: 300px;">
        <div style="width: 100%; border-radius: 12px; overflow: hidden; background: #f0f0f0; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 100%; display: block;">
            @else
                <div style="height: 300px; display: flex; justify-content: center; align-items: center; color: #999;">No Image</div>
            @endif
        </div>
    </div>

    {{-- 右側：詳細情報セクション --}}
    <div style="flex: 1.5; min-width: 300px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #eee;">
                <th style="text-align: left; padding: 15px 0; color: #606c88; width: 30%;">名称</th>
                <td style="padding: 15px 0; font-weight: bold; font-size: 1.2em;">{{ $item->name }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="text-align: left; padding: 15px 0; color: #606c88;">ステータス</th>
                <td style="padding: 15px 0;">
                    <span class="status-dot {{ $item->status == '保管中' ? 'status-keeping' : 'status-other' }}">
                        ● {{ $item->status }}
                    </span>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="text-align: left; padding: 15px 0; color: #606c88;">発見日</th>
                <td style="padding: 15px 0;">{{ $item->found_date }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="text-align: left; padding: 15px 0; color: #606c88;">発見場所</th>
                <td style="padding: 15px 0;">📍 {{ $item->found_place }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <th style="text-align: left; padding: 15px 0; color: #606c88;">カテゴリ / 色</th>
                <td style="padding: 15px 0;">{{ $item->category }} / {{ $item->color ?? '未登録' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 15px 0; color: #606c88; vertical-align: top;">説明</th>
                <td style="padding: 15px 0; line-height: 1.6;">{{ $item->description ?? '説明はありません' }}</td>
            </tr>
        </table>

        {{-- アクションボタン --}}
        <div style="margin-top: 30px; display: flex; gap: 15px; border-top: 1px solid #eee; padding-top: 20px;">
            <a href="{{ route('items.edit', $item->id) }}" class="gbtn gbtn-green">
                ✏️ 情報を編集する
            </a>

            <form action="{{ route('items.destroy', $item->id) }}" method="post" onsubmit="return confirm('本当にこのデータを削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">🗑️ 削除</button>
            </form>
        </div>
    </div>
</div>

@endsection