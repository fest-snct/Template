# fest-snct_HP2025
仙台高専高専祭2025のHPのリポジトリ

# document

[documentフォルダ](https://github.com/fest-snct/fest-snct_HP2025/tree/main/document)を参照してください。

# 開発の大まかな流れ
1. <del>ワイヤーフレーム(ページデザインの基礎)を作る</del>
2. <del>ページごとの役割分担を行う</del>
3. <del>環境構築(サーバーの設定やlocalhostの設定)</del>
4. 個々人または共同での開発   <-  now
5. リリース

# 補足
基本的にはブランチ分けて開発します  
ブランチ名は`develop_名前` の形式だと分かりやすいので、これでお願いします  
コードレビューは自分がします(自信ないけど、やってみる)

# microCMS 連携
このプロジェクトは `microCMS` を使ったコンテンツ管理に対応しています。  
`MICROCMS_SERVICE_DOMAIN` と `MICROCMS_API_KEY` が設定されている場合は API から取得し、未設定の場合は従来どおり `data/` 配下のローカルファイルを読みます。

## 1. `.env` を作成
`.env.sample` をもとに `.env` を作り、少なくとも以下を設定します。

```env
MICROCMS_SERVICE_DOMAIN="your-service"
MICROCMS_API_KEY="your-api-key"
MICROCMS_NEWS_ENDPOINT="news"
MICROCMS_STORES_ENDPOINT="stores"
MICROCMS_EVENTS_ENDPOINT="events"
```

## 2. microCMS のAPIを作成
以下の3つのAPIを作ると、そのまま繋ぎやすいです。

### `news`
- `title` 文字列
- `slug` 文字列（任意。未設定ならmicroCMSのコンテンツIDを使います）
- `date` 日付（任意。未設定なら `publishedAt` を使います）
- `image` 画像（任意）
- `ogp_description` または `summary` 複数行テキスト（任意）
- `content` リッチエディタ または HTML
- `body_markdown` 複数行テキスト（Markdown運用したい場合のみ）

### `stores`
- `id` 文字列
- `name` 文字列
- `location` 文字列
- `description` 複数行テキスト
- `image` 画像
- `news_slug` 文字列（関連ニュースに飛ばしたい場合）
- `news_link` URL（直接URLを持たせたい場合）

### `events`
- `category` 文字列
- `title` 文字列
- `date` 文字列
- `venue` 文字列
- `description` 複数行テキスト
- `detail_slug` 文字列（既存の `pages/event/*.php` に繋ぐ場合）
- `detail_url` URL（外部URLや任意URLに繋ぐ場合）
- `image` 画像

## 3. 運用イメージ
- 非技術者は `microCMS` のGUIでニュース投稿、画像アップロード、出店登録、イベント更新を行う
- PHP側は `lib/content.php` から `microCMS` APIを読み、一覧や詳細ページに表示する
- `microCMS` 未設定時はローカルデータを読むので、開発中の移行も段階的に進められます
