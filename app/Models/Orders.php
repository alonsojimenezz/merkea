<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'BranchId',
        'StatusId',
        'Name',
        'Email',
        'Phone',
        'Address',
        'PostalCodeId',
        'Slug'
    ];

    protected $table = 'orders';
}
