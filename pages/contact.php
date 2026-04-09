<?php
require_once __DIR__ . '/../config/site.php';

// OGP settings
$ogp_title = 'お問い合わせ | ' . $site_config['festival_label'];
$ogp_description = $site_config['festival_label'] . 'へのお問い合わせフォームです。ご不明な点などございましたら、お気軽にお問い合わせください。';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../css/contact.css">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <main>
        <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
        <div class="contact_header">
            <p class="title">お問い合わせ</p>
            <p><?= htmlspecialchars($site_config['festival_label'], ENT_QUOTES, 'UTF-8') ?>へのお問い合わせは、以下のGoogleフォームよりお願いいたします。</p>
            <p>※詳細は<a href="privacypolicy.php">プライバシーポリシー</a>を確認してください。</p>
        </div>
        <div class="form">
            <a href="https://forms.gle/49voKs9D1UwV1hCS7" target="_blank" rel="noopener noreferrer" class="google-form-button">
                Googleフォームでお問い合わせ
            </a>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>
