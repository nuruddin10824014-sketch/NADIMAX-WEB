<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_name',
        'device_code',
        'serial_number',
        'firmware',
        'battery',
        'signal_strength',
        'status',
        'last_sync',
        'api_key',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
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
     * Relasi ke Heart Rate
     */
    public function heartRates(): HasMany
    {
        return $this->hasMany(Heartrate::class, 'device_id');
    }
}