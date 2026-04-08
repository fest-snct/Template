<?php
/**
 * stores_array.php
 *
 * data/stores.json を読み込んで $stores 配列を提供します。
 * 以前は PHP 配列をハードコードしていましたが、
 * 出店情報の編集は data/stores.json を直接編集してください。
 */
$stores = json_decode(
    file_get_contents(__DIR__ . '/../../data/stores.json'),
    true
);
