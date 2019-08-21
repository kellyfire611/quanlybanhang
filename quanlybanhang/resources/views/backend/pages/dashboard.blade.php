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
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="productCountText">
                            Không biết
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="btnRefreshProductCount">Refresh dữ liệu</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('custom-scripts')
<!-- Các script dành cho thư viện Numeraljs -->
<script src="{{ asset('vendor/numeraljs/numeral.min.js') }}"></script>
<script>
    // Đăng ký tiền tệ VNĐ
    numeral.register('locale', 'vi', {
        delimiters: {
            thousands: ',',
            decimal: '.'
        },
        abbreviations: {
            thousand: 'k',
            million: 'tr',
            billion: 'ty',
            trillion: 'tyty'
        },
        ordinal: function(number) {
            return number === 1 ? 'một' : 'không';
        },
        currency: {
            symbol: 'vnđ'
        }
    });
    // Sử dụng locate vi (Việt nam)
    numeral.locale('vi');
</script>


<script>
    $(document).ready(function() {
        function getDataProductCount() {
            // Nhờ AJAX gởi request đến url /admin/api/getProductCount
            $.ajax('{{ route('backend.api.getProductCount') }}', {
                success: function(data) {
                    $('#productCountText').html(data.data[0].SoLuong + ' sản phẩm');
                },
                error: function() {
                    $('#productCountText').html('Không xử lý được!');
                }
            });
        };

        $('#btnRefreshProductCount').click(function(e) {
            getDataProductCount();
        });

        // Onload
        getDataProductCount();
    });
</script>
@endsection