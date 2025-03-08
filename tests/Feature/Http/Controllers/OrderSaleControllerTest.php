<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSaleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order_sale()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/order-sales', [
            'customer_name' => 'John Doe',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'customer_name' => 'John Doe',
                     'total_amount' => 00,
                     'user_id' => $user->id,
                 ]);

        $this->assertDatabaseHas('order_sales', [
            'customer_name' => 'John Doe',
            'total_amount' => 0,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_fails_to_create_an_order_sale_with_empty_customer_name()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/order-sales', [
            'customer_name' => '',            
            'user_id' => $user->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('customer_name');
    }

    /** @test */
    public function it_fails_to_create_an_order_sale_with_total_amount_as_text()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/order-sales', [
            'customer_name' => 'John Doe',
            'total_amount' => 'one hundred',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('total_amount');
    }
}