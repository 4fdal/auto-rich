<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'product_id',
        'discount_id',
        'name',
        'description',
        'tag',
        'photo',
        'price',
        'quantity',
        'weight_kg'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function discountId(){
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
