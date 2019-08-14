@extends('backend.layouts.master')

@section('title')
Danh sách Sản phẩm
@endsection

@section('feature-title')
Danh sách Sản phẩm
@endsection

@section('content')
<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Nhà cung cấp</th>
            <th>Loại sản phẩm</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listProducts as $product)
        <tr>
            <td width="40px;">{{ $product->product_code }}</td>
            <td>{{ $product->product_name }}</td>
            <td width="10%;" style="text-align: center;">{{ $product->nhacungcap->category_name }}</td>
            <td width="10%;" style="text-align: center;">{{ $product->supplier->supplier_name }}</td>
            <td>
                <a href="{{ route('backend.products.edit', ['id' => $product->id]) }}">Sửa</a>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection