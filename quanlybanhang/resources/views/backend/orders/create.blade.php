@extends('backend.layouts.master')

@section('title')
Thêm mới Đơn hàng
@endsection

@section('feature-title')
Thêm mới Đơn hàng
@endsection

@section('content')
<!-- DIV hiển thị thông báo lỗi start -->
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<!-- DIV hiển thị thông báo lỗi end -->

<form name="frmCreateOrder" id="frmCreateOrder" method="post" action="{{ route('backend.categories.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="order_code">Mã Loại sản phẩm</label>
    <input type="text" class="form-control" id="order_code" name="order_code" aria-describedby="order_codeHelp" placeholder="Nhập mã loại sản phẩm">
    <small id="order_codeHelp" class="form-text text-muted">Nhập mã loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="order_name">Tên Loại sản phẩm</label>
    <input type="text" class="form-control" id="order_name" name="order_name" aria-describedby="order_nameHelp" placeholder="Nhập Tên loại sản phẩm">
    <small id="order_nameHelp" class="form-text text-muted">Nhập tên loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="description">Diễn giải Loại sản phẩm</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Nhập mã loại sản phẩm">
    <small id="descriptionHelp" class="form-text text-muted">Diễn giải loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="image">Ảnh đại diện Loại sản phẩm</label>
    <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp">
    <small id="imageHelp" class="form-text text-muted">Chọn ảnh đại diện loại sản phẩm (tối đa là 5MB).</small>
  </div>

  <div class="card border-success text-white bg-gradient-primary mb-3">
    <div class="card-header bg-gradient-primary">
      <h5 class="card-title">Chọn sản phẩm trong đơn hàng</h5>
      <h6 class="card-subtitle mb-2">Card subtitle</h6>
    </div>
    <div class="card-body">
      <table class="table table-bordered text-white">
        <thead>
          <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>% Giảm giá</th>
            <th>###</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <input type="text" class="form-control" name="product_id" />
            </td>
            <td>
              <input type="text" class="form-control" name="quantity" />
            </td>
            <td>
              <input type="text" class="form-control" name="unit_price" />
            </td>
            <td>
              <input type="text" class="form-control" name="discount" />
            </td>
            <td>
              <button type="button" class="btn btn-primary">Thêm</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>% Giảm giá</th>
        <th>Thành tiền</th>
        <th>###</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sản phẩm</td>
        <td>Số lượng</td>
        <td>Giá</td>
        <td>% Giảm giá</td>
        <td>9999</td>
        <td>
          <button type="button" class="btn btn-danger">Xóa</button>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">Tổng</td>
        <td>9999</td>
        <td></td>
      </tr>
    </tfoot>
  </table>


  <a href="{{ route('backend.categories.index') }}" class="btn">Quay về</a>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>
@endsection

@section('custom-scripts')
<script>
  $(document).ready(function() {
    $("#frmCreateOrder").validate({
      rules: {
        order_code: {
          required: true,
          minlength: 3,
          maxlength: 20
        },
        order_name: {
          required: true,
          minlength: 3,
          maxlength: 20
        },
        description: {
          required: true,
          minlength: 3,
          maxlength: 50
        },
        image: {
          required: true
        },
      },
      messages: {
        order_code: {
          required: "Vui lòng nhập mã Loại sản phẩm",
          minlength: "Mã loại sản phẩm phải có ít nhất 3 ký tự",
          maxlength: "Mã loại sản phẩm không được vượt quá 20 ký tự"
        },
        order_name: {
          required: "Vui lòng nhập tên Loại sản phẩm",
          minlength: "Tên loại sản phẩm phải có ít nhất 3 ký tự",
          maxlength: "Tên loại sản phẩm không được vượt quá 20 ký tự"
        },
      },
      errorElement: "em",
      errorPlacement: function(error, element) {
        // Thêm class `invalid-feedback` cho field đang có lỗi
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
        // Thêm icon "Kiểm tra không Hợp lệ"
        if (!element.next("span")[0]) {
          $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>")
            .insertAfter(element);
        }
      },
      success: function(label, element) {
        // Thêm icon "Kiểm tra Hợp lệ"
        if (!$(element).next("span")[0]) {
          $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
            .insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      }
    });
  });
</script>


@endsection