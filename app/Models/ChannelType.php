<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChannelType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class, 'channel_type_id');
    }
}
