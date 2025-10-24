<?php
// OGP settings
$ogp_title = '謎解き愛好会からのお知らせ | 高専祭2025';
$ogp_description = '体験型謎解きイベント『一生脱出できない運命からの脱出～開運！脱出みくじ～』を開催！';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/stores/nazotokiaikoukai.webp';

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
    <title>謎解き愛好会からのお知らせ | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">謎解き愛好会からのお知らせ</p>
            <div class="news_content">
                <p>体験型謎解きイベント『一生脱出できない運命からの脱出～開運！脱出みくじ～』を開催！</p>
                <p>第4回リアル脱出ゲーム甲子園本選出場作品の再演です！</p>
                <p>脱出の運勢を掴み取れ！</p>
                <br>
                <p>場所: 8-202教室</p>
                <br>
                <p>開催時間</p>
                <p>10/25（土）</p>
                <p>10:30〜11:30</p>
                <p>13:00〜14:00</p>
                <p>15:00〜16:00</p>
                <br>
                <p>10/26（日）</p>
                <p>10:30〜11:30</p>
                <p>13:00〜14:00</p>
                <br>
                <p>※注意事項※</p>
                <p>・開催時間の15分前から受付を開始します。</p>
                <p>・事前予約等はできませんのでご了承ください。</p>
                <p>・途中参加ができませんので、参加希望の方は必ず開始時間までにお越しください。</p>
                <br>
                <p>また、校内を歩き回って謎を解く問題や、持ち帰って家で解ける謎を常時販売します！ぜひお越しください！</p>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
