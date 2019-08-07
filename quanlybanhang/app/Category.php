<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $table        = 'categories';
    
    protected $fillable     = ['category_code', 'category_name', 'description', 'image'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';

    // protected $dates        = [];
    // protected $dateFormat   = 'Y-m-d H:i:s';

    public function products() {
        return $this->hasMany('App\Product', 'category_id', 'id');
    }
}
