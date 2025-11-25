# mogitate-project

## 環境構築
### リポジトリの設定
% mkdir mogitate<br>
% cd mogitate<br>
% git clone https://github.com/kanayade/mogitate-project<br>
オリジナルのリモートリポジトリを作成し、リモートリポジトリのurlを変更する。<br>
% git remote set-url origin 作成したリポジトリのurl<br>
% git remote -v<br>
ローカルリポジトリの内容をリモートに反映させる。<br>
% git add .<br>
% git commit -m "リモートリポジトリの変更"<br>
% git push origin main<br>
### Dockerの設定
% docker-compose up -d --build<br>
% code .
### Laravelパッケージのインストール
% docker-compose exec php bash<br>
% composer install
### .envファイルの作成
% cp .env.example .env<br>
% exit<br>
.envファイルの修正<br>

```diff
// 前略

DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
+ DB_HOST=mysql
DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=
+ DB_DATABASE=laravel_db
+ DB_USERNAME=laravel_user
+ DB_PASSWORD=laravel_pass

// 後略
```

### アプリケーションキー生成
% php artisan key:generate<br>
### マイグレーション、シーディング
% php artisan migrate --seed

## 使用技術（実行環境）
・PHP 8.2<br>
・Laravel 10.x<br>
・MySQL 8.0<br>
・Docker / Docker Compose<br>

## ER図

## URL
・開発環境：http://localhost/<br>
・phpmyadmin：http://localhost:8080/<br>