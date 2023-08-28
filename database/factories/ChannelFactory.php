<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChannelFactory extends Factory
{
    protected $model = Channel::class;
    public static $num = 1;

    public function definition(): array
    {
        return [
            'channel_number' => self::$num++,
            'klm' => $this->faker->word(),
            'channel_type_id' => $this->faker->numberBetween(1, 200),
            'traffic_type_id' => $this->faker->numberBetween(1, 200),
            'transmission_type_id' => $this->faker->numberBetween(1, 200),
            'direction_level_id' => $this->faker->numberBetween(1, 200),
            'type_id' => $this->faker->numberBetween(1, 200),
            'bandwidth' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
