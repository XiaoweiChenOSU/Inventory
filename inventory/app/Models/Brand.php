<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class Brand extends Model
{
    protected $table = 'brands';

    public $timestamps = true;

    protected $fillable = [
        'brand_name'
    ];

    protected $guarded = [];

        
}