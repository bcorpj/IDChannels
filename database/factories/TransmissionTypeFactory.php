<?php

namespace Database\Factories;

use App\Models\TransmissionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransmissionTypeFactory extends Factory
{
    protected $model = TransmissionType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
