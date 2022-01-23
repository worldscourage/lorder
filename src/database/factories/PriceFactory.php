<?php

namespace Database\Factories;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class ProductFactory
 * @package Database\Factories
 *
 * @method Price create($attributes = [], ?Model $parent = null)
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(1, 100),
            'currency' => 'EUR'
        ];
    }
}
