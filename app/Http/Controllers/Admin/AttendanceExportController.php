<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttendanceExportController extends Controller
{
    private function attendanceQuery(Request $request)
    {
        $query = Attendance::with('user');

        // Employee Search
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('employee_id', 'like', '%' . $request->search . '%');
            });
        }

        // Date Filter
        if ($request->filled('date')) {

            $query->whereDate('date', $request->date);
        } else {

            // Default = today
            $query->whereDate('date', today());
        }

        return $query->orderBy('date', 'desc');
    }

    public function csv(Request $request)
    {
        $fileName = "Attendance_Report_" . now()->format('Y-m-d') . ".csv";

       $attendances = $this->attendanceQuery($request)->get();

        $headers = [

            "Content-Type" => "text/csv",

            "Content-Disposition" => "attachment; filename={$fileName}",

        ];

        $callback = function () use ($attendances) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Employee ID',

                'Employee Name',

                'Date',

                'Morning Time In',

                'Morning Time Out',

                'Afternoon Time In',

                'Afternoon Time Out',

                'Work Hours'

            ]);

            foreach ($attendances as $attendance) {

                fputcsv($file, [

                    $attendance->user->employee_id,

                    $attendance->user->name,

                    optional($attendance->date)->format('Y-m-d'),

                    optional($attendance->morning_time_in)->format('h:i:s A'),

                    optional($attendance->morning_time_out)->format('h:i:s A'),

                    optional($attendance->afternoon_time_in)->format('h:i:s A'),

                    optional($attendance->afternoon_time_out)->format('h:i:s A'),

                    $attendance->hours_worked

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pdf(Request $request)
    {

        $attendances = $this->attendanceQuery($request)->get();

        $pdf = Pdf::loadView(
            'admin.export.attendance_pdf',
            compact('attendances')
        );

        return $pdf->download('Attendance_Report.pdf');
    }
}
