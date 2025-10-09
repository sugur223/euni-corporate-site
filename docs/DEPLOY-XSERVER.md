# Xserverへの自動デプロイ設定

GitHub Actionsを使用してXserverに自動デプロイする手順です。

## 📋 事前準備

### 1. GitHubリポジトリの作成

1. GitHubで新しいリポジトリを作成（例: `euni-corporate-site`）
2. ローカルリポジトリとリンク

```bash
cd /mnt/c/Users/sstec/Downloads/CorporateSite
git remote add origin https://github.com/YOUR_USERNAME/euni-corporate-site.git
git branch -M main
git push -u origin main
```

### 2. Xserverの接続情報を確認

以下の情報をXserverのサーバーパネルで確認してください。

#### FTP接続情報（FTPデプロイの場合）
- FTPサーバー名（例: `sv12345.xserver.jp`）
- FTPユーザー名（例: `username`）
- FTPパスワード
- 公開ディレクトリパス（例: `/home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/`）

#### SSH接続情報（SSHデプロイの場合 - 推奨）
- SSHホスト（例: `sv12345.xserver.jp`）
- SSHポート（Xserverデフォルト: `10022`）
- SSHユーザー名（例: `username`）
- SSH秘密鍵（事前に生成・登録が必要）
- デプロイ先ディレクトリパス

---

## 🔐 GitHub Secretsの設定

GitHubリポジトリの設定でSecretsを追加します。

### 手順

1. GitHubリポジトリページを開く
2. **Settings** → **Secrets and variables** → **Actions** をクリック
3. **New repository secret** をクリックして以下を追加

### 方法1: FTP接続の場合

以下のSecretsを追加：

| Secret名 | 説明 | 例 |
|---------|------|---|
| `FTP_SERVER` | FTPサーバー名 | `sv12345.xserver.jp` |
| `FTP_USERNAME` | FTPユーザー名 | `username` |
| `FTP_PASSWORD` | FTPパスワード | `your-password` |
| `FTP_SERVER_DIR` | デプロイ先ディレクトリ | `/home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/` |

### 方法2: SSH接続の場合（推奨）

以下のSecretsを追加：

| Secret名 | 説明 | 例 |
|---------|------|---|
| `SSH_HOST` | SSHホスト | `sv12345.xserver.jp` |
| `SSH_USERNAME` | SSHユーザー名 | `username` |
| `SSH_PORT` | SSHポート | `10022` |
| `SSH_PRIVATE_KEY` | SSH秘密鍵（全文） | `-----BEGIN OPENSSH PRIVATE KEY-----...` |
| `SSH_TARGET_DIR` | デプロイ先ディレクトリ | `/home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/` |

---

## 🔑 SSH鍵の生成（SSH接続を使用する場合）

### 1. ローカルで鍵ペアを生成

```bash
# ED25519形式（推奨）
ssh-keygen -t ed25519 -C "github-actions@euni.co.jp" -f ~/.ssh/xserver_deploy

# または RSA形式
ssh-keygen -t rsa -b 4096 -C "github-actions@euni.co.jp" -f ~/.ssh/xserver_deploy
```

パスフレーズは空にしてください（GitHub Actionsで使用するため）。

### 2. 公開鍵をXserverに登録

1. Xserverのサーバーパネルにログイン
2. **SSH設定** を開く
3. **公開鍵登録・更新** をクリック
4. `~/.ssh/xserver_deploy.pub` の内容を貼り付けて登録

```bash
# 公開鍵の内容を表示
cat ~/.ssh/xserver_deploy.pub
```

### 3. 秘密鍵をGitHub Secretsに登録

```bash
# 秘密鍵の内容を表示
cat ~/.ssh/xserver_deploy
```

表示された内容をすべてコピーして、GitHub Secretsの `SSH_PRIVATE_KEY` に登録。

⚠️ **重要**: `-----BEGIN OPENSSH PRIVATE KEY-----` から `-----END OPENSSH PRIVATE KEY-----` まで全てコピーすること。

### 4. 接続テスト

```bash
ssh -p 10022 -i ~/.ssh/xserver_deploy username@sv12345.xserver.jp
```

接続できればOKです。

---

## ⚙️ デプロイ方法の選択

GitHub Variablesで使用するデプロイ方法を設定します。

