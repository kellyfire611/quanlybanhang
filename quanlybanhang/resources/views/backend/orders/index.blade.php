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
            <th>Tình trạng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lstOrders as $order)
        <tr>
            <td>{{ $order->OrderCode }}</td>
            <td>
                Họ tên: <b>{{ $order->last_name }} {{ $order->last_name }}</b><br />
                Công ty: {{ $order->company }}<br /> 
                Điện thoại: {{ $order->phone }}<br /> 
                Địa chỉ: {{ $order->address1 }}<br /> 
            </td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->shipped_date }}</td>
            <td>
                Tổng số mặt hàng: {{ number_format($order->TongSoMatHang, 0, ".", ",") }}<br />
                Tổng thành tiền: {{ number_format($order->TongThanhTien, 0, ".", ",") }}
            </td>
            <td>
                @if($order->order_status == 1)
                    <span class="badge badge-danger">Mới đặt hàng</span>
                @elseif($order->order_status == 2)
                    <span class="badge badge-success">Đã thanh toán</span>
                @endif
            </td>
            <td>
            <a href="{{ route('backend.orders.edit', ['id' => $order->id]) }}" class="btn btn-primary">Sửa</a>
                <form name="frmDeleteOrder" method="post" action="{{ route('backend.orders.destroy', ['id' => $order->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button class="btn btn-danger btn-icon-split btn-delete">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Xóa</span>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection