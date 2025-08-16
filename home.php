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

include './pages/includes/stores_array.php';

// Randomly select 6 stores
shuffle($stores);
$random_stores = array_slice($stores, 0, 6);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仙台高等専門学校広瀬キャンパス高専祭2025</title>
    <link rel="stylesheet" href="./css/home.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="./js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
    <script src="./js/home_animation.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
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
                <a class="subtitle <?= $currentPage == './pages/greeting.php' ? 'is-current' : '' ?>" href="./pages/greeting.php">ご挨拶</a>
                <a class="subtitle <?= $currentPage == './pages/event.php' ? 'is-current' : '' ?>" href="./pages/event.php">イベント企画</a>
                <a class="subtitle <?= $currentPage == './pages/stores.php' ? 'is-current' : '' ?>" href="./pages/stores.php">出店一覧</a>
                <a class="subtitle <?= $currentPage == './pages/access.php' ? 'is-current' : '' ?>" href="./pages/access.php">アクセス</a>
                <a class="subtitle <?= $currentPage == './pages/news.php' ? 'is-current' : '' ?>" href="./pages/news.php">ニュース</a>
                <a class="subtitle <?= $currentPage == './pages/Q&A.php' ? 'is-current' : '' ?>" href="./pages/Q&A.php">Q&A</a>
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
                <a href="./pages/greeting.php" class="hamburger-menu__item">ご挨拶</a>
                <a href="./pages/event.php" class="hamburger-menu__item">イベント企画</a>
                <a href="./pages/stores.php" class="hamburger-menu__item">出店一覧</a>
                <a href="./pages/access.php" class="hamburger-menu__item">アクセス</a>
                <a href="./pages/news.php" class="hamburger-menu__item">ニュース</a>
                <a href="./pages/Q&A.php" class="hamburger-menu__item">Q&A</a>
                <a href="./pages/contact.php" class="hamburger-menu__item">お問い合わせ</a>
                <a href="./pages//privacypolicy.php" class="hamburger-menu__item">プライバシーポリシー</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="main_logo">
            <img src="./images/icon.png" alt="Main Image" />
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">開催日時</p>
            <div class="fest_date">
                <p>一日目：10月25日(土)　　9:00-16:00</p>
                <p>二日目：10月26日(日)　　9:00-16:00</p>
            </div>
            <p>※時間は変更になる可能性がありあます。</p>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">ニュース</p>
            <div class="news_content">
            </div>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">校長挨拶</p>
            <div class="greetings_content"></div>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">イベント</p>
            <div class="event_content"></div>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">出店一覧</p>
            <div class="stores_content" id="home_stores_container">
                <?php foreach ($random_stores as $store) : ?>
                    <a href="./pages/stores.php?store=<?= htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <figure class="s_items store-item">
                            <img src="<?= htmlspecialchars($store['image'], ENT_QUOTES, 'UTF-8') ?>" class="s_pic" alt="<?= htmlspecialchars($store['alt'], ENT_QUOTES, 'UTF-8') ?>" />
                        </figure>
                    </a>
                <?php endforeach; ?>
            </div>
            <a href="./pages/stores.php" class="about">詳しくはこちら</a>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">アクセス</p>
            <div class="access_content">
                <p>公共交通機関</p>
                <p>JR仙山線　愛子駅より徒歩15分</p>
                <p>仙台市営バス 仙台高専広瀬キャンパス入口より徒歩5分</p>
                <a href="./pages/access.php" class="about">詳しくはこちら</a>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer_menu">
                <div class="subtitles">
                    <a class="subtitle" href="./home.php">ホーム</a>
                    <a class="subtitle" href="./pages/greeting.php">ご挨拶</a>
                    <a class="subtitle" href="./pages/event.php">イベント企画</a>
                    <a class="subtitle" href="./pages/stores.php">出店一覧</a>
                    <a class="subtitle" href="./pages/access.php">アクセス</a>
                    <a class="subtitle" href="./pages/news.php">ニュース</a>
                    <a class="subtitle" href="./pages/Q&A.php">Q&A</a>
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