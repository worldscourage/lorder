<?php

namespace Database\Seeders;

use App\Models\Country;
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
        // \App\Models\User::factory(10)->create();
        $this->createCountries();
    }

    protected function createCountries()
    {
        Country::factory(['id' => 'FI', 'name' => 'Finland', 'currency' => 'EUR'])->create();
        Country::factory(['id' => 'SE', 'name' => 'Sweden', 'currency' => 'EUR'])->create();
    }
}
