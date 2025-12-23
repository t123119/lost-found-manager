@extends('layouts.app')

@section('content')

<div class="complete-container">

    <div class="complete-icon">✅</div>

    <h2 class="complete-title">登録が完了しました</h2>

    <div class="complete-text">
        <p>
            落とし物情報をシステムに登録しました。<br>
        </p>
        <p style="font-size: 0.9em; color: #718096;">
            ※内容は確認後に一覧へ反映されます。
        </p>
    </div>

    <div class="center-buttons">
        <a href="{{ route('items.index') }}" class="btn-cancel">
            📋 一覧へ戻る
        </a>

        <a href="{{ route('items.create') }}" class="btn-submit">
            ＋ 続けて登録する
        </a>
    </div>

</div>

@endsection