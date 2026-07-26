<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workoutschedule extends Model
{
    use HasFactory;

    protected $table = 'workout_schedules';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'day',
        'start_time',
        'end_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}