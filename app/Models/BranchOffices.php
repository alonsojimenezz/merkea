<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffices extends Model
{
    use HasFactory;

    protected $table = 'branch_offices';

    protected $fillable = [
        'Name',
        'Address',
        'IsActive',
        'Frame'
    ];

    protected $primaryKey = 'Id';
}
