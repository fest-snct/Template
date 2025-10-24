<?php
// OGP settings
$ogp_title = '河北新報でご紹介いただきました！ | 高専祭2025';
$ogp_description = '2025年10月22日の河北新報の夕刊に、松本紀生オーロラフォトライブイベントについての記事を掲載いただきました。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/event/guest.webp';

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
    <title>河北新報でご紹介いただきました！ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">河北新報でご紹介いただきました！</p>
            <div class="news_content">
                <p>2025年10月22日の河北新報の夕刊に、松本紀生オーロラフォトライブイベントについての記事を掲載いただきました。</p>
                <p>オンライン版は<a href="https://kahoku.news/articles/20251022khn000015.html" target="_blank">こちら</a>から閲覧可能です。</p>
                <br>
                <p>本イベントは10月25日（日）に開催されます。</p>
                <p>入場無料で、最寄り駅からのシャトルバスもご用意しております。</p>
                <p>ぜひ、お越しください！</p>
                <br>
                <p>イベント詳細は<a href="/2025/pages/event/guest.php">こちら</a></p>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
