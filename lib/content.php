<?php

require_once __DIR__ . '/../config/site.php';
require_once __DIR__ . '/Parsedown.php';

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

initialize_environment();

function load_stores(): array
{
    if (is_microcms_enabled()) {
        $stores = load_stores_from_microcms();
        if ($stores !== null) {
            return $stores;
        }
    }

    return load_stores_from_file();
}

function load_events(): array
{
    if (is_microcms_enabled()) {
        $events = load_events_from_microcms();
        if ($events !== null) {
            return $events;
        }
    }

    return load_events_from_file();
}

function load_news_articles(bool $includeContent = false): array
{
    if (is_microcms_enabled()) {
        $articles = load_news_articles_from_microcms($includeContent);
        if ($articles !== null) {
            return $articles;
        }
    }

    return load_news_articles_from_files($includeContent);
}

function load_news_article(string $slug): ?array
{
    if ($slug === '') {
        return null;
    }

    if (is_microcms_enabled()) {
        $article = load_news_article_from_microcms($slug);
        if ($article !== null) {
            return $article;
        }
    }

    return load_news_article_from_file(__DIR__ . '/../data/news/' . $slug . '.md', true);
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

function build_event_image_url(?string $image): ?string
{
    global $site_config;

    if ($image === null || $image === '') {
        return null;
    }

    if (preg_match('/^https?:\/\//', $image) || str_starts_with($image, '/')) {
        return $image;
    }

    return rtrim($site_config['base_path'], '/') . '/images/' . ltrim($image, '/');
}

function build_event_detail_url(?string $detailSlug, ?string $detailUrl = null): ?string
{
    global $site_config;

    if ($detailUrl !== null && $detailUrl !== '') {
        return $detailUrl;
    }

    if ($detailSlug === null || $detailSlug === '') {
        return null;
    }

    return rtrim($site_config['base_path'], '/') . '/pages/event/' . rawurlencode($detailSlug) . '.php';
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

function load_stores_from_file(): array
{
    $storesPath = __DIR__ . '/../data/stores.json';
    $stores = json_decode((string) file_get_contents($storesPath), true);

    if (!is_array($stores)) {
        return [];
    }

    return array_values(array_filter(array_map(static function (array $store): array {
        return normalize_store_item($store);
    }, $stores)));
}

function load_events_from_file(): array
{
    $eventsPath = __DIR__ . '/../data/events.json';
    $events = json_decode((string) file_get_contents($eventsPath), true);

    if (!is_array($events)) {
        return [];
    }

    return array_values(array_map(static function (array $event): array {
        return normalize_event_item($event);
    }, $events));
}

function load_news_articles_from_files(bool $includeContent = false): array
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

function load_news_article_from_file(string $path, bool $includeContent): ?array
{
    if (!is_file($path)) {
        return null;
    }

    $raw = (string) file_get_contents($path);
    [$frontMatter, $body] = split_front_matter($raw);
    $meta = parse_front_matter($frontMatter);
    $slug = pathinfo($path, PATHINFO_FILENAME);
    $body = ltrim($body);

    $article = normalize_news_item(array_merge($meta, [
        'slug' => $slug,
        'markdown' => $body,
        'body' => $body,
    ]), $includeContent);

    if (!$includeContent) {
        unset($article['body_html']);
    }

    return $article;
}

function load_stores_from_microcms(): ?array
{
    $stores = microcms_fetch_list(microcms_endpoint('stores'));
    if ($stores === null) {
        return null;
    }

    return array_values(array_filter(array_map(static function (array $store): array {
        return normalize_store_item($store);
    }, $stores)));
}

function load_events_from_microcms(): ?array
{
    $events = microcms_fetch_list(microcms_endpoint('events'));
    if ($events === null) {
        return null;
    }

    return array_values(array_map(static function (array $event): array {
        return normalize_event_item($event);
    }, $events));
}

function load_news_articles_from_microcms(bool $includeContent = false): ?array
{
    $articles = microcms_fetch_list(microcms_endpoint('news'));
    if ($articles === null) {
        return null;
    }

    $normalized = array_values(array_map(static function (array $article) use ($includeContent): array {
        return normalize_news_item($article, $includeContent);
    }, $articles));

    usort($normalized, static function (array $a, array $b): int {
        $dateCompare = strcmp($b['date'], $a['date']);
        if ($dateCompare !== 0) {
            return $dateCompare;
        }

        return strcmp($b['slug'], $a['slug']);
    });

    return $normalized;
}

function load_news_article_from_microcms(string $slug): ?array
{
    $endpoint = microcms_endpoint('news');

    $byId = microcms_fetch_content($endpoint, $slug);
    if ($byId['ok']) {
        return normalize_news_item($byId['data'], true);
    }

    if ($byId['status'] !== 404) {
        return null;
    }

    $bySlug = microcms_fetch_list($endpoint, [
        'filters' => 'slug[equals]' . $slug,
        'limit' => 1,
    ]);

    if ($bySlug === null) {
        return null;
    }

    if ($bySlug !== []) {
        return normalize_news_item($bySlug[0], true);
    }

    return null;
}

function normalize_store_item(array $store): array
{
    global $site_config;

    $name = pick_first_string($store, ['name', 'title']) ?? extract_store_name((string) ($store['alt'] ?? ''));
    $location = pick_first_string($store, ['location', 'place', 'venue']) ?? extract_store_location((string) ($store['alt'] ?? ''));
    $description = pick_first_string($store, ['description', 'body', 'summary']) ?? '';
    $image = pick_asset_url($store, ['image', 'thumbnail', 'eyecatch']) ?? '';
    $newsSlug = pick_first_string($store, ['news_slug']) ?? extract_news_slug(pick_first_string($store, ['news_link']));
    $newsLink = pick_first_string($store, ['news_link']);
    if (($newsLink === null || $newsLink === '') && $newsSlug !== null) {
        $newsLink = build_news_url($newsSlug);
    }

    $id = pick_first_string($store, ['id', 'slug']) ?? slugify_fallback($name);

    return [
        'id' => $id,
        'name' => $name,
        'location' => $location,
        'description' => $description,
        'image' => build_store_image_url($image, $site_config['base_path']),
        'alt' => trim($name . ($location !== '' ? ' 場所: ' . $location : '')),
        'news_slug' => $newsSlug,
        'news_link' => $newsLink,
    ];
}

function normalize_event_item(array $event): array
{
    $detailSlug = pick_first_string($event, ['detail_slug']);
    $detailUrl = pick_first_string($event, ['detail_url', 'url', 'link']);

    return [
        'category' => pick_first_string($event, ['category']) ?? 'その他',
        'title' => pick_first_string($event, ['title', 'name']) ?? '',
        'date' => pick_first_string($event, ['date', 'schedule']) ?? '',
        'venue' => pick_first_string($event, ['venue', 'location', 'place']) ?? '',
        'description' => pick_first_string($event, ['description', 'body', 'summary']) ?? '',
        'detail_slug' => $detailSlug,
        'detail_url' => build_event_detail_url($detailSlug, $detailUrl),
        'image' => build_event_image_url(pick_asset_url($event, ['image', 'thumbnail', 'eyecatch'])),
    ];
}

function normalize_news_item(array $article, bool $includeContent): array
{
    $slug = pick_first_string($article, ['slug', 'id']) ?? '';
    $title = pick_first_string($article, ['title', 'name']) ?? $slug;
    $markdown = pick_first_string($article, ['markdown', 'body_markdown']);
    $body = pick_first_string($article, ['body_html', 'content_html', 'content', 'body']);
    $date = pick_first_string($article, ['date']) ?? pick_date_string($article, ['publishedAt', 'createdAt', 'updatedAt']);
    $image = pick_asset_url($article, ['image', 'thumbnail', 'eyecatch']);
    $summary = pick_first_string($article, ['ogp_description', 'summary', 'excerpt']) ?? '';

    $normalized = [
        'slug' => $slug,
        'title' => $title,
        'date' => $date,
        'image' => build_news_image_url($image),
        'ogp_description' => $summary !== '' ? $summary : build_news_summary((string) ($body ?? $markdown ?? '')),
        'markdown' => $markdown ?? '',
    ];

    if ($includeContent) {
        $normalized['body_html'] = render_content_body($body, $markdown);
    }

    return $normalized;
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

function render_content_body(?string $body, ?string $markdown): string
{
    if ($body !== null && $body !== '') {
        return str_replace('{{STORES_LIST}}', build_stores_list_markdown(), $body);
    }

    if ($markdown !== null && $markdown !== '') {
        return render_news_body($markdown);
    }

    return '';
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

    $query = parse_url($newsLink, PHP_URL_QUERY);
    if (!is_string($query)) {
        return null;
    }

    parse_str($query, $params);

    return isset($params['slug']) ? (string) $params['slug'] : null;
}

function initialize_environment(): void
{
    static $initialized = false;

    if ($initialized) {
        return;
    }

    $initialized = true;

    if (!class_exists('Dotenv\\Dotenv')) {
        return;
    }

    $root = dirname(__DIR__);
    $envPath = $root . '/.env';
    if (!is_file($envPath)) {
        return;
    }

    Dotenv\Dotenv::createImmutable($root)->safeLoad();
}

function is_microcms_enabled(): bool
{
    return microcms_service_domain() !== '' && microcms_api_key() !== '';
}

function microcms_endpoint(string $kind): string
{
    $defaults = [
        'news' => 'news',
        'stores' => 'stores',
        'events' => 'events',
    ];

    return env_value('MICROCMS_' . strtoupper($kind) . '_ENDPOINT', $defaults[$kind] ?? $kind);
}

function microcms_service_domain(): string
{
    return trim((string) env_value('MICROCMS_SERVICE_DOMAIN', ''));
}

function microcms_api_key(): string
{
    return trim((string) env_value('MICROCMS_API_KEY', ''));
}

function microcms_base_url(string $endpoint): string
{
    return 'https://' . microcms_service_domain() . '.microcms.io/api/v1/' . rawurlencode($endpoint);
}

function microcms_fetch_list(string $endpoint, array $queries = []): ?array
{
    $contents = [];
    $offset = 0;
    $limit = isset($queries['limit']) ? max(1, (int) $queries['limit']) : 100;

    do {
        $pageQueries = $queries;
        $pageQueries['limit'] = $limit;
        $pageQueries['offset'] = $offset;

        $response = microcms_get_json(microcms_base_url($endpoint), $pageQueries);
        if (!$response['ok'] || !is_array($response['data'])) {
            return null;
        }

        $pageContents = $response['data']['contents'] ?? [];
        if (!is_array($pageContents)) {
            return null;
        }

        foreach ($pageContents as $item) {
            if (is_array($item)) {
                $contents[] = $item;
            }
        }

        $totalCount = isset($response['data']['totalCount']) ? (int) $response['data']['totalCount'] : count($contents);
        $offset += count($pageContents);
        if (isset($queries['limit'])) {
            break;
        }
    } while ($offset < $totalCount && count($pageContents) > 0);

    return $contents;
}

function microcms_fetch_content(string $endpoint, string $contentId): array
{
    $response = microcms_get_json(microcms_base_url($endpoint) . '/' . rawurlencode($contentId));

    return [
        'ok' => $response['ok'] && is_array($response['data']),
        'status' => $response['status'],
        'data' => is_array($response['data']) ? $response['data'] : null,
    ];
}

function microcms_get_json(string $url, array $queries = []): array
{
    $query = $queries !== [] ? '?' . http_build_query($queries) : '';
    $headers = [
        'X-MICROCMS-API-KEY: ' . microcms_api_key(),
        'Accept: application/json',
    ];
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => implode("\r\n", $headers),
            'ignore_errors' => true,
            'timeout' => 10,
        ],
    ]);

    $response = @file_get_contents($url . $query, false, $context);
    if ($response === false) {
        return [
            'ok' => false,
            'status' => extract_http_status_code($http_response_header ?? []),
            'data' => null,
        ];
    }

    $decoded = json_decode($response, true);

    $status = extract_http_status_code($http_response_header ?? []);

    return [
        'ok' => $status >= 200 && $status < 300 && is_array($decoded),
        'status' => $status,
        'data' => is_array($decoded) ? $decoded : null,
    ];
}

