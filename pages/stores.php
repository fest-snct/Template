<?php
session_start();
$nonce = base64_encode(random_bytes(16));
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
    <title>出店一覧 | 高専祭2025</title>
    <link rel="stylesheet" href="../css/stores.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../js/stores.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8'); ?>" defer></script>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8'); ?>" defer></script>
</head>

<body>
    <?php include_once './includes/header.php'; ?>
    <main>
        <p class="title">出店一覧</p>
        <div id="s_container">
            <figure class="s_items" data-description="詳細1">
                <img src="https://img.skin/340x340?text=%E6%BA%96%E5%82%99%E4%B8%AD%E3%81%A7%E3%81%99...&fmt=gif" class="s_pic" alt="企画1" />
            </figure>
            <figure class="s_items" data-description="詳細2">
                <img src="https://img.skin/340x340?text=%E6%BA%96%E5%82%99%E4%B8%AD%E3%81%A7%E3%81%99...&fmt=gif" class="s_pic" alt="企画2" />
            </figure>
            <figure class="s_items" data-description="詳細3">
                <img src="https://img.skin/340x340?text=%E6%BA%96%E5%82%99%E4%B8%AD%E3%81%A7%E3%81%99...&fmt=gif" class="s_pic" alt="企画3" />
            </figure>
        </div>
    </main>
    <div id="modal" class="nodisp">
        <div id="modal_bg"></div>
        <div id="modal_inner">
            <div id="modal_root">
                <div id="modal_head">
                    <button class="close-button">
                        <div class="close-button__line"></div>
                        <div class="close-button__line"></div>
                    </button>
                    <div id="modal_title">
                        企画名
                    </div>
                </div>
                <img src="https://img.skin/340x340?text=%E6%BA%96%E5%82%99%E4%B8%AD%E3%81%A7%E3%81%99...&fmt=gif" id="modal_img" alt="企画名" /><br>
                <div id="modal_place">
                    場所
                </div>
                <div id="modal_txt">
                    出店詳細
                </div>
            </div>
            <a id="prev" class="modal_pn">❮</a>
            <a id="next" class="modal_pn">❯</a>
        </div>
    </div>
    <?php include_once './includes/footer.php'; ?>
</body>

</html>