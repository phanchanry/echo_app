$(document).ready(function () {
	$('form#loginForm').validate({
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
                required: true
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
                .closest('.input-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.input-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.input-group'));
        }

//        submitHandler: function (form) {
//        	
//        }
    });
	
	$("a#login").click(function () {
		if ($('form#loginForm').valid()) {
			$('form#loginForm').attr("method", "post");
			$('form#loginForm').attr("action", "/user/loginSubmit")
			$('form#loginForm').submit();
		}
	});

    $("a#fb_login").click(function () {
        FB.login(function(response) {
            if (response.authResponse) {
                var accessToken = FB.getAuthResponse()['accessToken'];
                FB.api('/me', function(response) {
                    $.ajax({
                        type: "POST",
                        url: Base_Url + "/user/facebook_login",
                        data : { response : response, accessToken : accessToken },
                        success: function(data) {
                            if (data.result == 'success'){
                                window.location.href = Base_Url;
                            }
                        }
                    });
                });
            } else {
            }
        }, {scope: 'offline_access, publish_actions, email, publish_stream'});
    });
    $("a#tw_login").click(function () {
        window.location.href = Base_Url + "/user/twitter_login"
    });
});