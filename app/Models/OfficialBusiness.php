<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialBusiness extends Model
{
    protected $fillable = [
        'user_id',
        'purpose',
        'destination',
        'ob_date',
        'time_start',
        'time_end',
        'remarks',
        'attachment',
        'status',
    ];

    protected $casts = [
        'ob_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}