<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Settings extends Controller
{
    /**
     * Display the administrator account settings page.
     */
    public function index()
    {
        $admin = Auth::user();

        return view('admin.settings', compact('admin'));
    }


    /**
     * Update administrator basic information.
     */
    public function updateInformation(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $admin->id,
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:30',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Basic Information
        |--------------------------------------------------------------------------
        */

        $admin->first_name = $validated['first_name'];

        $admin->middle_name = $validated['middle_name'] ?? null;

        $admin->last_name = $validated['last_name'];

        $admin->email = $validated['email'];

        $admin->contact_number = $validated['contact_number'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Update Full Name
        |--------------------------------------------------------------------------
        |
        | The "name" field is kept synchronized with the first,
        | middle, and last name fields.
        |
        */

        $admin->name = trim(
            $admin->first_name . ' ' .
            ($admin->middle_name
                ? $admin->middle_name . ' '
                : '') .
            $admin->last_name
        );


        $admin->save();


        return redirect()
            ->route('settings')
            ->with(
                'success',
                'Your basic information has been updated successfully.'
            );
    }


    /**
     * Update administrator profile photo.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Delete Old Photo
        |--------------------------------------------------------------------------
        */

        if ($admin->photo) {

            $oldPhoto = $admin->photo;

            if (Storage::disk('public')->exists($oldPhoto)) {

                Storage::disk('public')->delete($oldPhoto);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Store New Photo
        |--------------------------------------------------------------------------
        */

        $path = $request->file('photo')->store(
            'profile-photos',
            'public'
        );


        $admin->photo = $path;

        $admin->save();


        return redirect()
            ->route('settings')
            ->with(
                'success',
                'Your profile photo has been updated successfully.'
            );
    }


    /**
     * Update administrator password.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Save New Password
        |--------------------------------------------------------------------------
        */

        $admin->password = Hash::make(
            $validated['password']
        );

        $admin->save();


        return redirect()
            ->route('settings')
            ->with(
                'success',
                'Your password has been changed successfully.'
            );
    }
}
