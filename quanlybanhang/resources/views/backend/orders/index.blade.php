@extends('backend.layouts.master')

@section('title')
Danh sách Đơn hàng
@endsection

@section('feature-title')
Danh sách Đơn hàng
@endsection

@section('content')
<a href="{{ route('backend.orders.create') }}" class="btn btn-primary">Thêm mới</a>
<a href="{{ route('backend.orders.print') }}" class="btn btn-success">In danh sách</a>
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
        @foreach($lstOrders as $order)
        <tr>
            <td>{{ $order->category_code }}</td>
            <td>{{ $order->category_name }}</td>
            <td>{{ $order->description }}</td>
            <td>
                <img src="{{ asset('storage/uploads/' . $order->image ) }}" width="80px" height="80px" />
            </td>
            <td>
                <a href="{{ route('backend.orders.edit', ['id' => $order->id]) }}">Sửa</a>
                <form name="frmDeleteCategory" method="post" action="{{ route('backend.orders.destroy', ['id' => $order->id]) }}">
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