<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeDashboardController extends Controller
{
    public function index() {
        $PageData = [
            'title' => 'Employee Dashboard',
            'js' => asset('js/dashboard/employee/index.js'),
            'dashboardLink' => '/dashboard/employee/',
            'attendance' => $this->attendanceToday()
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
            'dashboardLink' => '/dashboard/employee/'
        ];

        return view('pages.employee.payslips', $PageData);
    }

    public function settings() {
        $PageData = [
            'title' => 'settings',
            'js' => asset('js/dashboard/employee/settings.js'),
            'dashboardLink' => '/dashboard/employee/'
        ];

        return view('pages.employee.settings', $PageData);
    }
}
