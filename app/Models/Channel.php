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

}
