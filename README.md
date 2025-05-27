# fest-snct_HP2025
仙台高専高専祭2025のHPのリポジトリ

# 必要なパッケージ等

- SCSS
```bash
sudo apt install ruby-sass
```
scssコンパイルしてcssにする感じでよろ

詳しくは https://github.com/fest-snct/fest-snct_HP2025/issues/3 を参照してくれ

# 開発の大まかな流れ
1. ワイヤーフレーム(ページデザインの基礎)を作る
2. ページごとの役割分担を行う
3. 環境構築(サーバーの設定やlocalhostの設定)
4. 個々人または共同での開発
5. リリース

# Commit Rule
commitは以下のルールに従ってやってみましょう(不便だったら辞める)
```bash
タイプ: 変更内容 (close #関連するIssue番号)
```    
| タイプ     | 説明                                   
|------------|--------------------------------------|
| `fix:`     | バグ修正                             | 
| `edit`     | コード変更 (動作に影響あり)            |
| `feat:`    | 新機能等の追加                         | 
| `ref:`     | リファクタリング（動作に影響なし）     | 
| `docs:`    | ドキュメント修正                     | 

### 例
```bash
git commit -m "fix: ページ遷移できない問題を解決 (close #hoge)"
git commit -m "edit: 画像を張り替え"
git commit -m "feat: お問い合わせページを作成 (close #hoge)"
git commit -m "ref: デバッグを削除"
git commit -m "docs: READMEを更新"
```

# 補足
基本的にはブランチ分けて開発します  
ブランチ名は`develop_名前` の形式だと分かりやすいので、これでお願いします  
コードレビューは自分がします(自信ないけど、やってみる)

