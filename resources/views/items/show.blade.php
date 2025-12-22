@extends('layouts.app')

@section('content')
<h2>{{ $item->name }}</h2>

<img src="{{ asset('storage/' . $item->image_path) }}" width="250">

<p>場所：{{ $item->found_place }}</p>
<p>カテゴリ：{{ $item->category }}</p>
<p>説明：{{ $item->description }}</p>

<form action="{{ route('items.destroy', $item->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button>削除</button>
</form>

@endsection
