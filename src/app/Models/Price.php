<?php

namespace App\Models;

use App\Services\Utils\Money;
use Database\Factories\PriceFactory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property float $price
 * @property string $currency
 * @property int $product_id
 *
 * @property-read Product $product
 *
 * @method static PriceFactory factory(...$parameters)
 */
class Price extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getPrice()
    {
        return new Money($this->currency, $this->price);
    }
}
