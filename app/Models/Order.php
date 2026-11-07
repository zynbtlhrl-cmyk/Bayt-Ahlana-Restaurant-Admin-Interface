<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'address',
        'notes',
        'food_name',
        'quantity',
        'total_price',
        'status',
        'order_type',
    ];
}