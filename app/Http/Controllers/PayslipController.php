<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payslip;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use App\Models\Rate;
use App\Models\Sale;
use App\Models\Deduction;
use App\Models\DeductionCategory;

class PayslipController extends Controller
{
    public function compute(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->start_date));
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->end_date));
        $days = ($startDate->diffInDays($endDate) + 1);

        $data = [
            'days' => $days,
            'days_worked' => 0,
            'gross' => [],
            'deductions' => [],
            'total_gross' => 00.00,
            'total_deduction' => 00.00,
            'total_net' => 00.00,
        ];

        $rateData = Rate::where('employee_id', $request->employee_id)->first();
        $deductionData = Deduction::where('user_id', $request->employee_id)->get();
        $salesData = Sale::where('employee_id', $request->employee_id)
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime(Carbon::parse($request->start_date))))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime(Carbon::parse($request->end_date))))
            ->get();
        $attendanceData = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime(Carbon::parse($request->start_date))))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime(Carbon::parse($request->end_date))))
            ->get();

        $rate = $rateData->rate ?? 00.00;

        $data['days_worked'] = count($attendanceData);
        $data['sales'] = $salesData;

        foreach ($deductionData as $deductionDatum){
            $deductionCategoryData = DeductionCategory::where('id', $deductionDatum->category_id)->first();
            $data['deductions'][] = [
                'name' => $deductionCategoryData->name,
                'deduction' => $deductionDatum->deduction
            ];
        }

        if(count($attendanceData) < $days) {
            $absent = $days - count($attendanceData);
            $data['deductions'][] = [
                'name' => 'Absences',
                'deduction' => ($absent * $rate)
            ];
        }


        if(count($salesData)) {
            $incentives = 0;
            $qtySales = 0;
            foreach ($salesData as $salesDatum) {
                $qtySales += $salesDatum->quantity;
            }

            $incentives = $qtySales * 2000;
            $data['gross'][] = [
                'name' => 'Other Earnings',
                'amount' => $incentives
            ];
        }

        $data['gross'][] = [
            'name' => 'Salary',
            'amount' => ($days * $rate)
        ];

        // Total Gross
        foreach ($data['gross'] as $gross) {
            $data['total_gross'] += $gross['amount'];
        }

        // Total Deductions
        foreach ($data['deductions'] as $deduction) {
            $data['total_deduction'] += $deduction['deduction'];
        }

        // Total Net
        $data['total_net'] = ($data['total_gross'] - $data['total_deduction']);

        return response($data, 201);
    }

    public function create(Request $request) {
        Payslip::create($request->all());
        return response($request->all(), 201);
    }

    public function get_all() {
        return response(['data' => Payslip::all()], 201);
    }
}
