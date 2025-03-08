<?php

namespace Core\Domain;

use InvalidArgumentException;

class OrderSale
{
    private string $customerName;
    private float $totalAmount;
    private int $userId;
    private array $products = [];

    public function __construct(string $customerName, float $totalAmount, int $userId)
    {
        $this->setCustomerName($customerName);
        $this->setTotalAmount($totalAmount);
        $this->setUserId($userId);
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    private function setCustomerName(string $customerName): void
    {
        if (empty($customerName) || strlen($customerName) < 3) {
            throw new InvalidArgumentException('Customer name is required and must be at least 3 characters long.');
        }
        $this->customerName = $customerName;
    }

    private function setTotalAmount(float $totalAmount): void
    {
        if ($totalAmount < 0) {
            throw new InvalidArgumentException('Total amount must be a positive number.');
        }
        $this->totalAmount = $totalAmount;
    }

    private function setUserId(int $userId): void
    {
        if (empty($userId)) {
            throw new InvalidArgumentException('User ID must be a valid number.');
        }
        $this->userId = $userId;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
        $this->updateTotalAmount();
    }

    public function removeProduct(Product $product): void
    {
        foreach ($this->products as $key => $existingProduct) {
            if ($existingProduct === $product) {
                unset($this->products[$key]);
                $this->products = array_values($this->products);
                $this->updateTotalAmount();
                return;
            }
        }
    }

    public function updateProduct(Product $oldProduct, Product $newProduct): void
    {
        foreach ($this->products as $key => $existingProduct) {
            if ($existingProduct === $oldProduct) {
                $this->products[$key] = $newProduct;
                $this->updateTotalAmount();
                return;
            }
        }
    }

    private function updateTotalAmount(): void
    {
        $this->totalAmount = array_reduce($this->products, function ($carry, Product $product) {
            return $carry + $product->getPrice();
        }, 0);
    }
}