<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeChannel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
