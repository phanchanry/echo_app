var Base_Url = document.location.origin;    
$(document).ready(function () {
	$('form#addApplicationForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
        	applicationName: {
                required: true,
                minlength: 2
            },
            applicationVersion: {
                required: true
            }
        },

//        messages: {
//        },


        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.appendTo(element.closest('div'));
        },

//        submitHandler: function (form) {
//        	
//        }
    });
	$("a#addApplication").click(function () {
		var tempUrl = Base_Url + "/application/saveApplication";
		
		$('form#addApplicationForm').attr("action", tempUrl);
		$('form#addApplicationForm').ajaxForm({
			success: function(data) {
				if (data.result == "success") {
					alert("Application added Successfully!");
					$("input[name='applicationName']").val("");
					$("input[name='applicationVersion']").val("");
				} else if (data.result == 'exist') {
					alert("Application Name already exist.");
				}		
			}
		}).submit();
	});
});
