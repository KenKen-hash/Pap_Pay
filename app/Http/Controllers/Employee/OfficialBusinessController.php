<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\OfficialBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NotificationHelper;

class OfficialBusinessController extends Controller
{
    /**
     * Display the employee's Official Business requests.
     */
    public function index(Request $request)
    {
        $employee = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Get only the logged-in employee's OB requests
        |--------------------------------------------------------------------------
        */
        $query = OfficialBusiness::where('user_id', $employee->id);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        | Search by purpose.
        |
        | Destination was removed from the new OB form and database.
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('purpose', 'like', '%' . $search . '%');

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        /*
        |--------------------------------------------------------------------------
        | Get latest OB requests
        |--------------------------------------------------------------------------
        */
        $officialBusinesses = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Summary Counts
        |--------------------------------------------------------------------------
        */
        $pendingOB = OfficialBusiness::where('user_id', $employee->id)
            ->where('status', 'Pending')
            ->count();

        $approvedOB = OfficialBusiness::where('user_id', $employee->id)
            ->where('status', 'Approved')
            ->count();

        $rejectedOB = OfficialBusiness::where('user_id', $employee->id)
            ->where('status', 'Rejected')
            ->count();

        $totalOB = OfficialBusiness::where('user_id', $employee->id)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Return Employee OB Page
        |--------------------------------------------------------------------------
        */
        return view('employee.file_ob', [

            'officialBusinesses' => $officialBusinesses,

            'pendingOB' => $pendingOB,

            'approvedOB' => $approvedOB,

            'rejectedOB' => $rejectedOB,

            'totalOB' => $totalOB,

        ]);
    }


    /**
     * Store a new Official Business request.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Employee Submission
        |--------------------------------------------------------------------------
        */

        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | General Information
            |--------------------------------------------------------------------------
            */

            'purpose' => [
                'required',
                'string',
                'max:1000',
            ],

            'ob_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'ob_date_to' => [
                'nullable',
                'date',
                'after_or_equal:ob_date',
            ],


            /*
            |--------------------------------------------------------------------------
            | Estimated Cost
            |--------------------------------------------------------------------------
            */

            'transportation_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'meals_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'lodging_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'others_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'registration_fee' => [
                'nullable',
                'numeric',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Attachments
            |--------------------------------------------------------------------------
            */

            'proof_images' => [
                'nullable',
                'array',
            ],

            'proof_images.*' => [
                'image',
                'mimes:jpg,jpeg,png',
                'max:5120',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Store Uploaded Attachments
        |--------------------------------------------------------------------------
        */

        $images = [];

        if ($request->hasFile('proof_images')) {

            foreach ($request->file('proof_images') as $image) {

                $images[] = $image->store(
                    'official-business',
                    'public'
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Create Official Business Request
        |--------------------------------------------------------------------------
        */

        $officialBusiness = OfficialBusiness::create([

            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            */

            'user_id' => Auth::id(),


            /*
            |--------------------------------------------------------------------------
            | General Information
            |--------------------------------------------------------------------------
            */

            'purpose' => $request->purpose,

            'ob_date' => $request->ob_date,

            'ob_date_to' => $request->ob_date_to ?: $request->ob_date,


            /*
            |--------------------------------------------------------------------------
            | Estimated Cost
            |--------------------------------------------------------------------------
            */

            'transportation_cost' => $request->transportation_cost ?? 0,

            'meals_cost' => $request->meals_cost ?? 0,

            'lodging_cost' => $request->lodging_cost ?? 0,

            'others_cost' => $request->others_cost ?? 0,

            'registration_fee' => $request->registration_fee ?? 0,


            /*
            |--------------------------------------------------------------------------
            | Attachments
            |--------------------------------------------------------------------------
            */

            'proof_images' => !empty($images)
                ? $images
                : null,


            /*
            |--------------------------------------------------------------------------
            | Approval Status
            |--------------------------------------------------------------------------
            */

            'status' => 'Pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Notify Admins
        |--------------------------------------------------------------------------
        |
        | Once the employee submits the OB, the request is immediately
        | sent to the administrators for approval.
        |
        */

        NotificationHelper::notifyAdmins(

            'New Official Business Request',

            Auth::user()->name .
                ' filed a new Official Business request for ' .
                $officialBusiness->ob_date .
                ($officialBusiness->ob_date_to
                    && $officialBusiness->ob_date_to != $officialBusiness->ob_date
                    ? ' to ' . $officialBusiness->ob_date_to
                    : '') .
                '.',

            'ob',

            route('official_business')

        );


        /*
        |--------------------------------------------------------------------------
        | Redirect Back to Employee OB Page
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('file_ob')
            ->with(
                'success',
                'Official Business submitted successfully and sent to the administrator for approval.'
            );
    }
}
