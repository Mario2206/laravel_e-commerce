<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "price" => $this->faker->randomFloat(2, 0, 1000),
            "description" => $this->faker->sentence(),
            "stock" => $this->faker->randomNumber(),
            "category_id" => DB::table('categories')->get('id')->random(1)->first()->id
        ];
    }
}
