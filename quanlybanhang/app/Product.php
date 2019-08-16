<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; // không sử dụng cột UPDATED_AT, CREATED_AT

    protected $table        = 'products';
    
    protected $fillable     = ['product_code', 'product_name', 'description', 'image', 'standard_cost', 'list_price', 'quantity_per_unit', 'discontinued', 'discount', 'category_id', 'supplier_id'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';

    // protected $dates        = [];
    // protected $dateFormat   = 'Y-m-d H:i:s';

    public function nhacungcap() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function supplier() {
        return $this->belongsTo('App\Supplier', 'supplier_id', 'id');
    }
}
