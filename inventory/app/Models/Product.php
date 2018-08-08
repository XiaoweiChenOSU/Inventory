<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 */
class Product extends Model
{
    //use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'sku',
        'description',
        'classification_id',
        'supplier_id',
        'brand_id',
        'code',
        'part_number',
        'cost',
        'selling_price',
        'retail_price',
        'weight',
        'weight_unit',
        'reorder_point',
        'min_qnty',
        'max_qnty',
        'note',
        'status_id',
        'image',
        'attribute_id'
    ];
    

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne('App\Models\CategoryDetail','id','category_id')->select(array('id', 'category_name'));
    } 

    public function supplier()
    {
        return $this->hasOne('App\Models\SupplierDetail','id','supplier_id')->select(array('id', 'supplier_name'));
    } 

    public function item()
    {
        return $this->hasMany('App\Models\Item','id','product_id')->select(array('id', 'warehous_id'));
    } 
}