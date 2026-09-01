<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartTimeSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartTimeSubjectController extends Controller
{
    /**
     * Display the Subject Assignment page.
     */
    public function index()
    {
        $partTimeEmployees = User::query()
            ->where('employment_type', 'Part-Time')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $assignments = PartTimeSubject::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('employment_type', 'Part-Time');
            })
            ->latest()
            ->get();

        $averageRate = $assignments->avg('rate_per_subject') ?? 0;

        $defaultClassesPerMonth = $assignments->avg('classes_per_month') ?? 0;

        return view('admin.subject_assignment', compact(
            'partTimeEmployees',
            'assignments',
            'averageRate',
            'defaultClassesPerMonth'
        ));
    }

    /**
     * Store a new subject assignment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'integer',
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
                'string',
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

        $employee = User::findOrFail(
            $validated['employee_id']
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure only Part-Time employees can be assigned
        |--------------------------------------------------------------------------
        */

        if ($employee->employment_type !== 'Part-Time') {

            return back()
                ->withInput()
                ->withErrors([
                    'employee_id' =>
                        'Only Part-Time employees can be assigned subjects.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Assignment
        |--------------------------------------------------------------------------
        */

        PartTimeSubject::create([
            'user_id' => $employee->id,
            'subject_name' => $validated['subject_name'],
            'rate_per_subject' => $validated['rate_per_subject'],
            'classes_per_month' => $validated['classes_per_month'],
            'day_of_week' => $validated['day_of_week'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment saved successfully.'
            );
    }

    /**
     * Show the edit page.
     */
    public function edit(PartTimeSubject $partTimeSubject)
    {
        $partTimeSubject->load('employee');

        if (
            !$partTimeSubject->employee ||
            $partTimeSubject->employee->employment_type !== 'Part-Time'
        ) {
            abort(404);
        }

        $partTimeEmployees = User::query()
            ->where('employment_type', 'Part-Time')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'admin.subject_assignment_edit',
            compact(
                'partTimeSubject',
                'partTimeEmployees'
            )
        );
    }

    /**
     * Update an existing subject assignment.
     */
    public function update(
        Request $request,
        PartTimeSubject $partTimeSubject
    ) {
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'integer',
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
                'string',
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

        $employee = User::findOrFail(
            $validated['employee_id']
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure only Part-Time employees can be assigned
        |--------------------------------------------------------------------------
        */

        if ($employee->employment_type !== 'Part-Time') {

            return back()
                ->withInput()
                ->withErrors([
                    'employee_id' =>
                        'Only Part-Time employees can be assigned subjects.'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Assignment
        |--------------------------------------------------------------------------
        */

        $partTimeSubject->update([
            'user_id' => $employee->id,
            'subject_name' => $validated['subject_name'],
            'rate_per_subject' => $validated['rate_per_subject'],
            'classes_per_month' => $validated['classes_per_month'],
            'day_of_week' => $validated['day_of_week'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment updated successfully.'
            );
    }

    /**
     * Delete a subject assignment.
     */
    public function destroy(PartTimeSubject $partTimeSubject)
    {
        DB::transaction(function () use ($partTimeSubject) {

            $partTimeSubject->delete();

        });

        return redirect()
            ->route('subject_assignment')
            ->with(
                'success',
                'Subject assignment removed successfully.'
            );
    }
}
