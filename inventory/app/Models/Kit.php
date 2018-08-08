<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockEntry
 */
class Kit extends Model
{

    use SoftDeletes;
    
    protected $table = 'kits';

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [

        'kit_code',
        'kit_sku',
        'kit_title',
        'quantity_sync',
        'status_id',
        
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany('App\Models\Product','sku','description')->select(array('sku', 'description'));
    } 


        
}