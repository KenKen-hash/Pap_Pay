<?php


namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Carbon\Carbon;

class LeaveController extends Controller
{
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
    public function store(Request $request)
    {
        $request->validate([

            'leave_type' => 'required|string|max:255',

            'start_date' => 'required|date',

            'end_date' => 'required|date|after_or_equal:start_date',

            'days' => 'required|integer|min:1',

            'reason' => 'required|string',

            'supervisor' => 'required|string|max:255',

            'return_date' => 'required|date|after:end_date',

            'attachment' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',

        ]);

        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = $request
                ->file('attachment')
                ->store('leave_attachments', 'public');
        }
        /*
|--------------------------------------------------------------------------
| Prevent Duplicate / Overlapping Leave
|--------------------------------------------------------------------------
*/

        $duplicate = LeaveRequest::where('user_id', Auth::id())

            ->whereIn('status', ['Pending', 'Approved'])

            ->where(function ($query) use ($request) {

                $query

                    ->whereBetween('start_date', [
                        $request->start_date,
                        $request->end_date
                    ])

                    ->orWhereBetween('end_date', [
                        $request->start_date,
                        $request->end_date
                    ])

                    ->orWhere(function ($q) use ($request) {

                        $q->where('start_date', '<=', $request->start_date)

                            ->where('end_date', '>=', $request->end_date);
                    });
            })

            ->exists();

        if ($duplicate) {

            return back()

                ->withInput()

                ->withErrors([

                    'duplicate' => 'You already have a Pending or Approved leave request that overlaps with the selected dates.'

                ]);
        }

        LeaveRequest::create([

            'user_id' => Auth::id(),

            'leave_type' => $request->leave_type,

            'supervisor' => $request->supervisor,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'return_date' => $request->return_date,

            'days' => $request->days,

            'reason' => $request->reason,

            'attachment' => $attachment,

            'status' => 'Pending',

        ]);

        return redirect()
            ->back()
            ->with('success', 'Leave request submitted successfully.');
    }
    public function cancel(LeaveRequest $leave)
    {
        if ($leave->user_id != Auth::id()) {

            abort(403);
        }

        if ($leave->status != 'Pending') {

            return back()->with(
                'error',
                'Only pending leave requests can be cancelled.'
            );
        }

        $leave->update([

            'status' => 'Cancelled',

        ]);

        return back()->with(
            'success',
            'Leave request cancelled successfully.'
        );
    }
}
