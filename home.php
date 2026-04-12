<?php
require_once __DIR__ . '/config/site.php';
require_once __DIR__ . '/lib/content.php';

// ── OGP ─────────────────────────────────────────────────────
$ogp_title       = $site_config['school_name'] . $site_config['festival_name'] . $site_config['year'];
$ogp_description = $site_config['school_name'] . 'で' . $site_config['year']
                 . '年に開催される' . $site_config['festival_name']
                 . 'の公式ウェブサイトです。開催日時、ニュース、イベント情報、出店一覧などを確認できます。';

session_start();
$nonce = base64_encode(random_bytes(16));
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");

// ── 出店一覧（ランダム6件） ──────────────────────────────────
$stores = load_stores();
shuffle($stores);
$random_stores = array_slice($stores, 0, 6);

$recent_news = array_slice(load_news_articles(), 0, 5);
$event_list = array_slice(load_events(), 0, 5);

$base = $site_config['base_path']; // e.g. '/2025/'
$festival_label = $site_config['festival_label'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="./css/home.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './pages/includes/header-favicon.php'; ?>
    <script src="./js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
    <script src="./js/home_animation.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <header>
        <?php $currentPage = $_SERVER['SCRIPT_NAME']; ?>
        <div class="mini_logo">
            <img src="./images/logo.webp" />
        </div>
        <div class="index">
            <a class="title" href="<?= $base ?>home.php"><?= htmlspecialchars($festival_label, ENT_QUOTES, 'UTF-8') ?></a>
            <div class="subtitles">
                <a class="subtitle <?= $currentPage == $base . 'pages/greeting.php'     ? 'is-current' : '' ?>" href="./pages/greeting.php">ご挨拶</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/event.php'        ? 'is-current' : '' ?>" href="./pages/event.php">イベント企画</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/stores.php'       ? 'is-current' : '' ?>" href="./pages/stores.php">出店一覧</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/access.php'       ? 'is-current' : '' ?>" href="./pages/access.php">アクセス</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/news.php'         ? 'is-current' : '' ?>" href="./pages/news.php">ニュース</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/Q&A.php'          ? 'is-current' : '' ?>" href="./pages/Q&A.php">Q&A</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/contact.php'      ? 'is-current' : '' ?>" href="./pages/contact.php">お問い合わせ</a>
                <a class="subtitle <?= $currentPage == $base . 'pages/privacypolicy.php'? 'is-current' : '' ?>" href="./pages/privacypolicy.php">プライバシーポリシー</a>
            </div>
        </div>
        <div class="menu">
            <img src="./images/menu.webp" alt="Menu Icon" />
        </div>
        <nav id="hamburger-menu" class="hamburger-menu">
            <div class="drop"></div>
            <div class="wave"></div>
            <div class="hamburger-menu__inner">
                <a href="<?= $base ?>home.php" class="hamburger-menu__item title">ホーム</a>
                <a href="<?= $base ?>pages/greeting.php" class="hamburger-menu__item">ご挨拶</a>
                <a href="<?= $base ?>pages/event.php" class="hamburger-menu__item">イベント企画</a>
                <a href="<?= $base ?>pages/stores.php" class="hamburger-menu__item">出店一覧</a>
                <a href="<?= $base ?>pages/access.php" class="hamburger-menu__item">アクセス</a>
                <a href="<?= $base ?>pages/news.php" class="hamburger-menu__item">ニュース</a>
                <a href="<?= $base ?>pages/Q&A.php" class="hamburger-menu__item">Q&A</a>
                <a href="<?= $base ?>pages/contact.php" class="hamburger-menu__item">お問い合わせ</a>
                <a href="<?= $base ?>pages/privacypolicy.php" class="hamburger-menu__item">プライバシーポリシー</a>
                <a href="<?= htmlspecialchars($site_config['sns']['x'], ENT_QUOTES, 'UTF-8') ?>" class="hamburger-menu__item">X</a>
                <a href="<?= htmlspecialchars($site_config['sns']['instagram'], ENT_QUOTES, 'UTF-8') ?>" class="hamburger-menu__item">Instagram</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="main_logo">
            <img src="./images/hp_icon.webp" alt="Main Image" />
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">開催日時</p>
            <div class="fest_date">
                <?php foreach ($site_config['dates'] as $d): ?>
                <p><?= htmlspecialchars($d['label'] . '：' . $d['date'] . '　　' . $d['time'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
            </div>
            <p><?= htmlspecialchars($site_config['dates_note'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">ニュース</p>
            <div class="news_content">
                <?php foreach ($recent_news as $news):
                    $display_date = str_replace('-', '.', $news['date']);
                    // 年を省いて月日だけ表示（従来の動作に合わせる）
                    $short_date = substr($display_date, 5); // MM.DD
                    $link = build_news_url($news['slug']);
                ?>
                <p>
                    <a href="<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>">
                        <span class="news-date"><?= htmlspecialchars($short_date, ENT_QUOTES, 'UTF-8') ?></span>
                        <?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </p>
                <?php endforeach; ?>
            </div>
            <a href="./pages/news.php" class="about">詳しくはこちら</a>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">校長挨拶</p>
            <div class="greetings_content">
                <p>　今年の<?= htmlspecialchars($site_config['festival_name'], ENT_QUOTES, 'UTF-8') ?>のテーマは「<?= htmlspecialchars($site_config['theme'], ENT_QUOTES, 'UTF-8') ?>」（<?= htmlspecialchars($site_config['theme_reading'], ENT_QUOTES, 'UTF-8') ?>）です。<?= htmlspecialchars($site_config['theme_description'], ENT_QUOTES, 'UTF-8') ?>という思いが込められています。</p>
            </div>
            <a href="./pages/greeting.php" class="about">詳しくはこちら</a>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">パンフレット</p>
            <div class="greetings_content">
                <p>パンフレットをスマホからも見ることができます。</p>
            </div>
            <a href="./attachment/<?= htmlspecialchars($site_config['pamphlet_file'], ENT_QUOTES, 'UTF-8') ?>" class="about">パンフレットはこちら</a>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">イベント</p>
            <div class="event_content">
                <?php foreach ($event_list as $event): ?>
                <p>
                    <a href="<?= htmlspecialchars($event['detail_url'] ?? './pages/event.php', ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </p>
                <?php endforeach; ?>
            </div>
            <a href="./pages/event.php" class="about">詳しくはこちら</a>
        </div>
        <div class="border"></div>
        <div class="main_menu">
            <p class="main_menus">出店一覧</p>
            <div class="stores_content" id="home_stores_container">
                <?php foreach ($random_stores as $store): ?>
                <a href="./pages/stores.php?store=<?= htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <figure class="store_item">
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
                <?php foreach ($site_config['access'] as $line): ?>
                <p><?= htmlspecialchars($line, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
                <a href="./pages/access.php" class="about">詳しくはこちら</a>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer_menu">
                <div class="subtitles">
                    <a class="subtitle" href="<?= $base ?>home.php">ホーム</a>
                    <a class="subtitle" href="<?= $base ?>pages/greeting.php">ご挨拶</a>
                    <a class="subtitle" href="<?= $base ?>pages/event.php">イベント企画</a>
                    <a class="subtitle" href="<?= $base ?>pages/stores.php">出店一覧</a>
                    <a class="subtitle" href="<?= $base ?>pages/access.php">アクセス</a>
                    <a class="subtitle" href="<?= $base ?>pages/news.php">ニュース</a>
                    <a class="subtitle" href="<?= $base ?>pages/Q&A.php">Q&A</a>
                    <a class="subtitle" href="<?= $base ?>pages/contact.php">お問い合わせ</a>
                    <a class="subtitle" href="<?= $base ?>pages/privacypolicy.php">プライバシーポリシー</a>
                    <div class="SNS">
                        <a class="subtitle" href="<?= htmlspecialchars($site_config['sns']['x'], ENT_QUOTES, 'UTF-8') ?>">X</a>
                        <a class="subtitle" href="<?= htmlspecialchars($site_config['sns']['instagram'], ENT_QUOTES, 'UTF-8') ?>">Instagram</a>
                    </div>
                </div>
            </div>
            <div>
                <p>© <?= htmlspecialchars($site_config['year'], ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($site_config['committee_name'], ENT_QUOTES, 'UTF-8') ?> - <?= htmlspecialchars($site_config['school_name'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </div>
    </footer>
</body>
</html>
