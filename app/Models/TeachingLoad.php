<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLoad extends Model
{
    use HasFactory;

    protected $table = 'employee_teaching_loads';

    protected $fillable = [
        'user_id',
        'department',
        'subject',
        'units',
        'rate',
        'remarks',
    ];

    protected $casts = [
        'units' => 'integer',
        'rate' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
