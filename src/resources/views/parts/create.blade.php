@extends('layouts.app')

@section('content')
<div class="createProductPage">
    <div class='container'>
        <h2 class='title'><i class="fas fa-wrench"></i> 部品登録</h2>
        <form class="new_user" action="/products/store" accept-charset="UTF-8" method="post">
            @csrf
            <div class="create-product-form create-part-form">
                <div class="product-info">
                    <div class="form-group">
                        <label for="name">部品名</label>
                        <div class="note-mark">必須</div><br>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="supplier">仕入先</label>
                        <div class="note-mark">必須</div><br>
                        <select name="supplier" required>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="commit" value="上記内容で部品を登録" class="loginBtn" data-disable-with="登録中...">
            </div>
        </form>
    </div>
</div>
@endsection