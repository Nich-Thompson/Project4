<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'city' => $this->faker->city,
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this -> faker->phoneNumber,
            'contact_name' => $this -> faker ->firstName . ' ' . $this -> faker ->lastName,
            'contact_phone_number' => $this -> faker->phoneNumber,
            'contact_email' => $this->faker->unique()->safeEmail,
            'deleted_at' => Carbon::now()
        ];
    }
}
