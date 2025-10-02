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

include './includes/stores_array.php';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出店一覧 | 高専祭2025</title>
    <link rel="stylesheet" href="../css/stores.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/stores.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8'); ?>" defer></script>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8'); ?>" defer></script>
</head>

<body>
    <?php include_once './includes/header.php'; ?>
    <main>
        <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
        <p class="title">出店一覧</p>
        <div id="s_container">
            <?php foreach ($stores as $store) : ?>
                <figure id="<?= htmlspecialchars($store['id'], ENT_QUOTES, 'UTF-8') ?>" class="s_items" data-description='<?= htmlspecialchars($store['description'], ENT_QUOTES, 'UTF-8') ?>'>
                    <img src="<?= htmlspecialchars($store['image'], ENT_QUOTES, 'UTF-8') ?>" class="s_pic" alt="<?= htmlspecialchars($store['alt'], ENT_QUOTES, 'UTF-8') ?>" />
                </figure>
            <?php endforeach; ?>
        </div>
        <div class="border"></div>
        <p class="b_title">教職員の出店</p>
        <div class="b_container">
            <p class="b_name">たのしい？理科実験・体験教室</p>
            <div class="b_info">出店場所：3-103</div>
            <p class="b_name">卒業生との交流会</p>
            <div class="b_info">出店場所：11-301</div>
            <div class="b_info">※10月25日土曜のみ</div>
            <p class="b_name">ホームカミングルーム</p>
            <div class="b_info">出店場所：2-201</div>
            <p class="b_name">入試相談ブース</p>
            <div class="b_info">出店場所：2-202</div>
            <p class="b_name">後援会バザー</p>
            <div class="b_info">出店場所：ピロティ</div>
            <p class="b_name">図書館</p>
            <div class="b_info">出店場所：図書館</div>
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
                <img src="/2025/images/store_modal_placeholder.webp" id="modal_img" alt="企画名" /><br>
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
    <?php
    if (isset($_GET['store'])) {
        $store_id = $_GET['store'];
        $selected_store_index = -1;
        foreach ($stores as $index => $store) {
            if ($store['id'] === $store_id) {
                $selected_store_index = $index;
                break;
            }
        }

        if ($selected_store_index !== -1) {
            echo "<script nonce='" . htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') . "'>";
            echo "window.addEventListener('load', function() {";
            echo "    const storeElement = document.getElementById('" . htmlspecialchars($store_id, ENT_QUOTES, 'UTF-8') . "');";
            echo "    if (storeElement) { showModal.call({ img_id: " . $selected_store_index . " }, { currentTarget: storeElement }); }";
            echo "});";
            echo "</script>";
        }
    }
    ?>
</body>

</html>