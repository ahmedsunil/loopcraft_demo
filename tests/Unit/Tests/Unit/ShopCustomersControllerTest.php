<?php

namespace Tests\Unit;

use App\Models\Shop\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopCustomersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_customers_with_related_data()
    {
        // Arrange
        $customer = Customer::factory()->create();
        // Add related data if needed

        // Act
        $response = $this->json('GET', '/api/shop_customers');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                "passsed"
            ]);
    }


}

