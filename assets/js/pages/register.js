$(document).ready(function () {
	$('form#registerForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
        	firstName: {
                required: true,
                minlength: 2
            },
            lastName: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phoneNumber: {
                required: true,
                number: true
            },
            company : {
            	required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            confirmPassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },

        messages: {
//        	firstName: {
//        		required: "First Name is required"
//        	},
//        	lastName: {
//        		required: "Last Name is required"
//        	}
        },


        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.input-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.input-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.input-group'));
        },

//        submitHandler: function (form) {
//        	
//        }
    });
	
	$("a#registerUser").click(function () {
		if ($('form#registerForm').valid()) {
			$('form#registerForm').attr("method", "post");
			$('form#registerForm').attr("action", "/user/registerUser")
			$('form#registerForm').ajaxForm({
				success: function(data) {
					if (data.result == "success") {
						alert("Registered Successfully.Please log in.");
						window.location.href = "/user/login";
					} else if (data.result == "exist") {
						alert("Name or Email address already exist!");
						return;
					}
				}
			}).submit();
		}
	});
});