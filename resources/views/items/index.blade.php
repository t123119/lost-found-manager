@extends('layouts.app')

@section('content')

{{-- 1. サービス紹介セクション --}}
<div class="description-grid">
    <div class="desc-card">
        <h4>🔍 検索</h4>
        <p>キーワードやカテゴリから拾得物を検索できます。</p>
    </div>
    <div class="desc-card">
        <h4>📋 一覧</h4>
        <p>登録されている拾得物の一覧を確認できます。</p>
    </div>
    <div class="desc-card">
        <h4>＋ 登録</h4>
        <p>新しい拾得物を登録します。</p>
    </div>
</div>

<hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

{{-- 2. タイトルエリア --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0; color: #2a4d8f;">📦 落とし物一覧</h2>
    <a href="{{ route('items.create') }}" class="gbtn gbtn-green">＋ 新規登録</a>
</div>

{{-- 3. 一覧表示セクション --}}
<div class="item-grid">
    @forelse($items as $item)
        <article class="item-card">
            {{-- 画像 --}}
            <div class="item-img-container">
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                @else
                    <div style="display: flex; justify-content: center; align-items: center; height: 100%; color: #ccc;">No Image</div>
                @endif
            </div>

            {{-- 情報 --}}
            <div class="item-body">
                <span class="badge">{{ $item->category }}</span>
                <h3 style="font-size: 16px; margin: 0 0 5px 0;">{{ $item->name }}</h3>
                <p style="font-size: 13px; color: #718096; margin: 0 0 10px 0;">📍 {{ $item->found_place }}</p>
                
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="status-dot {{ $item->status == '保管中' ? 'status-keeping' : 'status-other' }}">
                        ● {{ $item->status }}
                    </span>
                    <a href="{{ route('items.show', $item->id) }}" style="text-decoration: none; color: #2a4d8f; font-weight: bold; font-size: 13px;">
                        詳細 ＞
                    </a>
                </div>
            </div>
        </article>
    @empty
        <p style="grid-column: 1 / -1; text-align: center; color: #999; padding: 40px;">
            現在、登録されている落とし物はありません。
        </p>
    @endforelse
</div>

@endsection