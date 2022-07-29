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
                'data': 'days_worked'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'gross'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'deductions'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'net'
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

                $('#earnings-list li').not('li:last').remove();
                $('#deductions-list li').not('li:last').remove();
                grossTxt.text('00.00');
                tDeductionTxt.text('00.00');
                tNetTxt.text('00.00');
                daysWorkField.val(0);
                generateSlipSubmitBtn.attr('disabled', 'disabled');
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

                $('#earnings-list li').not('li:last').remove();
                $('#deductions-list li').not('li:last').remove();
                grossTxt.text('00.00');
                tDeductionTxt.text('00.00');
                tNetTxt.text('00.00');
                daysWorkField.val(0);
                generateSlipSubmitBtn.attr('disabled', 'disabled');
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
                                ₱${earnings[i]['amount']}
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
                                ₱${deductions[i]['deduction']}
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
