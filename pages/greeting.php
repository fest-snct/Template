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
    <title>ご挨拶 | 高専祭2025</title>
    <link rel="stylesheet" href="../css/greeting.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '/2025/pages/includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">校長からの挨拶</p>
            <div class="greeting_contents">
                <div class="greeting">
                    <p class="greeting_post">仙台高専校長</p>
                    <p class="greeting_name">橋爪 秀利</p>
                </div>
                <div class="greeting_content">
                    <img src="../images/principal.webp">
                    <div class="greeting_speech">
                        <p>　今年の⾼専祭のテーマは「彩風」（あやかぜ）です。このテーマには「個性豊かな出店や企画の彩りが、それぞれの色を持ちながらも一つに重なり合い、秋風のように心地よく⾼専祭全体を包み込む、そんなあたたかく一体感のあるイベントにしたい」という思いが込められています。</p>
                        <p>　今年の⾼専祭も、個々の個性や多様な考え方を大事にしながら、互いを尊重し合いクラスや学年の枠を越え、様々なイベントを実施し、幸せを感じ笑顔になれることを目指しています。まさに、多様なものを受け入れながら独自性を確立して行くという日本の伝統的良さを再確認すると同時に、世界でも必要とされるマインドではないでしょうか。</p>
                        <p>　学生が生み出す仙台⾼専の新しいパフォーマンスと何事にも挑戦するという活発な学生の姿を通して、本⾼専の創造力と新たな魅力を体験して頂くと同時に、本校の⾼専祭を是非楽しんでください。</p>
                    </div>
                </div>
            </div>
            <div class="border"></div>
            <p class="title">実行委員長からの挨拶</p>
            <div class="greeting_contents">
                <div class="greeting">
                    <p class="greeting_post">高専祭実行委員長</p>
                    <p class="greeting_name">高橋 劉和</p>
                </div>
                <div class="greeting_content">
                    <img src="../images/chairperson.webp">
                    <div class="greeting_speech">
                        <p>　高専祭実行委員長の高橋と申します。今年度も無事に高専祭を開催することができ、大変嬉しく思っております。 </p>
                        <p>　今年度のテーマは『彩風（あやかぜ）』。『彩』あふれる学生たちとその間を吹き抜ける『風』。その２つに焦点を当てたテーマとなっています。コロナ禍が明け、飲食の制限が解除されてからは3年が経ちました。高専祭実行委員会では、「かつての賑わいをもう一度」という思いのもと、様々な試行錯誤を重ねてまいりました。おかげさまで、企画や出店は以前のような活気を着実に取り戻しつつあります。さらに近年は、新しい工夫やよりユニークな挑戦をする団体も増えてきており、私自身も非常に楽しみにしています。</p>
                        <p>　学生たちの思いとエネルギーが重なり合い、この場だからこそ生まれる特別な風があります。ぜひ会場で、学生たちが紡ぎ出す色彩とその風を、全身で感じていただければ幸いです。それでは、今年度の高専祭もどうぞお楽しみください。</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php' ?>
</body>
</html>
