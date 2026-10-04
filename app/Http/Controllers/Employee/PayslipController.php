<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;

class PayslipController extends Controller
{
    /**
     * Display the employee's payslips.
     */
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


    /**
     * View an employee payslip.
     */
    public function view($id)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        | Only allow the currently authenticated employee to view
        | their own payslip.
        |--------------------------------------------------------------------------
        */

        $payslip = Payslip::where('id', $id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['Generated', 'Sent', 'Viewed'])
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | MARK AS VIEWED
        |--------------------------------------------------------------------------
        | When an employee opens a payslip that was previously sent,
        | change its status from Sent to Viewed.
        |--------------------------------------------------------------------------
        */

        if ($payslip->status === 'Sent') {
            $payslip->update([
                'status' => 'Viewed'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | DISPLAY PAYSLIP
        |--------------------------------------------------------------------------
        */

        return view(
            'employee.payslip-view',
            compact('payslip')
        );
    }


    /**
     * Download an employee payslip as PDF.
     */
    public function download($id)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        | Only allow the currently authenticated employee to download
        | their own payslip.
        |--------------------------------------------------------------------------
        */

        $payslip = Payslip::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | MARK AS VIEWED
        |--------------------------------------------------------------------------
        | When an employee downloads a payslip that was previously sent,
        | change its status from Sent to Viewed.
        |--------------------------------------------------------------------------
        */

        if ($payslip->status === 'Sent') {
            $payslip->update([
                'status' => 'Viewed'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'employee.export.payslip_pdf',
            compact('payslip')
        );


        /*
        |--------------------------------------------------------------------------
        | PDF SETTINGS
        |--------------------------------------------------------------------------
        */

        $pdf->setPaper('letter', 'portrait');


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD
        |--------------------------------------------------------------------------
        */

        return $pdf->download(
            'Payslip_' .
                $payslip->period_start->format('Ymd') .
                '_' .
                $payslip->period_end->format('Ymd') .
                '.pdf'
        );
    }
}
