@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px; color:#2a4d8f;">＋ 新規登録</h2>

<div class="create-card">

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 名前 -->
        <div class="form-group">
            <label>落とし物の名前</label>
            <input type="text" name="name" required>
        </div>

        <!-- カテゴリ -->
        <div class="form-group">
            <label>カテゴリ</label>
            <input type="text" name="category" required>
        </div>

        <!-- 色 -->
        <div class="form-group">
            <label>色</label>
            <input type="text" name="color">
        </div>

        <!-- 発見場所 -->
        <div class="form-group">
            <label>発見場所</label>
            <input type="text" name="found_place" required>
        </div>

        <!-- 発見日 -->
        <div class="form-group">
            <label>発見日</label>
            <input type="date" name="found_date" required>
        </div>

        <!-- 画像 -->
        <div class="form-group">
            <label>写真（画像アップロード）</label>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <!-- 説明 -->
        <div class="form-group">
            <label>説明</label>
            <textarea name="description" rows="4" placeholder="特徴や詳細を記入"></textarea>
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <button type="submit" class="btn-submit">登録する</button>
            <a href="{{ route('items.index') }}" class="btn-cancel">戻る</a>
        </div>
        

    </form>

</div>

@endsection
