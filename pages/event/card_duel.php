<?php
require_once __DIR__ . '/../../config/site.php';

// OGP settings
$ogp_title = 'デュエマ大会 | ' . $site_config['festival_label'];
$ogp_description = $site_config['festival_label'] . 'でデュエマ大会を開催します!奮ってご参加ください。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $site_config['base_path'] . 'images/event/poster.webp';

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
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="event-title">デュエマ大会</p>
            <div class="description">
                <p>日時：10月25日(土) 9:00~16:00</p>
                <p>会場：AL-B（8-303）</p>
                <p>参加費は無料です。</p>
                <p>自慢のデッキでデュエルしよう！</p>
                <p>大会形式：トーナメント形式</p>
                <p>参加希望者は当日、会場までお越しください。</p>
                <p>以下のリンクから申し込みしてください。</p>
                <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=XYP-cpVeEkWK4KezivJfyOmZXv_zmDxKgY7cnTNY2AxUN0RUQUtRRTQzWU1FQk02WlVHVVZaV0dOSS4u&origin=QRCode" class="link">参加申し込みForms</a>
                <img src="../../images/event/duel_poster.webp" alt="Duel Poster" class="poster-image">
            </div>
        </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>
