<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\DeChannel;
use App\Models\DirectionLevel;
use App\Models\TrafficType;
use App\Models\TransmissionType;
use App\Models\Type;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChannelsImport implements ToCollection
{
    public array $branches;

    public function collection(Collection $collection): void
    {
        $this->branches = Branch::all()->toArray();
        $endRow = 3830;
        for ($i = 10; $i <= $endRow; $i++) {
            try {
                $row = $collection[$i];

                if (is_null($row[17]))
                    continue;

                $channel = Channel::create([
                    'channel_number' => $row[17],
                    'klm' => $row[18],
                    'channel_type_id' => $this->getChannelType($row[19]),
                    'traffic_type_id' => $this->getTrafficType($row[20]),
                    'transmission_type_id' => $this->getTransmissionType($row[21]),
                    'direction_level_id' => $this->getDirectionLevel($row[22]),
                    'bandwidth' => $row[23],
                    'type_id' => $this->getTypeId($row[24]),
                    'branch_id' => Channel::getBranch($row[17]),
                ]);

                DeChannel::create([
                    'channel_id' => $channel->id,
                    'client_provider_name' => $row[25],
                    'start_connection_point' => $row[26],
                    'intermediate_connection' => $row[27],
                    'end_connection_point' => $row[28],
                    'using_device' => $row[29],
                    'length' => $row[31],
                    'testing' => $row[32],
                    'connection_line' => $row[33],
                    'reason' => $row[34]
                ]);

            } catch (Exception $exception) {
                print $exception->getMessage();
            }
        }
    }

    /**
     *
     * It takes the value in the argument
     * It returns the ID of a model if value in the argument is found in the database
     * If nothing found, it takes the value, and creates a new model, and returns the ID of the created model
     *
     *
     * @param string|null $value
     * @return int|null
     */
    public function getChannelType(?string $value): int|null
    {
        if (!$value)
            return null;

        if ($channelType = ChannelType::where('alias', 'like', $value.'%')->first())
            return $channelType->id;

        return ChannelType::create([
            'name' => $value,
            'alias' => $value
        ])->id;
    }

    public function getTrafficType(?string $value): int|null
    {
        if (!$value)
            return null;

        if ($channelType = TrafficType::where('alias', 'like', $value.'%')->first())
            return $channelType->id;

        return TrafficType::create([
            'name' => $value,
            'alias' => $value
        ])->id;
    }

    public function getTransmissionType(?string $value): int|null
    {
        if (!$value)
            return null;

        if ($channelType = TransmissionType::where('alias', 'like', $value.'%')->first())
            return $channelType->id;

        return TransmissionType::create([
            'name' => $value,
            'alias' => $value
        ])->id;
    }

    public function getDirectionLevel(?string $value): int|null
    {
        if (!$value)
            return null;

        if ($channelType = DirectionLevel::where('alias', 'like', $value.'%')->first())
            return $channelType->id;

        return DirectionLevel::create([
            'name' => $value,
            'alias' => $value
        ])->id;
    }

    public function getTypeId(?string $value): int|null
    {
        if (!$value)
            return null;

        if ($channelType = Type::where('alias', 'like', $value.'%')->first())
            return $channelType->id;

        return Type::create([
            'name' => $value,
            'alias' => $value
        ])->id;
    }



}
