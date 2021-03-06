<?php

namespace App\Services\Order;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use App\Services\Vat\Vat as VatService;

class OrderCreator
{
    public VatService $vatService; //todo as a a facade

    protected User $user;
    protected OrderRequestDto $requestDto;
    protected Country $country;

    protected Order $order;

    public function __construct(
        User $user,
        OrderRequestDto $requestDto
    ) {
        $this->user = $user;
        $this->requestDto = $requestDto;
        $this->vatService = resolve(VatService::class);
    }

    public function createOrder(): self
    {
        $order = new Order();
        $order->user_id = $this->user->id;
        $this->country = Country::find($this->requestDto->getCountry());
        $order->currency = $this->country->currency;
        $order->save();
        $this->order = $order;
        $this->processItems();
        $order->push();
        return $this;
    }

    protected function processItems()
    {
        foreach ($this->requestDto->getProducts() as $productRequest) {
            /** @var Price $productPrice */
            $productPrice = Price::where('product_id', '=', $productRequest->productId)->firstOrFail(); //todo make DB call optimal by mass call
            $item = new OrderItem();
            $item->count = $productRequest->count;
            if ($this->order->currency == $productPrice->currency) {
                $item->exchange_rate = 1;
            } else {
                throw new \Exception("currency difference not supported");
            }
            $item->price()->associate($productPrice);
            $this->applyVat($item);
            $item->order_id = $this->order->id;
            $this->order->items->add($item);
        }
    }

    protected function applyVat(OrderItem $item)
    {
        $vatRate = $this->vatService->getRate($this->country, $item->price->product->product_type_id);
        $item->vat()->associate($vatRate);
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
