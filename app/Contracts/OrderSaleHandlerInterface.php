<?php 

namespace App\Contracts;

use App\Models\OrderSale as OrderSaleModel;

interface OrderSaleHandlerInterface {
    public function create(string $customerName, int $userId): OrderSaleModel;

    public function update(int $id, string $customerName): OrderSaleModel;
    public function delete(int $id): void;
    public function find(int $id): OrderSaleModel;
    public function list(): array;
}