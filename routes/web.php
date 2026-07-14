<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\AttendanceController;

use App\Http\Controllers\Employee\PayslipController;
use App\Http\Controllers\Employee\LeaveController;
use App\Http\Controllers\Employee\OfficialBusinessController as EmployeeOfficialBusinessController;
use App\Http\Controllers\Employee\AnnouncementController as EmployeeAnnouncementController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\AttendanceExportController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OfficialBusinessController;
use App\Http\Controllers\Admin\FaceRegistrationController;
use App\Http\Controllers\Admin\FaceAttendanceController;
use App\Http\Controllers\Admin\UserWizardController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\AnnouncementController;


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/attendance', [AttendanceController::class, 'index'])
            ->name('attendance');

        Route::get('/file-leave', [LeaveController::class, 'index'])
            ->name('file_leave');

        Route::post('/file-leave', [LeaveController::class, 'store'])
            ->name('leave.store');

        Route::get('/payslip', [PayslipController::class, 'index'])
            ->name('payslip');

        Route::get('/my_profile', function () {
            return view('employee.my_profile');
        })->name('my_profile');

        Route::delete(
            '/file-leave/{leave}/cancel',
            [LeaveController::class, 'cancel']
        )->name('leave.cancel');

        Route::get(
            '/file_ob',
            [EmployeeOfficialBusinessController::class, 'index']
        )->name('file_ob');

        Route::post('/file-ob', [EmployeeOfficialBusinessController::class, 'store'])
            ->name('file_ob.store');

        Route::get(
            '/announcements',
            [EmployeeAnnouncementController::class, 'index']
        )->name('employee.announcements');
    });

Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/my-profile', [EmployeeProfileController::class, 'index'])
        ->name('my_profile');

    Route::patch('/my-profile', [EmployeeProfileController::class, 'update'])
        ->name('my_profile.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin-dashboard');

        Route::resource('employees', EmployeeController::class);

        Route::get('/attendance_list', [AdminAttendanceController::class, 'index'])
            ->name('attendance_list');

        Route::post(
            '/attendance/record',
            [AdminAttendanceController::class, 'record']
        )->name('attendance.record');

        Route::get('/attendance/export/csv', [AttendanceExportController::class, 'csv'])
            ->name('attendance.export.csv');

        Route::get('/attendance/export/pdf', [AttendanceExportController::class, 'pdf'])
            ->name('attendance.export.pdf');

        Route::get('/payslips', [PayslipController::class, 'index'])
            ->name('admin.payslips');

        Route::get('/payslips/create', [PayslipController::class, 'create'])
            ->name('admin.payslips.create');

        Route::post('/payslips/store', [PayslipController::class, 'store'])
            ->name('admin.payslips.store');

        Route::post('/payslips/{id}/release', [PayslipController::class, 'release'])
            ->name('admin.payslips.release');

        Route::get('/leaves', [AdminLeaveController::class, 'index'])
            ->name('admin.leaves');

        Route::get('/leaves/{id}', [AdminLeaveController::class, 'show'])
            ->name('admin.leaves.show');

        Route::post('/leaves/{id}/status', [AdminLeaveController::class, 'updateStatus'])
            ->name('admin.leaves.status');

        Route::get('/payroll', [PayrollController::class, 'index'])
            ->name('payroll');;

        Route::view('/payslip_list', 'admin.payslip_list')
            ->name('payslip_list');

        Route::view('/official_business', 'admin.official_business')
            ->name('official_business');

        Route::view('/departments', 'admin.departments')
            ->name('departments');

        Route::view('/reports', 'admin.reports')
            ->name('reports');

        Route::view('/settings', 'admin.settings')
            ->name('settings');

        Route::get('/users/create', [UserController::class, 'chooseType'])
            ->name('users.choose');

        Route::post('/users/create', [UserController::class, 'redirectCreate'])
            ->name('users.redirect');

        Route::get('/users/create/admin', [UserController::class, 'createAdmin'])
            ->name('users.admin');

        Route::get('/users/create/employee', [UserController::class, 'createEmployee'])
            ->name('users.employee');
        Route::get('/admin/users/create-employee', [UserController::class, 'createEmployee'])
            ->name('users.create.employee');
        Route::post('/admin/users/create/employee', [UserController::class, 'storeEmployee'])
            ->name('users.employee.store');

        Route::get(
            '/official_business',
            [OfficialBusinessController::class, 'index']
        )->name('official_business');

        Route::post(
            '/admin/official-business/{id}/approve',
            [OfficialBusinessController::class, 'approve']
        )->name('official_business.approve');

        Route::post(
            '/admin/official-business/{id}/reject',
            [OfficialBusinessController::class, 'reject']
        )->name('official_business.reject');

        Route::get(
            '/employees/{user}/face-registration',
            [FaceRegistrationController::class, 'show']
        )->name('admin.face.register');

        Route::post(
            '/employees/{id}/save-face',
            [FaceRegistrationController::class, 'save']
        )->name('face.save');

        Route::get(
            '/attendance-kiosk',
            [FaceAttendanceController::class, 'index']
        )->name('attendance.kiosk');

        Route::get(
            '/attendance/faces',
            [FaceAttendanceController::class, 'faces']
        )->name('attendance.faces');



        Route::prefix('admin')
            ->middleware(['auth'])
            ->group(function () {

                Route::get('/users/create', [UserWizardController::class, 'chooseType'])
                    ->name('users.create');

                Route::post('/users/choose', [UserWizardController::class, 'choose'])
                    ->name('users.choose');

                Route::get('/users/create/employee', [UserWizardController::class, 'employeeForm'])
                    ->name('users.employee');

                Route::get('/users/create/admin', [UserWizardController::class, 'adminForm'])
                    ->name('users.admin');
                Route::post(
                    '/users/employee/setup',
                    [UserWizardController::class, 'employeeSetup']
                )
                    ->name('users.employee.setup');

                Route::post('/users/admin/setup', [UserWizardController::class, 'adminSetup'])
                    ->name('users.admin.setup');
            });

        Route::get(
            '/announcements',
            [AnnouncementController::class, 'index']
        )->name('announcements');

        Route::post(
            '/announcements',
            [AnnouncementController::class, 'store']
        )->name('announcements.store');
    });

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/change-password-first-login', [
        App\Http\Controllers\Auth\FirstPasswordController::class,
        'index'
    ])->name('password.first');

    Route::post('/change-password-first-login', [
        App\Http\Controllers\Auth\FirstPasswordController::class,
        'update'
    ])->name('password.first.update');
});
require __DIR__ . '/auth.php';
