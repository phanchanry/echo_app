var Base_Url = document.location.origin;
var like_selected = false;
$(document).ready(function () {
	$("table#example1").dataTable();
	
	$("a#addComment").click(function () {
	    $("div#addCommentsModal").modal('show');
	});
	$('form#commentForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
        	description: {
                required: true,
                minlength: 2
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
        }

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
        	screenShotUpload: {
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
        },

//        submitHandler: function (form) {
//        	
//        }
    });
	
	//upload screen shot image
	 $("input[name='screenShotUpload']").change(function(){
   	
		$(this).closest("form").ajaxForm({
			 success: function(data) {
				if (data.result == "success") {
					$("div#img_wrap").html(data.image);
					//spinner.stop();
				} else if(data.result == 'not_allowed') {
   				alert("This file Type not Allowed");
				} else if (data.result == "max_exceed")
					alert ("file size is over Maximum");
			 } 
		}).submit();
   });
	 $('form#replyForm').validate({
	        errorElement: 'span', //default input error message container
	        errorClass: 'help-block', // default input error message class
	        focusInvalid: false, // do not focus the last invalid input
	        ignore: "",
	        rules: {
	        	replyDescription: {
	                required: true,
	                minlength: 2
	            }
	        },

//	        messages: {
//	        },


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
	        }

//	        submitHandler: function (form) {
//	        	
//	        }
     });
    $('form#multi_reply_form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            replyDescription: {
                required: true,
                minlength: 2
            }
        },

//	        messages: {
//	        },


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
        }

//	        submitHandler: function (form) {
//
//	        }
    });

    $('form#revised_feedback_form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            revisedDescription: {
                required: true,
                minlength: 2
            }
        },

//	        messages: {
//	        },


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
        }

