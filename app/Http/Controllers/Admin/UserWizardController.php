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

    public function employmentType()
    {
        return view('admin.users.employment-type');
    }

    public function choose(Request $request)
    {
        $request->validate([
            'role' => 'required|in:employee,admin',
        ]);

        if ($request->role === 'employee') {
            return redirect()->route('users.employment');
        }

        return redirect()->route('users.admin');
    }

    public function employeeForm(Request $request)
    {
        $request->validate([
            'employment_type' => 'required|in:Regular,Contractual,Part-Time',
        ]);

        return view('admin.users.create-employee', [
            'employmentType' => $request->employment_type,
        ]);
    }

    public function adminForm()
    {
        return view('admin.users.create-admin');
    }

    /*
    |--------------------------------------------------------------------------
    | Employee Setup
    |--------------------------------------------------------------------------
    */

    public function employeeSetup(Request $request)
    {
        $validated = $request->validate([
            'employment_type' => 'required|in:Regular,Contractual,Part-Time',
            'department' => 'required|in:Elementary,JHS,SHS,College,Admin,Laborers',

            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',

            'position' => 'nullable|string|max:255',
            'status' => 'nullable|in:Active,Inactive',
            'salary_grade' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'hire_date' => 'nullable|date',

            'sss_number' => 'nullable|string|max:30',
            'philhealth_number' => 'nullable|string|max:30',
            'pagibig_number' => 'nullable|string|max:30',
            'tin' => 'nullable|string|max:30',

            'emergency_contact_person' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $name = trim(
            $validated['first_name'] . ' ' .
            (!empty($validated['middle_name'])
                ? $validated['middle_name'] . ' '
                : '') .
            $validated['last_name']
        );

        $year = now()->year;

        $nextId = (User::max('id') ?? 0) + 1;

        $employeeId =
            'EMP' . $year . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $email = strtolower($employeeId) . '@pap-pay.local';

        $plainPassword = Str::password(10);

        User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'name' => $name,

            'employee_id' => $employeeId,
            'department' => $validated['department'],
            'position' => $validated['position'] ?? null,
            'contact_number' => $validated['contact_number'] ?? null,

            'gender' => $validated['gender'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'address' => $validated['address'] ?? null,

            'emergency_contact_person' =>
                $validated['emergency_contact_person'] ?? null,

            'emergency_contact_number' =>
                $validated['emergency_contact_number'] ?? null,

            'hire_date' => $validated['hire_date'] ?? null,
            'employment_type' => $validated['employment_type'],
            'salary_grade' => $validated['salary_grade'] ?? null,

            'sss_number' => $validated['sss_number'] ?? null,
            'philhealth_number' => $validated['philhealth_number'] ?? null,
            'pagibig_number' => $validated['pagibig_number'] ?? null,
            'tin' => $validated['tin'] ?? null,

            'bio' => $validated['bio'] ?? null,

            'status' => $validated['status'] ?? 'Active',

            'email' => $email,
            'password' => Hash::make($plainPassword),
            'role' => 'employee',
            'force_password_change' => true,
        ]);

        return back()->with([
            'success' => true,
            'email' => $email,
            'password' => $plainPassword,
            'employee_id' => $employeeId,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Administrator Setup
    |--------------------------------------------------------------------------
    */

    public function adminSetup(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:HR,VP,Accounts Payable',

            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $name = trim(
            $validated['first_name'] . ' ' .
            (!empty($validated['middle_name'])
                ? $validated['middle_name'] . ' '
                : '') .
            $validated['last_name']
        );

        $year = now()->year;

        $lastAdmin = Admin::latest('id')->first();

        $nextNumber = $lastAdmin
            ? $lastAdmin->id + 1
            : 1;

        $adminId =
            'ADM' . $year . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $email = strtolower($adminId) . '@pap-pay.local';

        $plainPassword = Str::password(10);

        DB::transaction(function () use (
            $adminId,
            $email,
            $plainPassword,
            $name,
            $validated
        ) {
            $user = User::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'name' => $name,

                'contact_number' =>
                    $validated['contact_number'] ?? null,

                'gender' =>
                    $validated['gender'] ?? null,

                'birth_date' =>
                    $validated['birth_date'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'email' => $email,
                'password' => Hash::make($plainPassword),
                'role' => 'admin',
                'force_password_change' => true,
                'status' => 'Active',
            ]);

            Admin::create([
                'user_id' => $user->id,
                'admin_id' => $adminId,
                'name' => $name,
                'category' => $validated['category'],
                'department' => null,
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

    /*
    |--------------------------------------------------------------------------
    | Department Head Form
    |--------------------------------------------------------------------------
    */

    public function departmentHeadForm()
    {
        return view('admin.users.create-department-head');
    }

    /*
    |--------------------------------------------------------------------------
    | Department Head Setup
    |--------------------------------------------------------------------------
    */

    public function departmentHeadSetup(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:Department Heads',

            'department' =>
                'required|in:Elementary,JHS,SHS,College,Admin,Laborers',

            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $name = trim(
            $validated['first_name'] . ' ' .
            (!empty($validated['middle_name'])
                ? $validated['middle_name'] . ' '
                : '') .
            $validated['last_name']
        );

        $year = now()->year;

        $lastAdmin = Admin::latest('id')->first();

        $nextNumber = $lastAdmin
            ? $lastAdmin->id + 1
            : 1;

        $adminId =
            'ADM' . $year . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $email = strtolower($adminId) . '@pap-pay.local';

        $plainPassword = Str::password(10);

        DB::transaction(function () use (
            $adminId,
            $email,
            $plainPassword,
            $name,
            $validated
        ) {
            /*
             * Create the user account.
             * The department is stored here.
             */
            $user = User::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'name' => $name,

                'department' => $validated['department'],

                'contact_number' =>
                    $validated['contact_number'] ?? null,

                'gender' =>
                    $validated['gender'] ?? null,

                'birth_date' =>
                    $validated['birth_date'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'email' => $email,
                'password' => Hash::make($plainPassword),
                'role' => 'admin',
                'force_password_change' => true,
                'status' => 'Active',
            ]);

            /*
             * Create the administrator record.
             *
             * IMPORTANT:
             * The selected department is also stored here.
             */
            $admin = new Admin();

            $admin->user_id = $user->id;
            $admin->admin_id = $adminId;
            $admin->name = $name;
            $admin->category = 'Department Heads';
            $admin->department = $validated['department'];
            $admin->email = $email;
            $admin->password = Hash::make($plainPassword);
            $admin->force_password_change = true;

            $admin->save();
        });

        return redirect()
            ->route('users.department-head')
            ->with([
                'success' => true,
                'admin_id' => $adminId,
                'department' => $validated['department'],
                'email' => $email,
                'password' => $plainPassword,
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Existing Admin Setup
    |--------------------------------------------------------------------------
    */

    public function adminSetupLegacy(Request $request)
    {
        return $this->adminSetup($request);
    }
}
