<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopBrandRequest;
use App\Http\Requests\UpdateShopBrandRequest;
use App\Models\Shop\Brand;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShopBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $brands = QueryBuilder::for(Brand::class)
            ->allowedFilters(['name'])
            ->with('addresses','products','media')
            ->get();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShopBrandRequest $request
     */
    public function store(StoreShopBrandRequest $request)
    {
        $brand = Brand::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Brand Created Successfully',
            'data' => $brand,
        ]);
    }

    /**
     * Display the specified resource.
     **/
    public function show(Brand $shop_brand)
    {
        $brand = QueryBuilder::for(Brand::class)
            ->with('addresses','products','media')
            ->find($shop_brand->id);

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopBrandRequest $request, Brand $shop_brand)
    {
        $shop_brand->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Brand Updated Successfully',
            'data' => $shop_brand,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $shop_brand)
    {
        $shop_brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brand Deleted Successfully',
        ]);
    }
}
