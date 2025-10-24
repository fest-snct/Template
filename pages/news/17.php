<?php
// OGP settings
$ogp_title = '写真部の展示・グッズ販売・フォトスポット | 高専祭2025';
$ogp_description = '写真部では、部員が撮った写真展示、グッズ販売、フォトスポットの設置を行います！';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/news/syashinbu_news.png';

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
    <title>写真部の展示・グッズ販売・フォトスポット | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">写真部の展示・グッズ販売・フォトスポット</p>
            <div class="news_content">
                <p>写真部では</p>
                <p>〇部員が撮った写真展示</p>
                <p>〇グッズ販売</p>
                <p>　・クリアしおり 450(各150)</p>
                <p>　・フォトブック 450円</p>
                <p>　・ポストカード 100円</p>
                <p>〇今年度の高専祭テーマ「彩風」をイメージしたフォトスポット</p>
                <p>を行います！</p>
                <br>
                <p>場所は8号棟2階(8-204)です！</p>
                <p>ぜひ来てください📸</p>
                <br>
                <p>※グッズの販売は12:00~</p>
                <img src="../../images/news/syashinbu_news.png" alt="Photobooth" class="cosplay-poster-image">
            </div>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>