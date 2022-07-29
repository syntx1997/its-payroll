const employeeSelect = $('select[name="employee_id"]');
const employeeInfo = $('#employee-info');

$(function (){
    employeeSelect.select2();
    employeeSelect.on('change', function (){
        const val = $(this).val();
        employeeInfo.show();
    });
});
