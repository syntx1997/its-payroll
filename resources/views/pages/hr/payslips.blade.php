<x-main :title="$title" :js="$js" :dashboardLink="$dashboardLink">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <button type="button" class="btn add-btn" data-toggle="modal" data-target="#generate-slip-modal"><i class="fa fa-plus"></i> New Payslip</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="payslip-table" class="table table-striped border" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
                        <th class="text-center">Days Worked</th>
                        <th class="text-center">Total Earnings</th>
                        <th class="text-center">Total Deductions</th>
                        <th class="text-center">Total Net</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="generate-slip-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="generate-slip-form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> New Payslip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Employee</label>
                        <div class="col-9">
                            <select name="employee_id" class="form-control" style="width: 100%">
                                <option>-- select employee --</option>
                                @foreach(\App\Models\Employee::all() as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->firstname }} {{ $employee->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="employee-info" style="display: none">
                        <div class="form-group row">
                            <label class="col-3">Employee ID</label>
                            <div class="col-9">
                                <input type="text" name="employee_id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Department</label>
                            <div class="col-9">
                                <input type="text" name="department" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Designation</label>
                            <div class="col-9">
                                <input type="text" name="designation" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Basic Salary</label>
                            <div class="col-9">
                                <input type="text" name="basic_salary" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Salary Date:</label>
                            <div class="row">
                                <div class="col-4">
                                    <input type="date" name="start_date" class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="date" name="end_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Days Worked:</label>
                            <input type="text" name="days_worked" class="form-control col-md-4" value="0" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center bg-light">Earnings</div>
                                    <ul class="list-group list-group-flush" id="earnings-list">
                                        <li class="list-group-item">
                                            <strong>Gross Pay</strong>
                                            <span class="float-right">
                                            ₱<span id="gross-txt">00.00</span>
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center bg-light">Deductions</div>
                                    <ul class="list-group list-group-flush" id="deductions-list">
                                        <li class="list-group-item">
                                            <strong>Total Deductions</strong>
                                            <span class="float-right">
                                            ₱<span id="tdeductions-txt">00.00</span>
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body bg-dark text-white">
                                <strong>Net Pay</strong>
                                <span class="float-right">
                                    ₱<span id="net-txt">00.00</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="days">
                    <input type="hidden" name="name">
                    <input type="hidden" name="gross">
                    <input type="hidden" name="deductions">
                    <input type="hidden" name="net">
                    <button type="submit" class="btn btn-secondary">Create</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</x-main>
