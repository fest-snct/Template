<?php
// OGP settings
$ogp_title = 'イベント企画 | 高専祭2025';
$ogp_description = '高専祭2025のイベント企画一覧。松本紀生さん特別企画やミニイベントなど、様々な企画を予定しています。';
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
    <title>イベント企画 | 高専祭2025</title>
    <link rel="stylesheet" href="../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">メインイベント</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">松本紀生さん特別企画</p>
                    <div class="description">
                        <p>二日目：10月26日(日)13:30から第一体育館で開催!</p>
                        <p>写真家の松本紀生さんが高専祭にやってくる!</p>
                        <a href="./event/guest.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">ゲーム大会</p>
                    <div class="description">
                        <p>会場：第一体育館</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">カラオケ</p>
                    <div class="description">
                        <p>会場：屋外ステージ</p>
                        <p>雨天時：第一体育館</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">コスプレ大会</p>
                    <div class="description">
                        <p>会場：屋外ステージ</p>
                        <p>雨天時：第一体育館</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">カードゲーム大会</p>
                    <div class="description">
                        <p>会場：AL-B（8-303）</p>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">ミニイベント</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">高専クイズ</p>
                    <div class="description">
                        <p>会場：受付</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">気配切り</p>
                    <div class="description">
                        <p>会場：グラウンド</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">スタンプラリー</p>
                    <div class="description">
                        <p>会場：受付</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>