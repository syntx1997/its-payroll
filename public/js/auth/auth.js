const loginForm = $('#login-form');
const loginSubmitBtn = loginForm.find('button[type="submit"]');

const api = '/func/auth/';

$(function (){

    loginForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'login',
            type: 'POST',
            data: loginForm.serialize(),
            dataType: 'JSON',
            success: function (res){
                resetForm(loginForm);
                $(alertMessage(res.message, 'info')).insertBefore(loginForm);

                setInterval(function (){
                    window.location.href = res.link;
                }, 2000);
            },
            error: function (err){
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    let error = errJSON.errors;
                    fieldValidation(formInput(loginForm, 'input', 'email'), error.email);
                    fieldValidation(formInput(loginForm, 'input', 'password'), error.password);
                }
                $(alertMessage(errJSON.message, 'danger')).insertBefore(loginForm);
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(loginSubmitBtn, 'Logging In')
            },
            complete: function (){
                submitBtnAfterSend(loginSubmitBtn, 'Login')
            }
        });
    });

});
