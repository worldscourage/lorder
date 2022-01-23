<?php

namespace App\Services\Order\Documents;

use App\Models\Order;

class DocumentFactory
{
    /**
     * @param string $mime
     * @param Order $order
     * @return AbstractDocumentGenerator
     * @throws \Exception
     */
    public function getOrderDocumentGenerator(string $mime, Order $order): AbstractDocumentGenerator
    {
        switch ($mime) {
            case 'json':
                return new JsonDocumentGenerator($order);
            default:
                throw new \Exception('unsupported type' . $mime);
        }
    }
}
