const addSaleForm = $('#add-sale-form');
const addSaleSubmitBtn = addSaleForm.find('button[type="submit"]');
const addSaleModal = $('#add-sale-modal');

const api = '/func/sales-board/';

$(function (){

    $('select[name="employee_id"]').select2();

    addSaleForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'add',
            type: 'POST',
            data: addSaleForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                resetForm(addSaleForm);
                hideModal(addSaleModal);
                $('#calendar').fullCalendar('refetchEvents');
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors){
                    const error = errJSON.errors;
                    fieldValidation(formInput(addSaleForm, 'select', 'employee_id'), error.employee_id);
                    fieldValidation(formInput(addSaleForm, 'input', 'quantity'), error.quantity);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(addSaleSubmitBtn, 'Adding');
            },
            complete: function (){
                submitBtnAfterSend(addSaleSubmitBtn, 'Add');
            }
        });
    });

});
