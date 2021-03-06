const employeeSelect = $('select[name="employee_id"]');
const employeeInfo = $('#employee-info');

const generateSlipForm = $('#generate-slip-form');
const generateSlipSubmitBtn = generateSlipForm.find('button[type="submit"]');
const generateSlipModal = $('#generate-slip-modal');

const startDateField = $('input[name="start_date"]');
const endDateField = $('input[name="end_date"]');
const daysWorkField = $('input[name="days_worked"]');
const daysField = $('input[name="days"]');

const grossTxt = $('#gross-txt');
const tDeductionTxt = $('#tdeductions-txt');
const tNetTxt = $('#net-txt');

const viewPayslipModal = $('#view-payslip-modal');

const payslipTable = $('#payslip-table');

const api = '/func/payslip/';

$(function (){
    generateSlipSubmitBtn.attr('disabled', 'disabled');
    employeeSelect.select2();

    const paySlipDataTable = payslipTable.DataTable({
        'ajax': api + 'get-all',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'designation'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'department'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'start_date'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'end_date'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'actions'
            }
        ]
    });

    employeeSelect.on('change', function (){
        const val = $(this).val();

        $.ajax({
            url: '/func/employee/get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            data: {id: val},
            dataType: 'JSON',
            success: function (res){
                const employee = res.employee;
                formInput(generateSlipForm, 'input', 'employee_id').val(employee.employee_id);
                formInput(generateSlipForm, 'input', 'department').val(employee.department);
                formInput(generateSlipForm, 'input', 'designation').val(employee.designation);
                formInput(generateSlipForm, 'input', 'basic_salary').val(employee.basic_salary);
                formInput(generateSlipForm, 'input', 'name').val(employee.name);
                employeeInfo.show();

                resetComputation();
            },
            error: function (err){
                const errJSON = err.responseJSON;
                console.log(errJSON);
            },
            beforeSend: function (){

            }
        });
    });

    startDateField.on('change', function (){
        const startDate = $(this).val();
        const endDate = endDateField.val();
        const employeeId = employeeSelect.val();

        computeSalary(startDate, endDate, employeeId);
    });

    endDateField.on('change', function (){
        const startDate = startDateField.val();
        const endDate = $(this).val();
        const employeeId = employeeSelect.val();

        computeSalary(startDate, endDate, employeeId);
    });

    generateSlipForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'create',
            type: 'POST',
            data: generateSlipForm.serialize(),
            success: function (res){
                hideModal(generateSlipModal);
                reloadDataTable(payslipTable);
                resetForm(generateSlipForm);

                resetComputation();
            },
            error: function (err){
                const errJSON = err.responseJSON;
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(generateSlipSubmitBtn, 'Creating Slip');
            },
            complete: function (){
                submitBtnAfterSend(generateSlipSubmitBtn, 'Create');
            }
        });
    });

});

function computeSalary(startDate, endDate, employeeId){
    resetComputation();
    $.ajax({
        url: api + 'compute',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        data: {
            start_date: startDate,
            end_date: endDate,
            employee_id: employeeId
        },
        dataType: 'JSON',
        success: function (res){
            grossTxt.text(res.total_gross);
            tDeductionTxt.text(res.total_deduction);
            tNetTxt.text(res.total_net);
            daysWorkField.val(res.days_worked);
            daysField.val(res.days);

            formInput(generateSlipForm, 'input', 'gross').val(res.total_gross);
            formInput(generateSlipForm, 'input', 'deductions').val(res.total_deduction);
            formInput(generateSlipForm, 'input', 'net').val(res.total_net);

            const earnings = res.gross;
            for(let i = 0; i < earnings.length; i++) {
                $('#earnings-list').prepend(
                    `
                        <li class="list-group-item">
                            ${earnings[i]['name']}
                            <span class="float-right">
                                ???${earnings[i]['amount']}
                            </span>
                        </li>
                    `
                );
            }

            const deductions = res.deductions;
            for(let i = 0; i < deductions.length; i++) {
                $('#deductions-list').prepend(
                    `
                        <li class="list-group-item">
                            ${deductions[i]['name']}
                            <span class="float-right">
                                ???${deductions[i]['deduction']}
                            </span>
                        </li>
                    `
                );
            }

            if(res.total_net === 0) {
                generateSlipSubmitBtn.attr('disabled', 'disabled');
            } else {
                generateSlipSubmitBtn.attr('disabled', false);
            }
        },
        error: function (err){
            const errJSON = err.responseJSON;
            console.log(errJSON);
        }
    });
}

function resetComputation() {
    $('#view-earnings-list li').not('li:last').remove();
    $('#view-deductions-list li').not('li:last').remove();

    $('#earnings-list li').not('li:last').remove();
    $('#deductions-list li').not('li:last').remove();
    grossTxt.text('00.00');
    tDeductionTxt.text('00.00');
    tNetTxt.text('00.00');
    daysWorkField.val(0);
    generateSlipSubmitBtn.attr('disabled', 'disabled');
}

$(document).on('click', '#view-payslip-btn', function (){
    resetComputation();
    const data = $(this).data();
    const computation = data.computations;
    const employee = data.employee;

    $('#view-month-txt').text(computation.month);
    $('#view-employee-id-txt').text(employee.employee_id);
    $('#view-department-txt').text(employee.department);
    $('#view-designation-txt').text(employee.designation);
    $('#view-basic-salary-txt').text(employee.basic_salary);
    $('#view-employee-name-txt').text(employee.name);
    $('#view-salary-date-txt').text(computation.start_date + ' - ' + computation.end_date);
    $('#view-days-txt').text(computation.days);
    $('#view-days-worked-txt').text(computation.days_worked);
    $('#view-gross-txt').text(computation.total_gross);
    $('#view-tdeductions-txt').text(computation.total_deduction);
    $('#view-net-txt').text(computation.total_net);

    const earnings = computation.gross;
    for(let i = 0; i < earnings.length; i++) {
        $('#view-earnings-list').prepend(
            `
                        <li class="list-group-item">
                            ${earnings[i]['name']}
                            <span class="float-right">
                                ???${earnings[i]['amount']}
                            </span>
                        </li>
                    `
        );
    }

    const deductions = computation.deductions;
    for(let i = 0; i < deductions.length; i++) {
        $('#view-deductions-list').prepend(
            `
                        <li class="list-group-item">
                            ${deductions[i]['name']}
                            <span class="float-right">
                                ???${deductions[i]['deduction']}
                            </span>
                        </li>
                    `
        );
    }

    showModal(viewPayslipModal);
});

$(document).on('click', '#download-payslip-btn', function (){
    const pdf = new jsPDF('p', 'mm', 'letter');
    var firstPage;
    const that = this;

    $(that).html(spinner + ' Downloading');
    html2canvas($('.export-pdf'), {
        onrendered: function (canvas){
            firstPage = canvas.toDataURL('image/png', 1.0);
            pdf.addImage(firstPage, 'PNG', 0, 0, 216, 0);
            pdf.save('payslip.pdf');
            $(that).html('<i class="la la-file-download"></i> Download Payslip');
        }
    });
});
