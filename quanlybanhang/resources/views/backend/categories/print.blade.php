@extends('print.layout.paper')

@section('title')
In danh sách Loại sản phẩm
@endsection

@section('paper-size')
A4
@endsection

@section('paper-class')
A4
@endsection

@section('content')
<section class="sheet padding-10mm">
    <article>
        <table border="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width:150px;">
                    <img src="{{ asset('img/logo-nentang.jpg') }}" style="width:150px;height:150px;" />
                </td>
                <td style="text-align: center;vertical-align: middle;">
                    <span style="font-weight: bold;font-size: 1.8em;">NỀN TẢNG <br /> HÀNH TRANG TỚI TƯƠNG LAI</span>
                </td>
            </tr>
        </table>

        <table border="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="text-align: center;">
                    <span style="font-weight: bold;font-size: 1.8em;">DANH SÁCH LOẠI SẢN PHẨM</span>
                </td>
            </tr>
        </table>

        <table border="1" width="100%" style="border-collapse: collapse;">
            <tr style="background-color: #beb6b6;">
                <td style="font-weight: bold;text-align:center;width: 80px;">Mã loại sản phẩm</td>
                <td style="font-weight: bold;text-align:center;width: 80px;">Tên loại sản phẩm</td>
                <td style="font-weight: bold;text-align:center;">Diễn giải loại sản phẩm</td>
                <td style="font-weight: bold;text-align:center;width: 80px;">Hình ảnh</td>
            </tr>
            @foreach($lstCategories as $category)
            <tr>
                <td>{{ $category->category_code }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <img src="{{ asset('storage/uploads/' . $category->image ) }}" width="80px" height="80px" />
                </td>
            </tr>
            @endforeach
        </table>
    </article>
</section>
@endsection
