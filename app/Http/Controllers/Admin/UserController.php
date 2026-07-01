<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function chooseType()
    {
        return view('admin.users.choose-type');
    }

    public function redirectCreate(Request $request)
    {
        if ($request->role == 'admin') {
            return redirect()->route('users.admin');
        }

        return redirect()->route('users.employee');
    }
public function createEmployee()
{
    $next = User::where('role', 'employee')->count() + 1;

    $email = 'EMP'
        . date('Y')
        . str_pad($next, 4, '0', STR_PAD_LEFT)
        . '@pap-pay.local';

    $password = Str::password(10);

    return view('admin.users.create-employee', compact(
        'email',
        'password'
    ));
}

public function storeEmployee(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:users,email',
        'password' => 'required',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'employee',
    ]);

    return redirect()->route('dashboard')
        ->with('success', 'Employee account created successfully.');
}

    public function createAdmin()
    {
        return view('admin.users.create-admin');
    }
}