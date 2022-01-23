<?php

namespace App\Models;

use App\Services\Utils\Money;
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

    protected ?Money $totalCostNet = null;
    protected ?Money $totalCostVat = null;
    protected ?Money $totalCostGross = null;

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function getTotalCostNet(): Money
    {
        if ($this->totalCostNet === null) {
            $this->calculateCost(); // make sure to call it only once not fall into recursion somehow
        }
        return $this->totalCostNet;
    }

    public function getTotalCostVat(): Money
    {
        if ($this->totalCostVat === null) {
            $this->calculateCost(); // make sure to call it only once not fall into recursion somehow
        }
        return $this->totalCostVat;
    }

    public function getTotalCostGross(): Money
    {
        if ($this->totalCostGross === null) {
            $this->calculateCost(); // make sure to call it only once not fall into recursion somehow
        }
        return $this->totalCostGross;
    }

    public function calculateCost(): self
    {
        $this->totalCostNet = new Money($this->currency);
        $this->totalCostVat = new Money($this->currency);
        foreach ($this->items as $item) {
            $itemPrice = $item->price->getPrice()->times($item->count);
            $this->totalCostNet->addFrom($itemPrice);
            $this->totalCostVat->addFrom($itemPrice->times($item->vat->rate));
        }
        $this->totalCostGross = (clone $this->totalCostNet)->addFrom($this->totalCostVat);
        return $this;
    }
}
