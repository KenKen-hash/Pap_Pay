<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceExportController extends Controller
{
    public function csv()
    {
        $fileName = 'attendance.csv';

        $attendances = Attendance::with('user')->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Employee ID', 'Name', 'Date', 'Status', 'Hours'
            ]);

            foreach ($attendances as $a) {
                fputcsv($file, [
                    $a->user->employee_id,
                    $a->user->name,
                    $a->date,
                    $a->status,
                    $a->hours_worked,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pdf()
{
    $attendances = Attendance::with('user')->get();

    $pdf = Pdf::loadView('admin.export.attendance_pdf', compact('attendances'));

    return $pdf->download('attendance-report.pdf');
}
}