<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'name',
        'department',
        'designation',
        'basic_salary',
        'start_date',
        'end_date',
        'days',
        'days_worked',
        'gross',
        'deductions',
        'net'
    ];
}
