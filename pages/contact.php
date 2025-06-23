<?php
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
    <title>お問い合わせ | 高専祭2025</title>
    <link rel="stylesheet" href="../css/contact.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <main>
        <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
        <div class="contact_header">
            <p class="title">お問い合わせ</p>
            <p>お問い合わせいただいた内容は確認後、担当者よりご返信させていただきます。</p>
            <p>※記入いただいた個人情報は、ご本人の同意なく第三者に提供することはございません。</p>
            <p>※詳細は<a href="privacypolicy.php">プライバシーポリシー</a>を確認してください。</p>
        </div>
        <div class="form">
            <form action="./endpoint/send_mail.php" method="POST" class="contact-form">
                <input type="hidden" name="nonce" value="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-group">
                    <label for="name">お名前 <span class="required">必須</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス <span class="required">必須</span></label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">お問い合わせ内容 <span class="required">必須</span></label>
                    <textarea id="message" name="message" rows="10" required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit">送信する</button>
                </div>
            </form>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>