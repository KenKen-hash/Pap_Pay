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
    $primaryEmployees = User::where('role', 'employee')
        ->where('department', 'Primary')
        ->latest()
        ->get();

    $secondaryEmployees = User::where('role', 'employee')
        ->where('department', 'Secondary')
        ->latest()
        ->get();

    $tertiaryEmployees = User::where('role', 'employee')
        ->where('department', 'Tertiary')
        ->latest()
        ->get();

    $nonTeachingEmployees = User::where('role', 'employee')
        ->where('department', 'Non-Teaching')
        ->latest()
        ->get();

    return view('admin.employees.index', compact(
        'primaryEmployees',
        'secondaryEmployees',
        'tertiaryEmployees',
        'nonTeachingEmployees'
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
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required'
    ]);

    User::create([

        'name'=>$request->name,

        'email'=>$request->email,

        'password'=>Hash::make($request->password),

        'role'=>'employee',

    ]);

    return redirect()
        ->route('employees.index')
        ->with('success','Employee created successfully.');
}

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}