
# お問い合わせフォーム（お問い合わせシステム）

本プロジェクトは、Laravel を使用したシンプルかつ高機能なお問い合わせ管理システムです。
入力フォーム、確認画面、サンクスページに加え、管理者向けのデータ管理機能を備えています。

## 🌲 プロジェクト概要
- **目的**: ユーザーからの問い合わせを円滑に管理し、管理者側で確認・検索・抽出を可能にする。
- **ターゲット**: ファッションECサイト等のカスタマーサポート。

## 🚀 機能一覧
### ユーザー側
- お問い合わせ入力フォーム
  - バリデーション機能（日本語エラーメッセージ対応）
  - 住所自動入力（※もし実装していれば）
- 入力内容確認画面（修正機能付き）
- 完了画面

### 管理者側
- 管理者ログイン・ログアウト機能
- お問い合わせ一覧表示
  - ページネーション（1ページ7件）
- 検索機能（氏名、性別、お問い合わせ種類、キーワード）
- 詳細表示（モーダルウィンドウ）
- お問い合わせデータの削除
- CSVエクスポート

## 🛠 使用技術
- **Framework**: Laravel Framework 8.83.29
- **Language**: PHP 8.5, HTML, CSS
- **Database**: MySQL [8.0 など]
- **Library**: [Laravel Fortify]

## 📦 環境構築
```bash
# 1. リポジトリのクローン
git clone git@github.com:yurikodoi/contact-form-test.git

# 2. パッケージのインストール
composer install
npm install && npm run dev

# 3. .envの作成とキーの生成
cp .env.example .env
php artisan key:generate

# 4. マイグレーションとシーディング
php artisan migrate --seed