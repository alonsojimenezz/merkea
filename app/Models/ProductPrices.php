<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrices extends Model
{
    use HasFactory;

    protected $table = 'product_prices';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'LastUpdater',
        'ProductId',
        'UnitId',
        'Key',
        'Barcode',
        'BasePrice',
        'DiscountType',
        'DiscountPercent',
        'DiscountFixed'
    ];
}
