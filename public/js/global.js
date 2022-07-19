const spinner = `
    <div class="spinner-border spinner-border-sm text-light" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    `;

function removeInputValidationErrors() {
    $('.alert').remove();
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('#notification').html('');
}

function submitBtnBeforeSend(button, text) {
    button.attr('disabled', 'disabled');
    button.html(spinner + ' ' + text);
}

function submitBtnAfterSend(button, text) {
    button.attr('disabled', false);
    button.html(text);
}

function formInput(form, type, name) {
    return form.find(type + '[name="'+ name +'"]');
}

function resetForm(form) {
    form[0].reset();
}

function hideModal(modal) {
    modal.modal('hide');
}

function showModal(modal) {
    modal.modal('show');
}

function reloadDataTable(table) {
    table.DataTable().ajax.reload(null);
}

function alertMessage(message, type) {
    return `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="la la-info"></i> ${message}
        </div>
    `;
}

function inputFeedback(message, type) {
    return `
        <div class="${type}-feedback d-block">
            ${message}
        </div>
    `;
}

function fieldValidation(fieldElement, message) {
    if(message) {
        fieldElement.addClass('is-invalid');
        fieldElement.after(inputFeedback(message, 'invalid'));
    } else {
        fieldElement.removeClass('is-invalid');
    }
}

