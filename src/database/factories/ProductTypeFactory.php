<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class ProductFactory
 * @package Database\Factories
 *
 * @method ProductType create($attributes = [], ?Model $parent = null)
 */
class ProductTypeFactory extends Factory
{
    protected $model = ProductType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
