@extends('layouts.app')

@section('content')
<div class="signinPage">
    <div class='container'>
        <h2 class='title'>商品登録</h2>

        <form class="new_user" id="new_user" action="/products/store" accept-charset="UTF-8" method="post">
            @csrf
            <div class="form-group">
                <label for="name">商品名</label><br>
                <input id="name" type="text" class="form-control" name="name" required autofocus>
            </div>
            <div class="form-group">
                <label for="product_code">商品コード</label><br>
                <input id="product_code" type="text" class="form-control" name="product_code">
            </div>
            <div class="form-group">
                <label for="image">商品画像</label><br>
                <input id="image" type="file" class="test" name="image" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="commit" value="上記内容で商品を登録" class="loginBtn" data-disable-with="登録中...">
            </div>
        </form>

    </div>
</div>
@endsection