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
            ModelsProductPrices::updateOrCreate([
                'ProductId' => $request->input('pid')
            ], [
                'LastUpdater' => auth()->user()->id,
                'BasePrice' => $request->input('price'),
                'DiscountType' => $request->input('discount_type'),
                'DiscountPercent' => $request->input('discount_percent'),
                'DiscountFixed' => $request->input('discount_fixed'),
            ]);

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
                    ['ParentId' => null, 'Description' => $product['department'], 'Active' => 1]
                );

                $arrayReturn[$k]['department'] = $department;

                $category = ModelsProductCategories::updateOrCreate(
                    ['Name' => $product['category'], 'ParentId' => $department->Id],
                    ['Description' => $product['category'], 'Active' => 1]
                );

                $arrayReturn[$k]['category'] = $category;

                $unit = ModelsUnits::updateOrCreate(
                    ['Name' => $product['unit']],
                    ['Key' => substr($product['unit'], 0, 2), 'Active' => 1]
                );

                $arrayReturn[$k]['unit'] = $unit;

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
                    ]
                );

                $arrayReturn[$k]['product'] = $productN;

                // $price = ModelsProductPrices::updateOrCreate(
                //     ['ProductId' => $productN->Id],
                //     [
                //         'LastUpdater' => 1,
                //         'BasePrice' => $product['price'],
                //         'DiscountType' => 0
                //     ]
                // );

                // $stock = ModelsProductStock::where('ProductId', $productN->Id)->where('BranchId', $branchId)->first();
                // if ($stock) {
                //     $stock->Quantity = $product['stock'];
                //     $stock->save();
                // } else {
                //     ModelsProductStock::create([
                //         'LastUpdater' => 1,
                //         'ProductId' => $productN->Id,
                //         'BranchId' => $branchId,
                //         'Quantity' => $product['stock']
                //     ]);
                // }
            }

            return [
                'code'  => 200,
                'products' => $arrayReturn
            ];
        } catch (Throwable $th) {
            return [
                'code'  => 500,
                'exception' => $th->getMessage(),
            ];
        }
    }
}
