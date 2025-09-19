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
    <title>松本紀生さんが高専祭にやってくる! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '/2025/pages/includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">松本紀生さんが高専祭にやってくる!</p>
            <div class="news_content">
                <p>今年の高専祭では、アラスカ写真家の松本紀生さんにお越しいただきます！</p>
                <p>フォトライブなど様々な企画を予定しています。ぜひお越しください！</p>
                <img src="../../images/event/guest.jpg" alt="Profile Image" class="profile-image">
            </div>

            <a href="../event/guest.php">詳しくはこちら<a>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>