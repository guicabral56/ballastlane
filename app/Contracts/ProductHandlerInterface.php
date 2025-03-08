<?php

namespace App\Contracts;

use App\Models\Product as ProductModel;

interface ProductHandlerInterface
{
    public function list(): array;
    public function find(int $id): ProductModel;
    public function create(string $name, int $price, int $userId, int $orderSaleId): ProductModel;
    public function update(int $id, string $name, int $price): ProductModel;
    public function delete(int $id): void;
}