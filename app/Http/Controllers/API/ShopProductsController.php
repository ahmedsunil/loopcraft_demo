<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageUploadRequest;
use App\Http\Requests\StoreShopProductRequest;
use App\Http\Requests\UpdateShopProductRequest;
use App\Models\Shop\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShopProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     */
    public function index()
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(['name'])
            ->with('brand','categories','comments')
            ->get();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreShopProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product Created Successfully',
            'data' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $shop_product
     * @return JsonResponse
     */
    public function show(Product $shop_product)
    {
        $products = QueryBuilder::for(Product::class)
            ->with('brand','categories','comments')
            ->find($shop_product->id);

        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateShopProductRequest $request
     * @param Product $shop_product
     * @return JsonResponse
     */
    public function update(UpdateShopProductRequest $request, Product $shop_product)
    {
        $shop_product->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product Updated Successfully',
            'data' => $shop_product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $shop_product)
    {
        $shop_product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Deleted Successfully',
        ]);
    }

    public function uploadImage(ProductImageUploadRequest $request, Product $product)
    {
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $fileName = time() . $image->getClientOriginalName();
            $image->storeAs('products/images', $fileName);

            $product->file_path = $fileName;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Product Image Uploaded Successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Image file not found.',
            ], 400);
        }
    }
}
