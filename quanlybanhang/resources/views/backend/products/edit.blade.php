@extends('backend.layouts.master')

@section('title')
Sửa Sản phẩm
@endsection

@section('feature-title')
Sửa Sản phẩm
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

<form name="frmEditProduct" id="frmEditProduct" method="post" action="{{ route('backend.products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="product_code">Mã sản phẩm</label>
    <input type="text" class="form-control" id="product_code" name="product_code" aria-describedby="product_codeHelp" placeholder="Nhập mã sản phẩm" value="{{ old('product_code', $product->product_code) }}">
    <small id="product_codeHelp" class="form-text text-muted">Nhập mã sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="product_name">Tên Loại sản phẩm</label>
    <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="product_nameHelp" placeholder="Nhập Tên sản phẩm" value="{{ old('product_name') }}">
    <small id="product_nameHelp" class="form-text text-muted">Nhập tên sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="image">Ảnh đại diện sản phẩm</label>
    <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp">
    <small id="imageHelp" class="form-text text-muted">Chọn ảnh đại diện sản phẩm (tối đa là 5MB).</small>
  </div>
  <div class="form-group">
    <label for="description">Diễn giải sản phẩm</label>
    <input type="text" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Nhập diễn giải sản phẩm">
    <small id="descriptionHelp" class="form-text text-muted">Diễn giải sản phẩm (24 ký tự).</small>
  </div>
  <div class="form-group">
    <label for="standard_cost">Giá nhập sản phẩm</label>
    <input type="text" class="form-control" id="standard_cost" name="standard_cost" aria-describedby="standard_costHelp" placeholder="Nhập Giá nhập sản phẩm">
  </div>
  <div class="form-group">
    <label for="list_price">Giá bán sản phẩm</label>
    <input type="text" class="form-control" id="list_price" name="list_price" aria-describedby="list_priceHelp" placeholder="Nhập Giá bán sản phẩm">
  </div>
  <div class="form-group">
    <label for="quantity_per_unit">Số lượng sản phẩm</label>
    <input type="text" class="form-control" id="quantity_per_unit" name="quantity_per_unit" aria-describedby="quantity_per_unitHelp" placeholder="Nhập Số lượng sản phẩm">
  </div>
  <div class="form-group">
    <label for="discontinued">Ngưng bán?</label>
    @if(old('discontinued', $product->discontinued))
    <input type="checkbox" class="form-control" id="discontinued" name="discontinued" aria-describedby="discontinuedHelp" checked>
    @else
    <input type="checkbox" class="form-control" id="discontinued" name="discontinued" aria-describedby="discontinuedHelp">
    @endif
  </div>
  <div class="form-group">
    <label for="discount">% giảm giá sản phẩm</label>
    <input type="text" class="form-control" id="discount" name="discount" aria-describedby="discountHelp" placeholder="Nhập % giảm giá sản phẩm">
  </div>
  <div class="form-group">
    <label for="category_id">Loại sản phẩm</label>
    <select id="category_id" name="category_id" class="form-control">
      @foreach($lstCategories as $category)
        @if(old('category_id', $product->category_id) == $category->id)
        <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
        @else
        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="supplier_id">Nhà cung cấp</label>
    <select id="supplier_id" name="supplier_id" class="form-control">
      @foreach($lstSuppliers as $supplier)
      <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
      @endforeach
    </select>
  </div>
  <a href="{{ route('backend.products.index') }}" class="btn">Quay về</a>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>
@endsection

@section('custom-scripts')
<script>
  $(document).ready(function() {
    $("#frmCreateProduct").validate({
      rules: {
        Product_code: {
          required: true,
          minlength: 3,
          maxlength: 20
        },
        Product_name: {
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
        Product_code: {
          required: "Vui lòng nhập mã Loại sản phẩm",
          minlength: "Mã loại sản phẩm phải có ít nhất 3 ký tự",
          maxlength: "Mã loại sản phẩm không được vượt quá 20 ký tự"
        },
        Product_name: {
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