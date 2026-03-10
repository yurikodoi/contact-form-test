# お問合せフォーム

Laravelを使用した、お問合せ管理およびユーザー管理システムです。

## 開発環境

- **言語:** PHP 8.x
- **フレームワーク:** Laravel 8.x
- **データベース:** MySQL 8.x
- **ツール:** Docker / Laravel Sail

## 作成した機能

- お問合せフォーム（入力・確認・完了）
- ユーザー登録・ログイン・ログアウト
- 管理画面（一覧表示・詳細表示・検索・削除・CSV出力）
- ページネーション機能

## テーブル設計

### Usersテーブル

| カラム名 | 型      | 備考           |
| :------- | :------ | :------------- |
| id       | bigint  | プライマリキー |
| name     | varchar | ユーザー名     |
| email    | varchar | メールアドレス |
| password | varchar | パスワード     |

### Contactsテーブル

| カラム名    | 型      | 備考                     |
| :---------- | :------ | :----------------------- |
| id          | bigint  | プライマリキー           |
| category_id | bigint  | 外部キー                 |
| first_name  | varchar | 姓                       |
| last_name   | varchar | 名                       |
| gender      | tinyint | 1:男性, 2:女性, 3:その他 |
| email       | varchar | メールアドレス           |
| tel         | varchar | 電話番号                 |
| address     | varchar | 住所                     |
| building    | varchar | 建物名                   |
| detail      | text    | お問合せ内容             |

### Categoriesテーブル

| カラム名 | 型      | 備考           |
| :------- | :------ | :------------- |
| id       | bigint  | プライマリキー |
| content  | varchar | お問合せの種類 |

## ER図

```mermaid
erDiagram
    Users ||--o| Contacts : "作成者(任意)"
    Contacts }|--|| Categories : "種類(必須)"

    Users {
        bigint id PK
        varchar name
        varchar email
        varchar password
    }

    Contacts {
        bigint id PK
        bigint category_id FK
        varchar first_name
        varchar last_name
        tinyint gender "1:男性, 2:女性, 3:その他"
        varchar email
        varchar tel
        varchar address
        varchar building
        text detail
    }

    Categories {
        bigint id PK
        varchar content
    }

```

## 画面一覧

| 画面名               | パス (Path) | ディレクトリ名 | 画面説明                             |
| :------------------- | :---------- | :------------- | :----------------------------------- |
| **お問合せフォーム** | `/`         | `/`            | お問合せ情報の入力                   |
| **確認画面**         | `/confirm`  | `/`            | 入力内容の最終確認                   |
| **サンクスページ**   | `/thanks`   | `/`            | 送信完了の通知                       |
| **ユーザー登録**     | `/register` | `auth`         | 新規ユーザーアカウントの作成         |
| **ログイン**         | `/login`    | `auth`         | 管理画面へのログイン                 |
| **管理画面**         | `/admin`    | `/`            | お問合せ一覧の表示・検索・削除       |
| **ログアウト**       | `/logout`   | -              | セッションを終了しログイン画面へ移動 |
| **CSV出力**          | `/export`   | -              | 検索結果をCSV形式でダウンロード      |

## 環境構築

1. リポジトリをクローン
   ```bash
   git clone git@github.com:your-repo/project.git
   ```
