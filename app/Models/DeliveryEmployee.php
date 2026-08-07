<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryEmployee extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'vehicle',
        'status',
    ];
}