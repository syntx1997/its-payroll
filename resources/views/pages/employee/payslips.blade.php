<x-main :title="$title" :js="$js" :dashboardLink="$dashboardLink" :avatar="$avatar">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ul>
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
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="view-payslip-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="export-pdf">
                    <div class="card bg-danger text-white text-center">
                        <div class="card-body">
                            <h5><strong>PAYSLIP</strong></h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center modal-title mb-5"><strong>For the Month of <span class="text-danger" id="view-month-txt"></span></strong></h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-6">Employee No.</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-employee-id-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">Department</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-department-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">Designation</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-designation-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">Basic Salary</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-basic-salary-txt"></span>/day
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-6">Employee Name.</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-employee-name-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">Salary Date</label>
                                    <div class="col-6">
                                        <small>
                                            <strong>
                                                <span id="view-salary-date-txt"></span>
                                            </strong>
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">No. of Days</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-days-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6">Days Worked</label>
                                    <div class="col-6">
                                        <strong>
                                            <span id="view-days-worked-txt"></span>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center bg-light">Earnings</div>
                                    <ul class="list-group list-group-flush" id="view-earnings-list">
                                        <li class="list-group-item">
                                            <strong>Gross Pay</strong>
                                            <span class="float-right">
                                            <u>
                                                ₱<span id="view-gross-txt">00.00</span>
                                            </u>
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center bg-light">Deductions</div>
                                    <ul class="list-group list-group-flush" id="view-deductions-list">
                                        <li class="list-group-item">
                                            <strong>Total Deductions</strong>
                                            <span class="float-right">
                                            <u>
                                                ₱<span id="view-tdeductions-txt">00.00</span>
                                            </u>
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
                                <u>
                                    ₱<span id="view-net-txt">00.00</span>
                                </u>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="download-payslip-btn" class="btn btn-danger btn-block"> <i class="la la-file-download"></i> Download Payslip</button>
                </div>
            </div>
        </div>
    </div>

</x-main>
