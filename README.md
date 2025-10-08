# 株式会社Euni コーポレートサイト

株式会社Euni（ユニ）のコーポレートサイト用WordPressカスタムテーマです。

## 会社概要

- **会社名**: 株式会社Euni（ユニ）
- **事業内容**: 若手社会人向けの成長支援コミュニティの企画・運営、つながり支援サービスの開発・提供
- **企業理念**: 善き心でつながり、全ての人がありたい姿を実現できる社会を創造する
- **コアメッセージ**: 「善き心で、つながろう」

## テーマの特徴

- BIZ ELITEテンプレート風のシンプルで洗練されたデザイン
- レスポンシブ対応（モバイル・タブレット・デスクトップ）
- ワンページデザイン（トップページ）
- カスタム投稿タイプ「ニュース」対応
- WordPress管理画面から編集可能な会社情報
- スムーススクロール、アニメーション効果
- SEO対策済み

## テーマ構成

```
euni-theme/
├── style.css                    # テーマ情報
├── functions.php                # テーマ設定
├── index.php                    # フォールバックテンプレート
├── front-page.php               # トップページ
├── page.php                     # 固定ページ
├── single.php                   # 投稿詳細ページ
├── archive.php                  # アーカイブページ（ニュース一覧）
├── 404.php                      # 404エラーページ
├── header.php                   # ヘッダー
├── footer.php                   # フッター
├── screenshot.png               # テーマスクリーンショット（推奨）
├── assets/
│   ├── css/
│   │   └── main.css            # メインスタイルシート
│   ├── js/
│   │   └── main.js             # メインJavaScript
│   └── images/                 # 画像ファイル
├── template-parts/
│   ├── content-philosophy.php  # 企業理念セクション
│   ├── content-service.php     # サービスセクション
│   ├── content-mvv.php         # MVVセクション
│   ├── content-values.php      # Valuesセクション
│   └── content-company.php     # 会社概要セクション
└── inc/
    ├── custom-post-types.php   # カスタム投稿タイプ
    ├── customizer.php          # カスタマイザー設定
    └── enqueue-scripts.php     # CSS/JS読み込み
```

## インストール方法

### 1. WordPressのインストール

1. WordPress 6.0以上をインストール
2. PHP 8.0以上が動作する環境を準備

### 2. テーマのインストール

1. `euni-theme`フォルダを`wp-content/themes/`ディレクトリにコピー
2. WordPress管理画面から「外観」→「テーマ」を開く
3. 「Euni Corporate Theme」を有効化

### 3. 初期設定

#### 会社情報の設定

1. WordPress管理画面から「外観」→「カスタマイズ」を開く
2. 「会社情報」セクションを開く
3. 以下の情報を入力：
   - 代表取締役
   - 設立年月
   - 資本金
   - 所在地
   - メールアドレス
   - 電話番号

#### ロゴの設定

1. 「外観」→「カスタマイズ」→「サイト基本情報」
2. 「ロゴを選択」からロゴ画像をアップロード（推奨サイズ: 200×60px）

#### メニューの設定

1. 「外観」→「メニュー」を開く
2. 新規メニューを作成
3. トップページの各セクションへのアンカーリンクを追加：
   - ホーム: `#hero`
   - 企業理念: `#philosophy`
   - サービス: `#service`
   - MVV: `#mvv`
   - Values: `#values`
   - 会社概要: `#company`
   - お問い合わせ: `#contact`
4. 「Primary Menu」として設定

## 使用方法

### ニュースの投稿

1. WordPress管理画面から「ニュース」→「新規追加」
2. タイトルと本文を入力
3. アイキャッチ画像を設定（推奨サイズ: 800×450px）
4. 公開

### お問い合わせフォームの設定

1. Contact Form 7プラグインをインストール・有効化
2. フォームを作成
3. `front-page.php`の該当箇所に生成されたショートコードを追加

## カスタマイズ

### デザインのカスタマイズ

`assets/css/main.css`のCSS変数を編集することで、カラーやフォントを変更できます：

```css
:root {
    --color-primary: #2563eb;
    --color-gradient-start: #667eea;
    --color-gradient-end: #764ba2;
    --font-family: ...;
}
```

### セクションの編集

トップページの各セクションは`template-parts/`ディレクトリ内のファイルで管理されています。

## 推奨プラグイン

- **Contact Form 7**: お問い合わせフォーム
- **Yoast SEO**: SEO対策
- **WP Super Cache**: キャッシュ最適化
- **Akismet**: スパム対策

## 動作要件

- WordPress 6.0以上
- PHP 8.0以上
- MySQL 5.7以上 / MariaDB 10.3以上

## ブラウザ対応

- Chrome（最新版）
- Firefox（最新版）
- Safari（最新版）
- Edge（最新版）

## セキュリティ

- すべての出力をエスケープ処理
- SQLインジェクション対策
- XSS対策
- CSRF対策（ノンス使用）

## ライセンス

このテーマは株式会社Euniの所有物です。

## 更新履歴

### Version 1.0.0 - 2025年

- 初期リリース
- トップページ実装
- ニュース機能実装
- カスタマイザー設定実装

## サポート

テーマに関するお問い合わせは、以下までご連絡ください：

- Email: [設定したメールアドレス]
- Website: https://euni.co.jp

## 開発者向け情報

### Git管理

このプロジェクトでは、テーマファイルのみをGit管理対象としています。

```bash
# リポジトリの初期化
git init
git add .
git commit -m "Initial commit: Euni corporate theme"
```

### ローカル開発環境

- Local by Flywheel
- MAMP/XAMPP
- Docker (wp-cli)

などの環境で開発可能です。

---

**株式会社Euni** - 善き心で、つながろう
