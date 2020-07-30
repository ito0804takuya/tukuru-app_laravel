@extends('layouts.app')

@section('content')
<div class="createProductPage">
  <div class='container'>
    <h2 class='title'><i class="fas fa-car"></i> 商品情報変更</h2>
    <form class="new_user" action="{{ route('products.update', $product->id) }}" accept-charset="UTF-8" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="create-product-form">
        <div class="product-info">
          <h3>商品情報</h3>
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <div class="form-group">
            <label for="name">商品名</label>
            <div class="note-mark">必須</div><br>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus>
          </div>
          <div class="form-group">
            <label for="product_code">商品コード</label><br>
            <input id="product_code" type="text" class="form-control" name="product_code" value="{{ $product->product_code }}">
          </div>
          <div class="form-group">
            <label for="image">商品画像</label>
            <div class="note-mark">必須</div><br>
            <div class="preview_box">
              <input type="file" class="file" name="image">
              <img width="250" src="{{ asset('storage/images/' . $product->image) }}" alt="" />
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="parts-info">
          <h3>構成部品</h3>
          <p class="note">１つ以上選択</p>
          <div class="note-mark">必須</div><br>
          @foreach($parts as $part)
          <div class="parts-select">
            <input type="checkbox" name="parts[]" value="{{ $part->id }}" {{ in_array($part->id, $partsIds, true) ? 'checked="checked"' : '' }}>
            <p class="parts-name">{{$part->name}}</p>
          </div>
          @endforeach
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" name="commit" value="上記内容で商品情報を変更" class="loginBtn" data-disable-with="更新中...">
      </div>
    </form>
  </div>
</div>
@endsection