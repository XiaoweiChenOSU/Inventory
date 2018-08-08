<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'warehouse_name'
    ];

    protected $guarded = [];
          
}