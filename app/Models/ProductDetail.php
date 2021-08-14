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
        'length',
        'width',
        'height',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
