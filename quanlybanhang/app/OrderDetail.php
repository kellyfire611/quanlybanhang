<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderDetail extends Model
{
    public $timestamps = false;

    protected $table        = 'order_details';
    
    protected $fillable     = ['order_id', 'product_id', 'quantity', 'unit_price', 'discount', 'order_detail_status', 'date_allocated'];
    protected $guarded      = ['order_id', 'product_id'];
    protected $primaryKey   = ['order_id', 'product_id'];

    // protected $dates        = ['date_allocated'];
    // protected $dateFormat   = 'Y-m-d H:i:s';

    public $incrementing = false; // Không sử dụng cột id

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }
        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        } // WHERE ... AND ... AND ...
        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }
        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }
        return $this->getAttribute($keyName);
    }

    public function order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
