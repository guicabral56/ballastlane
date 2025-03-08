<?php

namespace Tests\Core\Application\Product;

use App\Models\OrderSale;
use App\Models\User;
use Tests\TestCase;
use Core\Application\Product\ProductHandler;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct()
    {
        $handler = new ProductHandler();
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();
        $product = $handler->create('Test Product', 100, $user->id, $orderSale->id);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(100, $product->price);
        $this->assertEquals($user->id, $product->user_id);
        $this->assertEquals($orderSale->id, $product->order_sale_id);
    }

    public function testUpdateProduct()
    {
        $handler = new ProductHandler();
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();
        $product = Product::create([
            'name' => 'Old Product',
            'price' => 50,
            'user_id' => $user->id,
            'order_sale_id' => $orderSale->id,
        ]);

        $updatedProduct = $handler->update($product->id, 'Updated Product', 150);

        $this->assertEquals('Updated Product', $updatedProduct->name);
        $this->assertEquals(150, $updatedProduct->price);
        $this->assertEquals($user->id, $updatedProduct->user_id);
    }

    public function testDeleteProduct()
    {
        $handler = new ProductHandler();
        $user = User::factory()->create();
        $orderSale = OrderSale::factory()->create();
        $product = Product::create([
            'name' => 'Product to Delete',
            'price' => 75,
            'user_id' => $user->id,
            'order_sale_id' => $orderSale->id,
        ]);

        $handler->delete($product->id);

        $this->assertNull(Product::find($product->id));
    }
}
