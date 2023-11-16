<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopCustomerRequest;
use App\Http\Requests\UpdateShopCustomerRequest;
use App\Models\Shop\Customer;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShopCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function index()
    {
        $customers = QueryBuilder::for(Customer::class)
            ->allowedFilters(['name', 'email'])
            ->with('addresses','payments','comments')
            ->get();

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShopCustomerRequest $request
     * @return JsonResponse
     */
    public function store(StoreShopCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer Created Successfully',
            'data' => $customer,
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Customer $shop_customer)
    {
        $customer = QueryBuilder::for(Customer::class)
            ->with('addresses','payments','comments')
            ->find($shop_customer->id);

        return response()->json($customer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(UpdateShopCustomerRequest $request, Customer $shop_customer)
    {
        $shop_customer->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer Updated Successfully',
            'data' => $shop_customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(Customer $shop_customer)
    {
        $shop_customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer Deleted Successfully',
        ]);
    }
}
