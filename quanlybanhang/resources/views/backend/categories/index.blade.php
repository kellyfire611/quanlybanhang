@extends('backend.layouts.master')

@section('title')
Danh sách Loại sản phẩm
@endsection

@section('feature-title')
Danh sách Loại sản phẩm
@endsection

@section('content')
<a href="{{ route('backend.categories.create') }}" class="btn btn-primary">Thêm mới</a>
<a href="{{ route('backend.categories.print') }}" class="btn btn-success">In danh sách</a>
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Mã loại sản phẩm</th>
            <th>Tên loại sản phẩm</th>
            <th>Diễn giải</th>
            <th>Hình ảnh</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listCategories as $category)
        <tr>
            <td>{{ $category->category_code }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <img src="{{ asset('storage/uploads/' . $category->image ) }}" width="80px" height="80px" />
            </td>
            <td>
                <a href="{{ route('backend.categories.edit', ['id' => $category->id]) }}">Sửa</a>
                <form name="frmDeleteCategory" method="post" action="{{ route('backend.categories.destroy', ['id' => $category->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <input type="submit" value="Xóa" />
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection