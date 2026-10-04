<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Services\AuditLogService;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with('user')
            ->latest()
            ->paginate(10);

        // Dashboard Cards
        $pending = LeaveRequest::where('status', 'Pending')->count();

        $approved = LeaveRequest::where('status', 'Approved')->count();

        $rejected = LeaveRequest::where('status', 'Rejected')->count();

        $cancelled = LeaveRequest::where('status', 'Cancelled')->count();

        $onLeaveToday = LeaveRequest::where('status', 'Approved')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        return view('admin.leaves', compact(
            'leaveRequests',
            'pending',
            'approved',
            'rejected',
            'cancelled',
            'onLeaveToday'
        ));
    }

    public function show($id)
    {
        $leave = LeaveRequest::with('user')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Format Leave Dates
        |--------------------------------------------------------------------------
        | Leave dates are calendar dates, not times.
        | Convert them to Philippine time first so a stored midnight
        | value does not become the previous day when returned as UTC.
        |--------------------------------------------------------------------------
        */

        $startDate = $leave->start_date
            ? Carbon::parse($leave->start_date)
                ->setTimezone('Asia/Manila')
                ->format('Y-m-d')
            : null;

        $endDate = $leave->end_date
            ? Carbon::parse($leave->end_date)
                ->setTimezone('Asia/Manila')
                ->format('Y-m-d')
            : null;

        $returnDate = $leave->return_date
            ? Carbon::parse($leave->return_date)
                ->setTimezone('Asia/Manila')
                ->format('Y-m-d')
            : null;

        /*
        |--------------------------------------------------------------------------
        | Return Leave Request Data
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'id' => $leave->id,

            'user_id' => $leave->user_id,

            'leave_type' => $leave->leave_type,

            'leave_pay_type' => $leave->leave_pay_type,

            'start_date' => $startDate,

            'end_date' => $endDate,

            'return_date' => $returnDate,

            'days' => $leave->days,

            'reason' => $leave->reason,

            'attachment' => $leave->attachment,

            'status' => $leave->status,

            'remarks' => $leave->remarks,

            'approved_by' => $leave->approved_by,

            'approved_at' => $leave->approved_at,

            'created_at' => $leave->created_at,

            'updated_at' => $leave->updated_at,

            'user' => $leave->user,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',

            'remarks' => 'nullable|string|max:1000',
        ]);

        $leave = LeaveRequest::with('user')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Prevent Processing Twice
        |--------------------------------------------------------------------------
        */

        if ($leave->status != 'Pending') {

            return response()->json([

                'success' => false,

                'message' => 'This leave request has already been processed.'

            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Leave Status
        |--------------------------------------------------------------------------
        */

        $leave->update([

            'status' => $request->status,

            'remarks' => $request->remarks,

            'approved_by' => Auth::id(),

            'approved_at' => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | Audit Log
        |--------------------------------------------------------------------------
        */

        $action = $request->status === 'Approved'
            ? 'Leave Approved'
            : 'Leave Rejected';

        $description = 'Admin ' .
            Auth::user()->name .
            ' ' .
            strtolower($request->status) .
            ' leave request LV-' .
            str_pad($leave->id, 5, '0', STR_PAD_LEFT) .
            ' for employee ' .
            $leave->user->name .
            '.';

        AuditLogService::log(
            $action,
            $description
        );

        /*
        |--------------------------------------------------------------------------
        | Employee Notification
        |--------------------------------------------------------------------------
        |
        | Create a notification for the employee who filed the leave.
        |
        */

        Notification::create([

            'user_id' => $leave->user_id,

            'title' => $request->status === 'Approved'
                ? 'Leave Request Approved'
                : 'Leave Request Rejected',

            'message' => 'Your ' .
                $leave->leave_type .
                ' leave request has been ' .
                strtolower($request->status) .
                '.',

            'is_read' => false,

            'type' => $request->status === 'Approved'
                ? 'leave_approved'
                : 'leave_rejected',

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | Use the actual Laravel route instead of hardcoding
            | /employee/file-leave.
            |
            */

            'url' => route('file_leave'),

        ]);

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'message' => 'Leave request updated successfully.'

        ]);
    }
}   
