<?php
// OGP settings
$ogp_title = 'ぷよテト大会を開催します! | 高専祭2025';
$ogp_description = '高専祭2025でぷよテト大会を開催します!奮ってご参加ください。';
$ogp_type = 'article';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/event/puyoteto.webp';

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
    <title>ぷよテト大会を開催します! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">ぷよテト大会を開催します!</p>
            <div class="news_content">
                <p>高専祭2025でぷよテト大会を開催します!最強のぷよテトプレイヤーは誰だ！？</p>
                <p>日時：10月25日(土) 11:00~13:00</p>
                <p>会場：第一体育館</p>
                <p>参加費は無料です。</p>
                <p>大会形式：トーナメント形式</p>
                <p>参加希望者は以下のリンクから申し込み完了後、当日会場へお越しください。</p>
                <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=XYP-cpVeEkWK4KezivJfyE-ptyii6zlJj-PM44-6mdJUOEtCTEpRM0pFSzJUUUk5UkhUWVQwMUpGNy4u&origin=QRCode" class="link">参加申し込みForms</a>
                <img src="../../images/event/puyoteto.webp" alt="PuyoTeto Poster" class="poster-image">
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
