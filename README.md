# アプリケーション名
FashionablyLate（お問い合わせフォーム / 管理画面システム）

## 環境構築

### Dockerビルド
* git clone https://github.com/rikom20/contact-form-app.git
* docker-compose up -d --build

### Laravel環境構築
* docker-compose exec php bash
* composer install
* cp .env.example .env
* php artisan key:generate
* php artisan migrate
* php artisan db:seed

### 開発環境（URL）
* お問い合わせ画面：http://localhost/
* ユーザー登録画面：http://localhost/register
* ログイン画面：http://localhost/login
* 管理画面：http://localhost/admin
* phpMyAdmin：http://localhost:8080/

### 使用技術（実行環境）
* PHP 8.1.2
* Laravel 10.50.2
* MySQL 8.4.10
* Tailwind CSS
* Alpine.js

### ER図
```mermaid
erDiagram
    categories ||--o{ contacts : "relation"
    categories {
        bigint id PK
        varchar content "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }
    contacts {
        bigint id PK
        bigint category_id FK
        varchar first_name "NOT NULL"
        varchar last_name "NOT NULL"
        tinyint gender "NOT NULL"
        varchar email "NOT NULL"
        varchar tel "NOT NULL"
        varchar address "NOT NULL"
        varchar building
        text detail "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }
    users {
        bigint id PK
        varchar name "NOT NULL"
        varchar email "NOT NULL"
        varchar password "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }
```