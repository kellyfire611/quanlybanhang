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
                <form id="frmDeleteProduct" name="frmDeleteProduct" method="post" action="{{ route('backend.products.destroy', ['id' => $product->id]) }}">
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

@section('custom-scripts')
<script>
    $(document).ready(function() {

        // Gọi thử SweetAlert
        //Swal.fire('Hello world!');
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc thực hiện thao tác không?',
                text: "Khi xóa thành công không thể phục hồi được",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Thực hiện XÓA!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Đã xóa thành công!',
                        'Sản phẩm đã được xóa.',
                        'success'
                    )

                    // Submit form
                    // debugger;
                    $(this).parent('#frmDeleteProduct').submit();
                    // $('#frmDeleteProduct').submit();
                }
            });


        });
    });
</script>
@endsection