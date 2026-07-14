<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\Payroll;
use App\Models\Notification;
use App\Models\PayrollSetting;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',

        'email',
        'password',

        'employee_id',
        'department',
        'position',
        'contact_number',
        'photo',
        'status',

        'gender',
        'birth_date',
        'address',

        'emergency_contact_person',
        'emergency_contact_number',

        'hire_date',
        'employment_type',
        'salary_grade',
        'face_embedding',
        'face_registered_at',

        'username',
        'force_password_change',
        'role',

        'bio',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function officialBusinesses(): HasMany
    {
        return $this->hasMany(OfficialBusiness::class);
    }

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class)
            ->latest();
    }
    public function face()
    {
        return $this->hasOne(EmployeeFace::class);
    }
    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
    public function payrollSetting()
    {
        return $this->hasOne(PayrollSetting::class);
    }
}
