<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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

        return response()->json($leave);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $leave = LeaveRequest::findOrFail($id);

        // Prevent processing twice
        if ($leave->status != 'Pending') {

            return response()->json([

                'success' => false,

                'message' => 'This leave request has already been processed.'

            ], 422);
        }

        $leave->update([
            'status' => $request->status,
            'remarks' => $request->remarks,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        Notification::create([

            'user_id' => $leave->user_id,

            'title' => 'Leave Request Updated',

            'message' => 'Your ' . $leave->leave_type .
                ' leave request has been ' .
                strtolower($request->status) . '.',

            'type' => 'leave',

            'url' => '/employee/file-leave'

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Leave request updated successfully.'
        ]);
    }
}
