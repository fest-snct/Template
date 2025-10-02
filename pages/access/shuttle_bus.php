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
    <title>シャトルバス時刻表 | 高専祭2025</title>
    <?php include '../includes/header-favicon.php'; ?>
    <link rel="stylesheet" href="../../css/shuttle_bus.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    <script src="../../js/hamburger.js"nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, "UTF-8"); ?>" defer></script>
</head>
<body>
    <?php include '../includes/header.php' ?>
    <div class="wrapper">
        <main>
            <?php include '../includes/breadcrumb.php'; render_breadcrumb(); ?>
            <p class="title">シャトルバス時刻表</p>
            <div class="content">
                <div class="day_container">
                <div class="timetable-section">
                    <p class="direction-title">仙台高専広瀬 行</p>
                    <table>
                        <thead>
                            <tr>
                                <th>愛子駅</th>
                                <th>仙台高専広瀬</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>9:10 <span>(●2日目のみ)</span></td><td>9:15</td></tr>
                            <tr><td>9:45</td><td>9:50</td></tr>
                            <tr><td>10:35</td><td>10:40</td></tr>
                            <tr><td>11:25</td><td>11:30</td></tr>
                            <tr><td>12:10</td><td>12:15</td></tr>
                            <tr><td>12:55</td><td>13:00</td></tr>
                            <tr><td>13:30</td><td>13:35</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="timetable-section">
                    <p class="direction-title">愛子駅 行</p>
                    <table>
                        <thead>
                            <tr>
                                <th>仙台高専広瀬</th>
                                <th>愛子駅</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>12:40</td><td>12:45</td></tr>
                            <tr><td>13:15</td><td>13:20</td></tr>
                            <tr><td>13:50</td><td>13:55</td></tr>
                            <tr><td>14:35</td><td>14:40</td></tr>
                            <tr><td>15:10</td><td>15:15</td></tr>
                            <tr><td>15:35 <span>(★1日目のみ)</span></td><td>15:40</td></tr>
                            <tr><td>16:10 <span>(★1日目のみ)</span></td><td>16:15</td></tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php' ?>
</body>
</html>
</body>