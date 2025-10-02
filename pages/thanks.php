<?php
// OGP settings
$ogp_title = 'お問い合わせありがとうございます。 | 高専祭2025';
$ogp_description = '高専祭2025へのお問い合わせありがとうございます。';

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
        <title>お問い合わせありがとうございます。</title>
        <link rel="stylesheet" href="../css/thanks.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
        <?php include './includes/header-favicon.php'; ?>
        <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
    </head>
    <body>
        <?php include_once './includes/header.php'; ?>
        <main>
            <div class="thank-you-container">
                <p>お問い合わせありがとうございます。</p>
                <p>以下の内容でお問い合わせを受け付けました。</p>
                <pre class="inquiry-content"><code><?= htmlspecialchars($_SESSION['body'] ?? '', ENT_QUOTES, 'UTF-8'); ?></code></pre>
                <p>確認用メールを送信いたしましたので、確認お願い致します。</p> 
                <p>お問い合わせ内容につきましては、担当者が確認後対応させて頂きます。</p>
            </div>
        </main>
        <?php include_once './includes/footer.php'; ?>
    </body>
</html>