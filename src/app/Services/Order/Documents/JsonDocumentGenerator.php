<?php

namespace App\Services\Order\Documents;

use App\Models\Order;

class JsonDocumentGenerator extends AbstractDocumentGenerator
{
    public function generate(): string
    {
        $array = $this->order->load(['items.price.product', 'user'])->toArray();
        $array['totalToPay'] = $this->order->getTotalCostGross()->toArray();
        $array['totalVat'] = $this->order->getTotalCostVat()->toArray();
        return json_encode($array);
    }
}
