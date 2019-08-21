@extends('backend.layouts.master')

@section('title')
Màn hình Quản trị
@endsection

@section('feature-title')
Màn hình Quản trị - Báo cáo nhanh tình hình Hệ thống
@endsection

@section('content')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số Sản phẩm đang có trong Hệ thống</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">9999</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection