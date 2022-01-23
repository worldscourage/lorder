<?php

namespace App\Models;

use Database\Factories\ProductTypeToVatTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductTypeToVatType
 * @package App\Models
 *
 * @property string $country_id
 * @property int $product_type_id
 * @property string $vat_type
 *
 * @method static ProductTypeToVatTypeFactory factory(...$parameters)
 */
class ProductTypeToVatType extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'product_type_to_vat_types';
}
