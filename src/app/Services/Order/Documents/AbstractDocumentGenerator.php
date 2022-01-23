<?php

namespace App\Services\Order\Documents;

use App\Models\Order;

abstract class AbstractDocumentGenerator
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    abstract public function generate(): string;
}
