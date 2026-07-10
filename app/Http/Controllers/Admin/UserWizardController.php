<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserWizardController extends Controller
{
    public function chooseType()
    {
        return view('admin.users.choose-type');
    }

    public function choose(Request $request)
    {
        $request->validate([
            'role' => 'required'
        ]);

        if ($request->role == 'employee') {
            return redirect()->route('users.employee');
        }

        return redirect()->route('users.admin');
    }

    public function employeeForm()
    {
        return view('admin.users.create-employee');
    }

    public function adminForm()
    {
        return view('admin.users.create-admin');
    }

    public function employeeSetup(Request $request)
    {
        $request->validate([
            'department' => 'required'
        ]);

        /*
    |--------------------------------------------------------------------------
    | Generate Employee ID
    |--------------------------------------------------------------------------
    */

        $year = now()->year;

        $nextId = User::max('id') + 1;

        $employeeId = 'EMP' . $year . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        /*
    |--------------------------------------------------------------------------
    | Generate Credentials
    |--------------------------------------------------------------------------
    */

        $email = strtolower($employeeId) . '@pap-pay.local';

        $plainPassword = Str::password(10);

        /*
    |--------------------------------------------------------------------------
    | Create User
    |--------------------------------------------------------------------------
    */

        $user = User::create([

            'name' => 'New Employee',

            'employee_id' => $employeeId,

            'department' => $request->department,

            'email' => $email,

            'password' => Hash::make($plainPassword),

            'role' => 'employee',

            'force_password_change' => true

        ]);

        return redirect()
            ->route('users.employee')
            ->with([
                'success' => true,
                'email' => $email,
                'password' => $plainPassword,
                'employee_id' => $employeeId
            ]);
    }

   public function adminSetup(Request $request)
{
    $request->validate([
        'category' => 'required|in:HR,VP Finance,Accounts Receivable,Accounts Payable'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Generate Admin ID
    |--------------------------------------------------------------------------
    */

    $year = now()->year;

    $lastAdmin = Admin::latest('id')->first();

    $nextNumber = $lastAdmin ? $lastAdmin->id + 1 : 1;

    $adminId = 'ADM' . $year . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    /*
    |--------------------------------------------------------------------------
    | Generate Credentials
    |--------------------------------------------------------------------------
    */

    $email = strtolower($adminId) . '@pap-pay.local';

    $plainPassword = Str::password(10);

    /*
    |--------------------------------------------------------------------------
    | Save User + Admin
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use (
        $adminId,
        $email,
        $plainPassword,
        $request
    ) {

        // Create login account

        $user = User::create([

            'name' => 'New Administrator',

            'email' => $email,

            'password' => Hash::make($plainPassword),

            'role' => 'admin',

            'force_password_change' => true,

        ]);

        // Create admin profile

        Admin::create([

            'user_id' => $user->id,

            'admin_id' => $adminId,

            'name' => 'New Administrator',

            'category' => $request->category,

            'email' => $email,

            'password' => Hash::make($plainPassword),

            'force_password_change' => true,

        ]);

    });

    return redirect()
        ->route('users.admin')
        ->with([

            'success' => true,

            'admin_id' => $adminId,

            'email' => $email,

            'password' => $plainPassword,

        ]);
}
}
