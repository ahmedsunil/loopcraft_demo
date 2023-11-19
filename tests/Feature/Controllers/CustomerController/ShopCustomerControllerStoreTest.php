<?php

namespace Controllers\CustomerController;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShopCustomerControllerStoreTest extends TestCase
{
    public function test_can_create_customer(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $route = route('shop_customers.store');
        $response = $this->postJson($route, [
            'name' => 'Huseynu Ali',
            'email' => 'huseynuali@hotmail.com',
            'gender' => 'male'
        ]);

        $response->assertOk();
    }

    public function test_name_is_required(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $route = route('shop_customers.store');
        $response = $this->postJson($route, []);
        $response->assertJsonValidationErrors([
            'name' => 'required'
        ]);
    }

}
