<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeDashboardController extends Controller
{
    protected $avatar;
    protected $employee;
    function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            $employee = Employee::where('user_id', $this->user->id)->first();
            $this->employee = $employee;
            $this->avatar = $employee->avatar == null ? asset('img/user.jpg') : asset('storage/' . $employee->avatar);

            return $next($request);
        });
    }

    public function index() {
        $PageData = [
            'title' => 'Employee Dashboard',
            'js' => asset('js/dashboard/employee/index.js'),
            'dashboardLink' => '/dashboard/employee/',
            'attendance' => $this->attendanceToday(),
            'avatar' => $this->avatar
        ];

        return view('pages.employee.index', $PageData);
    }

    private function attendanceToday() {
        $data = [
            'time_in'   => null,
            'time_out'  => null,
            'date'      => null
        ];

        $employee = Employee::where('user_id', Auth::user()->id)->first();
        $ifExistsToday = Attendance::where('employee_id', $employee->id)->whereDate('created_at', DB::raw('CURDATE()'))->get();
        $lastAttendance = Attendance::all()->sortByDesc('id')->first();

        if($lastAttendance && $lastAttendance->time_out == null) {
            $data['time_in'] = $lastAttendance->time_in;
            $data['date'] = $lastAttendance->created_at;
        }

        if($lastAttendance && $lastAttendance->time_in != null && $lastAttendance->time_out != null) {
            $data['time_in'] = $lastAttendance->time_in;
            $data['time_out'] = $lastAttendance->time_out;
            $data['date'] = $lastAttendance->created_at;
        }

        return $data;
    }

    public function payslips() {
        $PageData = [
            'title' => 'Payslips',
            'js' => asset('js/dashboard/employee/payslips.js'),
            'dashboardLink' => '/dashboard/employee/',
            'avatar' => $this->avatar
        ];

        return view('pages.employee.payslips', $PageData);
    }

    public function settings() {
        $PageData = [
            'title' => 'Settings',
            'js' => asset('js/dashboard/employee/settings.js'),
            'dashboardLink' => '/dashboard/employee/',
            'avatar' => $this->avatar,
            'employee' => $this->employee
        ];

        return view('pages.employee.settings', $PageData);
    }
}
