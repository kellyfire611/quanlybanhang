@extends('backend.layouts.master')

@section('title')
Hiệu chỉnh Loại sản phẩm
@endsection

@section('feature-title')
Hiệu chỉnh Loại sản phẩm
@endsection

@section('content')
<form name="frmCreateCategory" method="post" action="{{ route('backend.categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="form-group">
    <label for="category_code">Mã Loại sản phẩm</label>
    <input type="text" class="form-control" id="category_code" name="category_code" aria-describedby="category_codeHelp" placeholder="Nhập mã loại sản phẩm" value="{{ $category->category_code }}">
    <small id="category_codeHelp" class="form-text text-muted">Nhập mã loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="category_name">Tên Loại sản phẩm</label>
    <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="category_nameHelp" placeholder="Nhập Tên loại sản phẩm" value="{{ $category->category_name }}">
    <small id="category_nameHelp" class="form-text text-muted">Nhập tên loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="description">Diễn giải Loại sản phẩm</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Nhập mã loại sản phẩm" value="{{ $category->description }}">
    <small id="descriptionHelp" class="form-text text-muted">Diễn giải loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="image">Ảnh đại diện Loại sản phẩm</label>
    <img src="{{ asset('storage/uploads/' . $category->image ) }}" width="150px" height="150px" />
    <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp">
    <small id="imageHelp" class="form-text text-muted">Chọn ảnh đại diện loại sản phẩm (tối đa là 5MB).</small>
  </div>
  <a href="{{ route('backend.categories.index') }}" class="btn">Quay về</a>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>
@endsection