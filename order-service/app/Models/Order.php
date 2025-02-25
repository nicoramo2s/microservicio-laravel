<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'items',
        'total_price',
        'status',
    ];
}
