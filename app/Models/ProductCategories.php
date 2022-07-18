<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Description',
        'Active',
        'ParentId',
        'Slug'
    ];

    public static function getAll()
    {
        return self::from('product_categories as c_pc')->select(
            "c_pc.*",
            DB::raw("(select concat(Name, if(pc.ParentId > 0,concat(' (',(select Name from product_categories where Id = pc.ParentId),')'),'')) from product_categories pc where Id = c_pc.ParentId) as ParentName"),
            DB::raw("
            concat(
                c_pc.Name,
                if(c_pc.ParentId > 0, concat(' (',(select Name from product_categories where Id = c_pc.ParentId),')'),''),
                if(c_pc.Active = 0,' [" . __('Inactive') . "]','')
            ) as NameStatus")
        )->orderBy('Name')->get();
    }

    public static function getChilds()
    {
        return self::from('product_categories as c_pc')
            ->whereNotNull('ParentId')
            ->select(
                "c_pc.*",
                DB::raw("(select concat(Name, if(pc.ParentId > 0,concat(' (',(select Name from product_categories where Id = pc.ParentId),')'),'')) from product_categories pc where Id = c_pc.ParentId) as ParentName"),
                DB::raw("
            concat(
                c_pc.Name,
                if(c_pc.ParentId > 0, concat(' (',(select Name from product_categories where Id = c_pc.ParentId),')'),''),
                if(c_pc.Active = 0,' [" . __('Inactive') . "]','')
            ) as NameStatus")
            )->orderBy('Name')->get();
    }

    public static function getActives()
    {
        return self::from('product_categories as c_pc')
            ->select(
                "c_pc.*",
                DB::raw("(select Name from product_categories where Id = c_pc.ParentId) as ParentName")
            )->where('Active', 1)
            ->orderBy('c_pc.Name')->get();
    }

    public static function getOne(int $id)
    {
        return self::from('product_categories as c_pc')
            ->select(
                "c_pc.*",
                DB::raw("(select Name from product_categories where Id = c_pc.ParentId) as ParentName")
            )->where('Id', $id)->first();
    }

    public static function getActivesTree($branchId)
    {
        $tree = [];
        $categories = DB::table('products as p')
            ->join('product_prices as pp', 'p.Id', '=', 'pp.ProductId')
            ->join('product_categories as pc', 'pc.Id', '=', 'p.CategoryId')
            ->join('product_categories as pd', 'pd.Id', '=', 'pc.ParentId')
            ->join('product_stocks as ps', 'ps.ProductId', '=', 'p.Id')
            ->where('p.Active', 1)
            ->where('ps.BranchId', $branchId)
            ->where('pp.BranchId', $branchId)
            ->where('ps.Quantity', '>', 0)
            ->select(
                'pd.Id as DepartmentId',
                'pd.Name as DepartmentName',
                'pd.Slug as DepartmentSlug',
                'pc.Id as CategoryId',
                'pc.Name as CategoryName',
                'pc.Slug as CategorySlug',
            )
            ->groupBy('pd.Id', 'pd.Name', 'pd.Slug', 'pc.Id', 'pc.Name', 'pc.Slug')
            ->orderBy('DepartmentName')
            ->orderBy('CategoryName');

        // dd(self::getQueryWithBindings($categories));

        $categories = $categories->get();

        // self::where('Active', 1)->whereNull('ParentId')->orWhere('ParentId', 0)->orderBy('Name')->get();
        foreach ($categories as $v) {
            if (!array_key_exists($v->DepartmentName, $tree)) {
                $tree[$v->DepartmentName] = [
                    'id' => $v->DepartmentId,
                    'text' => $v->DepartmentName,
                    'parent' => null,
                    'slug' => $v->DepartmentSlug,
                    'children' => []
                ];
            }

            $tree[$v->DepartmentName]['children'][] = [
                'id' => $v->CategoryId,
                'text' => $v->CategoryName,
                'parent' => $v->DepartmentId,
                'slug' => $v->CategorySlug
            ];

        }

        return $tree;
    }
}
