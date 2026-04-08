<?php
require_once __DIR__ . '/../../config/site.php';
$base            = $site_config['base_path'];
$festival_label  = $site_config['festival_name'] . $site_config['year'];
$school_label    = $site_config['school_name'] . $festival_label;
$protocol        = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://');
$default_ogp_img = $protocol . $_SERVER['HTTP_HOST'] . $base . ltrim($site_config['ogp_image_default'], '/');

// OGP 変数（各ページで事前に設定されていなければデフォルト値を使用）
$ogp_title       = isset($ogp_title)       ? $ogp_title       : $school_label;
$ogp_description = isset($ogp_description) ? $ogp_description : $school_label . 'のイベント情報、出店一覧、アクセス情報などを掲載しています。';
$ogp_type        = isset($ogp_type)        ? $ogp_type        : 'website';
$ogp_url         = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$ogp_image       = isset($ogp_image)       ? $ogp_image       : $default_ogp_img;
$ogp_site_name   = $school_label;
?>
<link rel="icon" href="<?= $base ?>favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?= $base ?>favicon.ico" type="image/x-icon">

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