function extract_http_status_code(array $headers): int
{
    foreach ($headers as $header) {
        if (preg_match('/^HTTP\/\S+\s+(\d{3})\b/', $header, $matches)) {
            return (int) $matches[1];
        }
    }

    return 0;
}

function env_value(string $key, mixed $default = null): mixed
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

function pick_first_string(array $item, array $keys): ?string
{
    foreach ($keys as $key) {
        if (!array_key_exists($key, $item)) {
            continue;
        }

        $value = $item[$key];
        if (is_string($value)) {
            $trimmed = trim($value);
            if ($trimmed !== '') {
                return $trimmed;
            }
        }
    }

    return null;
}

function pick_date_string(array $item, array $keys): string
{
    foreach ($keys as $key) {
        if (!isset($item[$key]) || !is_string($item[$key]) || $item[$key] === '') {
            continue;
        }

        return substr($item[$key], 0, 10);
    }

    return '';
}

function pick_asset_url(array $item, array $keys): ?string
{
    foreach ($keys as $key) {
        if (!array_key_exists($key, $item)) {
            continue;
        }

        $value = $item[$key];
        if (is_string($value) && trim($value) !== '') {
            return trim($value);
        }

        if (is_array($value) && isset($value['url']) && is_string($value['url']) && trim($value['url']) !== '') {
            return trim($value['url']);
        }
    }

    return null;
}

function slugify_fallback(string $text): string
{
    $slug = strtolower(trim((string) preg_replace('/[^A-Za-z0-9]+/', '-', $text), '-'));

    return $slug !== '' ? $slug : uniqid('item-', false);
}
