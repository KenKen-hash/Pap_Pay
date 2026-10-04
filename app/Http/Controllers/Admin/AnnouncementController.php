<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;

class AnnouncementController extends Controller
{

    public function index()
    {

        $announcements = Announcement::latest()
            ->take(10)
            ->get();

        return view(
            'admin.announcements',
            compact('announcements')
        );
    }

    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required|max:255',
            'message' => 'required',
            'attachment' => 'nullable|file|max:5120'

        ]);

        $file = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment')
                ->store('announcements', 'public');
        }

        $announcement = Announcement::create([

            'admin_id' => Auth::id(),

            'title' => $request->title,

            'message' => $request->message,

            'attachment' => $file

        ]);


        /*
|--------------------------------------------------------------------------
| Notify All Active Employees
|--------------------------------------------------------------------------
*/

        $employees = User::where('role', 'employee')
            ->where('status', 'Active')
            ->get();

        foreach ($employees as $employee) {

            Notification::create([

                'user_id' => $employee->id,

                'title' => 'New Announcement',

                'message' => $announcement->title,

                'is_read' => false,

                'type' => 'announcement',

                'url' => route('employee.announcements'),

            ]);
        }
        AuditLogService::log(
            'Announcement Created',
            'Admin ' .
                Auth::user()->name .
                ' posted announcement "' .
                $request->title .
                '".'
        );

        return back()->with('success', 'Announcement posted successfully.');
    }
}
