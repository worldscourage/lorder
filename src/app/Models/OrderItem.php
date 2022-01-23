<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderItem
 * @package App\Models
 *
 * @property int $id
 * @property int $count
 * @property int $order_id
 * @property int $price_id
 * @property int $vat_id
 *
 * @property-read Order $order
 * @property-read Price $price
 * @property-read Vat $vat
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'orders_items';

    public int $productId;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class, 'price_id', 'id');
    }

    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class, 'vat_id', 'id');
    }
}
