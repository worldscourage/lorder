<?php

namespace App\Models;

use Database\Factories\VatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vat
 * @package App\Models
 *
 * @property int $id
 * @property string $country_id
 * @property string $type
 * @property float $rate
 *
 * @method static VatFactory factory(...$parameters)
 */
class Vat extends Model
{
    use HasFactory;

    const TYPE_STD = 'STD';
}
