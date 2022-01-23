<?php

namespace App\Services\Vat;

use App\Models\Country;
use App\Models\ProductTypeToVatType;
use App\Models\Vat as Rate;

class Vat
{
    public function getRate(Country $country, ?int $productTypeId, ?\DateTime $dateTime = null): Rate
    {
        // todo cache
        $rate = null;
        if ($productTypeId === null) {
            $rate = $this->getStandardRate($country);
        } else {
            $rate = $this->getRateForProductType($country, $productTypeId);
        }
        if ($rate === null) {
            $rate = $this->exceptionalVatRate($country);
        }
        return $rate;
    }

    private function exceptionalVatRate(Country $country)
    {
        $rate = new Rate();
        $rate->rate = 0;
        $rate->country_id = $country->id;
        $rate->type = null;
        return $rate;
    }

    private function getRateForProductType(Country $country, string $productType): ?Rate
    {
        $vatMapping = ProductTypeToVatType::where('country_id', '=', $country->id)
            ->where('product_type_id', '=', $productType)
            ->first();
        $rate = null;
        if ($vatMapping !== null) {
            $rate = Rate::where('country_id', '=', $country->id)
                ->where('type', '=', $vatMapping->vat_type)
                ->first();
        }
        if ($rate === null) {
            $rate = $this->getStandardRate($country);
        }
        return $rate;
    }

    private function getStandardRate(Country $country): ?Rate
    {
        $rate = Rate::where('country_id', '=', $country->id)
            ->where('type', '=', Rate::TYPE_STD)
            ->first();
        return $rate;
    }
}
