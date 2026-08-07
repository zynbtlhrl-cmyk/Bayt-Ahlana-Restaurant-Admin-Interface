<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $fillable = [
    'restaurant_name',
    'logo',
    'banner',
    'description',
    'phone',
    'whatsapp',
    'email',
    'address',
    'opening_time',
    'closing_time',
    'working_days',
    'delivery_fee',
    'minimum_order',
    'orders_enabled',
    'cash_payment',
    'online_payment',
    'facebook',
    'instagram',
    'tiktok',
    'theme_color',
    'welcome_message',
];
}
