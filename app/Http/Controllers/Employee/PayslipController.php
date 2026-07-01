<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payslip;

class PayslipController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $latestPayslip = Payslip::where('user_id', $employee->id)
            ->latest()
            ->first();

        $payslips = Payslip::where('user_id', $employee->id)
            ->latest()
            ->paginate(10);

        return view('employee.payslip', compact(
            'employee',
            'latestPayslip',
            'payslips'
        ));
    }
}