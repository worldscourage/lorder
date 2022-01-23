<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $product_type_id
 *
 * @property-read ProductType $productType
 * @property-read Collection $prices
 *
 * @method static ProductFactory factory(...$parameters)
 */
class Product extends Model
{
    use HasFactory;

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'product_id', 'id');
    }
}
