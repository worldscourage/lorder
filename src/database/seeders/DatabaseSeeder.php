<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ProductType;
use App\Models\User;
use App\Models\Vat as VatRate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        ProductType::factory(['name' => 'Food'])->create();
        $this->createCountries();
    }

    protected function createCountries()
    {
        Country::factory(['id' => 'FI', 'name' => 'Finland', 'currency' => 'EUR'])->create();
        Country::factory(['id' => 'SE', 'name' => 'Sweden', 'currency' => 'EUR'])->create();
        VatRate::factory(['country_id' => 'FI', 'type' => 'STD', 'rate' => 0.24])->create();
        VatRate::factory(['country_id' => 'SE', 'type' => 'STD', 'rate' => 0.20])->create();
    }
}
