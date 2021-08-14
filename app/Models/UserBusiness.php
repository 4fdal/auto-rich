<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusiness extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'address_line1',
        'type',
        'mode',
    ];
}
