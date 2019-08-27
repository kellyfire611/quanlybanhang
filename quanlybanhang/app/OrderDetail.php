<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;

    protected $table        = 'order_details';
    
    protected $fillable     = ['order_id', 'product_id', 'quantity', 'unit_price', 'discount', 'order_detail_status', 'date_allocated'];
    protected $guarded      = ['order_id', 'product_id'];
    protected $primaryKey   = ['order_id', 'product_id'];

    protected $dates        = ['order_date', 'shipped_date', 'paid_date'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
