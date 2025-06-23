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
    ];

    // 現在のURLパスを取得（例: /about/greeting.php）
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    $breadcrumbs = ['<li><a href="/2025/home.php">ホーム</a></li>'];
    $link = '';

    foreach ($parts as $index => $part) {
        $cleanPart = preg_replace('/\.php/', '', $part);

        // 無視対象ならスキップ
        if (in_array($cleanPart, $ignoreList)) {
            continue;
        }

        $link .= '/' . $part;
        $isLast = ($index === array_key_last($parts));

        // ラベル取得
        $label = $labelMap[$cleanPart] ?? ucfirst($cleanPart);

        if ($isLast) {
            $breadcrumbs[] = "<li class='bold'>$label</li>";
        } else {
            $breadcrumbs[] = "<li><a href=\"$link\">$label</a></li>";
        }
    }

    echo '<nav class="breadcrumb" aria-label="Breadcrumb"><ol>' . implode('', $breadcrumbs) . '</ol></nav>';
}
?>
