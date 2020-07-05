@extends('layouts.app')

@section('content')
<div class="topPage">
    <div class="left">
        <ul class="sidenav">
            <li><a class="active" href="/">商品一覧</a></li>
            <li><a href="/">部品一覧</a></li>
            <li><a href="/">About</a></li>
        </ul>
    </div>
    <div class="right">
        <h3 class="title">商品一覧</h3>
        <p class="test">商品名検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">部品名検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">作成者名検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">更新者名検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">作成日時範囲検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">更新日時範囲検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">検索ボタン</p>
        <div class="paginate">1 2 3...</div>
        <table>
            <tr>
                <th>商品名</th>
                <th>商品コード</th>
                <th>画像</th>
                <th>作成者</th>
                <th>作成日</th>
                <th>最終更新者</th>
                <th>最終更新日</th>
            </tr>
            @foreach($products as $product)
            <tr class="lovelyrow" onclick="location.href='/'">
                <td class="product-name">{{$product->name}}</td>
                <td>{{$product->product_code}}</td>
                <td>画像</td>
                <td>{{$product->createdUser->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updatedUser->name}}</td>
                <td>{{$product->updated_at}}</td>
            </tr>
            @endforeach
        </table>

        <div class="paginate">1 2 3...</div>
    </div>
</div>
@endsection