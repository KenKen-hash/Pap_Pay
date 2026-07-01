<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class LeaveController extends Controller
{
    public function index()
{
    $notifications = Notification::where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

    $leaveRequests = Auth::user()
        ->leaveRequests()
        ->latest()
        ->get();

    return view('employee.file_leave', compact(
        'notifications',
        'leaveRequests'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'days' => 'required|integer|min:1',
            'reason' => 'required|string',
            'attachment' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'emergency_contact' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
        ]);

        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = $request
                ->file('attachment')
                ->store('leave_attachments', 'public');
        }

        LeaveRequest::create([

            'user_id' => Auth::id(),

            'leave_type' => $request->leave_type,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'days' => $request->days,

            'reason' => $request->reason,

            'attachment' => $attachment,

            'emergency_contact' => $request->emergency_contact,

            'contact_number' => $request->contact_number,

            'status' => 'Pending',

        ]);

        return redirect()
            ->back()
            ->with('success', 'Leave request submitted successfully.');
    }
}