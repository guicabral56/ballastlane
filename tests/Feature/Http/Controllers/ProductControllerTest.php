<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\OrderSale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Sample Product',
            'price' => 100,
            'order_sale_id' => $orderSale->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Sample Product',
                     'price' => 100,
                     'order_sale_id' => $orderSale->id,
                     'user_id' => $user->id,
                 ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Sample Product',
            'price' => 100,
            'order_sale_id' => $orderSale->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_fails_to_create_a_product_with_empty_name()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => '',
            'price' => 100,
            'order_sale_id' => $orderSale->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_fails_to_create_a_product_with_price_as_text()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Sample Product',
            'price' => 'one hundred',
            'order_sale_id' => $orderSale->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('price');
    }

    /** @test */
    public function it_fails_to_create_a_product_with_invalid_order_sale_id()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Sample Product',
            'price' => 100,
            'order_sale_id' => 999, // Invalid order_sale_id
            'user_id' => $user->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('order_sale_id');
    }

    /** @test */
    public function it_fails_to_create_a_product_with_invalid_user_id()
    {
        $orderSale = OrderSale::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Sample Product',
            'price' => 100,
            'order_sale_id' => $orderSale->id,
            'user_id' => 999, // Invalid user_id
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('user_id');
    }
}