1. GitHubリポジトリページを開く
2. **Settings** → **Secrets and variables** → **Actions** をクリック
3. **Variables** タブを開く
4. **New repository variable** をクリック

| Variable名 | 値 | 説明 |
|-----------|---|------|
| `DEPLOY_METHOD` | `ftp` または `ssh` | デプロイ方法を選択（空の場合はFTP） |

---

## 🚀 デプロイの実行

### 自動デプロイ

`main` ブランチにpushすると自動的にデプロイが実行されます。

```bash
git add .
git commit -m "Update theme files"
git push origin main
```

### 手動デプロイ

GitHubリポジトリページで：

1. **Actions** タブを開く
2. 左側の **Deploy to Xserver** をクリック
3. **Run workflow** をクリック
4. ブランチを選択して **Run workflow** をクリック

---

## 📝 デプロイされるファイル

以下のファイル・フォルダが `euni-theme/` ディレクトリからデプロイされます：

```
euni-theme/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── front-page.php
├── assets/
├── inc/
├── lib/
└── ...
```

### 除外されるファイル

以下のファイルは除外されます：

- `.git/` - Gitリポジトリ情報
- `.github/` - GitHub Actions設定
- `node_modules/` - Node.jsパッケージ
- `.DS_Store` - macOSシステムファイル
- `*.log` - ログファイル
- `README.md` - ドキュメント（オプション）

---

## 🔍 デプロイの確認

### GitHub Actionsログの確認

1. GitHubリポジトリの **Actions** タブを開く
2. 最新のワークフロー実行をクリック
3. 各ステップのログを確認

### Xserverでの確認

SSHでXserverに接続して確認：

```bash
ssh -p 10022 username@sv12345.xserver.jp
cd /home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/
ls -la
```

### WordPressでの確認

1. WordPress管理画面にログイン
2. **外観** → **テーマ** を開く
3. 「Euni Corporate Theme」が最新バージョンになっているか確認

---

## ⚠️ トラブルシューティング

### エラー: Permission denied

**原因**: ファイルの書き込み権限がない

**解決方法**:
```bash
# SSHでXserverに接続して権限を修正
chmod -R 755 /home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/
```

### エラー: Connection timeout

**原因**: FTP/SSH接続情報が間違っている

**解決方法**:
- GitHub Secretsの設定を再確認
- Xserverのサーバーパネルで接続情報を確認
- ファイアウォール設定を確認

### エラー: Host key verification failed

**原因**: SSHホストキーが未登録

**解決方法**:
ワークフローファイルに以下を追加（セキュリティ上注意が必要）：
```yaml
ARGS: "-avz --delete -e 'ssh -p 10022 -o StrictHostKeyChecking=no'"
```

### デプロイは成功するがファイルが反映されない

**原因**: デプロイ先のパスが間違っている

**解決方法**:
- `FTP_SERVER_DIR` または `SSH_TARGET_DIR` のパスを確認
- 末尾のスラッシュ `/` の有無を確認
- 正しいパス例: `/home/username/yourdomain.com/public_html/wp-content/themes/euni-theme/`

---

## 🔒 セキュリティのベストプラクティス

1. ✅ **Secretsを使用する**
   - パスワードや秘密鍵は必ずGitHub Secretsに保存
   - コードに直接書かない

2. ✅ **SSH接続を推奨**
   - FTPよりもSSH/SFTPの方が安全
   - 可能であればSSH鍵認証を使用

3. ✅ **最小権限の原則**
   - デプロイ用の専用ユーザーを作成
   - 必要最小限の権限のみ付与

4. ✅ **秘密鍵の管理**
   - 秘密鍵はローカルでのみ生成
   - パスフレーズなし（GitHub Actions用）
   - 定期的に鍵をローテーション

5. ✅ **デプロイログの確認**
   - デプロイ後は必ずログを確認
   - 異常があればすぐに対応

---

## 📚 参考リンク

- [Xserver SSH接続設定](https://www.xserver.ne.jp/manual/man_server_ssh.php)
- [GitHub Actions公式ドキュメント](https://docs.github.com/ja/actions)
- [FTP Deploy Action](https://github.com/SamKirkland/FTP-Deploy-Action)
- [SSH Deploy Action](https://github.com/easingthemes/ssh-deploy)

---

**最終更新**: 2025年10月9日
**バージョン**: 1.0
