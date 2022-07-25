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
        $ifExistsToday = Attendance::whereDate('created_at', DB::raw('CURDATE()'))->get();

        $lastAttendance = Attendance::all()->sortByDesc('id')->first();
        if($lastAttendance && $lastAttendance->time_out == null) {
            $attendance = Attendance::find($lastAttendance->id);
            $attendance->update(['time_out' => $currentTime]);

            return response(['message' => 'Punched out!'], 201);
        }

        if($lastAttendance && $lastAttendance->time_in != null && $lastAttendance->time_out != null) {
            return response(['message' => 'You already have an attendance for this day!'], 201);
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'time_in' => $currentTime
        ]);

        return response(['message' => 'Punched in!'], 201);
    }

    public function get_all() {
        return response(['data' => Attendance::all()]);
    }
}
