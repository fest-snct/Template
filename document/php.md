今回はPHPを使って開発を行います。
各ページの最初に必ず
```php
<?php
session_start();
$nonce = base64_encode(random_bytes(16));
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");
?>
```
を書いてください。
これはセキュリティ設定(CSP対策)です。
あとjsファイルを`<script>タグ`で参照する時は、
```php
<script src="./js/home.js" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" defer></script>
```
で参照させてください。`nonce`を入れることによってXSS対策できます。
CSSも同様に
```php
<link rel="stylesheet" href="./css/home.css" nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
```
で参照させてください。

**注意!!**
絶対にインラインでJSやCSSをかかないでください。