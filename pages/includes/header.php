<?php
require_once __DIR__ . '/../../config/site.php';

$current_file_path  = $_SERVER['SCRIPT_NAME'];
$base               = $site_config['base_path']; // e.g. '/2025/'
$festival_label     = $site_config['festival_name'] . $site_config['year'];

$levels_up = substr_count($current_file_path, '/') - substr_count($base, '/');
$path_to_root = '';
for ($i = 0; $i < $levels_up; $i++) {
    $path_to_root .= '../';
}
if (empty($path_to_root)) {
    $path_to_root = './';
}

$currentPage = $_SERVER['SCRIPT_NAME'];
?>
<header>
    <div class="mini_logo">
        <img src="<?= $path_to_root ?>images/logo.webp" />
    </div>
    <div class="index">
        <a class="title" href="<?= $path_to_root ?>home.php"><?= htmlspecialchars($festival_label, ENT_QUOTES, 'UTF-8') ?></a>
        <div class="subtitles">
            <a class="subtitle <?= $currentPage == $base . 'pages/greeting.php'      ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/greeting.php">ご挨拶</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/event.php'         ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/event.php">イベント企画</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/stores.php'        ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/stores.php">出店一覧</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/access.php'        ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/access.php">アクセス</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/news.php'          ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/news.php">ニュース</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/Q&A.php'           ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/Q&A.php">Q&A</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/contact.php'       ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/contact.php">お問い合わせ</a>
            <a class="subtitle <?= $currentPage == $base . 'pages/privacypolicy.php' ? 'is-current' : '' ?>" href="<?= $path_to_root ?>pages/privacypolicy.php">プライバシーポリシー</a>
        </div>
    </div>
    <div class="menu">
        <img src="<?= $path_to_root ?>images/menu.webp" alt="Menu Icon" />
    </div>
    <?php include __DIR__ . '/hamburgermenu.php'; ?>
</header>
