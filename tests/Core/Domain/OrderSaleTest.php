<?php

namespace Tests\Core\Domain;

use Core\Domain\OrderSale;
use Core\Domain\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class OrderSaleTest extends TestCase
{
    /** @test */
    public function it_can_create_an_order_sale()
    {
        $orderSale = new OrderSale('John Doe', 0, 1);

        $this->assertEquals('John Doe', $orderSale->getCustomerName());
        $this->assertEquals(0, $orderSale->getTotalAmount());
        $this->assertEquals(1, $orderSale->getUserId());
    }

    /** @test */
    public function it_throws_exception_for_invalid_customer_name()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Customer name is required and must be at least 3 characters long.');

        new OrderSale('', 0, 1);
    }

    /** @test */
    public function it_throws_exception_for_invalid_total_amount()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Total amount must be a positive number.');

        new OrderSale('John Doe', -1, 1);
    }

    /** @test */
    public function it_throws_exception_for_invalid_user_id()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('User ID must be a valid number.');

        new OrderSale('John Doe', 0, 0);
    }

    /** @test */
    public function it_can_add_products_and_update_total_amount()
    {
        $orderSale = new OrderSale('John Doe', 0, 1);

        $product1 = new Product('Product 1', 100, 1);
        $product2 = new Product('Product 2', 200, 1);

        // Add products
        $orderSale->addProduct($product1);
        $orderSale->addProduct($product2);

        $this->assertCount(2, $orderSale->getProducts());
        $this->assertEquals(300, $orderSale->getTotalAmount());
    }

    /** @test */
    public function it_can_edit_products_and_update_total_amount()
    {
        $orderSale = new OrderSale('John Doe', 0, 1);

        $product1 = new Product('Product 1', 100, 1);
        $product2 = new Product('Product 2', 200, 1);

        // Add products
        $orderSale->addProduct($product1);
        $orderSale->addProduct($product2);

        // Edit product
        $product3 = new Product('Product 3', 150, 1);
        $orderSale->updateProduct($product1, $product3);

        $this->assertCount(2, $orderSale->getProducts());
        $this->assertEquals(350, $orderSale->getTotalAmount());
    }

    /** @test */
    public function it_can_remove_products_and_update_total_amount()
    {
        $orderSale = new OrderSale('John Doe', 0, 1);

        $product1 = new Product('Product 1', 100, 1);
        $product2 = new Product('Product 2', 200, 1);

        // Add products
        $orderSale->addProduct($product1);
        $orderSale->addProduct($product2);

        // Remove product
        $orderSale->removeProduct($product2);

        $this->assertCount(1, $orderSale->getProducts());
        $this->assertEquals(100, $orderSale->getTotalAmount());
    }
}