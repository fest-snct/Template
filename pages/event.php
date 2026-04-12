<?php
require_once __DIR__ . '/../config/site.php';
require_once __DIR__ . '/../lib/content.php';

// OGP settings
$ogp_title = 'イベント企画 | ' . $site_config['festival_label'];
$ogp_description = $site_config['festival_label'] . 'のイベント企画一覧。';
$ogp_image = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $site_config['base_path'] . 'images/event/guest.webp';
$events_by_category = group_events_by_category(load_events());

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
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../css/event.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <?php $is_first_category = true; ?>
            <?php foreach ($events_by_category as $category => $events): ?>
            <?php if (!$is_first_category): ?>
            <div class="border"></div>
            <?php endif; ?>
            <p class="title"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></p>
            <div class="events">
                <?php foreach ($events as $event): ?>
                <div class="event">
                    <p class="event-title"><?= htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="description">
                        <?php if (!empty($event['description'])): ?>
                        <p><?= htmlspecialchars($event['description'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <?php if (!empty($event['venue'])): ?>
                        <p>会場: <?= htmlspecialchars($event['venue'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <?php if (!empty($event['date'])): ?>
                        <p>日程: <?= htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <?php if (!empty($event['detail_url'])): ?>
                        <a href="<?= htmlspecialchars($event['detail_url'], ENT_QUOTES, 'UTF-8') ?>" class="detail">詳細はこちら</a>
                        <?php endif; ?>
                        <?php if (!empty($event['image'])): ?>
                        <img src="<?= htmlspecialchars($event['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8') ?>" class="poster-image">
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $is_first_category = false; ?>
            <?php endforeach; ?>
            <div class="border"></div>
            <p class="title">タイムテーブル</p>
            <img class="time-table" src="../images/time-table.webp" alt="タイムテーブル">
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
