@extends('backend.layouts.master')

@section('title')
Sửa Đơn hàng
@endsection

@section('feature-title')
Sửa Đơn hàng
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

<form name="frmEditOrder" id="frmEditOrder" method="post" action="{{ route('backend.orders.update', ['id' => $order->id]) }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="customer_id">Khách hàng</label>
        <select id="customer_id" name="customer_id" class="form-control">
          @foreach($lstCustomers as $customer)
          @if(old('customer_id') == $customer->id)
          <option value="{{ $customer->id }}" selected>{{ $customer->last_name }} {{ $customer->first_name }}</option>
          @else
          <option value="{{ $customer->id }}">{{ $customer->last_name }} {{ $customer->first_name }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="employee_id">Nhân viên</label>
        <select id="employee_id" name="employee_id" class="form-control">
          @foreach($lstEmployees as $employee)
          @if(old('employee_id') == $employee->id)
          <option value="{{ $employee->id }}" selected>{{ $employee->last_name }} {{ $employee->first_name }}</option>
          @else
          <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="order_date">Ngày đặt hàng</label>
        <input type="text" class="form-control" id="order_date" name="order_date" aria-describedby="order_dateHelp" placeholder="" value="{{ old('order_date', $order->order_date) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ship_name">Tên người nhận hàng</label>
        <input type="text" class="form-control" id="ship_name" name="ship_name" aria-describedby="order_dateHelp" placeholder="" value="{{ old('ship_name', $order->ship_name) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ship_address1">Địa chỉ người nhận hàng 1</label>
        <input type="text" class="form-control" id="ship_address1" name="ship_address1" aria-describedby="order_dateHelp" placeholder="" value="{{ old('ship_address1', $order->ship_address1) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ship_address2">Địa chỉ người nhận hàng 1</label>
        <input type="text" class="form-control" id="ship_address2" name="ship_address2" aria-describedby="order_dateHelp" placeholder="" value="{{ old('ship_address2', $order->ship_address2) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ship_city">Thành phố</label>
        <input type="text" class="form-control" id="ship_city" name="ship_city" aria-describedby="order_dateHelp" placeholder="" value="{{ old('ship_city', $order->ship_city) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="ship_country">Quốc gia</label>
        <input type="text" class="form-control" id="ship_country" name="ship_country" aria-describedby="order_dateHelp" placeholder="" value="{{ old('ship_country', $order->ship_country) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="shipping_pee">Phí giao hàng</label>
        <input type="text" class="form-control" id="shipping_pee" name="shipping_pee" aria-describedby="order_dateHelp" placeholder="" value="{{ old('shipping_pee', $order->shipping_pee) }}">
      </div>
    </div>
  </div>

  <div class="card border-success text-white bg-gradient-primary mb-3">
    <div class="card-header bg-gradient-primary">
      <h5 class="card-title">Chọn sản phẩm trong đơn hàng</h5>
      <h6 class="card-subtitle mb-2">Chọn sản phẩm</h6>
    </div>
    <div class="card-body">
      <table class="table table-bordered text-white">
        <thead>
          <tr>
            <th style="width: 40%;">Sản phẩm</th>
            <th style="width: 20%;">Số lượng</th>
            <th style="width: 20%;">Giá</th>
            <th style="width: 10%;">% Giảm giá</th>
            <th style="width: 10%;">###</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <select class="form-control" name="product_id" id="product_id">
                @foreach($lstProducts as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="text" class="form-control" name="quantity" id="quantity" />
            </td>
            <td>
              <input type="text" class="form-control" name="unit_price" id="unit_price" />
            </td>
            <td>
              <input type="text" class="form-control" name="discount" id="discount" />
            </td>
            <td>
              <button type="button" class="btn btn-primary" id="btnThemSanPham">Thêm</button>
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
    <tbody id="tblSanPham">
      @foreach($order->details as $orderDetail)
      <tr>
        <td>{{ $orderDetail->product->product_name }}<input name="product_id[]" value="{{ $orderDetail->product_id }}" style="display: none;"></td>
        <td>{{ $orderDetail->quantity }}<input name="quantity[]" value="{{ $orderDetail->quantity }}" style="display: none;"></td>
        <td>{{ $orderDetail->unit_price }}<input name="unit_price[]" value="{{ $orderDetail->unit_price }}" style="display: none;"></td>
        <td>{{ $orderDetail->discount }}<input name="discount[]" value="{{ $orderDetail->discount }}" style="display: none;"></td>
        <td>{{ ($orderDetail->quantity * $orderDetail->unit_price) * (1 - $orderDetail->discount)  }}</td>
        <td><button type="button" class="btn btn-danger btn-xoa-order-detail">Xóa</button></td>
      </tr>
      @endforeach
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
    $("#frmEditOrder").validate({
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

    $('#btnThemSanPham').click(function() {
      // debugger;
      var product_id = $('#product_id').val();
      var product_displayText = $('#product_id option:selected').text();
      var quantity = $('#quantity').val();
      var unit_price = $('#unit_price').val();
      var discount = $('#discount').val();
      var thanhtien = (quantity * unit_price) * (1 - discount);

      var htmlTemplate = '<tr><td>' + product_displayText + '<input name="product_id[]" value="' + product_id + '" style="display: none;" /></td><td>' + quantity + '<input name="quantity[]" value="' + quantity + '" style="display: none;" /></td><td>' + unit_price + '<input name="unit_price[]" value="' + unit_price + '" style="display: none;" /></td><td>' + discount + '<input name="discount[]" value="' + discount + '" style="display: none;" /></td><td>' + thanhtien + '</td><td><button type="button" class="btn btn-danger">Xóa</button></td></tr>';
      $('#tblSanPham').append(htmlTemplate);

      // Clear
      $('#quantity').val('');
      $('#unit_price').val('');
      $('#discount').val('');
    });

    $('.btn-xoa-order-detail').click(function() {
      var trCanXoa = $(this).parent().parent(); //td -> tr\
      trCanXoa.remove();
    });
  });
</script>


@endsection