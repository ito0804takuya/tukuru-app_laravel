@extends('layouts.app')

@section('content')
<div class="topPage">
  <div class='container'>
    <h2 class='title'>TUKURUとは</h2>
    <p>製造業向けを想定した、商品・部品管理システムです。</p>
    <p>商品・部品のそれぞれについて、CRUD機能を設けています。</p>
    <p>何らかの形でものづくりをする人々の力になりたいという思いから、考案しました。</p>
    <div class="form-group text-center">
      <input type="button" value="戻る" onclick="history.back()" class="loginBtn backBtn">
    </div>
  </div>
</div>

@endsection