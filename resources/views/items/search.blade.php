@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px; color:#2a4d8f;">🔍 落とし物検索</h2>

<!-- 検索フォーム -->
<div class="create-card">

    <form action="{{ route('items.search') }}" method="GET">

        <!-- キーワード -->
        <div class="form-group">
            <label>キーワード</label>
            <input type="text" name="keyword"
                   value="{{ request('keyword') }}"
                   placeholder="名前・特徴など">
        </div>

        <!-- カテゴリ -->
        <div class="form-group">
            <label>カテゴリ</label>
            <input type="text" name="category"
                   value="{{ request('category') }}"
                   placeholder="財布、鍵、スマホ など">
        </div>

        <!-- 日付 -->
        <div class="form-group">
            <label>発見日</label>
            <input type="date" name="found_date"
                   value="{{ request('found_date') }}">
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">検索する</button>
            <a href="{{ route('items.index') }}" class="btn-cancel">一覧に戻る</a>
        </div>

    </form>
</div>

<!-- 検索結果表示 -->
@if(isset($items))
    <h3 style="margin:30px 0 15px; color:#2a4d8f;">検索結果</h3>

    @if($items->isEmpty())
        <p>該当する落とし物は見つかりませんでした。</p>
    @else
        @foreach($items as $item)
            <div class="card">
                <img src="{{ asset('storage/' . $item->image_path) }}" width="120">
                <p><strong>{{ $item->name }}</strong></p>
                <p>{{ $item->found_place }}</p>
                <a href="{{ route('items.show', $item->id) }}">詳細を見る</a>
            </div>
        @endforeach
    @endif
@endif

@endsection
