<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);
        return [
            "name" => $name,
        ];
    }

    public function withFakeImg( string $imgPath) {
        return $this->state(function () use ($imgPath) {
            return [
                "img_path" => $imgPath
            ];
        });
    }
}
