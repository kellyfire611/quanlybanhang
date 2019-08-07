@extends('backend.layouts.master')

@section('title')
Danh sách Loại sản phẩm
@endsection

@section('feature-title')
Danh sách Loại sản phẩm
@endsection

@section('content')
<a href="{{ route('backend.categories.create') }}" class="btn btn-primary">Thêm mới</a>
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Mã loại sản phẩm</th>
            <th>Tên loại sản phẩm</th>
            <th>Diễn giải</th>
            <th>Hình ảnh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listCategories as $category)
        <tr>
            <td>{{ $category->category_code }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->image }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection