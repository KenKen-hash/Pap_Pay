<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeProfileController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        return view('my_profile', compact('employee'));
    }

    public function update(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;

        $employee->name = trim(
            $request->first_name . ' ' .
            $request->middle_name . ' ' .
            $request->last_name
        );

        $employee->email = $request->email;
        $employee->contact_number = $request->contact_number;
        $employee->gender = $request->gender;
        $employee->birth_date = $request->birth_date;
        $employee->address = $request->address;
        $employee->bio = $request->bio;

        $employee->emergency_contact_person =
            $request->emergency_contact_person;

        $employee->emergency_contact_number =
            $request->emergency_contact_number;

        if ($request->filled('password')) {
            $employee->password =
                Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {

            $path = $request->file('photo')
                ->store('employees', 'public');

            $employee->photo = $path;
        }

        $employee->save();

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }
}