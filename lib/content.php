<?php

require_once __DIR__ . '/../config/site.php';
require_once __DIR__ . '/Parsedown.php';

function load_stores(): array
{
    $storesPath = __DIR__ . '/../data/stores.json';
    $stores = json_decode(file_get_contents($storesPath), true);

    if (!is_array($stores)) {
        return [];
    }

    return array_values(array_filter(array_map(static function (array $store): array {
        global $site_config;

        $name = $store['name'] ?? extract_store_name($store['alt'] ?? '');
        $location = $store['location'] ?? extract_store_location($store['alt'] ?? '');
        $image = $store['image'] ?? '';
        $newsSlug = $store['news_slug'] ?? extract_news_slug($store['news_link'] ?? null);

        return [
            'id' => (string) ($store['id'] ?? ''),
            'name' => $name,
            'location' => $location,
            'description' => (string) ($store['description'] ?? ''),
            'image' => build_store_image_url($image, $site_config['base_path']),
            'alt' => trim($name . ($location !== '' ? ' 場所: ' . $location : '')),
            'news_slug' => $newsSlug,
            'news_link' => $newsSlug !== null ? build_news_url($newsSlug) : null,
        ];
    }, $stores)));
}

function load_events(): array
{
    $eventsPath = __DIR__ . '/../data/events.json';
    $events = json_decode(file_get_contents($eventsPath), true);

    return is_array($events) ? $events : [];
}

function load_news_articles(bool $includeContent = false): array
{
    $files = glob(__DIR__ . '/../data/news/*.md') ?: [];
    $articles = [];

    foreach ($files as $file) {
        $article = load_news_article_from_file($file, $includeContent);
        if ($article !== null) {
            $articles[] = $article;
        }
    }

    usort($articles, static function (array $a, array $b): int {
        $dateCompare = strcmp($b['date'], $a['date']);
        if ($dateCompare !== 0) {
            return $dateCompare;
        }

        return strcmp($b['slug'], $a['slug']);
    });

    return $articles;
}

function load_news_article(string $slug): ?array
{
    $path = __DIR__ . '/../data/news/' . $slug . '.md';

    return load_news_article_from_file($path, true);
}

function build_news_url(string $slug): string
{
    global $site_config;

    return rtrim($site_config['base_path'], '/') . '/pages/news_article.php?slug=' . rawurlencode($slug);
}

function build_news_image_url(?string $image): string
{
    global $site_config;

    if ($image === null || $image === '') {
        $image = 'icon_yoko.webp';
    }

    if (preg_match('/^https?:\/\//', $image) || str_starts_with($image, '/')) {
        return $image;
    }

    return rtrim($site_config['base_path'], '/') . '/images/' . ltrim($image, '/');
}

function build_store_image_url(string $image, string $basePath): string
{
    if ($image === '') {
        return rtrim($basePath, '/') . '/images/store_modal_placeholder.webp';
    }

    if (preg_match('/^https?:\/\//', $image) || str_starts_with($image, '/')) {
        return $image;
    }

    return rtrim($basePath, '/') . '/images/stores/' . ltrim($image, '/');
}

function group_events_by_category(array $events): array
{
    $grouped = [];
    foreach ($events as $event) {
        $category = $event['category'] ?? 'その他';
        $grouped[$category][] = $event;
    }

    return $grouped;
}

function load_news_article_from_file(string $path, bool $includeContent): ?array
{
    if (!is_file($path)) {
        return null;
    }

    $raw = file_get_contents($path);
    [$frontMatter, $body] = split_front_matter($raw);
    $meta = parse_front_matter($frontMatter);
    $slug = pathinfo($path, PATHINFO_FILENAME);
    $body = ltrim($body);

    $article = [
        'slug' => $slug,
        'title' => (string) ($meta['title'] ?? $slug),
        'date' => (string) ($meta['date'] ?? ''),
        'image' => build_news_image_url($meta['image'] ?? 'icon_yoko.webp'),
        'ogp_description' => (string) ($meta['ogp_description'] ?? build_news_summary($body)),
        'markdown' => $body,
    ];

    if ($includeContent) {
        $article['body_html'] = render_news_body($body);
    }

    return $article;
}

function split_front_matter(string $raw): array
{
    $raw = str_replace(["\r\n", "\r"], "\n", $raw);
    if (preg_match('/\A---\n(.*?)\n---\n?(.*)\z/s', $raw, $matches)) {
        return [$matches[1], $matches[2]];
    }

    return ['', $raw];
}

function parse_front_matter(string $frontMatter): array
{
    $meta = [];
    foreach (explode("\n", $frontMatter) as $line) {
        if (!preg_match('/^([A-Za-z0-9_]+):\s*(.*)$/', trim($line), $matches)) {
            continue;
        }

        $key = $matches[1];
        $value = trim($matches[2]);
        $value = trim($value, "\"'");
        $meta[$key] = $value;
    }

    return $meta;
}

function render_news_body(string $markdown): string
{
    $markdown = str_replace('{{STORES_LIST}}', build_stores_list_markdown(), $markdown);
    $parsedown = new Parsedown();

    return $parsedown->text($markdown);
}

function build_stores_list_markdown(): string
{
    $lines = [];
    foreach (load_stores() as $store) {
        $lines[] = '- ' . $store['name'];
    }

    return implode("\n", $lines);
}

function build_news_summary(string $body): string
{
    $summary = trim(preg_replace('/\s+/u', ' ', strip_tags($body)));
    if ($summary === '') {
        return '';
    }

    return mb_substr($summary, 0, 120);
}

function extract_store_name(string $alt): string
{
    return trim((string) preg_replace('/\s*場所[:：].*$/u', '', $alt));
}

function extract_store_location(string $alt): string
{
    if (preg_match('/場所[:：]\s*(.+)$/u', $alt, $matches)) {
        return trim($matches[1]);
    }

    return '';
}

function extract_news_slug(?string $newsLink): ?string
{
    if ($newsLink === null || $newsLink === '') {
        return null;
    }

    if (preg_match('/slug=([^&]+)/', $newsLink, $matches)) {
        return $matches[1];
    }

    if (preg_match('/\/news\/([0-9A-Za-z_-]+)\.php$/', $newsLink, $matches)) {
        return $matches[1];
    }

    return null;
}
