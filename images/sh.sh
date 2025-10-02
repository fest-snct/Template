#!/bin/bash

find . -type f \( -iname "*.jpg" -o -iname "*.png" -o -iname "*.jpeg" \) -print0 | while IFS= read -r -d '' File; do
    
    # cwebpで変換し、&& そのコマンドが成功した場合のみ、元のファイルをrmで削除する
    cwebp -metadata icc -sharp_yuv "$File" -o "${File%.*}.webp" && rm "$File"

done

echo "変換とオリジナルファイルの削除が完了しました。"