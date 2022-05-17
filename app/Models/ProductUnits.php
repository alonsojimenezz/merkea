<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnits extends Model
{
    use HasFactory;

    protected $fillable = [
        'UnitId',
        'ProductId',
        'UserId'
    ];
}
