$(document).ready(function () {
	//user management page add function 
	
	//delete user 
	$("a#deleteQuestion").click(function () {
		var objList = $("table#example1").find("input:checkbox:checked");
		if( objList.size() == 0 ){alert("Please select Question to delete."); return;}
		if (!confirm("Are you Sure?")) return;
		var strQuestionIds = "";
		for( var i = 0 ; i < objList.size(); i ++ ){
			strQuestionIds += objList.eq(i).val();
			if( i != objList.size() - 1)
				strQuestionIds += ",";
		}
	    $.ajax({
	        url: "/admin/question_manage/removeQuestion",
	        cache : false,
	        dataType : "json",
	        type : "POST",
	        data : { questionIds : strQuestionIds },
	        success : function(data){
	            if(data.result == "success"){
	            	alert("Question deleted successfully.");
	            	for( var i = 0 ; i < objList.size(); i ++ ){
	            	objList.parents("tr").eq(i).remove();
	            	}
	            	window.location.reload();
	            }
	        }
	    });		
	 });
	
	$('form#addQuestionForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
        	question: {
                required: true,
                minlength: 2
            },
            tooltip: {
                required: true
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
            error.appendTo(element.closest('.form-group'));
        },

//        submitHandler: function (form) {
//        	
//        }
    });
	//add new question on add question page	
	$("a#addQuestion").click(function () {
		if ($('form#addQuestionForm').valid()) {
			$('form#addQuestionForm').attr("action", "/admin/question_manage/addQuestion")
			$('form#addQuestionForm').ajaxForm({
				success: function(data) {
					if (data.result == "success") {
						alert("Question added Successfully!");
						$("textarea[name='question']").val("");
						$("textarea[name='tooltip']").val("");
						$("select[name='rightAnswer']").val("Y");
					} else if (data.result == 'order_exist') {
						alert("Wrong Order! Already exist.");
					}		
				}
			}).submit();
		}
	});
	//edit question page loading
	$("a#editQuestion").click(function () {
		var questionId = $(this).parents("tr").eq(0).find("input#questionId").val();
		window.location.href = "/admin/question_manage/edit_question/" + questionId;
	});
	//question changed info save
	$("a#saveQuestion").click(function () {
		$('form#editQuestionForm').attr("action", "/admin/question_manage/editQuestion")
		$('form#editQuestionForm').ajaxForm({
			success: function(data) {
				if (data.result == "success") {
					alert("Applied Successfully!");
				} else if (data.result == 'order_exist') {
					alert("Wrong Order! Already exist.");
				}			
			}
		}).submit();
	});
});

