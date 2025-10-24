<?php
// OGP settings
$ogp_title = '高専女子プロジェクトです | 高専祭2025';
$ogp_description = '高専女子プロジェクトです。活動報告とドリンク販売を行います。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/news/josipuro_news/webp';

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
    <title>高専女子プロジェクトです | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">高専女子プロジェクトです</p>
            <div class="news_content">
                <p>高専女子プロジェクトです。</p>
                <p>活動報告とドリンク販売を行います。</p>
                <p>商品名は、「ゴマちゃんラテ」「初恋ソーダ」「赤点シロップ」「∞(インフィニティ)」です。</p>
                <p>ぜひ来てください！</p>
                <br>
                <p>出店時間：高専祭両日</p>
                <p>場所：8-306教室</p>
                <img src="../../images/news/josipuro_news.webp" alt="Kosen Girls Project" class="cosplay-poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
