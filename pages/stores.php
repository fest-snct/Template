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
        <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
        <p class="title">出店一覧</p>
        <div id="s_container">
            <figure class="s_items" data-description="写真部では部員が撮影した写真の展示をしたり、オリジナルグッズの販売を行っています。また、フォトスポットも設営しています。お気軽に寄ってみてください！お待ちしています！">
                <img src="/2025/images/stores/shashinnbu.png" class="s_pic" alt="写真部" />
            </figure>
            <figure class="s_items" data-description="本図書室で不要となった蔵書のほか、地域の方々や仙台市広瀬図書館様が寄贈してくださった本の無償譲渡を行います。">
                <img src="/2025/images/stores/toshoiinkai.png" class="s_pic" alt="図書委員会" />
            </figure>
            <figure class="s_items" data-description="私たち数理科学愛好会では、皆さんに科学への興味を持ってもらえるよう様々な現象の実演や展示をします。ぜひ気軽にお越しください。">
                <img src="/2025/images/stores/suurikagakuaikoukai.png" class="s_pic" alt="数理科学愛好会" />
            </figure>
            <figure class="s_items" data-description="部員が作成した楽曲を収録したCDと、オリジナルMVに登場するかわいいイラストのグッズを販売します！ぜひ、一度ブースへお越しください！">
                <img src="/2025/images/stores/DTMbu.png" class="s_pic" alt="DTM部" />
            </figure>
            <figure class="s_items" data-description="プログラミング部では、おなじみの弾幕ゲームや過去のプログラミングコンテスト出場作品などを展示しています。また、入力したテキストで学習するLLMも設置中です。どんなAIになるかは皆さん次第！">
                <img src="/2025/images/stores/puroguraminngubu.png" class="s_pic" alt="プログラミング部" />
            </figure>
            <figure class="s_items" data-description="科学部は毎年、高専ロボコンに参加しています。高専祭では、ロボットの展示、ロボットの操縦体験、ロボコンの競技説明を行い、科学部の活動やロボコンについて紹介します。">
                <img src="/2025/images/stores/kagakubu.png" class="s_pic" alt="科学部" />
            </figure>
            <figure class="s_items" data-description="高専女子プロジェクトでは、映えるエモいドリンクを販売します！また、フォトスポットや、活動内容を知っていただける展示もご用意しておりますので、ぜひお越しください！">
                <img src="/2025/images/stores/kousenjoshipurojekuto.png" class="s_pic" alt="高専女子プロジェクト" />
            </figure>
            <figure class="s_items" data-description="無料でお茶と和菓子をおもてなしいたします。華道の展示会も行っているのでぜひ足を運んでくれると嬉しいです。">
                <img src="/2025/images/stores/sakadoubu.png" class="s_pic" alt="茶華道部" />
            </figure>
            <figure class="s_items" data-description="1年3組の個性豊かな仲間たちがコスプレをして提供します！　???「やっぱ高専祭といえばコスプレですよねー。え行かない?世間は許してくｒえゃすぇんよ」">
                <img src="/2025/images/stores/zaiseria.png" class="s_pic" alt="ザイセリア" />
            </figure>
            <figure class="s_items" data-description="歩き回って疲れた時は、アツアツたい焼き、香ばしくて大容量のポップコーン、そして冷たいドリンクで一休み！美味しさ満点でエネルギーチャージ！ぜひお立ち寄りください！">
                <img src="/2025/images/stores/daiettoasukaraya.png" class="s_pic" alt="ダイエット明日から屋" />
            </figure>
            <figure class="s_items" data-description="三種のパンケーキにほろにがコーヒーゼリーと爽やかレモンティーをご用意！ぜひお立ち寄りください！">
                <img src="/2025/images/stores/kissaten.pdf.png" class="s_pic" alt="喫茶店.pdf" />
            </figure>
            <figure class="s_items" data-description="一回100円の射的です。的に当てるとお菓子をし一掴みできます。">
                <img src="/2025/images/stores/ennnichiIT2.png" class="s_pic" alt="縁日(IT2)" />
            </figure>
            <figure class="s_items" data-description="山形生まれ山形育ちの店主がプロヂュースした完璧な芋煮です！シンプルな具材と味付けに秘められた可能性は無限大です！ぜひご賞味ください！【山形の芋煮を全国に】">
                <img src="/2025/images/stores/imonigorou.png" class="s_pic" alt="芋煮五郎" />
            </figure>
            <figure class="s_items" data-description="体験型謎解きイベント『一生脱出できない運命からの脱出～開運！脱出みくじ～』を開催！第4回リアル脱出ゲーム甲子園本選出場作品の再演です！脱出の運勢を掴み取れ！">
                <img src="/2025/images/stores/nazotokiaikoukai.png" class="s_pic" alt="謎解き愛好会" />
            </figure>
            <figure class="s_items" data-description="絶対に楽しむことができる縁日です。ほんとのお祭りに来た気分で楽しんでいってねー">
                <img src="https://img.skin/400x300?text=%E6%BF%80%E6%83%85%E3%80%80%E8%8F%AF%E3%81%AE%E3%83%90%E3%83%AC%E3%83%BC%E9%83%A8&fmt=gif" class="s_pic" alt="激情　華のバレー部" />
            </figure>
            <figure class="s_items" data-description="フルーツ飴とチョコバナナを売ってます。仮進級並みにおいしいデザートをお届けします。">
                <img src="/2025/images/stores/nasusennassennburo-ka.png" class="s_pic" alt="那須セン斡旋ブローカ" />
            </figure>
            <figure class="s_items" data-description="【高専生の技術集めました】 プログラミング？電子回路？モデリング？ もちろん全部あります！3Dプリンター製のキーホルダーや光る基板ストラップ、左手デバイスまでも販売中…!? 是非お越しください！">
                <img src="/2025/images/stores/monodukurikennkyuukai.png" class="s_pic" alt="ものづくり研究会" />
            </figure>
            <figure class="s_items" data-description="みんな大好きお祭りなどにあるわたあめです">
                <img src="/2025/images/stores/watagashi.png" class="s_pic" alt="綿菓子" />
            </figure>
            <figure class="s_items" data-description="無線に関する機材や展示などをしています！体験コーナーもあるので無線について気になっている方はぜひ見に来てネ">
                <img src="/2025/images/stores/amatyuamusennbu.png" class="s_pic" alt="アマチュア無線部" />
            </figure>
            <figure class="s_items" data-description="クラゲファクトリーでは、ハンドクリーム・バスボム・クラゲのキーホルダーを自分好みに手作りできます。世界にひとつだけの作品を作ってみよう！">
                <img src="/2025/images/stores/kuragefakutori-.png" class="s_pic" alt="クラゲファクトリー" />
            </figure>
            <figure class="s_items" data-description="『焼きポテサラ』ポテトサラダを鉄板でジュワッと焼き上げた香ばしい逸品。外カリッ、中ホクホクの芋のうま味をたっぷり詰め込んだ一味違うポテサラはいかが？5種のトッピングも併せてご賞味あれ。カルメ焼きもあｒ">
                <img src="/2025/images/stores/yakipotesarakaihatuiinnkai.png" class="s_pic" alt="焼ポテサラ開発委員会" />
            </figure>
            <figure class="s_items" data-description="厳選した食材とソースが織りなす、深みのある味わい。噛むほどに広がる旨味と深い濃いコク。その瞬間、心の中でつぶやく＿＿「焼きそば、正直舐めてました。」そして確信する、これは別次元にうまい！！">
                <img src="/2025/images/stores/yakisobayakennsulin.png" class="s_pic" alt="焼きそば屋けんすぃん" />
            </figure>
            <figure class="s_items" data-description="駄菓子屋と休憩スペースで一息ついていってください❤️ゲーム機設置予定(スマブラ、マリカ、マリパetc…)長居も大歓迎ですヾ(:3ﾉｼヾ)ﾉｼ">
                <img src="/2025/images/stores/dosyudoudagashihannbaiki.png" class="s_pic" alt="ド手動駄菓子販売機" />
            </figure>
            <figure class="s_items" data-description="いつもは味わえない非日常のスリルを体験してみませんか？景品を求め、様々なゲームに挑戦しよう！楽しいカジノの世界へようこそ...">
                <img src="/2025/images/stores/IS4yuushi.png" class="s_pic" alt="IS4有志" />
            </figure>
            <figure class="s_items" data-description="本場、喜多方から直送した多加水縮れ麺、醤油ベースのスープ、やわらかいチャーシューを使った喜多方ラーメン。さらに仙台辛味噌スープと喜多方の麺を掛け合わせた当店オリジナルの一杯もお試しください！">
                <img src="/2025/images/stores/kitakatakousennra-mennka.png" class="s_pic" alt="喜多方高専ラーメン科" />
            </figure>
            <figure class="s_items" data-description="我ら応援団、心も胃袋も熱くする応援団伝統のお好み焼き&quot;焼蔵&quot;を提供いたします。とても美味しく、元気が出るので、お一つ食べに来てはいかがでしょうか。">
                <img src="/2025/images/stores/ouendan.png" class="s_pic" alt="応援団" />
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