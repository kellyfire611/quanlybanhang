<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $table        = 'orders';
    
    protected $fillable     = ['employee_id', 'customer_id', 'order_date', 'shipped_date', 'ship_name', 'ship_address1', 'ship_address2', 'ship_city', 'ship_state', 'ship_postal_code', 'ship_country', 'shipping_pee', 'payment_type', 'paid_date', 'order_status'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';

    // protected $dates        = ['order_date', 'shipped_date', 'paid_date'];
    // protected $dateFormat   = 'Y-m-d H:i:s';

    public function details() {
        return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }
}
