<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'postal_code',
        'address',
        'amount',
        'currency',
        'package_details',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'payment_status'
    ];
}
