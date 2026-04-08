<?php
function render_breadcrumb() {
    require_once __DIR__ . '/../../config/site.php';

    $base_path = $site_config['base_path']; // e.g. '/2025/'
    // base_path の先頭スラッシュを除いたセグメント群（例: ['2025']）
    $base_segments = array_filter(explode('/', trim($base_path, '/')));

    // ラベル変換マップ（ページ固有のラベル）
    $page_labels = [
        'greeting'      => 'ご挨拶',
        'event'         => 'イベント企画',
        'stores'        => '出店一覧',
        'access'        => 'アクセス',
        'news'          => 'ニュース',
        'contact'       => 'お問い合わせ',
        'privacypolicy' => 'プライバシーポリシー',
        'shuttle_bus'   => 'シャトルバス時刻表',
        'guest'         => '松本紀生オーロラフォトライブ',
        'card_yuugi'    => '遊戯王大会',
        'card_duel'     => 'デュエマ大会',
        'puyoteto'      => 'ぷよテト大会',
        'cosplay'       => 'コスプレ大会',
    ];

    // ニュース記事タイトルを JSON から動的に取得
    $news_labels = [];
    $news_dir = __DIR__ . '/../../data/news/';
    if (is_dir($news_dir)) {
        foreach (glob($news_dir . '*.json') as $file) {
            $item = json_decode(file_get_contents($file), true);
            if ($item && isset($item['id'], $item['title'])) {
                // ゼロ埋め ID と非ゼロ埋め ID 両方に対応（例: '01' と '1'）
                $news_labels[$item['id']] = $item['title'];
                $news_labels[ltrim($item['id'], '0') ?: '0'] = $item['title'];
            }
        }
    }

    $label_map = array_merge($page_labels, $news_labels);

    $path  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($path, '/'));

    $home_href   = $base_path . 'home.php';
    $breadcrumbs = ['<li><a href="' . htmlspecialchars($home_href, ENT_QUOTES, 'UTF-8') . '">ホーム</a></li>'];

    foreach ($parts as $index => $part) {
        $clean = preg_replace('/\.php$/', '', $part);

        // base_path のセグメント（例: '2025'）と 'pages' はスキップ
        if (in_array($clean, $base_segments) || $clean === 'pages') {
            continue;
        }

        $is_last = ($index === array_key_last($parts));
        $label   = $label_map[$clean] ?? ucfirst($clean);

        if ($is_last) {
            $breadcrumbs[] = '<li class="bold">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</li>';
        } else {
            $php_path = $_SERVER['DOCUMENT_ROOT'] . '/' . implode('/', array_slice($parts, 0, $index + 1)) . '.php';
            $href = file_exists($php_path)
                ? '/' . implode('/', array_slice($parts, 0, $index + 1)) . '.php'
                : '/' . implode('/', array_slice($parts, 0, $index + 1)) . '/';
            $breadcrumbs[] = '<li><a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '">'
                           . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</a></li>';
        }
    }

    echo '<nav class="breadcrumb" aria-label="Breadcrumb"><ol>'
       . implode('', $breadcrumbs)
       . '</ol></nav>';
}
?>
