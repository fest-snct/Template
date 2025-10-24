<?php
function render_breadcrumb() {
    // 無視したいスラップ
    $ignoreList = ['2025', 'pages'];

    // ラベル変換
    $labelMap = [
        'greeting' => 'ご挨拶',
        'event' => 'イベント企画',
        'stores' => '出店一覧',
        'access' => 'アクセス',
        'news' => 'ニュース',
        'contact' => 'お問い合わせ',
        'privacypolicy' => 'プライバシーポリシー',
        'shuttle_bus' => 'シャトルバス時刻表',
        '01' => '2025年度高専祭webサイト公開!',
        '02' => '出店一覧を公開しました!',
        '03' => '松本紀生さんが高専祭にやってくる!',
        '04' => 'しらはぎ号が今年も走る!',
        '05' => 'デュエマ大会を開催します!',
        '06' => '遊戯王大会を開催します!',
        '07' => 'ぷよテト大会を開催します!',
        '08' => 'コスプレ大会を開催します!',
        '09' => '謎解き愛好会からのお知らせ',
        '10' => '部員制作CDとグッズの販売！（DTM部）',
        '11' => '軽音楽部ライブのお知らせ',
        '12' => '吹奏楽部より皆様へ',
        'guest' => '松本紀生オーロラフォトライブ',
        'card_yuugi' => '遊戯王大会',
        'card_duel' => 'デュエマ大会',
        'puyoteto' => 'ぷよテト大会',
    ];

    // 現在のURLパスを取得（例: /about/greeting.php）
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    $breadcrumbs = ['<li><a href="/2025/home.php">ホーム</a></li>'];
    $link = '';
    $displayParts = [];

    foreach ($parts as $index => $part) {
        $cleanPart = preg_replace('/\.php/', '', $part);
        $isLast = ($index === array_key_last($parts));

        // 無視対象ならスキップ
        if (in_array($cleanPart, $ignoreList)) {
            $link .= '/' . $part;
            continue;
        }

        $displayParts[] = $cleanPart;

        // ラベル取得
        $label = $labelMap[$cleanPart] ?? ucfirst($cleanPart);

        if ($isLast) {
            $breadcrumbs[] = "<li class='bold'>$label</li>";
        } else {
            // 中間パーツに対応する .php があるかを仮定
            $phpPath = $_SERVER['DOCUMENT_ROOT'] . '/' . implode('/', array_slice($parts, 0, $index + 1)) . '.php';
            if (file_exists($phpPath)) {
                // ファイルがあれば .php にリンク
                $href = '/' . implode('/', array_slice($parts, 0, $index + 1)) . '.php';
            } else {
                // そうでなければディレクトリリンク
                $href = '/' . implode('/', array_slice($parts, 0, $index + 1)) . '/';
            }
            $breadcrumbs[] = "<li><a href=\"$href\">$label</a></li>";
        }
    }

    echo '<nav class="breadcrumb" aria-label="Breadcrumb"><ol>' . implode('', $breadcrumbs) . '</ol></nav>';
}
?>
