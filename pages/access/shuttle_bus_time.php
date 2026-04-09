<?php
require_once __DIR__ . '/../../config/site.php';

// OGP settings
$ogp_title = 'シャトルバス運行情報 | ' . $site_config['festival_label'];
$ogp_description = $site_config['festival_label'] . 'で運行するシャトルバスの、次の発車時刻をお知らせします。';

session_start();
$nonce = base64_encode(random_bytes(16));
$_SESSION['nonce'] = $nonce;
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <?php include '../includes/header-favicon.php'; ?>
    <link rel="stylesheet" href="../../css/shuttle_bus.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../../js/shuttle_bus.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
    <script src="../../js/shuttle_bus_times.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <div class="wrapper">
        <main>
            <div class="wrp">
                <div class="b_wrap">
                    <div class="via"><span class="via_ul">仙台高専広瀬<span class="via_small">行</span></span></div>
                    <div class="bustime">16:20</div>
                    <div class="more">最終便です</div>
                </div>
                <div class="b_wrap">
                    <div class="via"><span class="via_ul">愛子駅南口<span class="via_small">行</span></span></div>
                    <div class="bustime">16:20</div>
                    <div class="less">16:50</div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
</body>
