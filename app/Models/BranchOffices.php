<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BranchOffices extends Model
{
    use HasFactory;

    protected $table = 'branch_offices';

    protected $fillable = [
        'Name',
        'Address',
        'IsActive',
        'ServiceKey',
        'Frame'
    ];

    protected $primaryKey = 'Id';

    public static function getActives()
    {
        return DB::table('branch_offices')
            ->where('IsActive', true)
            ->select('branch_offices.*')
            ->orderBy('Name', 'asc')
            ->get();
    }
}
