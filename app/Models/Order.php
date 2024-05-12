<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_email','total_amount','status','payment_method','payment_status','shipping_address'
    ];
    use HasFactory;
}
