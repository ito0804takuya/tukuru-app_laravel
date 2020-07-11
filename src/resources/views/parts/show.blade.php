@extends('layouts.app')

@section('content')
<div class='show-product'>
    <h2 class='title'><i class="fas fa-wrench"></i> 部品詳細</h2>
    <div class="product-info">
        <div class='top'>
            <div class='product'>
                <h3>{{$part->name}}</h3><br>
            </div>
            <div class='bottons'>
                <a class='edit-btn' href="/products/edit"><i class="fas fa-edit"></i> 編集</a>
                <a class='delete-btn' href="/products/edit"><i class="fas fa-trash-alt"></i> 削除</a>
            </div>
        </div>
        <div class="main">
            <div class='left'>
                <table>
                    <tr>
                        <th>仕入先</th>
                        <td>{{$part->supplier->name}}</td>
                    </tr>
                    <tr>
                        <th>作成者</th>
                        <td>{{$part->createdUser->name}}</td>
                    </tr>
                    <tr>
                        <th>作成日</th>
                        <td>{{$part->created_at}}</td>
                    </tr>
                    <tr>
                        <th>最終更新者</th>
                        <td>{{$part->updatedUser->name}}</td>
                    </tr>
                    <tr>
                        <th>最終更新日</th>
                        <td>{{$part->updated_at}}</td>
                    </tr>
                </table>
                <div class='parts'>
                    <h4><i class="fas fa-car"></i> この部品を使用する商品</h4>
                    <table>
                        @foreach($products as $product)
                        <tr class="lovelyrow" onclick="location.href='/products/{{$product->id}}'">
                            <td>{{$product->name}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection