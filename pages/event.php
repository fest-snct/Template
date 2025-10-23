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
                        <p>二日目: 10月26日(日)13:30から第一体育館で開催!</p>
                        <p>写真家の松本紀生さんが高専祭にやってくる!</p>
                        <a href="./event/guest.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">ぷよテト大会</p>
                    <div class="description">
                        <p>会場: 第一体育館</p>
                        <p>日程: 10月25日（土）11:00-13:00</p>
                        <a href="./event/puyoteto.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">コスプレ大会</p>
                    <div class="description">
                        <p>会場: 晴天時は屋外ステージ、雨天時は第一体育館</p>
                        <p>晴天時: 10月25日（土）9:00-12:00</p>
                        <p>雨天時: 10月25日（土）14:00-15:30</p>
                        <a href="./event/cosplay.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">遊戯王大会</p>
                    <div class="description">
                        <p>会場: AL-B（8-303）</p>
                        <p>日程: 10月25日（土）9:00-16:00</p>
                        <a href="./event/card_yuugi.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">デュエマ大会</p>
                    <div class="description">
                        <p>会場: AL-B（8-303）</p>
                        <p>日程: 10月25日（土）9:00-16:00</p>
                        <a href="./event/card_duel.php" class="detail">詳細はこちら</a>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">ミニイベント</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">気配切り</p>
                    <div class="description">
                        <p>会場: グラウンド</p>
                        <p>日程: 10月25日（土）9:00-16:00</p>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">文化部演奏</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">筝曲部</p>
                    <div class="description">
                        <p>会場: 体育館</p>
                        <p>日程: 10月25日（土）16:30-17:00 （入場は16:00～可能です）</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">吹奏楽部</p>
                    <div class="description">
                        <p>会場: 体育館</p>
                        <p>日程: 10月25日（土）9:30-10:00 （入場は9:00～可能です）</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">軽音楽部</p>
                    <div class="description">
                        <p>会場: 体育館 (土曜午後に合奏所でも演奏!!)</p>
                        <p>日程: 10月26日（日）9:00-11:30</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">【急行しらはぎ号特別企画！】</p>
                    <div class="description">
                        <p>広瀬の軽音楽部が名取キャンパスで演奏！</p>
                        <p>10月25日 13時～14時　仙台高専名取 ステージにて</p>
                        <img src="../images/keionn_natori.webp" alt="Keionn Natori" class="poster-image">
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">常時開催イベント</p>
            <div class="events">
                <div class="event">
                    <p class="event-title">松本紀生写真展</p>
                    <div class="description">
                        <p>会場: 武道場</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">free カラオケ</p>
                    <div class="description">
                        <p>会場: 屋外ステージ</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">スタンプラリー</p>
                    <div class="description">
                        <p>会場: 校内and受付</p>
                    </div>
                </div>
                <div class="event">
                    <p class="event-title">高専クイズ</p>
                    <div class="description">
                        <p>会場: 校内and受付</p>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">タイムテーブル</p>
            <img class="time-table" src="../images/time-table.png" alt="タイムテーブル">
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>