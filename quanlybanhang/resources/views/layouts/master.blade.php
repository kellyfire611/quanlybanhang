<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý bán hàng | @yield('title')</title>

    <!-- CSS của Bootstrap -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" type="text/css" rel="stylesheet" />

    <!-- Style của dự án -->
    <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <!-- Dòng header - Start -->
        <div class="row">
            <!-- Cột logo 3 - Start -->
            <div class="col-md-3 col-6" id="logo">
                LOGO công ty
            </div>
            <!-- Cột logo 3 - End -->
            <!-- Cột tên công ty - Start -->
            <div class="col-md-9 col-6" id="company-name">
                Công ty bán hàng ABC
            </div>
            <!-- Cột tên công ty - End -->
        </div>
        <!-- Dòng header - End -->

        <!-- Dòng nội dung chính - Start -->
        <div class="row">
            <!-- Cột sidebar 3 - Start -->
            <div class="col-md-3" id="sidebar">
            </div>
            <!-- Cột sidebar 3 - End -->
            <!-- Cột nội dung - Start -->
            <div class="col-md-9" id="content">
                @yield('content')
            </div>
            <!-- Cột nội dung - End -->
        </div>
        <!-- Dòng nội dung chính - End -->

        <!-- Dòng footer - Start -->
        <div class="row">
            <!-- Cột footer 12 - Start -->
            <div class="col-md-12" id="footer">
                Bản quyền bởi &copy; 2019....   
            </div>
            <!-- Cột footer 12 - End -->
        </div>
        <!-- Dòng footer - End -->
    </div>

    <!-- JS của Jquery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <!-- JS của popperjs -->
    <script src="{{ asset('vendor/popperjs/popper.min.js') }}"></script>
    
    <!-- JS của Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>