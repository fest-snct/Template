<header>
    <?php $currentPage = $_SERVER['SCRIPT_NAME']; // 現在のファイル名（例: /pages/stores.php）?>
    <div class="mini_logo">
        <img src="https://img.skin/80x80/000/fff/?text=logo&fmt=png" />
    </div>
    <div class="index">
        <a class="title" href="../home.php">高専祭2025</a>
        <div class="subtitles">
            <p class="subtitle">ご挨拶</p>
            <a class="subtitle <?= $currentPage == '/2025/pages/stores.php' ? 'is-current' : '' ?>" href="./stores.php">企画一覧</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/access.php' ? 'is-current' : '' ?>" href="./access.php">アクセス</a>
            <p class="subtitle">ニュース</p>
            <p class="subtitle">Q&A</p>
            <a class="subtitle <?= $currentPage == '/2025/pages/contact.php' ? 'is-current' : '' ?>" href="./contact.php">お問い合わせ</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/privacypolicy.php' ? 'is-current' : '' ?>" href="./privacypolicy.php">プライバシーポリシー</a>
        </div>
    </div>
    <div class="menu">
        <img src="../images/menu.png" alt="Menu Icon" />
    </div>
    <?php include __DIR__ . '/hamburgermenu.php' ; ?>
</header>