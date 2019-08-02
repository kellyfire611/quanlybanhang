@extends('layouts.master')

@section('title')
Chức năng Hello
@endsection

@section('content')
    <?php
    $hoten = "<b>Dương Nguyễn Phú Cường</b>";
    $chenanh = 'sản phẩm tốt lắm <img src="https://nentang.vn/wp-content/uploads/2019/07/TemplateEngine_Workflow.png" />';

    $dadangnhap = false;
    $gioitinh = 0; //0: nam; 1: Nữ; 2: không công bố
    ?>

    Giá trị của $hoten là: {{ $hoten }}<br />
    Giá trị của $hoten no escapse HTML là: {!! $hoten !!}<br />
    Giá trị của $hoten là: @{{ $hoten }}<br />

@endsection