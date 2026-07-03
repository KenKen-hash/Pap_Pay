<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmployeeFace;
use Illuminate\Http\Request;

class FaceRegistrationController extends Controller
{
    public function show(User $user)
    {
        return view('admin.employees.face-registration', compact('user'));
    }
    
    public function save(Request $request,$id)
{

    $request->validate([

        'descriptor'=>'required|array'

    ]);

    EmployeeFace::updateOrCreate(

        [

            'user_id'=>$id

        ],

        [

            'descriptor'=>json_encode($request->descriptor)

        ]

    );

    return response()->json([

        'success'=>true

    ]);

}
}