@extends('layouts.app')

@section('content')
<div class="createProductPage">
    <div class='container'>
        <h2 class='title'><i class="fas fa-car"></i> 商品登録</h2>
        <form class="new_user" action="{{route('products.store')}}" accept-charset="UTF-8" method="post" enctype="multipart/form-data">
            @csrf
            <div class="create-product-form">
                <div class="product-info">
                    <h3>商品情報</h3>
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name">商品名</label>
                        <div class="note-mark">必須</div><br>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('product_code') has-error @enderror">
                        <label for="product_code">商品コード</label><br>
                        <input id="product_code" type="text" class="form-control" name="product_code">
                        @error('product_code')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">商品画像</label>
                        <div class="note-mark">必須</div><br>
                        <div class="preview_box">
                            <input type="file" class="file" name="image" required>
                        </div>
                        @error('image')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="line"></div>
                <div class="parts-info">
                    <h3>構成部品</h3>
                    <p class="note">１つ以上選択</p>
                    <div class="note-mark">必須</div><br>
                    @foreach($parts as $part)
                    <div class="parts-select">
                        <input id="parts" type="checkbox" class="selectBox" name="parts[]" value="{{$part->id}}">
                        <p class="parts-name">{{$part->name}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="commit" value="上記内容で商品を登録" class="loginBtn" data-disable-with="登録中...">
                <input type="button" value="戻る" onclick="history.back()" class="loginBtn backBtn">
            </div>
        </form>

    </div>
</div>
@endsection