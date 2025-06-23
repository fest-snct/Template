<?php
session_start();
$nonce = base64_encode(random_bytes(16));
$_SESSION['nonce'] = $nonce;
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
    <title>シャトルバス時刻表 | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/shuttle_bus.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <header>
        <?php $currentPage = $_SERVER['SCRIPT_NAME']; // 現在のファイル名（例: /pages/stores.php）?>
        <div class="mini_logo">
            <img src="https://img.skin/80x80/000/fff/?text=logo&fmt=png" />
        </div>
        <div class="index">
            <a class="title" href="../../home.php">高専祭2025</a>
            <div class="subtitles">
                <a class="subtitle <?= $currentPage == '/2025/pages/greeting.php' ? 'is-current' : '' ?>" href="./greeting.php">ご挨拶</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/event.php' ? 'is-current' : '' ?>" href="./event.php">イベント企画</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/stores.php' ? 'is-current' : '' ?>" href="./stores.php">出店一覧</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/access.php' ? 'is-current' : '' ?>" href="./access.php">アクセス</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/news.php' ? 'is-current' : '' ?>" href="./news.php">ニュース</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/Q&A.php' ? 'is-current' : '' ?>" href="./Q&A.php">Q&A</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/contact.php' ? 'is-current' : '' ?>" href="./contact.php">お問い合わせ</a>
                <a class="subtitle <?= $currentPage == '/2025/pages/privacypolicy.php' ? 'is-current' : '' ?>" href="./privacypolicy.php">プライバシーポリシー</a>
            </div>
        </div>
        <div class="menu">
            <img src="../../images/menu.png" alt="Menu Icon" />
        </div>
        <?php include '../includes/hamburgermenu.php' ; ?>
    </header>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">シャトルバス時刻表</p>
            <div class="content">
                <p>準備中です。</p>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>