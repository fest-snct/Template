<?php
/**
 * ニュース記事共通テンプレート
 *
 * 使い方: 各記事 PHP ファイルで $news_id をセットしてから include する。
 *   $news_id = '01';
 *   include __DIR__ . '/_template.php';
 */

require_once __DIR__ . '/../../config/site.php';

// ── JSON 読み込み ─────────────────────────────────────────────
$json_path = __DIR__ . '/../../data/news/' . $news_id . '.json';
if (!file_exists($json_path)) {
    http_response_code(404);
    exit('記事が見つかりません。');
}
$article = json_decode(file_get_contents($json_path), true);

// ── OGP ─────────────────────────────────────────────────────
$ogp_title       = $article['title'] . ' | ' . $site_config['festival_name'] . $site_config['year'];
$ogp_description = $article['ogp_description'];
$ogp_type        = 'article';
$protocol        = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://');
if ($article['ogp_image']) {
    $ogp_image = $protocol . $_SERVER['HTTP_HOST']
               . $site_config['base_path']
               . ltrim($article['ogp_image'], '/');
}
// ogp_image が null の場合は header-favicon.php がデフォルトを設定する

// ── CSP ──────────────────────────────────────────────────────
session_start();
$nonce = base64_encode(random_bytes(16));
$_SESSION['nonce'] = $nonce;

$extra = $article['extra_csp'] ?? [];
$extra_script = isset($extra['script_src']) ? ' ' . implode(' ', $extra['script_src']) : '';
$extra_frame  = isset($extra['frame_src'])  ? ' ' . implode(' ', $extra['frame_src'])  : '';

header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-{$nonce}'{$extra_script};
    style-src 'self' 'nonce-{$nonce}';
    frame-src 'self'{$extra_frame};
    frame-ancestors 'none';
");

// ── {{STORES_LIST}} 置換（出店一覧記事 用） ────────────────────
$body_html = $article['body_html'];
if (strpos($body_html, '{{STORES_LIST}}') !== false) {
    $stores_json = file_get_contents(__DIR__ . '/../../data/stores.json');
    $stores = json_decode($stores_json, true);
    $li_items = '';
    foreach ($stores as $store) {
        $li_items .= '<li class="store">'
                   . htmlspecialchars($store['alt'], ENT_QUOTES, 'UTF-8')
                   . '</li>' . "\n";
    }
    $body_html = str_replace('{{STORES_LIST}}', '<ul>' . $li_items . '</ul>', $body_html);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include __DIR__ . '/../includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include __DIR__ . '/../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title"><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="news_content">
                <?= $body_html ?>
            </div>
        </main>
    </div>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
