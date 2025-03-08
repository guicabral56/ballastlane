<?php

namespace Tests\Core\Application\Product;

use App\Models\User;
use Tests\TestCase;
use Core\Application\OrderSale\OrderSaleHandler;
use App\Models\OrderSale;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderSaleHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateOrderSale()
    {
        $user = User::factory()->create();
        
        $handler = new OrderSaleHandler();
        $orderSale = $handler->create('John Doe', $user->id);

        $this->assertInstanceOf(OrderSale::class, $orderSale);
        $this->assertEquals('John Doe', $orderSale->customer_name);
        $this->assertEquals(0, $orderSale->total_amount);
        $this->assertEquals($user->id, $orderSale->user_id);
    }

    public function testUpdateOrderSale()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::create([
            'customer_name' => 'Jane Doe',
            'total_amount' => 0,
            'user_id' => $user->id,
        ]);
        
        $handler = new OrderSaleHandler();
        $updatedOrderSale = $handler->update($orderSale->id, 'John Doe');

        $this->assertEquals('John Doe', $updatedOrderSale->customer_name);
        $this->assertEquals($user->id, $updatedOrderSale->user_id);
    }

    public function testDeleteOrderSale()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::create([
            'customer_name' => 'Jane Doe',
            'total_amount' => 0,
            'user_id' => $user->id,
        ]);
        
        $handler = new OrderSaleHandler();
        $handler->delete($orderSale->id);

        $this->assertNull(OrderSale::find($orderSale->id));
    }

    public function testListOrderSales()
    {
        $user = User::factory()->create();
        OrderSale::create([
            'customer_name' => 'Jane Doe',
            'total_amount' => 0,
            'user_id' => $user->id,
        ]);
        
        $handler = new OrderSaleHandler();
        $orderSales = $handler->list();

        $this->assertIsArray($orderSales);
        $this->assertCount(1, $orderSales);
    }

    public function testFindOrderSale()
    {
        $user = User::factory()->create();
        $orderSale = OrderSale::create([
            'customer_name' => 'Jane Doe',
            'total_amount' => 0,
            'user_id' => $user->id,
        ]);
        
        $handler = new OrderSaleHandler();
        $foundOrderSale = $handler->find($orderSale->id);

        $this->assertInstanceOf(OrderSale::class, $foundOrderSale);
        $this->assertEquals($orderSale->id, $foundOrderSale->id);
    }
}
