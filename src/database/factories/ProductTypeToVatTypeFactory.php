<?php

namespace Database\Factories;

use App\Models\ProductTypeToVatType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class VatFactory
 * @package Database\Factories
 *
 * @method ProductTypeToVatType create($attributes = [], ?Model $parent = null)
 */
class ProductTypeToVatTypeFactory extends Factory
{
    protected $model = ProductTypeToVatType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        ];
    }
}
