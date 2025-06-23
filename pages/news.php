<?php
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
</head>
<body>
    <?php include './includes/header.php' ?>
    <div class="wrapper">
        <main>
            <p class="title">ニュース一覧</p>
            <div class="news_list">
                <div>
                    <img src="https://img.skin/340x340?text=%E6%BA%96%E5%82%99%E4%B8%AD%E3%81%A7%E3%81%99...&fmt=gif" alt="ニュース1" /><br>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php' ?>
</body>
</html>