//	        submitHandler: function (form) {
//
//	        }
    });

	 //comment submit on add comment modal
	$("a#commentSubmit").click(function () {
		//if ($("input[name='feedbackId']").length) {
			if ($('form#commentForm').valid())
				addCommentSubmit ();
		//} else if ($('form#commentForm').valid()) {
	//		addCommentSubmit ();
	//	}
	});
	//feedback reply modal show
	$("button#feedbackReply").click(function () {
        var feedbackId = $(this).closest("li").find("input#feedback_id").val();
        $("div#addReplyModal").find("input[name='feedbackId']").val(feedbackId);
		$("div#addReplyModal").modal('show');
	});

    //feedback reply modal show
    $("button#multi_reply").click(function () {
        var replyId = $(this).closest("li").find("input#reply_id").val();
        $("div#multi_reply_modal").find("input[name='replyId']").val(replyId);
        $("div#multi_reply_modal").modal('show');
    });

	//feedback reply submit
	$("a#replySubmit").click(function () {
		if ($('div#addReplyModal').find('form#replyForm').valid()) {
			var tempUrl = Base_Url + "/application/replySubmit";
			
			$('div#addReplyModal').find('form#replyForm').attr("action", tempUrl);
			$('div#addReplyModal').find('form#replyForm').ajaxForm({
				success: function(data) {
					if (data.result == "success") {
						alert("Submit Successfully!");
                        var feedbackId = data.feedbackId;
                        window.location.href = Base_Url + '/application/view_comments/' + base64Encode(feedbackId);
					} else if (data.result == 'exist') {
						alert("You had already replied.");
					} else if (data.result == 'login_failed') {
                        alert("Please Login First.");
                        window.location.href = Base_Url + '/user/login';
                    }
				}
			}).submit();
		}
	});

    //feedback reply submit
    $("a#multi_reply_submit").click(function () {
        if ($('form#multi_reply_form').valid()) {
            var tempUrl = Base_Url + "/application/multi_reply_submit";

            $('form#multi_reply_form').attr("action", tempUrl);
            $('form#multi_reply_form').ajaxForm({
                success: function(data) {
                    if (data.result == "success") {
                        alert("Submit Successfully!");
                        var feedbackId = data.feedbackId;
                        window.location.href = Base_Url + '/application/view_comments/' + base64Encode(feedbackId);
                    } else if (data.result == 'exist') {
                        alert("You had already replied.");
                    } else if (data.result == 'login_failed') {
                        alert("Please Login First.");
                        window.location.href = Base_Url + '/user/login';
                    }
                }
            }).submit();
        }
    });

	$("a#download_feedback").click(function () {
//		$.ajax({
//			url: Base_Url + "/application/download_user_feedback";
//	        cache : false,
//	        dataType : "json",
//	        type : "POST",
//	        data : { placeCategory : placeCategory , placeSubCategory : placeSubCategory , findPlacesUaBucketId : findPlacesUaBucketId, cntLoaded : cntLoaded },
//	        success : function(data){
//	        	
//	        }
//		});
		
	});
    $("a#comment_like").click(function (e) {
        e.preventDefault();
        var obj = $(this);
        var likeCnt = obj.parent().find("span#like_cnt").text() * 1;
        var feedbackId = obj.closest("ul").next().find("input#feedback_id").val();
        $.ajax({
            url: Base_Url + "/application/save_comment_like",
            dataType: "json",
            type: "POST",
            cache: false,
            data: {feedbackId : feedbackId},
            success: function (data) {
                if (data.result == 'login_failed') {
                    alert("Please Log In first");
                    window.location.href = Base_Url + '/user/login';
                } else if (data.result == 'success') {
                    obj.parent().find("span#like_cnt").text(likeCnt + 1);
                }
            }
        });
    });
    $("a#comment_unlike").click(function (e) {
        e.preventDefault();
        var obj = $(this);
        var likeCnt = obj.parent().find("span#unlike_cnt").text() * 1;
        var feedbackId = obj.closest("ul").next().find("input#feedback_id").val();
        $.ajax({
            url: Base_Url + "/application/save_comment_unlike",
            dataType: "json",
            type: "POST",
            cache: false,
            data: {feedbackId : feedbackId},
            success: function (data) {
                if (data.result == 'login_failed') {
                    alert("Please Log In first");
                    window.location.href = Base_Url + '/user/login';
                } else if (data.result == 'success') {
                    obj.parent().find("span#unlike_cnt").text(likeCnt + 1);
                }
            }
        });
    });
    $(".screenshot-fancy").fancybox({
        groupAttr: 'data-rel',
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: true,
        helpers: {
            title: {
                type: 'inside'
            }
        }
    });
    $("button#add_revised_feedback").click(function () {
        var feedbackId = $(this).closest("ul").find("input#feedback_id").val();
        $("div#revised_feedback_modal").find("input[name='feedbackId']").val(feedbackId);
        $("div#revised_feedback_modal").modal('show');

    });
    $("a#add_revised_submit").click(function () {
        if ($("div#revised_feedback_modal").find('form#revised_feedback_form').valid()) {
            var tempUrl = Base_Url + "/application/revised_submit";

            $("div#revised_feedback_modal").find('form#revised_feedback_form').attr("action", tempUrl);
            $("div#revised_feedback_modal").find('form#revised_feedback_form').ajaxForm({
                success: function(data) {
                    if (data.result == "success") {
                        alert("Submit Successfully!");
                        var feedbackId = data.feedbackId;
                        window.location.href = Base_Url + '/application/view_comments/' + base64Encode(feedbackId);
                    } else if (data.result == 'exist') {
                        alert("someone had already replied.");
                        return;
                    } else if (data.result == 'login_failed') {
                        alert("Please Login First.");
                        window.location.href = Base_Url + '/user/login';
                    }
                }
            }).submit();
        }
    });

    $("button#leave_feedback_rate").click(function () {
        var feedbackId = $(this).closest("ul").find("input#feedback_id").val();
        $("div#star_rating_modal").find("input[name='referenceId']").val(feedbackId);
        $("div#star_rating_modal").find("input[name='referenceId']").attr('reference-type', 'feedback');
        $("div#star_rating_modal").modal('show');
    })
    $("button#leave_revised_rate").click(function () {
        var revisedId = $(this).closest("li").find("input#revised_id").val();
        $("div#star_rating_modal").find("input[name='referenceId']").val(revisedId);
        $("div#star_rating_modal").find("input[name='referenceId']").attr('reference-type', 'revised');
        $("div#star_rating_modal").modal('show');
    })

    $('input#rating-input1, input#rating-input2').rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'lg'
    });
    $('input#user-rated').rating({
        min: 0,
        max: 5,
        step: 1,
        disabled: true,
        showClear: false,
        starCaptionClasses: {
            0.5: '',
            1: '',
            1.5: '',
            2: '',
            2.5: '',
            3: '',
            3.5: '',
            4: '',
            4.5: '',
            5: ''
        },
        clearCaption: '',
    });
});
function addCommentSubmit () {
	var tempUrl = Base_Url + "/application/saveComment";
	var imagePath = $("div#img_wrap").find("img").attr("src");
	$('form#commentForm').find("input[name='screenShot']").val(imagePath);
	
	$('form#commentForm').attr("action", tempUrl);
	$('form#commentForm').ajaxForm({
		success: function(data) {
			if (data.result == "success") {
				if ($("input[name='locationId']").length){
					alert("Updated Successfully!");
					return;
				}
				alert("Comment added Successfully!");
				$("textarea[name='description']").val("");
				$("input[name='locationImageUpload']").val("");
				$("div#imge_wrap").html("");
				window.location.reload();
			} else if (data.result == 'exist') {
				alert("Location Name already exist.");
			} else if (data.result == 'login_failed') {
                alert("Please Login First");
                window.location.href = Base_Url + "/user/login";
            }
		}
	}).submit();
}