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
    <title>プライバシーポリシー</title>
    <link rel="stylesheet" href="/css/privacypolicy.css">
    <script src="/js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <main>
        <h1 class="page-title">プライバシーポリシー</h1>
        <p class="privacy-content">
            このプライバシーポリシーは、2025年度仙台高専広瀬キャンパス高専祭ウェブサイト（以下、「当サイト」と称します）の訪問者の個人情報の取り扱いに関するものです。当サイトを利用することにより、本プライバシーポリシーに同意したものとみなされます。
        </p>

        <h2 class="privacy-menu">個人情報の使用目的</h2>
        <p class="privacy-content">
            当サイトでは、お問い合わせの際、名前やメールアドレス等の個人情報を入力いただく場合がございます。
            取得した個人情報は、お問い合わせに対する回答や必要な情報を電子メールなどでご連絡する場合に利用させていただくものであり、これらの目的以外には利用いたしません。
        </p>

        <h2 class="privacy-menu">アクセス解析について</h2>
        <p class="privacy-content">
            当サイトは、Google アナリティクスを使用してウェブトラフィックの解析を行います。Googleアナリティクスは、Cookie（クッキー）を使用して訪問者の情報を収集します。
        </p>

        <h2 class="privacy-menu">個人情報の保護と安全性</h2>
        <p class="privacy-content">
            当サイトは、訪問者の個人情報を慎重に管理し、不正アクセス、紛失、改ざん、漏洩などのリスクに対して適切なセキュリティ対策を講じます。
        </p>

        <h2 class="privacy-menu">第三者への提供</h2>
        <p class="privacy-content">
            当サイトは、法令に基づいて要求された場合を除き、訪問者の個人情報を本人の同意無く第三者と共有することはありません。
        </p>

        <h2 class="privacy-menu">プライバシーポリシーの変更</h2>
        <p class="privacy-content">
            本プライバシーポリシーは、事前の予告なく変更することがあります。<br>
            本プライバシーポリシーの変更は、当サイトに掲載された時点で有効となるものとします。
        </p>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>