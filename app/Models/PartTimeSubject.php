<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartTimeSubject extends Model
{
    protected $table = 'part_time_subjects';

    protected $fillable = [
        'user_id',
        'subject_name',
        'rate_per_subject',
        'classes_per_month',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'rate_per_subject' => 'decimal:2',
        'classes_per_month' => 'integer',
        'is_active' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(
            PartTimeAttendance::class,
            'part_time_subject_id'
        );
    }
}
