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
    <title>アクセス | 高専祭2025</title>
    <link rel="stylesheet" href="../css/access.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/access.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>

<body>
    <?php include_once './includes/header.php'; ?>
    <main>
        <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
        <p class="title">アクセス</p>
        <div class="content_title">
            <h3>周辺地図</h3>
        </div>
        <div class="content_main">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50114.65604187606!2d140.68124455820308!3d38.2756446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f8a2beee3b9f50b%3A0x5b2959add5f6f104!2z5LuZ5Y-w6auY562J5bCC6ZaA5a2m5qChIOW6g-eArOOCreODo-ODs-ODkeOCuQ!5e0!3m2!1sja!2sjp!4v1723266768948!5m2!1sja!2sjp" id="google_embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><br>
        <span class="a_con_span">
            宮城県仙台市青葉区愛子中央4丁目16-1<br>
            公共交通機関<br>
            JR仙山線 愛子駅より徒歩15分<br>
            仙台市営バス 仙台高専広瀬キャンパス入口より徒歩5分
        </span>
        </div>
        <div class="border"></div>
        <div class="content_title">
            <h3>シャトルバス</h3>
        </div>
        <div class="content_main">
            <p>本校広瀬キャンパスとJR愛子駅を結ぶ無料シャトルバスを運行いたします。</p>
            <a class="time" href="./access/shuttle_bus.php">時刻表はこちら</a>
        </div>
        <div class="border"></div>
        <div class="content_title">
            <h3>急行しらはぎ号</h3>
        </div>
        <div class="content_main center">
            <img src="../images/sirahagi.png" alt="急行しらはぎ号">
            <a class="time" href="./news/04.php">詳しくはこちら</a>
        </div>
    </main>
    <?php include_once './includes/footer.php'; ?>
</body>

</html>