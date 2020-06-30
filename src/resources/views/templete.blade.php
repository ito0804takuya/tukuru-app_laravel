<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TUKURU</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
      <div class='header'>
        <div class='header__text'>
          商品と部品の管理システム
        </div>
        <div class='header__bar'>
          <div class='header__bar__logo'>
            <a class='tukuru-logo' href="/">TUKURU</a>
          </div>
          <div class='header__bar__signup'>
            <a class='signup-btn' href="https://laravel.com/docs">マイページ</a>
          </div>
          <div class='header__bar__signup'>
            <a class='signup-btn' href="https://laravel.com/docs">TUKURUを使う</a>
          </div>
        </div>
      </div>
      @yield('content')
      </body>
</html>