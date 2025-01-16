<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
     protected $guarded = [];

    // Define the relationship with the Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
