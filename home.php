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
    <header>
        <?php $currentPage = $_SERVER['SCRIPT_NAME']; // 現在のファイル名（例: /pages/stores.php）?>
        <div class="mini_logo">
            <img src="https://img.skin/80x80/000/fff/?text=logo&fmt=png" />
        </div>
        <div class="index">
            <a class="title" href="./home.php">高専祭2025</a>
            <div class="subtitles">
                <p class="subtitle">ご挨拶</p>
                <a class="subtitle <?= $currentPage == './pages/stores.php' ? 'is-current' : '' ?>" href="./pages/stores.php">企画一覧</a>
                <a class="subtitle <?= $currentPage == './pages/access.php' ? 'is-current' : '' ?>" href="./pages/access.php">アクセス</a>
                <p class="subtitle">ニュース</p>
                <p class="subtitle">Q&A</p>
                <a class="subtitle <?= $currentPage == './pages/contact.php' ? 'is-current' : '' ?>" href="./pages/contact.php">お問い合わせ</a>
                <a class="subtitle <?= $currentPage == './pages/privacypolicy.php' ? 'is-current' : '' ?>" href="./pages/privacypolicy.php">プライバシーポリシー</a>
            </div>
        </div>
        <div class="menu">
            <img src="./images/menu.png" alt="Menu Icon" />
        </div>
        <nav id="hamburger-menu" class="hamburger-menu">
            <!-- アニメーション部分 -->
            <div class="drop"></div>
            <div class="wave"></div>

            <div class="hamburger-menu__inner">
                <a href="./home.php" class="hamburger-menu__item title">ホーム</a>
                <a href="#" class="hamburger-menu__item">ご挨拶</a>
                <a href="./pages/stores.php" class="hamburger-menu__item">企画一覧</a>
                <a href="./pages/access.php" class="hamburger-menu__item">アクセス</a>
                <a href="#" class="hamburger-menu__item">ニュース</a>
                <a href="#" class="hamburger-menu__item">Q&A</a>
                <a href="./pages/contact.php" class="hamburger-menu__item">お問い合わせ</a>
                <a href="./pages//privacypolicy.php" class="hamburger-menu__item">プライバシーポリシー</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="main_logo">
            <img src="./images/icon.png" alt="Main Image" />
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer_menu">
                <a class="title" href="./home.php">ホーム</a>
                <div class="subtitles">
                    <p class="subtitle">ご挨拶</p>
                    <a class="subtitle" href="./pages/stores.php">企画一覧</a>
                    <a class="subtitle" href="./pages/access.php">アクセス</a>
                    <p class="subtitle">ニュース</p>
                    <p class="subtitle">Q&A</p>
                    <a class="subtitle" href="./pages/contact.php">お問い合わせ</a>
                    <a class="subtitle" href="./pages/privacypolicy.php">プライバシーポリシー</a>
                </div>
            </div>
            <div>
                <P>© 2025 高専祭実行委員会 - 仙台高等専門学校広瀬キャンパス</P>
            </div>
        </div>
    </footer>
</body>
</html>