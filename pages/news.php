<?php
// OGP settings
$ogp_title = 'ニュース | 高専祭2025';
$ogp_description = '高専祭2025の最新ニュース一覧。';

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
    <title>ニュース | 高専祭2025</title>
    <link rel="stylesheet" href="../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">ニュース一覧</p>
            <div class="news_list">
                <div class="news_item">
                    <a href="./news/04.php">
                        <div class="news_item_top">
                            <img src="../images/sirahagi.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.09.20</p>
                        <p class="news_title"><a href="./news/04.php">しらはぎ号が今年も走る!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/03.php">
                        <div class="news_item_top">
                            <img src="../images/event/poster.webp" alt="News Image" class="object-position-bottom">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.08.31</p>
                        <p class="news_title"><a href="./news/03.php">松本紀生さんが高専祭にやってくる!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/02.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.08.16</p>
                        <p class="news_title"><a href="./news/02.php">出店一覧を公開しました。</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/01.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    <a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.06.24</p>
                        <p class="news_title"><a href="./news/01.php">高専祭webサイトを公開しました。</a></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php' ?>
</body>
</html>
