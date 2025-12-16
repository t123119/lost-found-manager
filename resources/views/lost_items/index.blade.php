@extends('layouts.app')

@section('content')

<h2>落とし物一覧</h2>

<!-- ボタン配置エリア（登録・検索） -->
<div class="top-buttons">
    <a href="{{ route('items.create') }}" class="btn">＋ 登録</a>
    <a href="{{ route('items.search') }}" class="btn btn-secondary">🔍 検索</a>
</div>

<!-- ここに一覧の内容 -->
@foreach($items as $item)
    <div class="card">
        <img src="{{ asset('storage/' . $item->image_path) }}" width="150">
        <p>{{ $item->name }}</p>
        <p>{{ $item->found_place }}</p>
        <a href="{{ route('items.show', $item->id) }}">詳細</a>
    </div>
@endforeach

@endsection
