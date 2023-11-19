<?php

namespace Tests\Feature\Controllers\CustomerController;
use App\Models\Shop\Customer;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShopCustomerControllerIndexTest extends TestCase
{
    public function test_authenticated_users_can_fetch_the_customers(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Customer::factory()->create();

        $route = route('shop_customers.index');
        $response = $this->getJson($route);

        $response->assertOk();
    }

    /**
     * @dataProvider filterFields
     * */
    public function test_filterable_fields($field, $value, $expectedCode): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $route = route('shop_customers.index', [
            "filter[{$field}]" => $value,
        ]);
        $response = $this->getJson($route);
        $response->assertStatus($expectedCode);

        $response->assertOk();
    }

    public function filterFields(): array
    {
       return [
           ['name','Jacinto', 200],
       ];
    }

    public function test_unauthenticated_users_can_not_fetch_the_customers(): void
    {
        $route = route('shop_customers.index');
        $response = $this->getJson($route);

        $response->assertUnauthorized();
    }





}
