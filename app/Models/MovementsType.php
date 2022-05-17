<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementsType extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name'
    ];

    protected $table = 'movements_type';

    protected $primaryKey = 'Id';

    public $timestamps = false;
}
