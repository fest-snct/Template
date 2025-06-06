vscodeの拡張機能の`Live Sass Compiler`をインストール。

settings.jsonに以下を追加
```json
"liveSassCompile.settings.formats": [
        {
            "format": "expanded", 
            "extensionName": ".css",
            "savePath": "/css" // 出力先フォルダ。例: "/css" とするとプロジェクトルートにcssフォルダが作られ、その中に出力される
        }
],
"liveSassCompile.settings.generateMap": false, // mapファイル作成を無効化
```

vscodeの下部に以下のような表示がある

<img width="602" alt="Image" src="https://github.com/user-attachments/assets/df2e159d-5b65-4fa5-b9c3-6a595053306d" />

Watch Sassを押して追跡開始。
scssを保存するたびに、自動コンパイルしてくれる