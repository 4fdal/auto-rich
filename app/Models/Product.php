<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'category_id'];

    public function category(){
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}
