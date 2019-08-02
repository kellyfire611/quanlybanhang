<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table        = 'suppliers';
    
    protected $fillable     = ['supplier_code', 'supplier_name', 'description', 'image'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';

    // protected $dates        = [];
    // protected $dateFormat   = 'Y-m-d H:i:s';

    public function products() {
        return $this->hasMany('App\Product', 'supplier_id', 'id');
    }
}
