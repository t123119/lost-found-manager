@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px; color:#2a4d8f;">🔍 落とし物検索</h2>

<div class="create-card">
    <form action="{{ route('items.search') }}" method="GET">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>キーワード</label>
                <input type="text" name="keyword"
                       value="{{ request('keyword') }}"
                       placeholder="名前・特徴など">
            </div>

            <div class="form-group">
                <label>カテゴリ</label>
                <input type="text" name="category"
                       value="{{ request('category') }}"
                       placeholder="財布、鍵、スマホ など">
            </div>
        </div>

        <div class="form-group">
            <label>発見日</label>
            <input type="date" name="found_date"
                   value="{{ request('found_date') }}">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">🔍 この条件で検索する</button>
            <a href="{{ route('items.index') }}" class="btn-cancel">一覧に戻る</a>
        </div>
    </form>
</div>

@if(isset($items))
    <hr style="border: 0; border-top: 1px solid #eee; margin: 40px 0 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; color:#2a4d8f;">検索結果：{{ $items->count() }} 件</h3>
    </div>

    @if($items->isEmpty())
        <div style="text-align: center; padding: 40px; background: #fff; border-radius: 12px; border: 1px dashed #ccc;">
            <p style="color: #718096; margin-bottom: 10px;">該当する落とし物は見つかりませんでした。</p>
            <p style="font-size: 0.9em; color: #a0aec0;">条件を変えて再度検索してみてください。</p>
        </div>
    @else
        {{-- 一覧画面と同じグリッドレイアウトを適用 --}}
        <div class="item-grid">
            @foreach($items as $item)
                <article class="item-card">
                    <div class="item-img-container">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                        @else
                            <div style="display: flex; justify-content: center; align-items: center; height: 100%; color: #ccc;">No Image</div>
                        @endif
                    </div>

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
            @endforeach
        </div>
    @endif
@endif

@endsection