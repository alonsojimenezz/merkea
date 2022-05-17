<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'LastUpdater',
        'ProductId',
        'UnitId',
        'Quantity'
    ];

    protected $table = 'product_stocks';

    protected $primaryKey = 'Id';
}
