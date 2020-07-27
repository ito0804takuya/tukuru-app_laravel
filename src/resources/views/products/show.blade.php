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
                <a class='edit-btn' href="/products/{{$product->id}}/edit"><i class="fas fa-edit"></i> 編集</a>
                <form class='delete-btn' method="post" name="delete_form" action="{{ route('products.destroy', $product->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <a href="javascript:delete_form.submit()" onclick="return window.confirm('削除しますか？');"><i class="fas fa-trash-alt"></i> 削除</a>
                </form>
            </div>
        </div>
        <div class="main">
            <div class='left'>
                <img class='image' src="{{ asset('storage/images/' . $product->image) }}" alt="" />
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
                        <td>{{isset($product->updatedUser->name) ? $product->updatedUser->name : ''}}</td>
                    </tr>
                    <tr>
                        <th>最終更新日</th>
                        <td>{{$product->updated_at}}</td>
                    </tr>
                </table>
                <div class='parts'>
                    <h4><i class="fas fa-wrench"></i> 構成部品</h4>
                    <table>
                        @foreach($parts as $part)
                        <tr class="lovelyrow" onclick="location.href='/parts/{{$part->id}}'" name="parts" value="{{$part->id}}">
                            <td>{{$part->name}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection