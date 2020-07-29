@extends('layouts.app')

@section('content')
<div class="createProductPage">
  <div class='container'>
    <h2 class='title'><i class="fas fa-wrench"></i> 部品情報変更</h2>
    <form class="new_user" action="{{ route('parts.update', $part->id) }}" accept-charset="UTF-8" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="create-product-form create-part-form">
        <div class="product-info">
          <div class="form-group @error('name') has-error @enderror">
            <label for="name">部品名</label>
            <div class="note-mark">必須</div><br>
            <input type="hidden" name="part_id" value="{{ $part->id }}">
            <input id="name" type="text" class="form-control" name="name" value="{{ $part->name }}" required autofocus>
            @error('name')
            <span class="help-block">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group @error('supplier_id') has-error @enderror">
            <label for="supplier">仕入先</label>
            <div class="note-mark">必須</div><br>
            <select name="supplier_id" required>
              @foreach($suppliers as $supplier)
              @if($supplier->id === $part->supplier_id)
              <option value="{{$supplier->id}}" selected>{{$supplier->name}}</option>
              @else
              <option value="{{$supplier->id}}">{{$supplier->name}}</option>
              @endif
              @endforeach
              @error('supplier_id')
              <span class="help-block">{{ $message }}</span>
              @enderror
            </select>
          </div>
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" name="commit" value="上記内容で部品情報を変更" class="loginBtn" data-disable-with="登録中...">
      </div>
    </form>
  </div>
</div>
@endsection