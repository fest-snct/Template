<?php
// OGP settings
$ogp_title = 'ニュース | 高専祭2025';
$ogp_description = '高専祭2025の最新ニュース一覧。';

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
    <title>ニュース | 高専祭2025</title>
    <link rel="stylesheet" href="../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include './includes/header-favicon.php'; ?>
    <script src="../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include './includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include './includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">ニュース一覧</p>
            <div class="news_list">
                <div class="news_item">
                    <a href="./news/19.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.25</p>
                        <p class="news_title"><a href="./news/19.php">高専祭Award!!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/18.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.25</p>
                        <p class="news_title"><a href="./news/18.php">天候によりカラオケが中止となりました</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/17.php">
                        <div class="news_item_top">
                            <img src="../images/news/syashinbu_news.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/17.php">写真部の展示・グッズ販売・フォトスポット</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/16.php">
                        <div class="news_item_top">
                            <img src="../images/news/yakisobaya_news.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/16.php">絶品焼きそば、ここにあり！</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/15.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.25</p>
                        <p class="news_title"><a href="./news/15.php">河北新報でご紹介いただきました！</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/14.php">
                        <div class="news_item_top">
                            <img src="../images/news/probu_news.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/14.php">プログラミング部です</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/13.php">
                        <div class="news_item_top">
                            <img src="../images/stores/kousenjoshipurojekuto.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/13.php">高専女子プロジェクトです</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/12.php">
                        <div class="news_item_top">
                            <img src="../images/news/suisougaku.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/12.php">吹奏楽部より皆様へ</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/11.php">
                        <div class="news_item_top">
                            <img src="../images/news/keionn_news.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/11.php">軽音楽部ライブのお知らせ</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/10.php">
                        <div class="news_item_top">
                            <img src="../images/stores/DTMbu.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/10.php">部員制作CDとグッズの販売！（DTM部）</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/09.php">
                        <div class="news_item_top">
                            <img src="../images/stores/nazotokiaikoukai.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.24</p>
                        <p class="news_title"><a href="./news/09.php">謎解き愛好会からのお知らせ</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/08.php">
                        <div class="news_item_top">
                            <img src="../images/event/kosupure.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.20</p>
                        <p class="news_title"><a href="./news/08.php">コスプレ大会を開催します!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/07.php">
                        <div class="news_item_top">
                            <img src="../images/event/puyoteto.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.17</p>
                        <p class="news_title"><a href="./news/07.php">ぷよテト大会を開催します!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/06.php">
                        <div class="news_item_top">
                            <img src="../images/event/yuugi_poster.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.17</p>
                        <p class="news_title"><a href="./news/06.php">遊戯王大会を開催します!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/05.php">
                        <div class="news_item_top">
                            <img src="../images/event/duel_poster.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.10.17</p>
                        <p class="news_title"><a href="./news/05.php">デュエマ大会を開催します!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/04.php">
                        <div class="news_item_top">
                            <img src="../images/sirahagi.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.09.20</p>
                        <p class="news_title"><a href="./news/04.php">しらはぎ号が今年も走る!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/03.php">
                        <div class="news_item_top">
                            <img src="../images/event/poster.webp" alt="News Image" class="object-position-bottom">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.08.31</p>
                        <p class="news_title"><a href="./news/03.php">松本紀生さんが高専祭にやってくる!</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/02.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    </a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.08.16</p>
                        <p class="news_title"><a href="./news/02.php">出店一覧を公開しました。</a></p>
                    </div>
                </div>
                <div class="news_item">
                    <a href="./news/01.php">
                        <div class="news_item_top">
                            <img src="../images/icon_yoko.webp" alt="News Image">
                        </div>
                    <a>
                    <div class="news_item_bottom">
                        <p class="news_date">2025.06.24</p>
                        <p class="news_title"><a href="./news/01.php">高専祭webサイトを公開しました。</a></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include './includes/footer.php' ?>
</body>
</html>
