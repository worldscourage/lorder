<?php

namespace App\Models;

use Database\Factories\ProductTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductType
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @method static ProductTypeFactory factory(...$parameters)
 *
 */
class ProductType extends Model
{
    use HasFactory;
}
