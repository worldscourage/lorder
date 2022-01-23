<?php

namespace App\Services\Order;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;

class OrderCreator
{
    protected User $user;
    protected OrderRequestDto $requestDto;

    protected Order $order;

    public function __construct(
        User $user,
        OrderRequestDto $requestDto
    ) {
        $this->user = $user;
        $this->requestDto = $requestDto;
    }

    public function createOrder(): self
    {
        $order = new Order();
        $order->user_id = $this->user->id;
        $country = Country::find($this->requestDto->getCountry());
        $order->currency = $country->currency;
        $this->order = $order;
        $this->processItems();
        return $this;
    }

    protected function processItems()
    {
        foreach ($this->requestDto->getProducts() as $productRequest) {
            $productPrice = Price::where('product_id', '=', $productRequest->productId)->firstOrFail(); //todo make DB call optimal by mass call
            $item = new OrderItem();
            $item->price()->associate($productPrice);
            $this->order->items->add($item);
        }
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
