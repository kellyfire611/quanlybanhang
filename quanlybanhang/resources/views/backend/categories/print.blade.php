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
                    <span style="font-weight: bold;font-size: 3em;">TÊN CÔNG TY</span>
                </td>
            </tr>
        </table>

        <table border="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="text-align: center;">
                    <span style="font-weight: bold;font-size: 3em;">DANH SÁCH LOẠI SẢN PHẨM</span>
                </td>
            </tr>
        </table>

        <table border="1" width="100%" style="border-collapse: collapse;">
            <tr>
                <td>Mã loại sản phẩm</td>
                <td>Tên loại sản phẩm</td>
                <td>Diễn giải loại sản phẩm</td>
                <td>Hình ảnh</td>
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
