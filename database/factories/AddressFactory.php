<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'public_place' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'district' => $this->faker->streetAddress(),
            'city_id' => City::factory()->create()->pluck('id')->random(),

        ];
    }
}
