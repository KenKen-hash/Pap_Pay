<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\OfficialBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficialBusinessController extends Controller
{
    public function index(Request $request)
    {
        $employee = Auth::user();

        $query = OfficialBusiness::where('user_id', $employee->id);

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('purpose', 'like', '%' . $request->search . '%')
                    ->orWhere('destination', 'like', '%' . $request->search . '%');
            });
        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Latest 10 records
        $officialBusinesses = $query
            ->latest()
            ->paginate(10);

        return view('employee.file_ob', [

            'officialBusinesses' => $officialBusinesses,

            'pendingOB' => OfficialBusiness::where('user_id', $employee->id)
                ->where('status', 'Pending')
                ->count(),

            'approvedOB' => OfficialBusiness::where('user_id', $employee->id)
                ->where('status', 'Approved')
                ->count(),

            'rejectedOB' => OfficialBusiness::where('user_id', $employee->id)
                ->where('status', 'Rejected')
                ->count(),

            'totalOB' => OfficialBusiness::where('user_id', $employee->id)
                ->count()

        ]);
    }
    public function store(Request $request)
    {
        $request->validate([

            'purpose' => 'required|string|max:1000',

            'destination' => 'required|string|max:255',

            'ob_date' => 'required|date|after_or_equal:today',

            'morning_time_in' => 'nullable',
            'morning_time_out' => 'nullable',

            'afternoon_time_in' => 'nullable',
            'afternoon_time_out' => 'nullable',

            'proof_images' => 'nullable|array',

            'proof_images.*' => 'image|mimes:jpg,jpeg,png|max:5120',


        ]);

        $images = [];

        if ($request->hasFile('proof_images')) {

            foreach ($request->file('proof_images') as $image) {

                $images[] = $image->store(
                    'official-business',
                    'public'
                );
            }
        }
        OfficialBusiness::create([

            'user_id' => Auth::id(),

            'purpose' => $request->purpose,

            'destination' => $request->destination,

            'ob_date' => $request->ob_date,

            'morning_time_out' => $request->morning_time_out,
            'morning_time_in' => $request->morning_time_in,

            'afternoon_time_out' => $request->afternoon_time_out,
            'afternoon_time_in' => $request->afternoon_time_in,

            'status' => 'Pending',

        ]);

        return redirect()
            ->route('file_ob')
            ->with('success', 'Official Business submitted successfully.');
    }
}
