<?php
require_once __DIR__ . '/../../config/site.php';

$current_file_path = $_SERVER['SCRIPT_NAME'];
$base              = $site_config['base_path'];

$levels_up = substr_count($current_file_path, '/') - substr_count($base, '/');
$path_to_root = '';
for ($i = 0; $i < $levels_up; $i++) {
    $path_to_root .= '../';
}
if (empty($path_to_root)) {
    $path_to_root = './';
}
?>
<footer>
    <div class="footer-content">
        <div class="footer_menu">
            <div class="subtitles">
                <a class="subtitle" href="<?= $path_to_root ?>home.php">ホーム</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/greeting.php">ご挨拶</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/event.php">イベント企画</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/stores.php">出店一覧</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/access.php">アクセス</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/news.php">ニュース</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/Q&A.php">Q&A</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/contact.php">お問い合わせ</a>
                <a class="subtitle" href="<?= $path_to_root ?>pages/privacypolicy.php">プライバシーポリシー</a>
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
