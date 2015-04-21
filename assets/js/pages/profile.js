var Base_Url = document.location.origin;    
$(document).ready(function () {
    $('form#profile_form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            firstName: {
                required: true
            },
            lastName: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                minlength: 5
            },
            confirmPassword: {
                minlength: 5,
                equalTo: "#password"
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
    $('form#imageUploadForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            profileImage: {
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
            error.appendTo(element.closest('form'));
        }

//        submitHandler: function (form) {
//        	
//        }
    });

    //upload screen shot image
    $("input[name='profileImage']").change(function () {
        var formObj = $(this).closest("form");
        formObj.attr("action", Base_Url + "/user/upload_profile_image");
        formObj.ajaxForm({
            success: function (data) {
                if (data.result == "success") {
                    $("div#img_wrap").html(data.image);
                    //spinner.stop();
                } else if (data.result == 'not_allowed') {
                    alert("This file Type not Allowed");
                } else if (data.result == "max_exceed")
                    alert("file size is over Maximum");
            }
        }).submit();
    });
    $("a#save_user").click(function (e) {
        var imgPath = $("div#img_wrap").find("img").attr("src");
        var formObj = $('form#profile_form');
        formObj.attr("action", Base_Url + "/user/save_user_profile");

        formObj.find("input[name='profileImgPath']").val(imgPath);
        e.preventDefault();
        if (formObj.valid()) {
            formObj.ajaxSubmit({
                success: function (data) {
                    if (data.result == 'success') {
                        alert("Saved Successfully!");
                        return;
                    } else {
                        alert("Failed");
                        return;
                    }
                }
            });
        }
    });
});