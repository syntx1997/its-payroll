<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payslip;
use Illuminate\Support\Facades\Auth;
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

        return response($this->get_computation([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'employee_id' => $request->employee_id
        ]), 201);
    }

    public function create(Request $request) {
        Payslip::create($request->all());
        return response($request->all(), 201);
    }

    public function get_all() {
        $data = [];

        $payslips = Payslip::all();
        foreach ($payslips as $payslip) {

            $employee = Employee::where('employee_id', $payslip->employee_id)->first();
            $computation =  htmlspecialchars(json_encode($this->get_computation([
                'employee_id' => $employee->id,
                'start_date' => $payslip->start_date,
                'end_date' => $payslip->end_date
            ])), ENT_QUOTES, 'UTF-8');

            $btnAttribute = 'data-computations="'. $computation .'" data-employee="'. htmlspecialchars(json_encode($payslip), ENT_QUOTES, 'UTF-8') .'"';

            $actions = <<<HERE
                <button id="view-payslip-btn" type="button" class="btn btn-link text-danger" $btnAttribute>
                    <li class="la la-file-invoice-dollar"></li> View Slip
                </button>
            HERE;


            $data[] = [
                'id' => $payslip->id,
                'employee_id' => $payslip->employee_id,
                'name' => $payslip->name,
                'department' => $payslip->department,
                'designation' => $payslip->designation,
                'basic_salary' => $payslip->basic_salary,
                'start_date' => $payslip->start_date,
                'end_date' => $payslip->end_date,
                'days' => $payslip->days,
                'days_worked' => $payslip->days_worked,
                'gross' => $payslip->gross,
                'deductions' => $payslip->deductions,
                'net' => $payslip->net,
                'actions' => $actions
            ];
        }

        return response(['data' => $data], 201);
    }

    private function get_computation($inputData) {
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($inputData['start_date']));
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($inputData['end_date']));
        $days = ($startDate->diffInDays($endDate) + 1);

        $data = [
            'month' => Carbon::parse($inputData['start_date'])->format('M Y'),
            'start_date' => Carbon::parse($inputData['start_date'])->format('M d, Y'),
            'end_date' => Carbon::parse($inputData['end_date'])->format('M d, Y'),
            'days' => $days,
            'days_worked' => 0,
            'gross' => [],
            'deductions' => [],
            'total_gross' => 00.00,
            'total_deduction' => 00.00,
            'total_net' => 00.00,
        ];

        $rateData = Rate::where('employee_id', $inputData['employee_id'])->first();
        $deductionData = Deduction::where('user_id', $inputData['employee_id'])->get();
        $salesData = Sale::where('employee_id', $inputData['employee_id'])
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime(Carbon::parse($inputData['start_date']))))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime(Carbon::parse($inputData['end_date']))))
            ->get();
        $attendanceData = Attendance::where('employee_id', $inputData['employee_id'])
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime(Carbon::parse($inputData['start_date']))))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime(Carbon::parse($inputData['end_date']))))
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

        return $data;
    }

    public function get_employee_slip() {
        $data = [];

        $employee = Employee::where('user_id', Auth::user()->id)->first();

        $payslips = Payslip::where('employee_id', $employee->employee_id)->get();
        foreach ($payslips as $payslip) {

            $employee = Employee::where('employee_id', $payslip->employee_id)->first();
            $computation =  htmlspecialchars(json_encode($this->get_computation([
                'employee_id' => $employee->id,
                'start_date' => $payslip->start_date,
                'end_date' => $payslip->end_date
            ])), ENT_QUOTES, 'UTF-8');

            $btnAttribute = 'data-computations="'. $computation .'" data-employee="'. htmlspecialchars(json_encode($payslip), ENT_QUOTES, 'UTF-8') .'"';

            $actions = <<<HERE
                <button id="view-payslip-btn" type="button" class="btn btn-link text-danger" $btnAttribute>
                    <li class="la la-file-invoice-dollar"></li> View Slip
                </button>
            HERE;


            $data[] = [
                'id' => $payslip->id,
                'employee_id' => $payslip->employee_id,
                'name' => $payslip->name,
                'department' => $payslip->department,
                'designation' => $payslip->designation,
                'basic_salary' => $payslip->basic_salary,
                'start_date' => $payslip->start_date,
                'end_date' => $payslip->end_date,
                'days' => $payslip->days,
                'days_worked' => $payslip->days_worked,
                'gross' => $payslip->gross,
                'deductions' => $payslip->deductions,
                'net' => $payslip->net,
                'actions' => $actions
            ];
        }

        return response(['data' => $data], 201);
    }
}
