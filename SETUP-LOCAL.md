# Euniテーマ ローカルセットアップ手順

## 方法1：Local by Flywheel（推奨・最も簡単）

### 1. Local by Flywheelのインストール
1. https://localwp.com/ にアクセス
2. 無料ダウンロード（メールアドレス登録が必要）
3. インストールして起動

### 2. 新規サイト作成
1. 「+ CREATE A NEW SITE」をクリック
2. サイト名：euni-test（任意）
3. 「Preferred」を選択
4. WordPressのユーザー名・パスワードを設定
5. 「ADD SITE」をクリック

### 3. テーマのインストール
1. Localで作成したサイトを右クリック→「Show Folder」
2. `app/public/wp-content/themes/` フォルダを開く
3. この`euni-theme`フォルダをコピー＆ペースト

### 4. テーマの有効化
1. Localで「WP ADMIN」をクリック
2. WordPressにログイン
3. 「外観」→「テーマ」
4. 「Euni Corporate Theme」を有効化

### 5. 初期設定
1. 「外観」→「カスタマイズ」→「会社情報」で情報入力
2. 「外観」→「メニュー」でナビゲーション設定
3. 「設定」→「表示設定」で固定ページを選択

---

## 方法2：wp-now（超簡単・Node.js必要）

### 1. Node.jsのインストール
https://nodejs.org/ からNode.jsをインストール

### 2. wp-nowのインストールと起動
```bash
# コマンドプロンプトで実行
cd C:\Users\sstec\Downloads\CorporateSite

# wp-nowをインストール
npm install -g @wp-now/wp-now

# WordPressを起動
npx @wp-now/wp-now start
```

### 3. ブラウザでアクセス
http://localhost:8881

### 4. テーマの有効化
1. WordPress管理画面にアクセス
2. デフォルトのユーザー名：admin、パスワード：password
3. 「外観」→「テーマ」→「Euni Corporate Theme」を有効化

---

## 方法3：XAMPP（従来の方法）

### 1. XAMPPのインストール
1. https://www.apachefriends.org/ からダウンロード
2. インストール

### 2. WordPressのダウンロード
1. https://ja.wordpress.org/ からダウンロード
2. `C:\xampp\htdocs\euni` に解凍

### 3. データベース作成
1. XAMPPでApache、MySQLを起動
2. http://localhost/phpmyadmin にアクセス
3. 「euni_db」という名前のデータベースを作成

### 4. WordPressのセットアップ
1. http://localhost/euni にアクセス
2. WordPressのインストールを実行
3. データベース情報を入力

### 5. テーマのインストール
1. `euni-theme`フォルダを`C:\xampp\htdocs\euni\wp-content\themes\`にコピー
2. WordPress管理画面で有効化

---

## テーマの機能確認

### 1. 基本設定
- ロゴのアップロード
- 会社情報の入力（カスタマイザー）
- メニューの設定

### 2. ニュースの投稿
- 「ニュース」→「新規追加」
- タイトル、本文、アイキャッチ画像を設定

### 3. ショートコードのテスト
固定ページで以下を試してください：

```
[euni_button url="https://euni.co.jp" text="詳しく見る" style="primary"]

[euni_news count="3"]

[euni_box icon="💡" title="ポイント"]
重要な情報をここに記載
[/euni_box]
```

---

## トラブルシューティング

### エラー：環境要件を満たしていません
- PHP 8.0以上、WordPress 6.0以上が必要です
- Local by Flywheelなら自動で最新版が使用されます

### テーマが表示されない
1. `euni-theme`フォルダが正しい場所にあるか確認
2. `style.css`が存在するか確認
3. ファイルのパーミッションを確認

### スタイルが適用されない
1. 「外観」→「カスタマイズ」を開いて保存
2. ブラウザのキャッシュをクリア（Ctrl+Shift+R）
3. WordPressのキャッシュプラグインをクリア

---

## サポート

問題が解決しない場合は、以下を確認してください：
- PHPエラーログ
- WordPressデバッグモード（wp-config.phpでWP_DEBUGを有効化）
- ブラウザのコンソール（F12）
