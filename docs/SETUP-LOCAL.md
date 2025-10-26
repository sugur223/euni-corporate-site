# Euniテーマ ローカルセットアップ（wp-now）

このプロジェクトのローカル環境は「wp-now + Node.js」を前提としています。以下の手順に従えば、ヒーロー「善き心で、つながろう」まで含めた本番同等の画面を再現できます。

## 1. 必要ソフトの準備
- Node.js（https://nodejs.org/）をインストール
- npm v9 以上を推奨

## 2. WordPress を起動
リポジトリ直下で以下を実行します。

```bash
cd C:\Users\sstec\Downloads\CorporateSite

# 初回のみ wp-now をグローバルインストール
npm install -g @wp-now/wp-now

# 推奨: package.json の npm start を使う
npm start
# 直接指定する場合
# npx @wp-now/wp-now start --path=euni-theme
```

`npm start` で http://localhost:8881 に WordPress が立ち上がります。

## 3. テーマを wp-now 側にコピー（初回のみ）
wp-now は `~/.wp-now/wp-content/playground/themes/` をテーマフォルダとして利用します。以下のコマンドでテーマをコピーしてください。

```bash
cp -R ./euni-theme ~/.wp-now/wp-content/playground/themes/
```

Windows から操作する場合は  
`\\wsl$\<ディストリ名>\home\<ユーザー名>\.wp-now\wp-content\playground\themes\`  
へ `euni-theme` フォルダをドラッグ＆ドロップしても同じです。

> `~/.wp-now` を削除した場合は再度コピーが必要です。通常の再起動ではコピーし直す必要はありません。

## 4. テーマを有効化
1. http://localhost:8881/wp-admin にアクセス（ユーザー `admin` / パスワード `password`）
2. 「外観 > テーマ」で「Euni Corporate Theme」を有効化

## 5. ホームページの表示設定（必須）
フロントページのテンプレートは固定ページ指定が前提です。

1. 固定ページを 1 つ作成（タイトルは「Home」など任意。中身は空でも可）
2. 「設定 > 表示設定」を開き、「ホームページの表示」で「固定ページ」を選択
3. 「ホームページ」プルダウンで作成したページを指定し「変更を保存」

この設定を行わない場合、WordPress は `index.php` を利用し、ヒーローセクションが表示されません。

## 6. 追加の初期設定
- 「外観 > カスタマイズ > 会社情報」で会社名や連絡先を入力
- 「ニュース > 新規追加」でカスタム投稿を確認（投稿が無い場合はダミーが表示されます）
- メニューは header/footer に直書きなので、WordPress のメニュー設定は不要です

## テーマの機能確認
1. ロゴ・会社情報の登録
2. ニュースの投稿と表示確認
3. 以下のショートコードを固定ページで実行し、ブロックの動作を確認

```
[euni_button url="https://euni.co.jp" text="詳しく見る" style="primary"]

[euni_news count="3"]

[euni_box icon="💡" title="ポイント"]
重要な情報をここに記載
[/euni_box]
```

## トラブルシューティング
- `npm start` 時に `EAI_AGAIN` などのネットワークエラーが出る場合は、プロキシ設定やネットワーク接続を確認し、再度実行してください。
- テーマが一覧に出ない / 有効化できない場合は `~/.wp-now/wp-content/playground/themes/euni-theme` が存在しているか確認します。
- トップページが表示されない場合は「設定 > 表示設定」で固定ページがホームに指定されているか確認してください。
- スタイルが崩れる場合は「外観 > カスタマイズ」を開いて保存し直し、ブラウザのキャッシュをクリアします（Ctrl+Shift+R）。

## サポート
それでも問題が解決しない場合は、PHP エラーログ・WordPress のデバッグモード（`wp-config.php` で `WP_DEBUG` を有効化）・ブラウザコンソールを確認し、現象を添えて報告してください。
