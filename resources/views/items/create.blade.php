@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px; color:#2a4d8f;">＋ 新規登録</h2>

<div class="create-card">

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">落とし物の名前 <span style="color: red; font-size: 0.8em;">(必須)</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="category">カテゴリ <span style="color: red; font-size: 0.8em;">(必須)</span></label>
            <input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="例：財布、スマートフォン" required>
            @error('category') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="color">色</label>
            <input type="text" name="color" id="color" value="{{ old('color') }}" placeholder="例：黒、シルバー">
            @error('color') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="found_place">発見場所 <span style="color: red; font-size: 0.8em;">(必須)</span></label>
            <input type="text" name="found_place" id="found_place" value="{{ old('found_place') }}" required>
            @error('found_place') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="found_date">発見日 <span style="color: red; font-size: 0.8em;">(必須)</span></label>
            <input type="date" name="found_date" id="found_date" value="{{ old('found_date', date('Y-m-d')) }}" required>
            @error('found_date') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="image">写真 <span style="color: red; font-size: 0.8em;">(必須)</span></label>
            <input type="file" name="image" id="image" accept="image/*" required>
            <p style="font-size: 0.8em; color: #718096; margin-top: 5px;">※2MB以内の画像を選択してください</p>
            @error('image') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" rows="4" placeholder="特徴（傷の有無、ブランド名など）を記入してください">{{ old('description') }}</textarea>
            @error('description') <p style="color:red; font-size:0.8em; margin-top:5px;">{{ $message }}</p> @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">🚀 登録する</button>
            <a href="{{ route('items.index') }}" class="btn-cancel">戻る</a>
        </div>

    </form>

</div>

@endsection