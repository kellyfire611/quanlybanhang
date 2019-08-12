@extends('backend.layouts.master')

@section('title')
Thêm mới Loại sản phẩm
@endsection

@section('feature-title')
Thêm mới Loại sản phẩm
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

<form name="frmCreateCategory" id="frmCreateCategory" method="post" action="{{ route('backend.categories.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="category_code">Mã Loại sản phẩm</label>
    <input type="text" class="form-control" id="category_code" name="category_code" aria-describedby="category_codeHelp" placeholder="Nhập mã loại sản phẩm">
    <small id="category_codeHelp" class="form-text text-muted">Nhập mã loại sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="category_name">Tên Loại sản phẩm</label>
    <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="category_nameHelp" placeholder="Nhập Tên loại sản phẩm">
    <small id="category_nameHelp" class="form-text text-muted">Nhập tên loại sản phẩm (24 ký tự).</small>
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
  <a href="{{ route('backend.categories.index') }}" class="btn">Quay về</a>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>
@endsection

@section('custom-scripts')
<script>
  $(document).ready(function() {
    $("#frmCreateCategory").validate({
      rules: {
        category_code: {
          required: true,
          minlength: 3,
          maxlength: 20
        },
        category_name: {
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
        category_code: {
          required: "Vui lòng nhập mã Loại sản phẩm",
          minlength: "Mã loại sản phẩm phải có ít nhất 3 ký tự",
          maxlength: "Mã loại sản phẩm không được vượt quá 20 ký tự"
        },
        category_name: {
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