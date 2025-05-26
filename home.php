<?php
session_start();
$nonce = base64_encode(random_bytes(16));
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>
    <header>
        <div class="mini_logo">
            <img src="https://picsum.photos/80" />
        </div>
        <div class="index">
            <p class="title">高専祭2025</p>
            <div class="subtitles">
                <p class="subtitle">ご挨拶</p>
                <p class="subtitle">企画一覧</p>
                <p class="subtitle">アクセス</p>
                <p class="subtitle">ニュース</p>
                <p class="subtitle">Q&A</p>
                <p class="subtitle">お問い合わせ</p>
                <p class="subtitle">プライバシーポリシー</p>
            </div>
        </div>
        <div class="menu">
            <img src="https://picsum.photos/80" alt="Menu Icon" />
        </div>
    </header>
    <main>
        <div class="main_logo">
            <img src="https://picsum.photos/400/600" alt="Main Image" />
        </div>
    </main>
</body>
</html>