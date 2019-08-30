<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Customer;
use App\Employee;
use App\Order;
use App\OrderDetail;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hello');
        // HERE DOC string PHP
        $sql = <<<EOT
    SELECT o.id, CONCAT('ORDER_', o.id) AS OrderCode, o.order_date, o.shipped_date, o.order_status,
        c.last_name, c.first_name, c.email, c.company, c.phone, c.address1,
        COUNT(*) TongSoMatHang
        , SUM((od.quantity * od.unit_price) * (1 - od.discount)) AS TongThanhTien
    FROM orders o
    JOIN customers c ON o.customer_id = c.id
    JOIN order_details od ON od.order_id = o.id
    GROUP BY o.id, o.order_date, o.shipped_date,	c.last_name, c.first_name, c.email, c.company, c.phone, c.address1, o.order_status
EOT;
        // Raw SQL
        $lstOrders = DB::select($sql);
        // dd($lstOrders);
        return view('backend.orders.index')
            ->with('lstOrders', $lstOrders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstCustomers = Customer::all();
        $lstEmployees = Employee::all();

        $lstProducts = Product::all();
        return view('backend.orders.create')
            ->with('lstCustomers', $lstCustomers)
            ->with('lstEmployees', $lstEmployees)
            ->with('lstProducts', $lstProducts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        // New Order
        $order = new Order();
        $order->employee_id         = $request->employee_id;
        $order->customer_id         = $request->customer_id;
        $order->order_date          = $request->order_date;
        $order->shipped_date        = '2019-02-02 18:16:00';
        $order->ship_name           = $request->ship_name;
        $order->ship_address1       = $request->ship_address1;
        $order->ship_address2       = $request->ship_address2;
        $order->ship_city           = $request->ship_city;
        $order->ship_state          = $request->ship_state;
        $order->ship_postal_code    = $request->ship_postal_code;
        $order->ship_country        = $request->ship_country;
        $order->shipping_pee        = $request->shipping_pee;
        $order->payment_type        = "Tiền mặt";
        $order->paid_date           = Carbon::now();
        $order->order_status        = "1"; //1: mới đặt hàng; 2: đã thanh toán xong
        $order->save(); // Có 1 dòng order mới trong db; $order->id lấy dc ID mới sinh của MYSQL

        foreach($request->product_id as $index => $value) {
            $order_id = $order->id;
            $product_id = $request->product_id[$index]; //1 | 3
            $quantity = $request->quantity[$index]; // 2 | 20
            $unit_price = $request->unit_price[$index];
            $discount = $request->discount[$index];
            $order_detail_status = '1'; //1: sản phẩm này mới đặt hàng; 2: sản phẩm này đã được giao
            // dd($order_id, $product_id, $quantity, $unit_price, $discount);
            
            // Save bằng RAW SQL
            // $sqlInsert = "INSERT INTO order_details (order_id, product_id, quantity, unit_price, discount, order_detail_status, date_allocated) VALUES ($order_id, $product_id, $quantity, $unit_price, $discount, '$order_detail_status', '2019-08-30')";
            // DB::select($sqlInsert);

            // Save bằng Model
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $product_id;
            $orderDetail->quantity = $quantity;
            $orderDetail->unit_price = $unit_price;
            $orderDetail->discount = $discount;
            $orderDetail->order_detail_status = $order_detail_status;
            $orderDetail->save();
        }

        return redirect()->route('backend.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $lstCustomers = Customer::all();
        $lstEmployees = Employee::all();

        $lstProducts = Product::all();
        return view('backend.orders.edit')
            ->with('lstCustomers', $lstCustomers)
            ->with('lstEmployees', $lstEmployees)
            ->with('lstProducts', $lstProducts)
            ->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $order = Order::find($id);

        // Xóa sạch Sản phẩm chi tiết
        foreach($order->details as $index => $orderDetail) {
            $orderDetail->delete();
        }

        $order->employee_id         = $request->employee_id;
        $order->customer_id         = $request->customer_id;
        $order->order_date          = $request->order_date;
        $order->shipped_date        = '2019-02-02 18:16:00';
        $order->ship_name           = $request->ship_name;
        $order->ship_address1       = $request->ship_address1;
        $order->ship_address2       = $request->ship_address2;
        $order->ship_city           = $request->ship_city;
        $order->ship_state          = $request->ship_state;
        $order->ship_postal_code    = $request->ship_postal_code;
        $order->ship_country        = $request->ship_country;
        $order->shipping_pee        = $request->shipping_pee;
        $order->payment_type        = "Tiền mặt";
        $order->paid_date           = Carbon::now();
        $order->order_status        = "1"; //1: mới đặt hàng; 2: đã thanh toán xong
        $order->save(); // Có 1 dòng order mới trong db; $order->id lấy dc ID mới sinh của MYSQL

        foreach($request->product_id as $index => $value) {
            $order_id = $order->id;
            $product_id = $request->product_id[$index]; //1 | 3
            $quantity = $request->quantity[$index]; // 2 | 20
            $unit_price = $request->unit_price[$index];
            $discount = $request->discount[$index];
            $order_detail_status = '1'; //1: sản phẩm này mới đặt hàng; 2: sản phẩm này đã được giao
            // dd($order_id, $product_id, $quantity, $unit_price, $discount);
            
            // Save bằng RAW SQL
            // $sqlInsert = "INSERT INTO order_details (order_id, product_id, quantity, unit_price, discount, order_detail_status, date_allocated) VALUES ($order_id, $product_id, $quantity, $unit_price, $discount, '$order_detail_status', '2019-08-30')";
            // DB::select($sqlInsert);

            // Save bằng Model
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $product_id;
            $orderDetail->quantity = $quantity;
            $orderDetail->unit_price = $unit_price;
            $orderDetail->discount = $discount;
            $orderDetail->order_detail_status = $order_detail_status;
            $orderDetail->save();
        }

        return redirect()->route('backend.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        
        // Xóa sạch Sản phẩm chi tiết
        foreach($order->details as $index => $orderDetail) {
            $orderDetail->delete();
        }

        $order->delete();

        return redirect()->route('backend.orders.index');
    }
}
