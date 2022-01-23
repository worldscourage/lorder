<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 * @package App\Models
 *
 * @property int $user_id
 * @property string $currency
 *
 * @property-read Collection|OrderItem[] $items
 */
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'orders';

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
