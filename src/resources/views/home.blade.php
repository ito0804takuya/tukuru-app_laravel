@extends('layouts.app')

@section('content')
<div class="topPage">
    <div class="left">
        <ul class="sidenav">
            <li><a class="active" href="/products"><i class="fas fa-car"></i> 商品一覧</a></li>
            <li><a href="/parts"><i class="fas fa-wrench"></i> 部品一覧</a></li>
            <li><a href="/products">About</a></li>
        </ul>
    </div>
    <div class="right">
        <div class='title-area'>
            <p class='title'><i class="fas fa-car"></i> 商品一覧</p>
            <a class="create-product-btn" href="/products/create"><i class="fas fa-plus"></i> 商品を新規登録</a>
        </div>
        <div class="search">
            <form action="{{route('products.index')}}" accept-charset="UTF-8" method="get">
                <div class="search__top">
                    <div class="search__top__left">
                        <label for="product_name">商品名</label>
                        <input id="product_name" type="text" class="form-control" name="search_product_name" value="@if(isset($request['search_product_name'])){{$request['search_product_name']}}@endif">
                    </div>
                    <div class="search__top__right search_product_code">
                        <label for="product_code">商品コード</label>
                        <input id="product_code" type="text" class="form-control" name="search_product_code" value="@if(isset($request['search_product_code'])){{$request['search_product_code']}}@endif">
                    </div>
                </div>
                <div class="search__bottom">
                    <div class="search__bottom__left">
                        <div class="search__bottom__left__box">
                            <label for="created_user_name">作成者名</label>
                            <input id="created_user_name" type="text" class="form-control" name="search_created_user_name" value="@if(isset($request['search_created_user_name'])){{$request['search_created_user_name']}}@endif">
                        </div>
                        <div class="search__bottom__left__box">
                            <label for="updated_user_name">更新者名</label>
                            <input id="updated_user_name" type="text" class="form-control" name="search_updated_user_name" value="@if(isset($request['search_updated_user_name'])){{$request['search_updated_user_name']}}@endif">
                        </div>
                    </div>
                    <div class="search__bottom__right">
                        <div class="search__bottom__right__box">
                            <label>作成日時</label>
                            <input type="date" name="created_from" value="@if(isset($request['created_from'])){{$request['created_from']}}@endif">
                            <span>~</span>
                            <input type="date" name="created_until" value="@if(isset($request['created_until'])){{$request['created_until']}}@endif">
                        </div>
                        <div class="search__bottom__right__box">
                            <label>更新日時</label>
                            <input type="date" name="updated_from" value="@if(isset($request['updated_from'])){{$request['updated_from']}}@endif">
                            <span>~</span>
                            <input type="date" name="updated_until" value="@if(isset($request['updated_until'])){{$request['updated_until']}}@endif">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="検索" class="searchBtn">
                    <input type="reset" value="リセット" class="searchBtn reset">
                </div>
            </form>
        </div>
        <div class="paginate">1 2 3...</div>
        <table>
            <tr>
                <th>商品名</th>
                <th>商品コード</th>
                <th>作成者</th>
                <th>作成日</th>
                <th>最終更新者</th>
                <th>最終更新日</th>
            </tr>
            @foreach($products as $product)
            <tr class="lovelyrow" onclick="location.href='/products/{{$product->id}}'">
                <td class="product-name">{{$product->name}}</td>
                <td>{{$product->product_code}}</td>
                <td>{{$product->createdUser->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{isset($product->updatedUser->name) ? $product->updatedUser->name : ''}}</td>

                <td>{{$product->updated_at}}</td>
            </tr>
            @endforeach
        </table>

        <div class="paginate">1 2 3...</div>
    </div>
</div>
@endsection