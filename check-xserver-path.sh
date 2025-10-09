#!/bin/bash
# Xserverのパス確認用スクリプト
# 使い方: ./check-xserver-path.sh [SSHユーザー名] [SSHホスト]

SSH_USER=$1
SSH_HOST=$2
SSH_PORT=10022

if [ -z "$SSH_USER" ] || [ -z "$SSH_HOST" ]; then
    echo "使い方: ./check-xserver-path.sh [SSHユーザー名] [SSHホスト]"
    echo "例: ./check-xserver-path.sh xs123456 sv12345.xserver.jp"
    exit 1
fi

echo "=== Xserverに接続してパスを確認します ==="
echo "SSHユーザー名: $SSH_USER"
echo "SSHホスト: $SSH_HOST"
echo ""

# SSH接続して現在のパスとWordPressの場所を確認
ssh -p $SSH_PORT -i ~/.ssh/xserver_euni_deploy $SSH_USER@$SSH_HOST << 'ENDSSH'
echo "=== ホームディレクトリ ==="
pwd
echo ""

echo "=== ドメイン一覧 ==="
ls -la ~/
echo ""

echo "=== WordPressインストール場所を検索中 ==="
find ~/ -name "wp-config.php" -type f 2>/dev/null | head -5
echo ""

echo "=== themesディレクトリを検索中 ==="
find ~/ -path "*/wp-content/themes" -type d 2>/dev/null | head -5
echo ""
ENDSSH
