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
            <th>Mã đơn hàng</th>
            <th>Thông tin khách hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Đã giao hàng vào lúc</th>
            <th>Thông tin tóm tắt đơn hàng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lstOrders as $order)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection