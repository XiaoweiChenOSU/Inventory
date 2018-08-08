<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class Status extends Model
{
    protected $table = 'statuses';

    public $timestamps = true;

    protected $fillable = [
        'status_name'
    ];

    protected $guarded = [];

        
}