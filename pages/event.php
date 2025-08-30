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
    <title>イベント企画 | 高専祭2025</title>
    <link rel="stylesheet" href="../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '/2025/pages/includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">イベント企画</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">松本紀生さん特別企画</p>
                    <div class="description">
                        <p>一日目：10月25日(土)　　13:30から</p>
                        <p>写真家の松本紀生さんが高専祭にやってくる!</p>
                        <a href="./event/guest.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">ミニイベント</p>
            <div class="events">
                <p>準備中です。</p>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>