<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;

class PayslipController extends Controller
{
    public function index()
    {
        $payslips = Payslip::where('user_id', auth()->id())
            ->whereIn('status', ['Generated', 'Sent', 'Viewed'])
            ->orderByDesc('period_end')
            ->paginate(10);

        $latestPayslip = $payslips->first();

        return view(
            'employee.payslip',
            compact(
                'payslips',
                'latestPayslip'
            )
        );
    }
    public function download($id)
    {
        $payslip = Payslip::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($payslip->status == 'Sent') {
            $payslip->update([
                'status' => 'Viewed'
            ]);
        }

        $pdf = Pdf::loadView(
            'employee.export.payslip_pdf',
            compact('payslip')
        );

        return $pdf->download(
            'Payslip_' .
                $payslip->period_start->format('Ymd') .
                '_' .
                $payslip->period_end->format('Ymd') .
                '.pdf'
        );
    }
}
