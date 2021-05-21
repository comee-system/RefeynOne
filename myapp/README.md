## webpackのインストール
参考URL
`https://itsakura.com/js-webpack-install`
- さくらさーばーにnpmがはいってないことを忘れていましたのでローカルで作成してjsを上げます




`npm init -y`
   - package.jsonがインストールされる
- npm install コマンドを入力します
`npm install webpack webpack-cli --save-dev`
   - インストールが完了するとnode_modulesというフォルダが作成されます
- webpackを実行してjsを生成します
`.\node_modules\.bin\webpack`

- 入力するコマンドを短縮する
   - package.jsonを変更
```
 "scripts": {
    "test": "webpack"
  },
```
  - `npm run test`で実行可能になる

- npm-watchの install
`npm install npm-watch`
- package.jsonにwatchの追加
```
  "scripts": {
    "test": "webpack",
	"watch": "webpack --watch"
  },

```
- watchコマンド実行
`npm run watch`





# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) (v5) CSS
framework by default. You can, however, replace it with any other library or
custom styles.
