<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockDetail
 */
class Item extends Model
{
    //use SoftDeletes;

    protected $table = 'items';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'warehous_id',
        'location_id',
        'quantity',
        'reason_id',
        'note'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product','id','product_id')->select(array('id', 'description','code',));
    }  
}