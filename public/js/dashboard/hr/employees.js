const addForm = $('#add-employee-form');
const addSubmitBtn = addForm.find('button[type="submit"]');
const addModal = $('#add-employee-modal');

const editForm = $('#edit-employee-form');
const editSubmitBtn = editForm.find('button[type="submit"]');
const editModal = $('#edit-employee-modal');

const employeesTable = $('#employees-table');

const api = '/func/employee/'

$(function (){
    $('#side-AllEmployees-link').addClass('active');

    const employeesDataTable = employeesTable.DataTable({
        'ajax': api + 'get-all',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'avatar_html'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'employee_id'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'email'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'contact'
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
                'data': 'actions'
            },
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false
    });

    addForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'add',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (res){
                resetForm(addForm);
                hideModal(addModal);
                reloadDataTable(employeesTable);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(addForm, 'input', 'avatar'), error.avatar);
                    fieldValidation(formInput(addForm, 'input', 'firstname'), error.firstname);
                    fieldValidation(formInput(addForm, 'input', 'middlename'), error.middlename);
                    fieldValidation(formInput(addForm, 'input', 'lastname'), error.lastname);
                    fieldValidation(formInput(addForm, 'select', 'gender'), error.gender);
                    fieldValidation(formInput(addForm, 'input', 'birthday'), error.birthday);
                    fieldValidation(formInput(addForm, 'textarea', 'address'), error.address);
                    fieldValidation(formInput(addForm, 'input', 'designation'), error.designation);
                    fieldValidation(formInput(addForm, 'input', 'department'), error.department);
                    fieldValidation(formInput(addForm, 'input', 'email'), error.email);
                    fieldValidation(formInput(addForm, 'input', 'contact'), error.contact);
                    fieldValidation(formInput(addForm, 'input', 'password'), error.password);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(addSubmitBtn, 'Adding')
            },
            complete: function (){
                submitBtnAfterSend(addSubmitBtn, 'Add');
            }
        });
    });

    addForm.find('input[name="avatar"]').on('change', function (){
        if(this.files && this.files[0]){
            const reader = new FileReader();

            reader.onload = function (e){
                addForm.find('.employee-avatar img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    editForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'edit',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (res){
                resetForm(editForm);
                hideModal(editModal);
                reloadDataTable(employeesTable);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(editForm, 'input', 'avatar'), error.avatar);
                    fieldValidation(formInput(editForm, 'input', 'firstname'), error.firstname);
                    fieldValidation(formInput(editForm, 'input', 'middlename'), error.middlename);
                    fieldValidation(formInput(editForm, 'input', 'lastname'), error.lastname);
                    fieldValidation(formInput(editForm, 'select', 'gender'), error.gender);
                    fieldValidation(formInput(editForm, 'input', 'birthday'), error.birthday);
                    fieldValidation(formInput(editForm, 'textarea', 'address'), error.address);
                    fieldValidation(formInput(editForm, 'input', 'designation'), error.designation);
                    fieldValidation(formInput(editForm, 'input', 'department'), error.department);
                    fieldValidation(formInput(editForm, 'input', 'email'), error.email);
                    fieldValidation(formInput(editForm, 'input', 'contact'), error.contact);
                    fieldValidation(formInput(editForm, 'input', 'password'), error.password);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(editSubmitBtn, 'Editing')
            },
            complete: function (){
                submitBtnAfterSend(editSubmitBtn, 'Edit');
            }
        });
    });

    editForm.find('input[name="avatar"]').on('change', function (){
        if(this.files && this.files[0]){
            const reader = new FileReader();

            reader.onload = function (e){
                editForm.find('.employee-avatar img').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

});

$(document).on('click', '#edit-btn', function (){
    const data = $(this).data();

    formInput(editForm, 'input', 'firstname').val(data.firstname);
    formInput(editForm, 'input', 'middlename').val(data.middlename);
    formInput(editForm, 'input', 'lastname').val(data.lastname);
    formInput(editForm, 'select', 'gender').val(data.gender);
    formInput(editForm, 'input', 'birthday').val(data.birthday);
    formInput(editForm, 'textarea', 'address').val(data.address);
    formInput(editForm, 'input', 'designation').val(data.designation);
    formInput(editForm, 'input', 'department').val(data.department);
    formInput(editForm, 'input', 'email').val(data.email);
    formInput(editForm, 'input', 'contact').val(data.contact);
    formInput(editForm, 'input', 'id').val(data.id);

    editForm.find('.employee-avatar img').attr('src', data.avatar ? BaseURl + '/storage/' + data.avatar : BaseURl + '/img/user.jpg');

    showModal(editModal);
});
