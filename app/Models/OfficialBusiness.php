<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialBusiness extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Employee
        'user_id',

        // General Information
        'purpose',
        'ob_date',
        'ob_date_to',

        // Estimated Cost
        'transportation_cost',
        'meals_cost',
        'lodging_cost',
        'others_cost',
        'registration_fee',

        // Attachments
        'proof_images',

        // Approval
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',

    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        // Uploaded attachments are stored as JSON
        'proof_images' => 'array',

        // OB dates
        'ob_date' => 'date',
        'ob_date_to' => 'date',

        // Approval date
        'approved_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Employee Relationship
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Approver Relationship
    |--------------------------------------------------------------------------
    */

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
