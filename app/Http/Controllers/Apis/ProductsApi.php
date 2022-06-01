<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Models\Products as ModelsProducts;
use App\Models\ProductTags as ModelsProductTags;
use App\Models\ProductUnits as ModelsProductUnits;
use App\Models\ProductPrices as ModelsProductPrices;
use App\Models\ProductStock as ModelsProductStock;
use App\Models\ProductStockMovements as ModelsProductStockMovements;
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
                $previusStock = ModelsProductStock::where('ProductId', $stock['pid'])->where('UnitId', $stock['unit'])->first();
                $newStock = ModelsProductStock::updateOrCreate([
                    'ProductId' => $stock['pid'],
                    'UnitId' => $stock['unit'],
                ], [
                    'LastUpdater' => auth()->user()->id,
                    'Quantity' => $stock['stock']
                ]);

                ModelsProductStockMovements::create([
                    'UserId' => auth()->user()->id,
                    'ProductId' => $stock['pid'],
                    'UnitId' => $stock['unit'],
                    'Quantity' => $stock['stock'],
                    'PreviousQuantity' => $previusStock ? $previusStock->Quantity : 0,
                    'UserId' => auth()->user()->id,
                    'ReasonId' => 1,
                    'Description' => 'Inventory adjustment by user'
                ]);
            }

            return $this->jsonResponse(200, __('Saved successfully'), [
                'alert' => __('The product stock were updated successfully'),
            ]);
        } catch (Throwable $th) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $th->getMessage(),
            ]);
        }
    }
}
