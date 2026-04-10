<?php
function render_breadcrumb() {
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
        '13' => '高専女子プロジェクトです',
        '14' => 'プログラミング部です',
        '15' => '河北新報でご紹介いただきました！',
        '16' => '絶品焼きそば、ここにあり！',
        '17' => '写真部の展示・グッズ販売・フォトスポット',
        '18' => 'Freeカラオケ中止のお知らせ',
        '19' => '高専祭Award!!',
        'guest' => '松本紀生オーロラフォトライブ',
        'card_yuugi' => '遊戯王大会',
        'card_duel' => 'デュエマ大会',
        'puyoteto' => 'ぷよテト大会',
        'cosplay' => 'コスプレ大会',
    ];

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
    $parts = array_values(array_filter(explode('/', trim($path, '/')), static function ($part) {
        return $part !== '' && $part !== '2025' && $part !== 'pages';
    }));

    $breadcrumbs = [
        [
            'label' => 'ホーム',
            'href' => '/2025/home.php',
        ],
    ];

    if ($parts === []) {
        echo '<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li class="bold">ホーム</li></ol></nav>';
        return;
    }

    $normalizedPath = implode('/', $parts);

    $routeMap = [
        'greeting.php' => [
            ['label' => $labelMap['greeting']],
        ],
        'event.php' => [
            ['label' => $labelMap['event']],
        ],
        'stores.php' => [
            ['label' => $labelMap['stores']],
        ],
        'access.php' => [
            ['label' => $labelMap['access']],
        ],
        'access/shuttle_bus.php' => [
            ['label' => $labelMap['access'], 'href' => '/2025/pages/access.php'],
            ['label' => $labelMap['shuttle_bus']],
        ],
        'news.php' => [
            ['label' => $labelMap['news']],
        ],
        'contact.php' => [
            ['label' => $labelMap['contact']],
        ],
        'privacypolicy.php' => [
            ['label' => $labelMap['privacypolicy']],
        ],
        'Q&A.php' => [
            ['label' => 'Q&A'],
        ],
        'event/guest.php' => [
            ['label' => $labelMap['event'], 'href' => '/2025/pages/event.php'],
            ['label' => $labelMap['guest']],
        ],
        'event/card_yuugi.php' => [
            ['label' => $labelMap['event'], 'href' => '/2025/pages/event.php'],
            ['label' => $labelMap['card_yuugi']],
        ],
        'event/card_duel.php' => [
            ['label' => $labelMap['event'], 'href' => '/2025/pages/event.php'],
            ['label' => $labelMap['card_duel']],
        ],
        'event/puyoteto.php' => [
            ['label' => $labelMap['event'], 'href' => '/2025/pages/event.php'],
            ['label' => $labelMap['puyoteto']],
        ],
        'event/cosplay.php' => [
            ['label' => $labelMap['event'], 'href' => '/2025/pages/event.php'],
            ['label' => $labelMap['cosplay']],
        ],
    ];

    foreach (array_keys($labelMap) as $newsSlug) {
        if (preg_match('/^\d+$/', $newsSlug) !== 1) {
            continue;
        }

        $routeMap['news/' . $newsSlug . '.php'] = [
            ['label' => $labelMap['news'], 'href' => '/2025/pages/news.php'],
            ['label' => $labelMap[$newsSlug]],
        ];
    }

    $items = $routeMap[$normalizedPath] ?? [];
    if ($items === []) {
        foreach ($parts as $index => $part) {
            $cleanPart = preg_replace('/\.php$/', '', $part);
            $items[] = [
                'label' => $labelMap[$cleanPart] ?? ucfirst($cleanPart),
                'href' => $index === array_key_last($parts) ? null : '/2025/' . implode('/', array_slice($parts, 0, $index + 1)),
            ];
        }
    }

    foreach ($items as $index => $item) {
        $label = htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8');
        $isLast = $index === array_key_last($items);

        if ($isLast || empty($item['href'])) {
            $breadcrumbs[] = [
                'label' => $label,
                'href' => null,
            ];
            continue;
        }

        $breadcrumbs[] = [
            'label' => $label,
            'href' => $item['href'],
        ];
    }

    $html = '';
    foreach ($breadcrumbs as $index => $breadcrumb) {
        $isLast = $index === array_key_last($breadcrumbs);

        if ($isLast || empty($breadcrumb['href'])) {
            $html .= "<li class='bold'>{$breadcrumb['label']}</li>";
            continue;
        }

        $href = htmlspecialchars($breadcrumb['href'], ENT_QUOTES, 'UTF-8');
        $html .= "<li><a href=\"{$href}\">{$breadcrumb['label']}</a></li>";
    }

    echo '<nav class="breadcrumb" aria-label="Breadcrumb"><ol>' . $html . '</ol></nav>';
}
?>
