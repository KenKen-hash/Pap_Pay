<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        // Active Employees
        $elementaryEmployees = User::where('role', 'employee')
            ->where('department', 'Elementary')
            ->where('status', 'Active')
            ->latest()
            ->get();

        $jhsEmployees = User::where('role', 'employee')
            ->where('department', 'JHS')
            ->where('status', 'Active')
            ->latest()
            ->get();

        $shsEmployees = User::where('role', 'employee')
            ->where('department', 'SHS')
            ->where('status', 'Active')
            ->latest()
            ->get();

        $collegeEmployees = User::where('role', 'employee')
            ->where('department', 'College')
            ->where('status', 'Active')
            ->latest()
            ->get();

        $adminEmployees = User::where('role', 'employee')
            ->where('department', 'Admin')
            ->where('status', 'Active')
            ->latest()
            ->get();

        $laborerEmployees = User::where('role', 'employee')
            ->where('department', 'Laborers')
            ->where('status', 'Active')
            ->latest()
            ->get();

        // Inactive Employees
        $inactiveEmployees = User::where('role', 'employee')
            ->where('status', 'Inactive')
            ->latest()
            ->get();

        $inactiveCount = $inactiveEmployees->count();

        return view('admin.employees.index', compact(
            'elementaryEmployees',
            'jhsEmployees',
            'shsEmployees',
            'collegeEmployees',
            'adminEmployees',
            'laborerEmployees',
            'inactiveEmployees',
            'inactiveCount'
        ));
    }

    public function create()
    {
        // Next employee number
        $next = User::count() + 1;

        $email = 'EMP' .
            date('Y') .
            str_pad($next, 4, '0', STR_PAD_LEFT)
            . '@pap-pay.local';

        $password = Str::password(10);

        return view('admin.users.create-employee', compact(
            'email',
            'password'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => 'employee',

        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(User $employee)
    {
        return response()->json($employee);
    }
    public function edit(User $employee)
    {
        return response()->json($employee);
    }

    public function update(Request $request, User $employee)
    {
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $employee->id,
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'employment_type' => 'nullable|string|max:255',
            'salary_grade' => 'nullable|string|max:255',
            'emergency_contact_person' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $validated['name'] = trim(
            $validated['first_name'] . ' ' .
                (!empty($validated['middle_name']) ? $validated['middle_name'] . ' ' : '') .
                $validated['last_name']
        );

        $employee->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully.'
        ]);
    }
    public function destroy(User $employee)
    {
        $employee->update([
            'status' => 'Inactive'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Employee has been deactivated successfully.'
        ]);
    }

    public function reactivate(User $employee)
    {
        $employee->update([
            'status' => 'Active'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Employee reactivated successfully.'
        ]);
    }
}
