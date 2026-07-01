<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\OfficialBusiness;
use App\Models\Payroll;
use App\Models\Announcement;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        $employee = Auth::user();

        $attendance = Attendance::where('user_id', $employee->id)
            ->where(function ($query) use ($keyword) {
                $query->where('date', 'LIKE', "%{$keyword}%")
                      ->orWhere('status', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $leaveRequests = LeaveRequest::where('user_id', $employee->id)
            ->where(function ($query) use ($keyword) {
                $query->where('leave_type', 'LIKE', "%{$keyword}%")
                      ->orWhere('status', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $officialBusinesses = OfficialBusiness::where('user_id', $employee->id)
            ->where(function ($query) use ($keyword) {
                $query->where('purpose', 'LIKE', "%{$keyword}%")
                      ->orWhere('status', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $payrolls = Payroll::where('user_id', $employee->id)
            ->where(function ($query) use ($keyword) {
                $query->where('pay_period', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $announcements = Announcement::where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%")
            ->get();

        return view('search-results', compact(
            'keyword',
            'attendance',
            'leaveRequests',
            'officialBusinesses',
            'payrolls',
            'announcements'
        ));
    }
}