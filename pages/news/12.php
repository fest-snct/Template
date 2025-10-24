<?php
// OGP settings
$ogp_title = '吹奏楽部より皆様へ | 高専祭2025';
$ogp_description = '私たち吹奏楽部は、高専祭のオープニングをつとめるべく、演奏を披露させていただきます。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/icon_yoko.webp';

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
    <title>吹奏楽部より皆様へ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">吹奏楽部より皆様へ</p>
            <div class="news_content">
                <p>私たち吹奏楽部は、高専祭のオープニングをつとめるべく、演奏を披露させていただきます。</p>
                <p>日時、場所は以下の通りです。</p>
                <br>
                <p>日時: 10/25 9:30～10:00</p>
                <p>場所: 第一体育館</p>
                <br>
                <p>高専祭にいらっしゃる方々に楽しんでいただけること、そして出店されるすべての方々の成功を願い、演奏いたします。</p>
                <p>皆様のご来場を、心より、お待ちしております！</p>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
