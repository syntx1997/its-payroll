const employeeSelect = $('select[name="employee_id"]');
const employeeInfo = $('#employee-info');

const generateSlipForm = $('#generate-slip-form');

$(function (){
    employeeSelect.select2();
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
                employeeInfo.show();
            },
            error: function (err){
                const errJSON = err.responseJSON;
                console.log(errJSON);
            },
            beforeSend: function (){

            }
        });
    });
});
