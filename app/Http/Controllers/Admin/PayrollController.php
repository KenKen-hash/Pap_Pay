<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')
            ->orderBy('department')
            ->orderBy('name')
            ->get()
            ->groupBy('department');

        return view('admin.payroll', compact('employees'));
    }
}