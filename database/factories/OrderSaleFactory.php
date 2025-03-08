<?php

namespace Database\Factories;

use App\Models\OrderSale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderSale>
 */
class OrderSaleFactory extends Factory
{
    protected $model = OrderSale::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'total_amount' => fake()->randomNumber(5),
            'user_id' => User::factory(), // Cria um usuário associado
        ];
    }
}
