@extends('layouts.app')

@section('content')
<div class="topPage">
    <div class="left">
        <ul class="sidenav">
            <li><a href="/products"><i class="fas fa-car"></i> 商品一覧</a></li>
            <li><a class="active" href="/parts"><i class="fas fa-wrench"></i> 部品一覧</a></li>
            <li><a href="/products">About</a></li>
        </ul>
    </div>
    <div class="right">
        <div class='title-area'>
            <p class='title'><i class="fas fa-wrench"></i> 部品一覧</p>
            <a class="create-product-btn" href="/parts/create"><i class="fas fa-plus"></i> 部品を新規登録</a>
        </div>
        <div class="search">
            <form action="{{route('parts.index')}}" accept-charset="UTF-8" method="get">
                <div class="search__top">
                    <div class="search__top__left">
                        <label for="part_name">部品名</label>
                        <input id="part_name" type="text" class="form-control" name="search_part_name" value="@if(isset($request['search_part_name'])){{$request['search_part_name']}}@endif">
                    </div>
                    <div class="search__top__right">
                        <label for="supplier">仕入先名</label>
                        <select name="search_supplier_id">
                            <option value="">指定なし</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="search-bottom">
                    <div class="search-bottom-left">
                        <label for="created_user_name">作成者名</label>
                        <input id="created_user_name" type="text" class="form-control" name="search_created_user_name" value="@if(isset($request['search_created_user_name'])){{$request['search_created_user_name']}}@endif">

                        <label for="updated_user_name">更新者名</label>
                        <input id="updated_user_name" type="text" class="form-control" name="search_updated_user_name" value="@if(isset($request['search_updated_user_name'])){{$request['search_updated_user_name']}}@endif">
                    </div>
                    <div class="search-bottom-right">
                        <label>作成日時</label>
                        <input type="date" name="created_from" value="@if(isset($request['created_from'])){{$request['created_from']}}@endif">
                        <span>~</span>
                        <input type="date" name="created_until" value="@if(isset($request['created_until'])){{$request['created_until']}}@endif">

                        <label>更新日時</label>
                        <input type="date" name="updated_from" value="@if(isset($request['updated_from'])){{$request['updated_from']}}@endif">
                        <span>~</span>
                        <input type="date" name="updated_until" value="@if(isset($request['updated_until'])){{$request['updated_until']}}@endif">
                    </div>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="commit" value="検索" class="loginBtn" data-disable-with="登録中...">
                    <input type="reset" name="bt01" value="リセット">
                </div>
            </form>
        </div>
        <div class="paginate">1 2 3...</div>
        <table>
            <tr>
                <th>部品名</th>
                <th>仕入先</th>
                <th>作成者</th>
                <th>作成日</th>
                <th>最終更新者</th>
                <th>最終更新日</th>
            </tr>
            @foreach($parts as $part)
            <tr class="lovelyrow" onclick="location.href='/parts/{{$part->id}}'">
                <td class="product-name">{{$part->name}}</td>
                <td>{{$part->supplier->name}}</td>
                <td>{{$part->createdUser->name}}</td>
                <td>{{$part->created_at}}</td>
                <td>{{isset($part->updatedUser->name) ? $part->updatedUser->name : ''}}</td>
                <td>{{$part->updated_at}}</td>
            </tr>
            @endforeach
        </table>

        <div class="paginate">1 2 3...</div>
    </div>
</div>
@endsection