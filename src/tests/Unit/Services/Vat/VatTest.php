<?php

namespace Tests\Unit\Services\Vat;

use App\Models\Country;
use App\Models\ProductType;
use App\Models\ProductTypeToVatType;
use App\Models\Vat as VatRate;
use App\Services\Vat\Vat;
use Tests\TestCase;

class VatTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAll()
    {
        VatRate::factory(['country_id' => 'FI', 'type' => 'REDUCED', 'rate' => 0.1])->create();
        $pt1 = ProductType::factory(['name' => 'medicine'])->create();
        $pt2 = ProductType::factory(['name' => 'weapons'])->create();
        ProductTypeToVatType::factory(['product_type_id' => $pt1->id, 'country_id' => 'FI', 'vat_type' => 'REDUCED'])->create();
        $fi = Country::findOrFail('FI');

        $service = new Vat();
        $this->assertEquals(
            0.1,
            $service->getRate($fi, $pt1->id, null)->rate
        );
        $this->assertEquals(
            0.24, // standard rate by default
            $service->getRate($fi, null, null)->rate
        );
        $this->assertEquals(
            0.24, // standard rate when product mapping not defined
            $service->getRate($fi, $pt2->id, null)->rate
        );

    }

    public function testExceptionalRate()
    {
        $af = Country::factory(['id' => 'AF', 'name' => 'Afganistan'])->create();
        $service = new Vat();
        $this->assertEquals(
            0, // zero when country vat not defined
            $service->getRate($af, null, null)->rate
        );
    }
}
