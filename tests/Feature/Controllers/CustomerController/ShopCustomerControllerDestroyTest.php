<?php

namespace Controllers\CustomerController;
use App\Models\Shop\Customer;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShopCustomerControllerDestroyTest extends TestCase
{
    public function test_can_destroy_customer(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $shop_customer = Customer::factory()->create();

        $route = route('shop_customers.destroy', $shop_customer);
        $response = $this->deleteJson($route);

        $response->assertOk();
    }

    public function test_unauthenticated_response()
    {
        $shop_customer = Customer::factory()->create();
        $route = route('shop_customers.destroy', $shop_customer);
        $response = $this->deleteJson($route);

        $response->assertUnauthorized();
    }

}
