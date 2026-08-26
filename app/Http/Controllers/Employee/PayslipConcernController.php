<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Payslip;
use App\Models\PayslipConcern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NotificationHelper;

class PayslipConcernController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payslip_id' => 'required|exists:payslips,id',
            'reason' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Make sure the employee can only submit a concern
        // about their own payslip.
        $payslip = Payslip::where('id', $request->payslip_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $attachment = null;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')
                ->store('payslip-concerns', 'public');
        }

        PayslipConcern::create([
            'user_id' => Auth::id(),
            'payslip_id' => $payslip->id,
            'reason' => $request->reason,
            'attachment' => $attachment,
            'status' => 'Pending',
        ]);

        NotificationHelper::notifyAdmins(
            'New Payslip Concern',
            Auth::user()->name . ' submitted a concern about a payslip.',
            'payslip_concern',
            route('admin.payslip-concerns.index')
        );

        return back()->with(
            'success',
            'Your payslip concern has been submitted successfully.'
        );
    }
}
