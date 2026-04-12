<?php
/**
 * site.php — サイト全体の設定ファイル
 *
 * 基本値を定義しつつ、年度ごとの可変データは data/config.json から上書きします。
 * Do `require __DIR__ . '/../config/site.php';` to load $site_config.
 */
$site_config = [

    // ── 基本情報 ────────────────────────────────────────────────
    'year'            => '2025',               // 開催年度
    'festival_name'   => '高専祭',             // 祭名（年度を含まない）
    'school_name'     => '仙台高等専門学校広瀬キャンパス',
    'committee_name'  => '高専祭実行委員会',

    // ── テーマ ──────────────────────────────────────────────────
    'theme'           => '彩風',              // テーマ名
    'theme_reading'   => 'あやかぜ',          // テーマ読み
    'theme_description' => '個性豊かな出店や企画の彩りが、それぞれの色を持ちながらも一つに重なり合い、秋風のように心地よく高専祭全体を包み込む、そんなあたたかく一体感のあるイベントにしたい',

    // ── 開催日程 ────────────────────────────────────────────────
    'dates' => [
        ['label' => '一日目', 'date' => '10月25日(土)', 'time' => '9:30-16:00'],
        ['label' => '二日目', 'date' => '10月26日(日)', 'time' => '9:30-15:00'],
    ],
    'dates_note' => '※時間は変更になる可能性があります。',

    // ── アクセス ────────────────────────────────────────────────
    'access' => [
        'JR仙山線 愛子駅より徒歩15分',
        '仙台市営バス 仙台高専広瀬キャンパス入口より徒歩5分',
    ],

    // ── SNS ─────────────────────────────────────────────────────
    'sns' => [
        'x'         => 'https://x.com/Kosensai_Zitsui',
        'instagram' => 'https://www.instagram.com/hirosekousensai/',
    ],

    // ── パンフレット ─────────────────────────────────────────────
    'pamphlet_file' => 'kosensai2025_pamphlet.pdf',  // attachment/ 以下のファイル名

    // ── URL・パス ────────────────────────────────────────────────
    // サーバー上のプロジェクトルートパス（先頭・末尾スラッシュ付き）
    // 例: GitHub Pages で /2026/ にデプロイするなら '/2026/' に変更する
    'base_path' => '/2025/',

    // ── OGP デフォルト ──────────────────────────────────────────
    'ogp_image_default' => 'images/hp_icon.webp',
];

$config_path = __DIR__ . '/../data/config.json';
if (is_file($config_path)) {
    $json = json_decode(file_get_contents($config_path), true);
    if (is_array($json)) {
        if (!empty($json['year'])) {
            $site_config['year'] = (string) $json['year'];
        }
        if (!empty($json['school_name'])) {
            $site_config['school_name'] = (string) $json['school_name'];
        }
        if (!empty($json['theme'])) {
            $site_config['theme'] = (string) $json['theme'];
        }
        if (!empty($json['theme_kana'])) {
            $site_config['theme_reading'] = (string) $json['theme_kana'];
        }

        $dates = [];
        if (!empty($json['date_day1'])) {
            [$date, $time] = array_pad(explode(' ', (string) $json['date_day1'], 2), 2, '');
            $dates[] = ['label' => '一日目', 'date' => $date, 'time' => $time];
        }
        if (!empty($json['date_day2'])) {
            [$date, $time] = array_pad(explode(' ', (string) $json['date_day2'], 2), 2, '');
            $dates[] = ['label' => '二日目', 'date' => $date, 'time' => $time];
        }
        if ($dates !== []) {
            $site_config['dates'] = $dates;
        }
    }
}

$site_config['festival_label'] = $site_config['festival_name'] . $site_config['year'];
$site_config['base_path'] = '/' . trim($site_config['year'], '/') . '/';
$site_config['pamphlet_file'] = 'kosensai' . $site_config['year'] . '_pamphlet.pdf';
$site_config['ogp_image_default'] = 'images/hp_icon.webp';
