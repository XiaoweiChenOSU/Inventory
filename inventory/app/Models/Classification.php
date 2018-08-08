<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class Classification extends Model
{
    protected $table = 'classifications';

    public $timestamps = true;

    protected $fillable = [
        'classification_name'
    ];

    protected $guarded = [];

        
}