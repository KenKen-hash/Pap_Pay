<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeFace;
use App\Models\User;

class FaceAttendanceController extends Controller
{

    public function index()
    {
        return view('admin.attendance-kiosk');
    }

    public function faces()
    {

        $employees = EmployeeFace::with('user')->get();

        $data = [];

        foreach ($employees as $face) {

            if (!$face->user) {
                continue;
            }

            $data[] = [

                'id' => $face->user->id,

                'employee_id' => $face->user->employee_id,

                'name' => $face->user->name,

                'department' => $face->user->department,

                'position' => $face->user->position,

                'photo' => $face->user->photo
                    ? asset('storage/' . $face->user->photo)
                    : asset('images/default-avatar.png'),

                'descriptor' => json_decode($face->descriptor)

            ];
        }

        return response()->json($data);
    }
}
