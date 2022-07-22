const employeesTable = $('#employees-table');

const setDeductionForm = $('#set-deduction-form');
const setDeductionSubmitBtn = setDeductionForm.find('button[type="submit"]');
const setDeductionModal = $('#set-deduction-modal');

const api = '/func/employee-deduction/';

$(function (){

    const employeesDataTable = employeesTable.DataTable({
        'ajax': api + 'get-all-employees',
        'columns': [
            {
                'className': 'details-control',
                'orderable': false,
                'data': '',
                'defaultContent': ''
            },
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
            }
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false
    });

    $('#employees-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = employeesDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });

    setDeductionForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'set',
            type: 'POST',
            data: setDeductionForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                reloadDataTable(employeesTable);
                hideModal(setDeductionModal);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(setDeductionForm, 'input', 'deduction'), error.deduction);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(setDeductionSubmitBtn, 'Setting');
            },
            complete: function (){
                submitBtnAfterSend(setDeductionSubmitBtn, 'Set');
            }
        });
    });

});

function more_details(data) {
    const deductionData = data.deductions;
    let deductions = '';
    deductionData.map((deduction) => {
        deductions += `
            <tr>
                <td class="text-center">${deduction.name}</td>
                <td class="text-center">
                    <button id="set-deduction-btn" type="button"
                    class="btn btn-link ${deduction.deduction === 'Not Set' ? 'text-danger' : ''}"
                    data-employee_id="${data.employee_id}"
                    data-employee_name="${data.name}"
                    data-category_id="${deduction.id}"
                    data-user_id="${data.id}"
                    data-name="${deduction.name}"
                    data-deduction="${deduction.deduction}">
                        ${deduction.deduction}
                    </button>
                </td>
            </tr>
        `;
    });

    return `
        <table class="table table-bordered" style="width: 100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">Category</th>
                    <th class="text-center">Deduction</th>
                </tr>
            </thead>
            <tbody>
                ${deductions}
            </tbody>
        </table>
    `;
}

$(document).on('click', '#set-deduction-btn', function (){
    const data = $(this).data();

    setDeductionForm.find('#employee_id_txt').text(data.employee_id);
    setDeductionForm.find('#employee_name_txt').text(data.employee_name);
    setDeductionForm.find('#category_txt').text(data.name);

    formInput(setDeductionForm, 'input', 'category_id').val(data.category_id);
    formInput(setDeductionForm, 'input', 'user_id').val(data.user_id);

    if(data.deduction !== 'Not Set') {
        formInput(setDeductionForm, 'input', 'deduction').val(data.deduction);
    } else {
        formInput(setDeductionForm, 'input', 'deduction').val('');
    }

    showModal(setDeductionModal);
});
