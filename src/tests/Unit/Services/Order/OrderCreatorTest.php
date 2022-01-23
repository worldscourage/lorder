<?php

namespace Tests\Unit\Services\Order;

use App\Models\Price;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use App\Services\Order\OrderCreator;
use App\Services\Order\OrderRequestDto;
use Tests\TestCase;

class OrderCreatorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAll()
    {
        $productType = ProductType::factory();
        $p1 = Product::factory()
            ->for($productType, 'productType')
            ->has(Price::factory(['price' => 10]), 'prices')
            ->create();
        $p2 = Product::factory()
            ->has(Price::factory(['price' => 20]), 'prices')
            ->create();
        $this->assertNotNull($p1->productType, 'product type not defined');
        $this->assertNotEmpty($p2->prices, 'no prices defined');

        $dto = new OrderRequestDto("FI", [['cnt' => 2, 'id' => $p1->id], ['cnt' => 2, 'id' => $p2->id]]);
        $creator = (new OrderCreator(User::find(1), $dto))->createOrder();
        $order = $creator->getOrder();

        $this->assertEquals('EUR', $order->currency);
        $this->assertCount(2, $order->items);
    }
}
