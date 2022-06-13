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

    public static function getActivesTree()
    {
        $tree = [];
        $categories = self::where('Active', 1)->whereNull('ParentId')->orWhere('ParentId', 0)->orderBy('Name')->get();
        foreach ($categories as $k => $v) {
            $childs = self::where('Active', 1)->where('ParentId', $v->Id)->orderBy('Name')->get();
            $tree[$k] = [
                'id' => $v->Id,
                'text' => $v->Name,
                'parent' => $v->ParentId,
                'children' => []
            ];

            foreach ($childs as $child) {
                $tree[$k]['children'][] = [
                    'id' => $child->Id,
                    'text' => $child->Name,
                    'parent' => $child->ParentId,
                ];
            }
        }

        return $tree;
    }
}
