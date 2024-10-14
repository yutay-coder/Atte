# Atte

# アプリケーション名：Atte
社員向けの勤怠管理システム。
会員登録したのちログインして勤務開始・終了、休憩開始・終了の打刻を行う。
また、日別の勤務時間一覧を閲覧することも可能。

## 作成した目的
模擬案件を通して実戦に近い開発経験を積むため。

## アプリケーションURL
ローカル環境で実行。

## 機能一覧
会員登録処理
ログイン処理
ログアウト処理
勤務開始処理
勤務終了処理
休憩開始処理
休憩終了処理
日別勤怠情報取得

## 使用技術(実行環境)
php:7.4.9
Larvalバージョン８
MySQL

URL
開発環境：　http://localhost/
phpMyAdmin:　http://localhost:8080/

## テーブル設計
案件シート.テーブル仕様書　参照

## ER図
https://dbdiagram.io/d/670d1b7e97a66db9a3ea942d


## 環境構築
## クローンしたのち、以下でDockerビルド
docker-compose up -d --build

## Composerでlaravelをインストールする＆確認
docker-compose exec php bash
composer -v

## PHPコンテナにログインし、マイグレーションを実行
php artisan migrate
