<?php 

namespace Core\Application\Product;

use App\Contracts\ProductHandlerInterface;
use App\Models\Product;
use Core\Application\OrderSale\OrderSaleHandler;
use Core\Domain\Product as ProductDomain;

final class ProductHandler implements ProductHandlerInterface
{
    public function list(): array
    {
        return Product::all()->toArray();
    }

    public function find(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function create(string $name, int $price, int $userId, int $orderSaleId): Product
    {
        $model = new ProductDomain($name, $price, $userId);
        
        $model = Product::create([
            'name' => $model->getName(),
            'price' => $model->getPrice(),
            'user_id' => $model->getUserId(),
            'order_sale_id' => $orderSaleId,
        ]);
        OrderSaleHandler::updateTotalAmount($orderSaleId);
        
        return $model;
    }

    public function update(int $id, string $name, int $price): Product
    {
        $product = Product::findOrFail($id);

        $model = new ProductDomain($name, $price, $product->user_id);        
        $product->name = $model->getName();
        $product->price = $model->getPrice();
        $product->save();        
        OrderSaleHandler::updateTotalAmount($product->order_sale_id);

        return $product;
    }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
    }
}
