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
    <title>しらはぎ号が今年も走る! | 高専祭2025</title>
    <link rel="stylesheet" href="../../css/news.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <?php include '/2025/pages/includes/header-favicon.php'; ?>
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">しらはぎ号が今年も走る!</p>
            <div class="news_content">
                <p>今年度の高専祭でも、名取キャンパス後援会及び、広瀬キャンパス後援会のご支援により、名取-広瀬間を結ぶ急行シャトルバス「しらはぎ」を運行いたします。</p>
                <p>なお、10/25（土）、10/26（日）両日運行いたします。</p>

                <div class="flex-container">
                <div class="timetable-wrapper">
                    <div class="timetable-container">
                        <div class="timetable-section">
                            <h4 class="direction-title">名取 → 広瀬</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>便</th>
                                        <th>名取 発</th>
                                        <th>広瀬 着</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1号</td>
                                        <td>10:40</td>
                                        <td>11:25</td>
                                    </tr>
                                    <tr>
                                        <td>3号</td>
                                        <td>14:20</td>
                                        <td>15:05</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="timetable-section">
                            <h4 class="direction-title">広瀬 → 名取</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>便</th>
                                        <th>広瀬 発</th>
                                        <th>名取 着</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2号</td>
                                        <td>11:45</td>
                                        <td>12:30</td>
                                    </tr>
                                    <tr>
                                        <td>4号</td>
                                        <td>15:25</td>
                                        <td>16:10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="notes">
                        <p><strong>ご注意:</strong></p>
                        <ul>
                            <li>発着時刻は目安です。天候や道路状況などにより到着時間は前後する場合がございます。</li>
                            <li>ご乗車には<strong>乗車2分前まで</strong>に急行乗車券の発券が必要です。</li>
                            <li>天候や運行状況により到着時間が前後する場合がございます。あらかじめご了承ください。</li>
                            <li>乗車特典の内容は予告なく変更される可能性がございます。あらかじめご了承ください。</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <img src="../../images/sirahagi.webp" alt="しらはぎ号" class="sirahagi">
                </div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>