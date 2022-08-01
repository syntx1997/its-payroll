<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function punch(Request $request) {
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        $currentTime = Carbon::parse(now())->format('H:i:s');

        // check if there's existing attendance today
        $ifExistsToday = Attendance::where('employee_id', $employee->id)->whereDate('created_at', DB::raw('CURDATE()'))->first();

        $lastAttendance = Attendance::where('employee_id', $employee->id)->orderBy('id', 'DESC')->first();
        if($lastAttendance && $lastAttendance->time_out == null) {
            $attendance = Attendance::find($lastAttendance->id);
            $attendance->update(['time_out' => $currentTime]);

            return response(['message' => 'Punched out!'], 201);
        }

        if($lastAttendance && $lastAttendance->time_in != null && $lastAttendance->time_out != null && $ifExistsToday) {
            return response(['message' => 'You already have an attendance for this day!'], 201);
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'time_in' => $currentTime
        ]);


        return response(['message' => 'Punched in!'], 201);
    }

    public function get_all() {
        $data = [];

        $employee = Employee::where('user_id', Auth::user()->id)->first();

        foreach (Attendance::where('employee_id', $employee->id)->get()->sortByDesc('id') as $attendance) {
            $data[] = [
                'date' => Carbon::parse($attendance->created_at)->format('M d, Y'),
                'time_in' => Carbon::parse($attendance->time_in)->format('h:i A'),
                'time_out' => $attendance->time_out != null ? Carbon::parse($attendance->time_out)->format('h:i A') : '00:00'
            ];
        }

        return response(['data' => $data]);
    }

    public function get_all_employees() {
        $data = [];

        $employees = Employee::all();
        foreach ($employees as $employee){

            if($employee->avatar == null) {
                $avatar_html = '<img src="'. asset('img/user.jpg') .'" style="width: 50px">';
            } else {
                $avatar_html = '<img src="'. asset('storage/'.$employee->avatar) .'" style="width: 50px">';
            }

            $attendance = [];
            $daysInMonth = Carbon::now()->daysInMonth; // days in today's month
            for ($day = 1; $day < ($daysInMonth + 1); $day++) {
                $employeeAttendances = Attendance::where('employee_id', $employee->id)->whereMonth('created_at', Carbon::now()->month)->get();
                if(count($employeeAttendances)) {
                    foreach ($employeeAttendances as $employeeAttendance) {
                        $attendanceDay = Carbon::parse($employeeAttendance->created_at)->format('j');
                        if($day == $attendanceDay) {
                            $attendance['number' . $day] = '<i class="la la-check text-success"></i>';
                        } else {
                            $attendance['number' . $day] = '<i class="la la-times text-danger font-weight-bold"></i>';
                        }
                    }
                } else {
                    $attendance['number' . $day] = '<i class="la la-times text-danger font-weight-bold"></i>';
                }
            }

            if($daysInMonth == 30) {
                $attendance['number31'] = '<i class="la la-times text-danger font-weight-bold"></i>';
            }


            $data[] = [
                'avatar_html' => $avatar_html,
                'name' => $employee->firstname . ' ' . $employee->lastname,
                '1' => $attendance['number1'],
                '2' => $attendance['number2'],
                '3' => $attendance['number3'],
                '4' => $attendance['number4'],
                '5' => $attendance['number5'],
                '6' => $attendance['number6'],
                '7' => $attendance['number7'],
                '8' => $attendance['number8'],
                '9' => $attendance['number9'],
                '10' => $attendance['number10'],
                '11' => $attendance['number11'],
                '12' => $attendance['number12'],
                '13' => $attendance['number13'],
                '14' => $attendance['number14'],
                '15' => $attendance['number15'],
                '16' => $attendance['number16'],
                '17' => $attendance['number17'],
                '18' => $attendance['number18'],
                '19' => $attendance['number19'],
                '20' => $attendance['number20'],
                '21' => $attendance['number21'],
                '22' => $attendance['number22'],
                '23' => $attendance['number23'],
                '24' => $attendance['number24'],
                '25' => $attendance['number25'],
                '26' => $attendance['number26'],
                '27' => $attendance['number27'],
                '28' => $attendance['number28'],
                '29' => $attendance['number29'],
                '30' => $attendance['number30'],
                '31' => $attendance['number31']
            ];
        }

        return response(['data' => $data], 201);
    }
}
