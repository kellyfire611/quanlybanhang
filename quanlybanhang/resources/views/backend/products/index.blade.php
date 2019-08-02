<h1>Danh sách Sản phẩm</h1>

<table border="1" cellspacing="0">
    <thead>
        <tr style="background: #00ff00;">
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Nhà cung cấp</th>
            <th>Loại sản phẩm</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listProducts as $product)
        <tr>
            <td width="40px;">{{ $product->product_code }}</td>
            <td>{{ $product->product_name }}</td>
            <td width="10%;" style="text-align: center;">{{ $product->nhacungcap->category_name }}</td>
            <td width="10%;" style="text-align: center;">{{ $product->supplier->supplier_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>