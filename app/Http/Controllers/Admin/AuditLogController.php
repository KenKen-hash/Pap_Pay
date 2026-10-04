<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display the admin activity log.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                    ->orWhere('action', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('middle_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Admin filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('admin')) {
            $query->where('user_id', $request->admin);
        }

        /*
        |--------------------------------------------------------------------------
        | Action filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        /*
        |--------------------------------------------------------------------------
        | Date filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        /*
        |--------------------------------------------------------------------------
        | Activity records
        |--------------------------------------------------------------------------
        |
        | 50 per page keeps the page fast while still looking like
        | a simple activity feed.
        |
        */

        $logs = $query
            ->paginate(50)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Admin list
        |--------------------------------------------------------------------------
        */

        $admins = \App\Models\User::query()
            ->where('role', 'admin')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Available actions
        |--------------------------------------------------------------------------
        */

        $actions = AuditLog::query()
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('admin.audit-log.index', compact(
            'logs',
            'admins',
            'actions'
        ));
    }
}
