<?php

namespace App\Services\Order;

use App\Models\OrderItem;

class OrderRequestDto
{
    /** @var array|OrderItem[] */
    protected array $products;
    protected string $country;

    /**
     * OrderRequestDto constructor.
     * @param string $country
     * @param array $products
     * @throws OrderRequestDtoException
     */
    public function __construct(
        string $country,
        array $products
    ) {
        $this->country = $country;
        $this->products = $this->processProducts($products);
    }

    /**
     * @param array $requestProducts
     * @throws OrderRequestDtoException
     */
    private function processProducts(array $requestProducts): array
    {
        $items = [];
        foreach ($requestProducts as $product) {
            $item = $this->getProductForOrder($product);
            if (isset($items[$item->productId])) {
                $items[$item->productId]->count += $item->count;
            } else {
                $items[$item->productId] = $this->getProductForOrder($product);
            }
        }
        return $items;
    }

    private function getProductForOrder(array $requestProduct): OrderItem
    {
        if (!isset($requestProduct['cnt']) || !isset($requestProduct['id']) || !is_numeric($requestProduct['cnt'])) {
            throw new OrderRequestDtoException("wrong data");
        }
        $orderItem = new OrderItem();
        $orderItem->count = $requestProduct['cnt'];
        $orderItem->productId = $requestProduct['id'];
        return $orderItem;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
