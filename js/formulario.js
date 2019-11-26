/* # Validando Formulario
============================================*/
$(document).ready(function() {
    $('#formulario').validate({
        errorElement: "span",
        rules: {
            login: {
                minlength: 4,
                maxlength: 8,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 6,
                maxlength: 16,
                required: true
            },
            cpassword: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            login: {
                required: "Introduzca un nome de usuario",
                minlength: "O nome de usuario é demasiado corto",
                maxlength: "O nome de usuario é demasiado longo"
            },
            email: {
                required: "Debe introducir unha dirección de correo electrónico",
                email: "A dirección de correo electrónico intoducida non é valida"
            },
            password: {
                required: "Introduzca o contrasinal",
                minlength: "A contrasinal debe ser maior de 8 caracteres",
                maxlength: "O contrasinal introducido é demasiado longo"
            },
            cpassword: {
                required: "Repita o contrasinal",
                equalTo: "Os contrasinais non coinciden."
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group')
                .removeClass('success').addClass('error');
        },
        success: function(element) {
            element
                .closest('.control-group')
                .removeClass('error').addClass('success');
        },
    });
});