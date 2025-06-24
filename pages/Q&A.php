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
    <title>Q&A | 高専祭2025</title>
    <link rel="stylesheet" href="../css/Q&A.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">Q&A</p>
            <div class="contents">
                <dl class="qa-list">
                    <dt>高専祭の日程はいつですか？</dt>
                    <dd>高専祭は10月25日（土）から10月26日（日）の2日間開催されます。</dd>

                    <dt>高専祭の開催時間は何時から何時までですか？</dt>
                    <dd>高専祭の開催時間は9:30-16:00（25日）/9:30-15:00（26日）です。</dd>

                    <dt>駐車場はありますか？</dt>
                    <dd>学校の駐車場は面談のために来校される保護者様のみご利用いただけます。<br>それ以外のお客様は公共交通機関をご利用ください。</dd>

                    <dt>酒類は提供されますか？</dt>
                    <dd>いいえ、酒類の提供は行われません。また、酒類を校内に持ち込むことはできません。</dd>

                    <dt>緊急事態やトラブルが発生した場合、どこに連絡すればいいですか？</dt>
                    <dd>高専祭受付までお越しいただくか、腕章を付けている近くの実行委員までご連絡ください。</dd>

                    <dt>学生以外の一般の人も参加できますか？</dt>
                    <dd>はい、学生だけでなく一般の方も大歓迎です。大会等への参加も可能です。</dd>

                    <dt>学校の敷地内での喫煙は可能ですか？</dt>
                    <dd>いいえ、学校の敷地内では全面禁煙となっております。</dd>

                    <dt>（保護者向け）担任面談の場所を教えてください。</dt>
                    <dd>教員によって異なります。具体的な場所が不明な場合は受付でご案内します。</dd>
                </dl>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>