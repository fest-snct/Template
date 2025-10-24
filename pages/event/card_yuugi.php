<?php
// OGP settings
$ogp_title = '遊戯王大会 | 高専祭2025';
$ogp_description = '高専祭2025で遊戯王大会を開催します!奮ってご参加ください。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/event/poster.webp';

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
    <title>遊戯王大会 | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="event-title">遊戯王大会</p>
            <div class="description">
                <p>日時：10月26日(日) 9:00~15:00</p>
                <p>会場：AL-B（8-303）</p>
                <p>参加費は無料です。</p>
                <p>自慢のデッキでデュエルしよう！</p>
                <p>大会形式：トーナメント形式</p>
                <p>参加希望者は当日、会場までお越しください。</p>
                <p>以下のリンクから申し込みしてください。</p>
                <a href="https://docs.google.com/forms/d/e/1FAIpQLSewJGuuIuniq1awxzmSJ9kqL4PXb1MWhdE-3REx3hYMVu8SQQ/viewform">参加申し込みForms</a>
                <img src="../../images/event/yuugi_poster.webp" alt="Yuugi Poster" class="poster-image">
            </div>
        </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>
