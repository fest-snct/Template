<?php
// OGP settings
$ogp_title = 'プログラミング部です | 高専祭2025';
$ogp_description = 'プログラミング部では、おなじみの弾幕ゲームや過去のプログラミングコンテスト出場作品などを展示しています。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/news/probu_news.webp';

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
    <title>プログラミング部です | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">プログラミング部です</p>
            <div class="news_content">
                <p>プログラミング部では、おなじみの弾幕ゲームや過去のプログラミングコンテスト出場作品などを展示しています。</p>
                <p>また、入力したテキストで学習するLLMも設置中です。どんなAIになるかは皆さん次第！</p>
                <p>ぜひお気軽に遊びに来てください！</p>
                <br>
                <p>場所: 松韻会館2階</p>
                <br>
                <p>・高専プロコン：動画、作品展示、賞状、ポスターなど</p>
                <p>・個人作品：AI解説動画、学習型AIなど</p>
                <img src="../../images/news/probu_news.webp" alt="Programming Club" class="cosplay-poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
