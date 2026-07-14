<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [

        'admin_id',
        'title',
        'message',
        'attachment'

    ];

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}