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
        $categories = self::getActives();
        $tree = [];
        foreach ($categories as $category) {
            if ($category->ParentId == 0) {
                $tree[] = [
                    'id' => $category->Id,
                    'name' => $category->Name,
                    'children' => []
                ];
            } else {
                foreach($tree as &$parent) {
                    if ($parent['id'] == $category->ParentId) {
                        $parent['children'][] = [
                            'id' => $category->Id,
                            'name' => $category->Name,
                        ];
                    }
                }
            }
        }
        return $tree;
    }
}