<?php
require_once __DIR__ . '/../../config/site.php';

// OGP settings
$ogp_title = 'シャトルバス時刻表 | ' . $site_config['festival_label'];
$ogp_description = $site_config['festival_label'] . 'で運行する、本校広瀬キャンパスとJR愛子駅を結ぶ無料シャトルバスの時刻表です。';

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
    <title><?= htmlspecialchars($ogp_title, ENT_QUOTES, 'UTF-8') ?></title>
    <?php include '../includes/header-favicon.php'; ?>
    <link rel="stylesheet" href="../../css/shuttle_bus.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
    <script src="../../js/shuttle_bus.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p id="nxt_bus_t" class="title">次のシャトルバス</p>
            <div id="wrp" class="disp_none">
                <div class="b_wrap">
                    <div class="via"><span class="via_ul">仙台高専広瀬<span class="via_small">行</span></span></div>
                    <div id="bus11" class="bustime b_thank">本日の運行は<br>終了しました</div>
                    <div id="bus12" class="more">最終便です</div>
                </div>
                <div class="b_wrap">
                    <div class="via"><span class="via_ul">愛子駅南口<span class="via_small">行</span></span></div>
                    <div id="bus21" class="bustime">16:20</div>
                    <div id="bus22" class="less">16:50</div>
                </div>
            </div>
            <div id="bustime_notice">
                読み込み中です...
            </div>
            <p class="title">シャトルバス時刻表</p>
            <div class="content">
                <div class="tables_flex">
                    <div class="tables_con">
                        <table class="main_table"><tbody>
                        <tr>
                            <th colspan=7 class="thead">仙台高専広瀬<span class="tbl_small">行</span></th>
                        </tr>
                        <tr>
                            <td class="td_hour">8</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">9</td>
                            <td class="td_left"></td>
                            <td class="td_center"><span class="mark2">10</span></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center">45</td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">10</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center">35</td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">11</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center">25</td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">12</td>
                            <td class="td_left"></td>
                            <td class="td_center">10</td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right">55</td>
                        </tr>
                            <tr class="tr_stripe">
                            <td class="td_hour">13</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center">30</td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">14</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                            <tr class="tr_stripe">
                            <td class="td_hour">15</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">16</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">17</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                    </tbody></table>
                    <div>凡例）<span class="mark_sample2">10</span>：２日目のみの運行</div>
                </div>
                <div class="tables_con">
                    <table class="main_table"><tbody>
                        <tr>
                        <th colspan=7 class="thead">愛子駅南口<span class="tbl_small">行</span></th>
                        </tr>
                        <tr>
                            <td class="td_hour">8</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">9</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">10</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">11</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">12</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center">40</td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">13</td>
                            <td class="td_left"></td>
                            <td class="td_center">15</td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right">50</td>
                        </tr>
                        <tr>
                            <td class="td_hour">14</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center">35</td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">15</td>
                            <td class="td_left"></td>
                            <td class="td_center">10</td>
                            <td class="td_center"></td>
                            <td class="td_center"><span class="mark">35</span></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr>
                            <td class="td_hour">16</td>
                            <td class="td_left"></td>
                            <td class="td_center"><span class="mark">10</span></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                        <tr class="tr_stripe">
                            <td class="td_hour">17</td>
                            <td class="td_left"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_center"></td>
                            <td class="td_right"></td>
                        </tr>
                    </tbody></table>
                    <div>凡例）<span class="mark_sample">35</span>：１日目のみの運行</div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
</body>
