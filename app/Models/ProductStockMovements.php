<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockMovements extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserId',
        'ProductId',
        'UnitId',
        'PreviousQuantity',
        'Quantity',
        'ReasonId',
        'Description'
    ];

    protected $table = 'product_stock_movements';

    protected $primaryKey = 'Id';
}
