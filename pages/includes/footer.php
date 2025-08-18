<?php
$current_file_path = $_SERVER['SCRIPT_NAME'];
$project_root_path = '/2025/';

$levels_up = substr_count($current_file_path, '/') - substr_count($project_root_path, '/');

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
                    <a class="subtitle" href="https://x.com/Kosensai_Zitsui">X</a>
                    <a class="subtitle" href="https://www.instagram.com/hirosekousensai/">Instagram</a>
                </div>
            </div>
        </div>
        <div>
            <P>© 2025 高専祭実行委員会 - 仙台高等専門学校広瀬キャンパス</P>
        </div>
    </div>
</footer>