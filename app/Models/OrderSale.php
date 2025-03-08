<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSale extends Model
{
    use HasFactory;

    protected $table = 'order_sales';
    protected $fillable = ['customer_name', 'total_amount', 'user_id'];
}
