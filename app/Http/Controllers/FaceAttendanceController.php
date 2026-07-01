<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceAttendanceController extends Controller
{
    public function index()
    {
        return view('kiosk.attendance');
    }
}