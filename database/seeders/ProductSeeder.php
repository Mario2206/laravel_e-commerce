<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(int $quantity)
    {
        $imgPath = $this->faker->image(public_path("storage"), 640, 480, null, false);
        Product::factory($quantity)->create(['img_path' => $imgPath]);
    }
}
