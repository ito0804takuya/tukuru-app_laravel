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
            <a class="create-product-btn" href="/parts/create">部品を新規登録</a>
        </div>
        <p class="test">部品名検索</p>
        <p class="test">入力ボックス</p>
        <p class="test">仕入先名検索</p>
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
                <th>部品名</th>
                <th>仕入先</th>
                <th>作成者</th>
                <th>作成日</th>
                <th>最終更新者</th>
                <th>最終更新日</th>
            </tr>
            @foreach($parts as $part)
            <tr class="lovelyrow" onclick="location.href='/products'">
                <td class="product-name">{{$part->name}}</td>
                <td>{{$part->supplier->name}}</td>
                <td>{{$part->createdUser->name}}</td>
                <td>{{$part->created_at}}</td>
                <td>{{$part->updatedUser->name}}</td>
                <td>{{$part->updated_at}}</td>
            </tr>
            @endforeach
        </table>

        <div class="paginate">1 2 3...</div>
    </div>
</div>
@endsection