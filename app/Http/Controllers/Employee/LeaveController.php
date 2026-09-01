<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\Notification;
use App\Helpers\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display employee leave page.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $leaveHistory = Auth::user()
            ->leaveRequests()
            ->latest()
            ->paginate(10);

        return view('employee.file_leave', compact(
            'notifications',
            'leaveHistory'
        ));
    }

    /**
     * Store a new leave request.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'leave_type' => [
                'required',
                'string',
                'max:255',
            ],

            'leave_pay_type' => [
                'required',
                'string',
                'in:Leave with pay,Leave without pay',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'return_date' => [
                'required',
                'date',
                'after:end_date',
            ],

            'days' => [
                'required',
                'integer',
                'min:1',
            ],

            'reason' => [
                'required',
                'string',
            ],

            'attachment' => [
                'nullable',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Calculate Days Server-Side
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);

        $calculatedDays = $startDate->diffInDays($endDate) + 1;

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate / Overlapping Leave Requests
        |--------------------------------------------------------------------------
        */

        $duplicate = LeaveRequest::where(
            'user_id',
            Auth::id()
        )
            ->whereIn('status', [
                'Pending',
                'Approved',
            ])
            ->where(function ($query) use ($validated) {

                $query
                    ->whereBetween('start_date', [
                        $validated['start_date'],
                        $validated['end_date'],
                    ])

                    ->orWhereBetween('end_date', [
                        $validated['start_date'],
                        $validated['end_date'],
                    ])

                    ->orWhere(function ($q) use ($validated) {

                        $q->where(
                            'start_date',
                            '<=',
                            $validated['start_date']
                        )
                            ->where(
                                'end_date',
                                '>=',
                                $validated['end_date']
                            );
                    });
            })
            ->exists();

        if ($duplicate) {

            return back()
                ->withInput()
                ->withErrors([
                    'duplicate' =>
                        'You already have a Pending or Approved leave request that overlaps with the selected dates.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Attachment
        |--------------------------------------------------------------------------
        */

        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = $request
                ->file('attachment')
                ->store(
                    'leave_attachments',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Leave Request
        |--------------------------------------------------------------------------
        */

        LeaveRequest::create([
            'user_id' => Auth::id(),

            'leave_type' => $validated['leave_type'],

            'leave_pay_type' => $validated['leave_pay_type'],

            'start_date' => $validated['start_date'],

            'end_date' => $validated['end_date'],

            'return_date' => $validated['return_date'],

            'days' => $calculatedDays,

            'reason' => $validated['reason'],

            'attachment' => $attachment,

            'status' => 'Pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notify Administrators
        |--------------------------------------------------------------------------
        */

        NotificationHelper::notifyAdmins(
            'New Leave Request',
            Auth::user()->name . ' filed a leave request.',
            'leave',
            route('admin.leaves')
        );

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('file_leave')
            ->with(
                'success',
                'Leave request submitted successfully.'
            );
    }

    /**
     * Cancel a pending leave request.
     */
    public function cancel(LeaveRequest $leave)
    {
        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($leave->user_id !== Auth::id()) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Only Pending Requests Can Be Cancelled
        |--------------------------------------------------------------------------
        */

        if ($leave->status !== 'Pending') {

            return back()->with(
                'error',
                'Only pending leave requests can be cancelled.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Cancel Request
        |--------------------------------------------------------------------------
        */

        $leave->update([
            'status' => 'Cancelled',
        ]);

        return back()->with(
            'success',
            'Leave request cancelled successfully.'
        );
    }
}
