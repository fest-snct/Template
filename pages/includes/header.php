<header>
    <?php $currentPage = $_SERVER['SCRIPT_NAME']; // 現在のファイル名（例: /pages/stores.php）?>
    <div class="mini_logo">
        <img src="https://img.skin/80x80/000/fff/?text=logo&fmt=png" />
    </div>
    <div class="index">
        <a class="title" href="../home.php">高専祭2025</a>
        <div class="subtitles">
            <a class="subtitle <?= $currentPage == '/2025/pages/greeting.php' ? 'is-current' : '' ?>" href="./greeting.php">ご挨拶</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/event.php' ? 'is-current' : '' ?>" href="./event.php">イベント企画</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/stores.php' ? 'is-current' : '' ?>" href="./stores.php">出店一覧</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/access.php' ? 'is-current' : '' ?>" href="./access.php">アクセス</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/news.php' ? 'is-current' : '' ?>" href="./news.php">ニュース</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/Q&A.php' ? 'is-current' : '' ?>" href="./Q&A.php">Q&A</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/contact.php' ? 'is-current' : '' ?>" href="./contact.php">お問い合わせ</a>
            <a class="subtitle <?= $currentPage == '/2025/pages/privacypolicy.php' ? 'is-current' : '' ?>" href="./privacypolicy.php">プライバシーポリシー</a>
        </div>
    </div>
    <div class="menu">
        <img src="../images/menu.png" alt="Menu Icon" />
    </div>
    <?php include __DIR__ . '/hamburgermenu.php' ; ?>
</header>