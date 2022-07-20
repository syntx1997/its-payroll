const addForm = $('#add-category-form');
const addSubmitBtn = addForm.find('button[type="submit"]');
const addModal = $('#add-category-modal');

const editForm = $('#edit-category-form');
const editSubmitBtn = editForm.find('button[type="submit"]');
const editModal = $('#edit-category-modal');

const categoriesTable = $('#categories-table');

const api = '/func/deduction-category/';

$(function (){

    const categoriesDataTable = categoriesTable.DataTable({
        'ajax': api + 'get-all',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'id'
            },
            {
                'className': 'text-center font-weight-bold',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'actions'
            }
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
            data: addForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                resetForm(addForm);
                hideModal(addModal);
                reloadDataTable(categoriesTable);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(addForm, 'input', 'name'), error.name);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(addSubmitBtn, 'Adding');
            },
            complete: function (){
                submitBtnAfterSend(addSubmitBtn, 'Add')
            }
        })
    });

    editForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'edit',
            type: 'PUT',
            data: editForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                resetForm(editForm);
                hideModal(editModal);
                reloadDataTable(categoriesTable);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const error = errJSON.errors;
                    fieldValidation(formInput(editForm, 'input', 'name'), error.name);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(editSubmitBtn, 'Editing');
            },
            complete: function (){
                submitBtnAfterSend(editSubmitBtn, 'Edit')
            }
        })
    });

});

$(document).on('click', '#edit-btn', function (){
    const data = $(this).data();
    formInput(editForm, 'input', 'id').val(data.id);
    formInput(editForm, 'input', 'name').val(data.name);

    showModal(editModal);
});

$(document).on('click', '#delete-btn', function (){
    const data = $(this).data();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: api + 'delete',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'DELETE',
                data: {id: data.id},
                dataType: 'JSON',
                success: function (res) {
                    reloadDataTable(categoriesTable);
                }
            });
        }
    })
});
