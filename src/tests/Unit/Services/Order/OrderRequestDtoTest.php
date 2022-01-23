<?php

namespace Tests\Unit\Services\Order;

use App\Services\Order\OrderRequestDto;
use PHPUnit\Framework\TestCase;

class OrderRequestDtoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIt()
    {
        $dto = new OrderRequestDto("FI", [['cnt' => 1, 'id' => 1], ['cnt' => 2, 'id' => 2], ['cnt' => 1, 'id' => 1]]);
        $this->assertEquals('FI', $dto->getCountry());
        $products = $dto->getProducts();
        $this->assertCount(2, $products);
        $this->assertEquals(2, $products[1]->count);
    }
}
