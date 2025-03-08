<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'order_sale_id', 'user_id'];

    public function orderSale()
    {
        return $this->belongsTo(OrderSale::class, 'order_sale_id');
    }
}
