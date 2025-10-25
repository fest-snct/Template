<?php
// OGP settings
$ogp_title = '高専祭Award!! | 高専祭2025';
$ogp_description = '高専祭Awardへのご協力をお願いします！';
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
    <title>高専祭Award!! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">高専祭Award!!</p>
            <div class="news_content">
                <p>高専祭Awardへのご協力をお願いします！</p>
                <p>以下のリンクからFormsに回答してください。</p>
                <p><a href="https://forms.cloud.microsoft/pages/responsepage.aspx?id=XYP-cpVeEkWK4KezivJfyK4j7n8TQNJOqczWngrF0PVUNlpWUDdMOVlPRDVBNFNFQ1NPVzY5NjJVSC4u&origin=QRCode&route=shorturl" target="_blank">回答フォームはこちら</a></p>
            </div>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>