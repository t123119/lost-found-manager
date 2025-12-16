<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found 管理システム</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
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

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: 0.2s;
        }

        nav a:hover {
            opacity: 0.7;
        }

        /* 全体のコンテンツ領域 */
        main {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        /* フッター */
        footer {
            text-align: center;
            padding: 20px 0;
            color: #777;
            font-size: 14px;
        }

        /* 上部ボタンエリア */
        .top-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        /* ボタンデザイン */
        .btn {
            display: inline-block;
            background: #2a4d8f;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        .btn:hover {
            opacity: 0.85;
        }

        .btn-secondary {
            background: #556aa8;
        }

            /* ▼ 共通メニューボタンの枠 */
        .global-menu {
            max-width: 900px;
            margin: 15px auto 0;
            display: flex;
            gap: 15px;
            padding: 0 20px;
        }

        /* ▼ ボタンデザイン */
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

        .gbtn:hover {
            opacity: 0.85;
        }

        /* ▼ カラーバリエーション */
        .gbtn-gray {
            background: #606c88;
        }

        .gbtn-green {
            background: #2a8f6a;
        }

        /* 3カラム並び */
        .menu-description-row {
            max-width: 900px;
            margin: 15px auto 25px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            padding: 0 20px;
        }

        /* 個別カード */
        .desc-card {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            text-align: center;
            border-left: 4px solid #2a4d8f;
        }

        .desc-card h4 {
            margin: 0 0 8px;
            font-size: 16px;
            color: #2a4d8f;
        }

        .desc-card p {
            font-size: 13px;
            color: #444;
        }

        /* ▼ 登録フォームのカード */
        .create-card {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* ▼ フォーム要素 */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #2a4d8f;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2a4d8f;
            box-shadow: 0 0 5px rgba(42,77,143,0.3);
            outline: none;
        }

        /* ▼ ボタン */
        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-submit {
            background: #2a8f6a;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            transition: 0.2s;
        }

        .btn-submit:hover {
            opacity: 0.85;
        }

        .btn-cancel {
            background: #606c88;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        .btn-cancel:hover {
            opacity: 0.85;
        }


    </style>
</head>
<!-- 🔽 共通メニューボタン -->

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
    <div class="menu-description-row">
    <div class="desc-card">
        <h4>🔍 検索</h4>
        <p>キーワード、カテゴリ、日付から検索ができます。</p>
    </div>

    <div class="desc-card">
        <h4>📋 一覧</h4>
        <p>最新の落とし物を時系列で確認できます。</p>
    </div>

    <div class="desc-card">
        <h4>＋ 登録</h4>
        <p>拾得物の写真や特徴を登録できます（管理者向け）。</p>
    </div>
</div>

    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} Lost & Found System
</footer>

</body>
</html>
