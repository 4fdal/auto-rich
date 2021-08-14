<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    use HasFactory;
    protected $fillable = ["product_detail_id", "product_id", "quantity", "total", "discounted", "user_id"] ;


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productDetail(){
        return $this->belongsTo(ProductDetail::class, 'product_detail_id');
    }
}
