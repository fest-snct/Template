<?php
// OGP settings
$ogp_title = 'コスプレ大会 | 高専祭2025';
$ogp_description = '高専祭2025でコスプレ大会を開催します!奮ってご参加ください。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/event/kosupure.webp';

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
    <title>コスプレ大会 | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="event-title">コスプレ大会</p>
            <div class="description">
                <p>日時：10月25日(土) 14:00~15:30</p>
                <p>会場: 屋外ステージ (雨天時: 第一体育館)</p>
                <p>参加費は無料です。</p>
                <p>お気に入りのキャラクターになりきって、高専祭を盛り上げよう！</p>
                <p>参加希望者は事前に<a href="https://forms.office.com/r/C4fEMzykkk?origin=QRCode">リンク</a>から申し込みし、当日参加してください。</p>
                <p>※このイベントへの申し込みは仙台高専広瀬キャンパス在学生限定となります。</p>
                <img src="../../images/event/kosupure.webp" alt="Cosplay Poster" class="poster-image">
            </div>
        </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>
