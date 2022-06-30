<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostalCoverage extends Model
{
    use HasFactory;

    protected $table = 'postal_coverages';

    protected $fillable = [
        'UserId',
        'StateId',
        'BranchId',
        'City',
        'Colony',
        'PostalCode',
        'IsActive',
    ];

    protected $primaryKey = 'Id';

    public static function getAll()
    {
        return DB::table('postal_coverages')
            ->join('states', 'states.Id', '=', 'postal_coverages.StateId')
            ->join('branch_offices', 'branch_offices.Id', '=', 'postal_coverages.BranchId')
            ->select('postal_coverages.*', 'states.Name as State', 'branch_offices.Name as Branch')
            ->get();
    }

    public static function getActivesByBranch($branchId)
    {
        return DB::table('postal_coverages')
            ->join('states', 'states.Id', '=', 'postal_coverages.StateId')
            ->join('branch_offices', 'branch_offices.Id', '=', 'postal_coverages.BranchId')
            ->select('postal_coverages.*', 'states.Name as State', 'branch_offices.Name as Branch')
            ->where('postal_coverages.BranchId', $branchId)
            ->where('postal_coverages.IsActive', 1)
            ->get();

    }
}
