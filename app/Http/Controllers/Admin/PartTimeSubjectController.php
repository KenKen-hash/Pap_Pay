<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PartTimeSubject;
use Illuminate\Http\Request;

class PartTimeSubjectController extends Controller
{
    /**
     * Display subject assignment page.
     */
    public function index()
    {
        $partTimeEmployees = User::where(
            'employment_type',
            'Part-Time'
        )
        ->orderBy('first_name')
        ->get();

        $assignments = PartTimeSubject::with('employee')
            ->where('is_active', true)
            ->latest()
            ->get();

        $averageRate = $assignments->avg(
            'rate_per_subject'
        ) ?? 0;

        $defaultClassesPerMonth = $assignments->avg(
            'classes_per_month'
        ) ?? 0;

        return view(
            'admin.subject_assignment',
            compact(
                'partTimeEmployees',
                'assignments',
                'averageRate',
                'defaultClassesPerMonth'
            )
        );
    }


    /**
     * Store a new subject assignment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'employee_id' => [
                'required',
                'exists:users,id',
            ],

            'subject_name' => [
                'required',
                'string',
                'max:255',
            ],

            'rate_per_subject' => [
                'required',
                'numeric',
                'min:0',
            ],

            'classes_per_month' => [
                'required',
                'integer',
                'min:1',
            ],

            'day_of_week' => [
                'required',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Make sure selected employee is actually Part-Time
        |--------------------------------------------------------------------------
        */

        $employee = User::findOrFail(
            $validated['employee_id']
        );


        if ($employee->employment_type !== 'Part-Time') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Only Part-Time employees can be assigned subjects.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        |
        | Blade uses employee_id but database uses user_id.
        |
        */

        PartTimeSubject::create([

            'user_id' =>
                $validated['employee_id'],

            'subject_name' =>
                $validated['subject_name'],

            'rate_per_subject' =>
                $validated['rate_per_subject'],

            'classes_per_month' =>
                $validated['classes_per_month'],

            'day_of_week' =>
                $validated['day_of_week'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

            'is_active' =>
                true,
        ]);


        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment successfully created.'
            );
    }


    /**
     * Edit assignment.
     */
    public function edit($id)
    {
        $assignment =
            PartTimeSubject::findOrFail($id);

        $partTimeEmployees = User::where(
            'employment_type',
            'Part-Time'
        )
        ->orderBy('first_name')
        ->get();

        return view(
            'admin.subject_assignment_edit',
            compact(
                'assignment',
                'partTimeEmployees'
            )
        );
    }


    /**
     * Update assignment.
     */
    public function update(
        Request $request,
        $id
    ) {
        $assignment =
            PartTimeSubject::findOrFail($id);


        $validated = $request->validate([

            'employee_id' =>
                'required|exists:users,id',

            'subject_name' =>
                'required|string|max:255',

            'rate_per_subject' =>
                'required|numeric|min:0',

            'classes_per_month' =>
                'required|integer|min:1',

            'day_of_week' =>
                'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',

            'start_time' =>
                'required|date_format:H:i',

            'end_time' =>
                'required|date_format:H:i|after:start_time',

        ]);


        $employee = User::findOrFail(
            $validated['employee_id']
        );


        if ($employee->employment_type !== 'Part-Time') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Only Part-Time employees can be assigned subjects.'
                );
        }


        $assignment->update([

            'user_id' =>
                $validated['employee_id'],

            'subject_name' =>
                $validated['subject_name'],

            'rate_per_subject' =>
                $validated['rate_per_subject'],

            'classes_per_month' =>
                $validated['classes_per_month'],

            'day_of_week' =>
                $validated['day_of_week'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

        ]);


        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment successfully updated.'
            );
    }


    /**
     * Soft-delete assignment.
     */
    public function destroy($id)
    {
        $assignment =
            PartTimeSubject::findOrFail($id);


        $assignment->update([
            'is_active' => false,
        ]);


        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment removed successfully.'
            );
    }
}
