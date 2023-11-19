<?php

namespace Controllers\CustomerController;
use App\Models\Shop\Customer;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShopCustomerControllerShowTest extends TestCase
{
    public function test_can_see_create_customer(): void
    {
        $user = User::factory()->create();
        $shop_customer = Customer::factory()->create();

        Sanctum::actingAs($user);

        $route = route('shop_customers.show', $shop_customer);
        $response = $this->getJson($route);
        $response->assertOk();

    }

    public function test_unauthenticated_response(): void
    {
        $shop_customer = Customer::factory()->create();

        $route = route('shop_customers.show', $shop_customer);
        $response = $this->getJson($route);
        $response->assertUnauthorized();

    }
}
