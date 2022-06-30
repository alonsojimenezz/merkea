<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Models\Products as ModelsProducts;
use App\Models\ProductTags as ModelsProductTags;
use App\Models\ProductPrices as ModelsProductPrices;
use App\Models\ProductStock as ModelsProductStock;
use App\Models\ProductStockMovements as ModelsProductStockMovements;
use App\Models\BranchOffices as ModelsBranchOffices;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\Units as ModelsUnits;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductsApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $exist = ModelsProducts::where('Name', $request->input('name'))
                ->orWhere('Slug', $request->input('slug'))->first();
            if (!$exist) {

                $product = ModelsProducts::create([
                    'Slug' => $request->input('slug'),
                    'Name' => $request->input('name'),
                    'Key' => $request->input('key'),
                    'Active' => 1
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Product saved successfully'),
                    'product' => $product
                ]);
            } else {
                return $this->jsonResponse(400, __('The product or product slug already exists'));
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = ModelsProducts::find($id);
            if ($product) {

                ModelsProducts::where('Id', $id)->update([
                    'Name' => $request->input('name') ?? $product->Name,
                    'Slug' => $request->input('slug') ?? $product->Slug,
                    'Key' => $request->input('key') ?? $product->Key,
                    'Barcode' => $request->input('barcode') ?? $product->Barcode,
                    'Description' => $request->input('description') ?? $product->Description
                ]);

                return $this->jsonResponse(200, __('Updated'), [
                    'alert' => __('Product updated successfully'),
                    'product' => $product
                ]);
            } else {
                return $this->jsonResponse(400, __('Product not found'));
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadMainImage(Request $request)
    {
        try {
            $product = ModelsProducts::find($request->input('pid'));
            if (is_file(public_path($product->Image)))
                unlink(public_path($product->Image));

            $imagePath = $request->file('image')->store('products/' . date('Y') . '/' . date('m') . '/' . date('d'), 'files');
            ModelsProducts::where('Id', $request->input('pid'))->update([
                'Image' => 'files/' . $imagePath
            ]);
            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The main product image was updated successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function changeProductStatus(Request $request)
    {
        try {
            ModelsProducts::where('Id', $request->input('pid'))->update([
                'Active' => $request->input('active')
            ]);
            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product status was updated successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function changeProductCategory(Request $request)
    {
        try {
            ModelsProducts::where('Id', $request->input('pid'))->update([
                'CategoryId' => $request->input('category')
            ]);
            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product category was updated successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function highlightProduct(Request $request)
    {
        try {
            ModelsProducts::where('Id', $request->input('pid'))->update([
                'Highlight' => $request->input('highlight')
            ]);

            $alert = $request->input('highlight') == 1 ? __('The product was highlighted successfully') : __('The product highlight was removed successfully');
            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => $alert
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function changeProductTags(Request $request)
    {
        try {
            ModelsProductTags::where('ProductId', $request->input('pid'))->delete();
            $tags = array_column(json_decode($request->input('tags')), 'value');

            foreach ($tags as $tag) {
                ModelsProductTags::create([
                    'Tag' => $tag,
                    'ProductId' => $request->input('pid'),
                    'UserId' => auth()->user()->id
                ]);
            }

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product tags were updated successfully'),
                'tags' => $request->input('tags')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function uploadGallery(Request $request)
    {
        try {
            $files = $request->file('gallery');

            foreach ($files as $file) {
                $path = $file->store('products/' . date('Y') . '/' . date('m') . '/' . date('d'), 'files');

                ProductImages::create([
                    'ProductId' => $request->input('pid'),
                    'Image' => 'files/' . $path,
                    'UserId' => auth()->user()->id
                ]);
            }

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The images was saved successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function deleteGalleryImage(Request $request)
    {
        try {
            $image = ProductImages::find($request->input('gid'));
            if (is_file(public_path($image->Image)))
                unlink(public_path($image->Image));

            ProductImages::where('Id', $request->input('gid'))->delete();

            return $this->jsonResponse(200, __('Removed successfully'), [
                'alert' => __('The image was deleted successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function changeProductUnits(Request $request)
    {
        try {
            ModelsProducts::where('Id', $request->input('pid'))->update([
                'UnitId' => $request->input('unit')
            ]);
            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product unit of measure was updated successfully')
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function setProductPrices(Request $request)
    {
        try {
            foreach ($request->input('prices') as $price) {
                ModelsProductPrices::updateOrCreate([
                    'ProductId' => $request->input('pid'),
                    'BranchId' => $price['branch'],
                ], [
                    'LastUpdater' => auth()->user()->id,
                    'BasePrice' => $price['price'],
                    'DiscountType' => $price['discount_type'],
                    'DiscountPercent' => $price['discount_percent'],
                    'DiscountFixed' => $price['discount_fixed'],
                ]);
            }

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product price was updated successfully'),
                'request' => $request->all()
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
                'request' => $request->all()
            ]);
        }
    }

    public function setProductStock(Request $request)
    {
        try {
            $stocks = $request->input('stocks');
            foreach ($stocks as $stock) {
                $previusStock = ModelsProductStock::where('ProductId', $stock['pid'])->where('BranchId', $stock['branch'])->first();
                $newStock = ModelsProductStock::updateOrCreate([
                    'ProductId' => $stock['pid'],
                    'BranchId' => $stock['branch'],
                ], [
                    'LastUpdater' => auth()->user()->id,
                    'Quantity' => $stock['stock']
                ]);

                ModelsProductStockMovements::create([
                    'UserId' => auth()->user()->id,
                    'ProductId' => $stock['pid'],
                    'BranchId' => $stock['branch'],
                    'Quantity' => $stock['stock'],
                    'PreviousQuantity' => $previusStock ? $previusStock->Quantity : 0,
                    'UserId' => auth()->user()->id,
                    'ReasonId' => 1,
                    'Description' => 'Inventory adjustment by user'
                ]);
            }

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product stock were updated successfully'),
                'movements' => ModelsProducts::movements($request->input('pid'))
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function uploadInventory(Request $request)
    {
        try {
            $path = $request->file('inventory')->getRealPath();

            $data = Excel::toArray([], $path);

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product stock were updated successfully'),
                'data'  => $data
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    public function serviceUpdate(Request $request, $key)
    {
        try {
            $isValidKey = $this->validateServiceKey($key);
            if ($isValidKey > 0) {
                $processed = $this->processProducts($request->input('products'), $isValidKey);
                return $this->jsonResponse(200, __('Products updated successfully'), [
                    'result' => $processed
                ]);
            } else {
                return $this->jsonResponse(500, __('Service Key is not valid'));
            }
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }

    private function validateServiceKey($key)
    {
        $branchId = ModelsBranchOffices::where('ServiceKey', $key)->first();
        if (!$branchId)
            return 0;
        return $branchId->Id;
    }

    private function processProducts($products, $branchId)
    {
        try {
            $arrayReturn = [];
            foreach ($products as $k => $product) {
                $department = ModelsProductCategories::updateOrCreate(
                    ['Name' => $product['department']],
                    ['Slug' => Str::slug($product['department'], '-', 'es'), 'ParentId' => null, 'Description' => $product['department'], 'Active' => 1]
                );

                $category = ModelsProductCategories::updateOrCreate(
                    ['Name' => $product['category'], 'ParentId' => $department->Id],
                    ['Slug' => Str::slug($product['category'], '-', 'es'), 'Description' => $product['category'], 'Active' => 1]
                );

                $unit = ModelsUnits::updateOrCreate(
                    ['Name' => $product['unit']],
                    ['Key' => substr($product['unit'], 0, 2), 'Active' => 1]
                );

                $product['description'] = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $product['description'])));

                $searchDuplicityName = ModelsProducts::where('Name', $product['description'])->where('Key', '<>', $product['key'])->first();
                if ($searchDuplicityName) {
                    $product['description'] = $product['description'] . ' ' . $product['key'];
                }

                $productN = ModelsProducts::updateOrCreate(
                    ['Key' => $product['key']],
                    [
                        'Name' => $product['description'],
                        'UnitId' => $unit->Id,
                        'CategoryId' => $category->Id,
                        'Slug' => Str::slug($product['description'], '-', 'es'),
                        'BarCode' => $product['key'],
                        'Active' => $product['status'] > 0 ? 1 : 0,
                        'granel' => $product['granel'] > 0 ? 1 : 0,
                    ]
                );

                $productId = $productN->Id ?? $productN->id;

                try {
                    $price = ModelsProductPrices::updateOrCreate(
                        [
                            'ProductId' => $productId,
                            'BranchId' => $branchId
                        ],
                        [
                            'LastUpdater' => 1,
                            'BasePrice' => $product['price']
                        ]
                    );
                } catch (Throwable $th) {
                    $arrayReturn[$k]['error']['price'] = $th->getMessage();
                }

                try {
                    $stock = ModelsProductStock::where('ProductId', $productId)->where('BranchId', $branchId)->first();
                    if ($stock) {
                        if ($stock->Quantity != $product['stock']) {

                            ModelsProductStockMovements::create([
                                'UserId' => 1,
                                'ProductId' => $productId,
                                'BranchId' => $branchId,
                                'Quantity' => $product['stock'],
                                'PreviousQuantity' => $stock->Quantity,
                                'ReasonId' => 3,
                                'Description' => 'Inventory Update from Sicar Service by user'
                            ]);

                            $stock->Quantity = $product['stock'];
                            $stock->save();
                        }
                    } else {
                        $stock = ModelsProductStock::create([
                            'LastUpdater' => 1,
                            'ProductId' => $productId,
                            'BranchId' => $branchId,
                            'Quantity' => ($product['stock'] < 0) ? 0 : $product['stock']
                        ]);

                        ModelsProductStockMovements::create([
                            'UserId' => 1,
                            'ProductId' => $productId,
                            'BranchId' => $branchId,
                            'Quantity' => $product['stock'],
                            'PreviousQuantity' => 0,
                            'ReasonId' => 2,
                            'Description' => 'Sicar Initial Inventory by user'
                        ]);
                    }
                } catch (Throwable $th) {
                    $arrayReturn[$k]['error']['stock'] = $th->getMessage();
                }
            }

            try {
                DB::unprepared("
                UPDATE product_categories set Active = 1;

                update
                product_categories c
                set c.Active = 0
                where c.ParentId is not null
                and c.Id not in (
                    select
                    p.CategoryId
                    from products p
                    inner join product_stocks s on p.Id = s.ProductId
                    where p.Active = 1
                    and s.Quantity > 0
                    and p.CategoryId is not null
                    group by p.CategoryId
                );

                update product_categories
                set Active = 0
                where Id in (
                    select * from (
                        select
                        c.Id
                        from product_categories c
                        where c.ParentId is null
                        and (select count(*) from product_categories c2 where c2.ParentId = c.Id and c2.Active = 1) = 0
                    ) as tf
                )");
            } catch (Throwable $th) {
                $arrayReturn['error']['category'] = $th->getMessage();
            }

            return [
                'code'  => 200,
                'errors' => $arrayReturn
            ];
        } catch (Throwable $th) {
            return [
                'code'  => 500,
                'exception' => $th->getMessage(),
            ];
        }
    }
}
