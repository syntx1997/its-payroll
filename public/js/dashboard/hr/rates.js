const employeesTable = $('#employees-table');

const setRateForm = $('#set-rate-form');
const setRateSubmitBtn = setRateForm.find('button[type="submit"]');
const setRateModal = $('#set-rate-modal');

const api = '/func/employee-rate/';

$(function (){

    const employeesDataTable = employeesTable.DataTable({
        'ajax': api + 'get-all-employees',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'avatar_html',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'employee_id',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'email',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'contact',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'designation',
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'rate',
            }
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false
    });

    setRateForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'set',
            type: 'POST',
            data: setRateForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                reloadDataTable(employeesTable);
                hideModal(setRateModal);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(setRateForm, 'input', 'rate'), error.rate)
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(setRateSubmitBtn, 'Setting');
            },
            complete: function (){
                submitBtnAfterSend(setRateSubmitBtn, 'Set');
            }
        });
    });

});

$(document).on('click', '#set-rate-btn', function (){
    const data = $(this).data();

    setRateForm.find('#employee_id_txt').text(data.employee_id);
    setRateForm.find('#employee_name_txt').text(data.employee_name);

    formInput(setRateForm, 'input', 'rate').val(data.rate);
    formInput(setRateForm, 'input', 'employee_id').val(data.id);

    showModal(setRateModal);
});
