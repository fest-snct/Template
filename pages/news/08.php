<?php
// OGP settings
$ogp_title = 'コスプレ大会を開催します! | 高専祭2025';
$ogp_description = '高専祭2025でコスプレ大会を開催します!奮ってご参加ください。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/event/kosupure.webp';

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
    <title>コスプレ大会を開催します! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">コスプレ大会を開催します!</p>
            <div class="news_content">
                <p>高専祭2025でコスプレ大会を開催します!お気に入りのキャラクターになりきって、高専祭を盛り上げよう！</p>
                <p>日時：10月25日(土) 14:00~15:30</p>
                <p>会場: 屋外ステージ (雨天時: 第一体育館)</p>
                <p>参加費は無料です。</p>
                <p>参加希望者は当日、ステージ裏の受付までお越しください。</p>
                <p>詳細は<a href="../event/cosplay.php">こちら</a>をご覧ください。</p>
                <img src="../../images/event/kosupure.webp" alt="Cosplay Poster" class="cosplay-poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
