<?php

namespace Core\Application\OrderSale;

use App\Contracts\OrderSaleHandlerInterface;
use App\Models\OrderSale as OrderSaleModel;
use Core\Domain\OrderSale;

class OrderSaleHandler implements OrderSaleHandlerInterface
{
    public function list(): array
    {
        return OrderSaleModel::all()->toArray();
    }

    public function create(string $customerName, int $userId): OrderSaleModel
    {
        $model = new OrderSale($customerName, 0, $userId);

        return OrderSaleModel::create([
            'customer_name' => $model->getCustomerName(),
            'user_id' => $model->getUserId(),
            'total_amount' => 0
        ]);
    }

    public static function updateTotalAmount(int $orderSale): void
    {
        $orderSale = OrderSaleModel::findOrFail($orderSale);
        $orderSale->total_amount = $orderSale->products()->sum('price');;
        $orderSale->save();
    }

    public function update(int $id, string $customerName): OrderSaleModel
    {
        $orderSale = OrderSaleModel::findOrFail($id);

        $totalAmount = $orderSale->products()->sum('price');
        $model = new OrderSale($customerName, $totalAmount, $orderSale->user_id);
        $orderSale->customer_name = $model->getCustomerName();
        $orderSale->user_id = $model->getUserId();
        $orderSale->total_amount = $model->getTotalAmount();
        $orderSale->save();

        return $orderSale;
    }

    public function delete(int $id): void
    {
        OrderSaleModel::findOrFail($id)->delete();
    }

    public function find(int $id): OrderSaleModel
    {
        return OrderSaleModel::findOrFail($id);
    }
}
