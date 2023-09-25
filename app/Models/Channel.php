<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function deChannel(): HasOne
    {
        return $this->hasOne(DeChannel::class);
    }

    public function information(): HasOne
    {
        return $this->hasOne(ChannelInformation::class);
    }

    public function channelType(): BelongsTo
    {
        return $this->belongsTo(ChannelType::class, 'channel_type_id');
    }

    public function trafficType(): BelongsTo
    {
        return $this->belongsTo(TrafficType::class, 'traffic_type_id');
    }

    public function transmissionType(): BelongsTo
    {
        return $this->belongsTo(TransmissionType::class, 'transmission_type_id');
    }

    public function directionLevel(): BelongsTo
    {
        return $this->belongsTo(DirectionLevel::class, 'direction_level_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    /*
     * Channel methods
     */

    public static function getBranch(?string $value): int|null
    {
        $channelNumber = (int) $value;
        $channelNumber = substr($channelNumber, -3);
        $branches = Branch::all()->toArray();

        // Iterate through the branches to find a match.
        foreach ($branches as $index => $branch) {
            if ($channelNumber >= $branch['channel_range_from'] && $channelNumber <= $branch['channel_range_to']) {
                return $index + 1; // Add 1 to match your branch numbering.
            }
        }

        return 10;
    }

    public static function reformatToSixDigit(string $value): string
    {
        $number = (int) $value;

        return sprintf('%06d', $number);
    }
}
