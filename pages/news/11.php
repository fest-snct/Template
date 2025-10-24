<?php
// OGP settings
$ogp_title = '軽音楽部ライブのお知らせ | 高専祭2025';
$ogp_description = '軽音楽部です！合奏所と第一体育館で部員による演奏を行います！';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/keionn_natori.webp';

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
    <title>軽音楽部ライブのお知らせ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">軽音楽部ライブのお知らせ</p>
            <div class="news_content">
                <p>軽音楽部です！</p>
                <p>合奏所と第一体育館で部員による演奏を行います！</p>
                <p>さらに今年は名取キャンパスでも演奏します！</p>
                <p>是非気軽に足を運んでください〜！</p>
                <br>
                <p>合奏所演奏：10月25日（土）午後</p>
                <p>体育館ステージ演奏：10月26日（日）9時～11時半</p>
                <p>【急行しらはぎ号企画！】仙台高専名取ステージ演奏：10月25日（土）13時～14時</p>
                <img src="../../images/news/keionn_news.webp" alt="Light Music Club" class="cosplay-poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
