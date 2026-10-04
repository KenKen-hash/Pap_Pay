<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payslip;
use App\Models\User;
use App\Services\AuditLogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PayslipController extends Controller
{
    public function index()
    {
        $payslips = Payslip::with('user')
            ->latest()
            ->get()
            ->groupBy(function ($payslip) {
                return $payslip->period_start . '_' . $payslip->period_end;
            });

        return view(
            'admin.payslip_list',
            compact('payslips')
        );
    }

    public function history($period_start, $period_end)
    {
        $payslips = Payslip::with('user')
            ->where('period_start', $period_start)
            ->where('period_end', $period_end)
            ->orderBy('user_id')
            ->get();

        return view(
            'admin.payslip_history',
            compact(
                'payslips',
                'period_start',
                'period_end'
            )
        );
    }

    public function create()
    {
        $employees = User::all();

        return view('admin.payslips.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'pay_period' => 'required',
            'basic_pay' => 'required',
        ]);

        $payslip = Payslip::create([
            'user_id' => $request->user_id,
            'pay_period' => $request->pay_period,
            'basic_pay' => $request->basic_pay,
            'net_pay' => $request->net_pay ?? 0,
            'sss' => $request->sss ?? 0,
            'philhealth' => $request->philhealth ?? 0,
            'pagibig' => $request->pagibig ?? 0,
            'tax' => $request->tax ?? 0,
            'status' => 'draft',
        ]);

        AuditLogService::log(
            'Payslip Created',
            'Admin ' .
            Auth::user()->name .
            ' created a payslip for employee ' .
            $payslip->user->name .
            '.'
        );

        return redirect()->route('admin.payslips')->with('success', 'Payslip created successfully');
    }

    public function release($id)
    {
        $payslip = Payslip::with('user')->findOrFail($id);

        $payslip->update([
            'status' => 'released'
        ]);

        AuditLogService::log(
            'Payslip Released',
            'Admin ' .
            Auth::user()->name .
            ' released the payslip of employee ' .
            $payslip->user->name .
            '.'
        );

        return back()->with('success', 'Payslip released to employee');
    }

    public function show($id)
    {
        $payslip = Payslip::with('user')->findOrFail($id);

        return view(
            'admin.payslip_view',
            compact('payslip')
        );
    }

    public function download($period_start, $period_end)
    {
        $payslips = Payslip::with('user')
            ->where('period_start', $period_start)
            ->where('period_end', $period_end)
            ->get();

        if ($payslips->isEmpty()) {
            abort(404, 'No payslips found.');
        }

        $pdf = Pdf::loadView('admin.payslips.pdf', compact('payslips'));

        return $pdf->download("Payslips_{$period_start}_to_{$period_end}.pdf");
    }

    public function markPaid($id)
    {
        $payslip = Payslip::with('user')->findOrFail($id);

        $payslip->update([
            'status' => 'Paid',
        ]);

        AuditLogService::log(
            'Payslip Marked as Paid',
            'Admin ' .
            Auth::user()->name .
            ' marked the payslip of employee ' .
            $payslip->user->name .
            ' as paid.'
        );

        return redirect()->back()->with(
            'success',
            'Payslip marked as paid successfully.'
        );
    }
}