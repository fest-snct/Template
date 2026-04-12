<?php
require_once __DIR__ . '/../config/site.php';
require_once __DIR__ . '/../lib/content.php';

$slug = isset($_GET['slug']) ? basename((string) $_GET['slug']) : '';
$article = load_news_article($slug);

if ($article === null) {
    http_response_code(404);
    exit('記事が見つかりません。');
}

$ogp_title = $article['title'] . ' | ' . $site_config['festival_label'];
$ogp_description = $article['ogp_description'];
$ogp_type = 'article';
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$ogp_image = preg_match('/^https?:\/\//', $article['image'])
    ? $article['image']
    : $protocol . $_SERVER['HTTP_HOST'] . $article['image'];

session_start();
$nonce = base64_encode(random_bytes(16));
$_SESSION['nonce'] = $nonce;
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-{$nonce}';
    style-src 'self' 'nonce-{$nonce}';
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
    <link rel="stylesheet" href="../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include __DIR__ . '/includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include __DIR__ . '/includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title"><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="news_content">
                <?= $article['body_html'] ?>
            </div>
        </main>
    </div>
    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
