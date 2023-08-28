<?php

namespace Database\Factories;

use App\Models\DeChannel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DeChannelFactory extends Factory
{
    protected $model = DeChannel::class;

    public function definition(): array
    {
        return [
            'channel_id' => $this->faker->numberBetween(1, 2000),
            'client_provider_name' => $this->faker->word(),
            'start_connection_point' => $this->faker->word(),
            'end_connection_point' => $this->faker->word(),
            'intermediate_connection' => $this->faker->word(),
            'using_device' => $this->faker->word(),
            'connection_date' => $this->faker->dateTime(),
            'length'  => $this->faker->word(),
            'testing'  => $this->faker->word(),
            'connection_line'  => $this->faker->word(),
            'reason' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
