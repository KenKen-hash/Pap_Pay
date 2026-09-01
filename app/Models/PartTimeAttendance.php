<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartTimeAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'part_time_subject_id',
        'attendance_date',
        'time_in',
        'time_out',
        'status',
    ];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            PartTimeSubject::class,
            'part_time_subject_id'
        );
    }
}
