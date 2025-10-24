<?php
// OGP settings
$ogp_title = '部員制作CDとグッズの販売！（DTM部） | 高専祭2025';
$ogp_description = 'DTM部です！部員が作成した楽曲を収録したCDと、オリジナルMVに登場するかわいいイラストのグッズを販売します！';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/stores/DTMbu.webp';

session_start();
$nonce = base64_encode(random_bytes(16));
$_SESSION['nonce'] = $nonce;
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "' https://www.youtube.com;
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self' https://www.youtube.com;
    frame-ancestors 'none';
");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>部員制作CDとグッズの販売！（DTM部） | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">部員制作CDとグッズの販売！（DTM部）</p>
            <div class="news_content">
                <p>こんにちは！DTM部です！</p>
                <p>部員が作成した楽曲を収録したCDと、オリジナルMVに登場するかわいいイラストのグッズを販売します！</p>
                <p>頑張って100枚手焼きしたのでぜひ買ってください😁👍</p>
                <br>
                <p>【おしながき】</p>
                <p>2025年DTM部高専祭CD（アクリルキーホルダー1個付属）：500円</p>
                <p>仙台高専DTM部 ずんだもんアルバム：300円</p>
                <br>
                <p>【収録曲試聴！クロスフェード動画】</p>
                <p><a href="https://www.youtube.com/watch?v=ACZp1yMFsZw">https://www.youtube.com/watch?v=ACZp1yMFsZw</a></p>
                <p><a href="https://www.youtube.com/watch?v=SjwAYK0U2Tg">https://www.youtube.com/watch?v=SjwAYK0U2Tg</a></p>
                <br>
                <p>【DTM部 SNS】</p>
                <p>・Twitter：<a href="https://x.com/nitsc_dtm">https://x.com/nitsc_dtm</a></p>
                <p>・YouTube：<a href="https://www.youtube.com/@dtm9695">https://www.youtube.com/@dtm9695</a></p>
                <p>・ニコニコ動画：<a href="https://www.nicovideo.jp/user/133011324">https://www.nicovideo.jp/user/133011324</a></p>
                <img src="../../images/news/dtm_news.webp" alt="DTM Club" class="cosplay-poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
