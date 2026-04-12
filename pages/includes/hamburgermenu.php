<?php
require_once __DIR__ . '/../../config/site.php';
$base = $site_config['base_path'];
?>
<nav id="hamburger-menu" class="hamburger-menu">
    <!-- アニメーション部分 -->
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
