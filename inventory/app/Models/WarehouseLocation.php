<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class WarehouseLocation extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'location_name',
        'warehouse_id',
    ];

    protected $guarded = [];
          
}