@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px; color:#2a4d8f;">📝 登録情報の編集</h2>

<div class="create-card">

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>落とし物の名前</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
            @error('name') <p style="color:red; font-size:0.8em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>カテゴリ</label>
            <input type="text" name="category" value="{{ old('category', $item->category) }}" required>
            @error('category') <p style="color:red; font-size:0.8em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>ステータス</label>
            <select name="status" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
                <option value="保管中" {{ old('status', $item->status) == '保管中' ? 'selected' : '' }}>保管中</option>
                <option value="返却済" {{ old('status', $item->status) == '返却済' ? 'selected' : '' }}>返却済</option>
                <option value="破棄済" {{ old('status', $item->status) == '破棄済' ? 'selected' : '' }}>破棄済</option>
            </select>
        </div>

        <div class="form-group">
            <label>色</label>
            <input type="text" name="color" value="{{ old('color', $item->color) }}">
        </div>

        <div class="form-group">
            <label>発見場所</label>
            <input type="text" name="found_place" value="{{ old('found_place', $item->found_place) }}" required>
        </div>

        <div class="form-group">
            <label>発見日</label>
            <input type="date" name="found_date" value="{{ old('found_date', $item->found_date) }}" required>
        </div>

        <div class="form-group">
            <label>写真の変更（変更しない場合は選択不要）</label>
            @if($item->image_path)
                <div style="margin-bottom: 10px;">
                    <p style="font-size: 0.9em; color: #666;">現在の写真：</p>
                    <img src="{{ asset('storage/' . $item->image_path) }}" width="150" style="border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="image" accept="image/*">
            @error('image') <p style="color:red; font-size:0.8em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>説明</label>
            <textarea name="description" rows="4">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">更新する</button>
            <a href="{{ route('items.show', $item->id) }}" class="btn-cancel">キャンセル</a>
        </div>

    </form>
</div>

@endsection