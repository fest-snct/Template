<?php
session_start();
$nonce = base64_encode(random_bytes(16));
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
    <title>松本紀生オーロラフォトライブ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="event-title">松本紀生オーロラフォトライブ</p>
            <div class="description">
                <p>日時：10月26日(日) 13:00開場 13:30開演</p>
                <p>会場：仙台高専第一体育館</p>
                <p>入場料は無料です。</p>
                <p>未就学児も入場可ですが、他のお客様のご迷惑にならないようにお願いいたします。</p>
                <p>イベントへご来場の際は、公共交通機関のご利用にご協力くださいますようお願いいたします。お車でのご来場はご遠慮ください。</p>
                <p>会場へのアクセスは、<a href="https://fest-snct.jp/2025/pages/access.php" target="_blank">こちら</a>をご覧ください。</p>
                <div>
                    <img src="../../images/event/poster.jpg" alt="Event Poster" class="poster-image">
                </div>
                <div class="profile">
                    <p>写真家 松本紀生氏</p>
                    <p>１９７２年愛媛県松山市生まれ。アラスカ大学卒業。自然写真家。</p>
                    <p>１年の約半分をアラスカで過ごし、単独で動物やオーロラを撮影。</p>
                    <p>近年は気候変動に関する取材も行っている。</p>
                    <p>その活動はＴＢＳ「情熱大陸」、今年４月２５日のＮＨＫ ＢＳスペシャル「極限の世界の光」、アメリカ「National Geographic Channel」などのテレビ番組のほか、中学道徳（２０１９－）や高等学校の英語の教科書（２０１９－）でも紹介される。</p>
                    <p>日本滞在中はスライドショー「アラスカフォトライブ」で全国の学校、企業、団体を講演してまわる。</p>
                    <a href="https://www.matsumotonorio.com/">オフィシャルサイト</a>
                </div>
            </div>
        </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>