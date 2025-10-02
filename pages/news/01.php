<?php
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
    <title>2025年度高専祭webサイト公開! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">2025年度高専祭webサイト公開!</p>
            <div class="news_content">
                <p>ついに今年度のWebサイトが公開されました！</p>
                <p>高専祭当日までの間、様々な情報が本サイトに掲載されます。</p>
                <p>例年通りページが更新されるたびに、この「ニュース」ページで報告していきます。</p>
                <p>今年度の高専祭は10/26（土）、27（日）の2日間、名取キャンパスとの同日開催になります。</p>
                <p>ぜひ当日をお楽しみに!</p>
            </div>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>