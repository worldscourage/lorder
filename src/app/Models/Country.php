<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property string $currency
 */
class Country extends Model
{
    use HasFactory;

    public $primaryKey = 'id';
    public $table = 'countries';
}
