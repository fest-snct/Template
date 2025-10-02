<link rel="icon" href="/2025/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/2025/favicon.ico" type="image/x-icon">

<?php
// OGP (Open Graph Protocol)
$ogp_title = isset($ogp_title) ? $ogp_title : '仙台高等専門学校広瀬キャンパス高専祭2025';
$ogp_description = isset($ogp_description) ? $ogp_description : '仙台高専広瀬キャンパスで2025年に開催される高専祭の公式ウェブサイトです。イベント情報、出店一覧、アクセス情報などを掲載しています。';
$ogp_type = isset($ogp_type) ? $ogp_type : 'website';
$ogp_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$ogp_image = isset($ogp_image) ? $ogp_image : (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/2025/images/hp_icon.webp';
$ogp_site_name = '仙台高等専門学校広瀬キャンパス高専祭2025';
?>

<meta property="og:title" content="<?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($ogp_description, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="<?= htmlspecialchars($ogp_type, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($ogp_url, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="<?= htmlspecialchars($ogp_image, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:site_name" content="<?= htmlspecialchars($ogp_site_name, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($ogp_description, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($ogp_image, ENT_QUOTES, 'UTF-8') ?>">