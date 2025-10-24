<?php
// OGP settings
$ogp_title = '絶品焼きそば、ここにあり！ | 高専祭2025';
$ogp_description = '厳選した食材とソースが織りなす、深みある味わい。噛むほどに広がる旨味と、深く濃いコク。たくさんの具。その瞬間、心の中でつぶやく──「焼きそば、正直なめてました。」そして確信する、これは別次元にうまい！！';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/news/yakisobaya_news.jpg';

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
    <title>絶品焼きそば、ここにあり！ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">絶品焼きそば、ここにあり！</p>
            <div class="news_content">
                <img src="../../images/news/yakisobaya_news.jpg" alt="焼きそば" style="margin-bottom: 1rem; width: 100%;">
                <p>厳選した食材とソースが織りなす、深みある味わい。</p>
                <p>噛むほどに広がる旨味と、深く濃いコク。たくさんの具。</p>
                <p>その瞬間、心の中でつぶやく──</p>
                <p>「焼きそば、正直なめてました。」</p>
                <p>そして確信する、これは別次元にうまい！！</p>
                <br>
                <p>一個400円</p>
                <p>二個セット750円</p>
            </div>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
