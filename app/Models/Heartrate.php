<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Heartrate extends Model
{
    use HasFactory;

    protected $table = 'heart_rates';

    protected $fillable = [
        'user_id',
        'device_id',
        'bpm',
        'spo2',
        'body_temperature',
        'air_quality',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
            'body_temperature' => 'float',
            'bpm' => 'integer',
            'spo2' => 'integer',
            'air_quality' => 'integer',
        ];
    }

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Device
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}