<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\DeChannel;
use App\Models\DirectionLevel;
use App\Models\TrafficType;
use App\Models\TransmissionType;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Type::factory(200)->create();
        ChannelType::factory(200)->create();
        TrafficType::factory(200)->create();
        TransmissionType::factory(200)->create();
        DirectionLevel::factory(200)->create();
        Channel::factory(2000)->create();
        DeChannel::factory(2000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
