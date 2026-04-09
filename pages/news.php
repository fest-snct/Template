<?php
require_once __DIR__ . '/../config/site.php';
require_once __DIR__ . '/../lib/content.php';

$ogp_title       = 'ニュース | ' . $site_config['festival_name'] . $site_config['year'];
$ogp_description = $site_config['festival_name'] . $site_config['year'] . 'の最新ニュース一覧。';

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

$news_list = load_news_articles();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">ニュース一覧</p>
            <div class="news_list">
                <?php foreach ($news_list as $news):
                    // 表示用日付: YYYY-MM-DD → YYYY.MM.DD
                    $display_date = str_replace('-', '.', $news['date']);
                    $thumb = $news['image'];
                    $link = build_news_url($news['slug']);
                ?>
                <div class="news_item">
                    <a href="<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>">
                        <div class="news_item_top">
                            <img src="<?= htmlspecialchars($thumb, ENT_QUOTES, 'UTF-8') ?>" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date"><?= htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="news_title">
                            <a href="<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>
