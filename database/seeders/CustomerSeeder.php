<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Location;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::factory()->count(10)->create();

        $faker = Factory::create(Factory::DEFAULT_LOCALE);


        foreach ($customers as $customer){
            for($i = 0; $i < 2; $i++){
                Location::create([
                    'name' => 'locatie '.(1),
                    'city' => $customer->city,
                    'street' => $customer->street,
                    'number' => $customer->number,
                    'postal_code' => $customer->postal_code,
                    'building_number' => $faker->buildingNumber,
                    'customer_id' => $customer->id
                ]);
            }
        }
    }
}
