<?php

namespace Tests\Unit;

use App\Models\OrderSale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order_sale()
    {
        $userId = User::factory()->create()->id;
        OrderSale::create([
            'customer_name' => 'John Doe',
            'total_amount' => 100.00,
            'user_id' => $userId,
        ]);

        $this->assertDatabaseHas('order_sales', [
            'customer_name' => 'John Doe',
            'total_amount' => 100.00,
            'user_id' => $userId,
        ]);
    }
}
