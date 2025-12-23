<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found 管理システム</title>

    <style>
        body {
            font-family: "Segoe UI", "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            color: #333;
        }

        /* ヘッダー */
        header {
            background: #2a4d8f;
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            font-size: 20px;
            margin: 0;
        }

        /* 全体のコンテンツ領域 */
        main {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            min-height: 60vh;
        }

        /* 成功メッセージ */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
            font-weight: 600;
        }

        /* フッター */
        footer {
            text-align: center;
            padding: 20px 0;
            color: #777;
            font-size: 14px;
        }

        /* 共通メニュー */
        .global-menu {
            max-width: 900px;
            margin: 15px auto 0;
            display: flex;
            gap: 15px;
            padding: 0 20px;
        }

        .gbtn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            background: #2a4d8f;
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .gbtn:hover { opacity: 0.85; }
        .gbtn-gray { background: #606c88; }
        .gbtn-green { background: #2a8f6a; }

        /* フォーム共通スタイル */
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; color: #2a4d8f; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;
            font-size: 14px; box-sizing: border-box;
        }

        .btn-submit { background: #2a8f6a; color: white; padding: 10px 25px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; }
        .btn-cancel { background: #606c88; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 600; display: inline-block; }
        
        /* 完了画面用カードなどの共通スタイル */
        .create-card { background: #ffffff; padding: 10px; }

        /* 説明用カードのグリッド */
        .description-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .desc-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            text-align: center;
            border-left: 4px solid #2a4d8f;
        }

        /* 落とし物一覧のグリッド */
        .item-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        /* 個別カード */
        .item-card {
            background: white;
            border: 1px solid #e0e6ed;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .item-card:hover {
            transform: translateY(-5px);
        }

        .item-img-container {
            width: 100%;
            height: 150px;
            background: #f0f0f0;
        }

        .item-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-body {
            padding: 15px;
        }

        /* バッジやラベル */
        .badge {
            display: inline-block;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 12px;
            background: #e2e8f0;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .status-dot {
            font-size: 12px;
            font-weight: bold;
        }

        .status-keeping { color: #2a8f6a; }
        .status-other { color: #606c88; }

        .btn-delete {
            background: #e53e3e; /* 赤色 */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-delete:hover {
            background: #c53030;
        }

        /* 完了画面用のスタイル */
        .complete-container {
            text-align: center;
            padding: 40px 20px;
        }

        .complete-icon {
            font-size: 64px;
            color: #2a8f6a;
            margin-bottom: 20px;
        }

        .complete-title {
            color: #2a8f6a;
            margin-bottom: 15px;
        }

        .complete-text {
            margin-bottom: 30px;
            line-height: 1.8;
            color: #4a5568;
        }

        .center-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
    </style>
</head>

<body>

<header>
    <h1>Lost & Found 管理システム</h1>
</header>

<div class="global-menu">
    <a href="{{ route('items.search') }}" class="gbtn">🔍 検索</a>
    <a href="{{ route('items.index') }}" class="gbtn gbtn-gray">📋 一覧</a>
    <a href="{{ route('items.create') }}" class="gbtn gbtn-green">＋ 登録</a>
</div>

<main>
    {{-- フラッシュメッセージの表示エリア --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 個別ページのコンテンツ --}}
    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} Lost & Found System
</footer>

</body>
</html>