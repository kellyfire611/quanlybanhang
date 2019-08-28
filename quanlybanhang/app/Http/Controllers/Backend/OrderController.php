<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        
        // return view('backend.orders.create')
        //     ->with('lstProducts', $lstProducts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
