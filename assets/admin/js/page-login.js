$(document).ready(function() {

    $('#btn-register').click(function () {
        $('.login-form').hide();
        $('.register-form').show();
    });
    $('#btn-forgot-pwd').click(function () {
        $('.login-form').hide();
        $('.forget-pwd-form').show();
    });

    $('#btn-register-back').click(function () {
        $('.login-form').show();
        $('.register-form').hide();
    });
    $('#btn-forget-back').click(function () {
        $('.login-form').show();
        $('.forget-pwd-form').hide();
    });

    $('#btn-forget-register').click(function () {
        $('.forget-pwd-form').hide();
        $('.register-form').show();
    });

    $('.login-form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },

        messages: {
            email: {
                required: "Email is required"
            },
            password: {
                required: "Password is required"
            }
        },


        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.input-icon'));
        },

        submitHandler: function (form) {
        	 $('.login-form').attr("action", "/admin/login/loginSubmit");
            form.submit();
        }
    });

    $('.forget-pwd-form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            email: {
                required: true,
                email: true
            }
        },

        messages: {
            email: {
                required: "Email is required."
            }
        },


        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.input-icon'));
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

    $('.register-form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            firstname: {
                required: true,
                minlength: 2
            },
            lastname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phonenumber: {
                required: true
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            country: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirmpassword: {
                required: true,
                minlength: 5,
                equalTo: "#register-password"
            }
        },

        messages: {
        },


        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.input-icon'));
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

});
