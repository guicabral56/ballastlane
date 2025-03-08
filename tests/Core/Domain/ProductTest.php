<?php

namespace Tests\Core\Domain;

use Core\Domain\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function it_can_create_a_product()
    {
        $product = new Product('Sample Product', 100, 1);

        $this->assertEquals('Sample Product', $product->getName());
        $this->assertEquals(100, $product->getPrice());
        $this->assertEquals(1, $product->getUserId());
    }

    /** @test */
    public function it_throws_exception_for_invalid_name()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Name is required and must be at least 3 characters long.');

        new Product('', 100, 1);
    }

    /** @test */
    public function it_throws_exception_for_short_name()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Name is required and must be at least 3 characters long.');

        new Product('ab', 100, 1);
    }
}