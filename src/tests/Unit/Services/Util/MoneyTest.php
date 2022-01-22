<?php

namespace Tests\Unit\Services\Util;

use App\Services\Utils\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddFrom()
    {
        $a = new Money('EUR', 1);
        $b = new Money('EUR', 2);
        $this->assertEquals(3, $a->addFrom($b)->getAmount());
        $this->assertEquals('EUR', $a->getCurrency());
    }
}
