<?php

namespace Tests\Unit;

use App\Models\OrderSale;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $userId = User::factory()->create()->id;
        $orderSale = OrderSale::create([
            'customer_name' => 'John Doe',
            'total_amount' => 100.00,
            'user_id' => $userId,
        ]);

        Product::create([
            'name' => 'Sample Product',
            'price' => 50.00,
            'user_id' => $userId,
            'order_sale_id' => $orderSale->id,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Sample Product',
            'price' => 50.00,
            'user_id' => $userId,
            'order_sale_id' => $orderSale->id,
        ]);
    }
}
