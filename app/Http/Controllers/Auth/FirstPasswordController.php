<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FirstPasswordController extends Controller
{
    public function index()
    {
        return view('auth.first-password');
    }

    public function update(Request $request)
    {
        $request->validate([

            'password' => [
                'required',
                'confirmed',
                'min:8'
            ]

        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->password);

        $user->force_password_change = false;

        $user->save();

        if ($user->role == 'admin') {

            return redirect()->route('admin-dashboard')
                ->with('success', 'Password changed successfully.');

        }

        return redirect()->route('dashboard')
            ->with('success', 'Password changed successfully.');
    }
}