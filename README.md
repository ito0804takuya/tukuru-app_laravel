## 目次
- アプリの名称
- アプリの概要、目的
- 使い方
- 使用技術
- 実装機能
- DB設計

## アプリの名称
### TUKURU

## アプリの概要、目的
製造業向けを想定した、商品・部品管理システムです。  
商品・部品のそれぞれについて、CRUD機能を設けています。  
何らかの形でものづくりをする人々の力になりたいという思いから、考案しました。  

## 使い方
### URL
http://13.231.189.5
### テスト用アカウント：  
- メールアドレス: tukuru@example.com
- パスワード: P@ssw0rd

## 使用技術
### フロント
- HTML
- Scss  
- Javascript
### サーバサイド
- Laravel(6.18.25)
### インフラ
- DB：MySQL  
- コンテナ：Docker  
- サーバー：AWS ECS(EC2), RDS, S3, VPC, IAM  
- バージョン管理：github

## 実装機能
- CRUD機能
- ユーザログイン・ログアウト
- 画像アップロード
- ページネーション
- 単体テスト
- DBテーブルのリレーション管理

## DB設計
### productsテーブル
|Column|Type|Options|
|------|----|-------|
|name|string|unique|
|created_user_id|integer||
|updated_user_id|integer|nullable|
#### アソシエーション
- belongsToMany :parts, through :product_parts

### partsテーブル
|Column|Type|Options|
|------|----|-------|
|name|string|unique|
|supplier_id|integer||
|created_user_id|integer||
|updated_user_id|integer|nullable|
#### アソシエーション
- belongsToMany :products, through :product_parts
- belongsTo :supplier

### product_partsテーブル
|Column|Type|Options|
|------|----|-------|
|product_id|integer||
|part_id|integer||
#### アソシエーション
- hasMany :products
- hasMany :parts

### suppliersテーブル
|column|Type|Option|
|-------|----|-----|
|name|string||
#### アソシエーション
- has_many :part

### usersテーブル
|column|Type|Option|
|-------|----|-----|
|name|string||
|email|string|unique|
|password|string||
#### アソシエーション
- has_many :products
