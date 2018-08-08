<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitProducts extends Model
{
    use SoftDeletes;
    
    protected $table = 'kit_products';

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        
        'kid_id',
        'product_id',
        'product_sku',
        'product_name',
	    'product_quantity',
    ];


    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function kits()
    {
        return $this->belongsTo('App\Models\Kit','id','kid_id');
    } 
        
}
