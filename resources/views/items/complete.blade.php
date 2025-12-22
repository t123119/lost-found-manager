@extends('layouts.app')

@section('content')

<div class="create-card" style="text-align:center;">

    <h2 style="color:#2a8f6a; margin-bottom:15px;">
        ✅ 登録が完了しました
    </h2>

    <p style="margin-bottom:25px;">
        落とし物情報を登録しました。<br>
        内容は運営の承認後に一覧へ表示されます。
    </p>

    <div class="form-buttons" style="justify-content:center;">
        <a href="{{ route('items.index') }}" class="btn-cancel">
            一覧へ戻る
        </a>

        <a href="{{ route('items.create') }}" class="btn-submit">
            続けて登録する
        </a>
    </div>

</div>

@endsection
