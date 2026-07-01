<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
   public function index(Request $request)
{
    $attendances = Attendance::query()
        ->with(['user:id,name,employee_id,department']) // performance boost

        // Search (optimized grouping)
        ->when($request->search, function ($query) use ($request) {
            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_id', 'like', "%{$search}%");
                });
            });
        })

        // Date filter
        ->when($request->date, function ($query) use ($request) {
            $query->whereDate('date', $request->date);
        })

        ->orderByDesc('date')
        ->orderByDesc('id')

        ->paginate(15)
        ->withQueryString();

    return view('admin.attendance_list', compact('attendances'));
}
}