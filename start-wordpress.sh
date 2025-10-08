#!/bin/bash
echo "========================================="
echo "Euniテーマ WordPressローカル起動"
echo "========================================="
echo ""
echo "wp-nowをインストール中..."
npm install -g @wp-now/wp-now

echo ""
echo "WordPressを起動しています..."
echo "ブラウザで http://localhost:8881 を開いてください"
echo ""
echo "デフォルトログイン情報:"
echo "  ユーザー名: admin"
echo "  パスワード: password"
echo ""
echo "Ctrl+C で停止できます"
echo "========================================="
echo ""

npx @wp-now/wp-now start --path=euni-theme
