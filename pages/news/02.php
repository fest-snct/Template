<?php
// OGP settings
$ogp_title = '2025年度高専祭出店一覧を公開しました! | 高専祭2025';
$ogp_description = '今年の出店一覧を公開しました！今年は以下の26団体が出店します!';
$ogp_type = 'article';

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

include '../includes/stores_array.php';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2025年度高専祭出店一覧を公開しました! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">出店一覧を公開しました!</p>
            <div class="news_content">
                <p>今年の出店一覧を公開しました！</p>
                <p>今年は以下の26団体が出店します!</p>
                <ul>
                    <?php foreach ($stores as $store) : ?>
                        <li class="store"><?= htmlspecialchars($store['alt'], ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <p>詳細は<a href="../stores.php">出店一覧<a>からご覧ください。</p>
        </main>
     </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>