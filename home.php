<?php
session_start();
$nonce = base64_encode(random_bytes(16));
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");
require_once './vendor/autoload.php';
// dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$user = $_ENV['BASIC_USER'];
$hashed_pass = $_ENV['BASIC_PASS']; // password_hashで生成した値

if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    $_SERVER['PHP_AUTH_USER'] !== $user ||
    !password_verify($_SERVER['PHP_AUTH_PW'], $hashed_pass)
) {
    header('WWW-Authenticate: Basic realm="Protected Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo '認証が必要です';
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="./js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include_once 'pages/includes/header.php'; ?>
    <main>
        <div class="main_logo">
            <img src="/images/icon.png" alt="Main Image" />
        </div>
    </main>
    <?php include_once 'pages/includes/footer.php'; ?>
</body>
</html>