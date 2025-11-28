<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull(),
            'package_id' => $this->faker->randomDigitNotNull(),
            'registered_by' => $this->faker->randomDigitNotNull(),
            'status' => 'active',
            'total_price' => $this->faker->numberBetween(10000, 200000),
        ];
    }
}
