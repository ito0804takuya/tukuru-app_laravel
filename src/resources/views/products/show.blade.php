@extends('layouts.app')

@section('content')
<div class='show-product'>
    <h2 class='title'><i class="fas fa-car"></i> 商品詳細</h2>
    <div class="product-info">
        <div class='top'>
            <div class='product'>
                <h3>{{$product->name}}</h3><br>
            </div>
            <div class='bottons'>
                <a class='edit-btn' href="/products/edit">編集</a>
                <a class='delete-btn' href="/products/edit">削除</a>
            </div>
        </div>
        <div class="main">
            <div class='left'>
                <div class='image'></div>
                <table>
                    <tr>
                        <th>商品コード</th>
                        <td>{{$product->product_code}}</td>
                    </tr>
                    <tr>
                        <th>作成者</th>
                        <td>{{$product->createdUser->name}}</td>
                    </tr>
                    <tr>
                        <th>作成日</th>
                        <td>{{$product->created_at}}</td>
                    </tr>
                    <tr>
                        <th>最終更新者</th>
                        <td>{{$product->updatedUser->name}}</td>
                    </tr>
                    <tr>
                        <th>最終更新日</th>
                        <td>{{$product->updated_at}}</td>
                    </tr>
                </table>
                <div class='parts'>
                    <h4><i class="fas fa-wrench"></i> 構成部品</h4>
                    @foreach($parts as $part)
                    <a class="parts-name" href="/parts/{{$part->id}}">・{{$part->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection