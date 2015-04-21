tableManaged.init();
$(document).ready(function () {
	
	$('form#addAdminForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
        	adminName: {
                required: true,
                minlength: 2
            },
            adminEmail: {
                required: true,
                email: true
            },
            adminPassword: {
                required: true,
                minlength: 6
            }
        },

        messages: {
        	adminName: {
        		required: "Name is required"
        	},
        	adminEmail: {
        		required: "Email is required"
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
            error.appendTo(element.closest('.form-group'));
        },

//        submitHandler: function (form) {
//        	
//        }
    });
	
	$("a#addAdmin").click(function () {
		if ($('form#addAdminForm').valid()) {
			$('form#addAdminForm').attr("action", "/admin/manage_user/addAdmin")
			$('form#addAdminForm').ajaxForm({
				success: function(data) {
					if (data.result == "success") {
						alert("Administrator added Successfully!");
						$("input#adminName").val("");
						$("input#adminEmail").val("");
						$("input#adminPassword").val("");
					} else if (data.result == "exist") {
						alert("Name or Email address already exist!");
						return;
					}
				}
			}).submit();
		}
	});
	//delete admin 
	$("a#deleteAdmin").click(function () {
		var objList = $("table#example2").find("input:checkbox:checked");
		if( objList.size() == 0 ){alert("Please select Administrator to delete."); return;}
		var strAdminIds = "";
		for( var i = 0 ; i < objList.size(); i ++ ){
			strAdminIds += objList.eq(i).val();
			if( i != objList.size() - 1)
				strAdminIds += ",";
		}
	    $.ajax({
	        url: "/admin/manage_user/deleteAdmin",
	        cache : false,
	        dataType : "json",
	        type : "POST",
	        data : { strAdminIds : strAdminIds },
	        success : function(data){
	            if(data.result == "success"){
	            	alert("Administrator deleted successfully.");
	            	for( var i = 0 ; i < objList.size(); i ++ ){
	            		objList.parents("tr").eq(i).remove();
	            	}
	            }
	        }
	    });		
	 });
	//delete user 
	$("a#deleteUser").click(function () {
		var objList = $("table#example1").find("input:checkbox:checked");
		if( objList.size() == 0 ){alert("Please select user to delete."); return;}
		var strUserIds = "";
		for( var i = 0 ; i < objList.size(); i ++ ){
			strUserIds += objList.eq(i).val();
			if( i != objList.size() - 1)
				strUserIds += ",";
		}
	    $.ajax({
	        url: "/admin/manage_user/deleteUser",
	        cache : false,
	        dataType : "json",
	        type : "POST",
	        data : { strUserIds : strUserIds },
	        success : function(data){
	            if(data.result == "success"){
	            	alert("User deleted successfully.");
	            	for( var i = 0 ; i < objList.size(); i ++ ){
	            	objList.parents("tr").eq(i).remove();
	            	}
	            	window.location.reload();
	            }
	        }
	    });		
	 });
	//admin management page password check box change event
	$("input#changePwdCheck").change(function () {
		if ($(this).prop("checked"))
			$(this).parents("div.form-group").eq(0).next().removeClass("hide");
		else $(this).parents("div.form-group").eq(0).next().addClass("hide");
	});
	//admin management page save changed information
	$("a#editAdmin").click(function () {
		$("form#editAdminForm").attr("action", "/admin/manage_user/editAdmin");
		$("form#editAdminForm").ajaxForm({
			success: function (data) {
				if (data.result == "success") {
					alert("Updated Successfully!");
					return;
				} else alert ("Failed");
			}
		}).submit();
	});
});

function onEnableBlocked (obj) {
	var userId = $(obj).parents("tr").eq(0).find("input#userId").val();
	$.ajax({
        url: "/admin/manage_user/enableBlockedUser",
        cache : false,
        dataType : "json",
        type : "POST",
        data : { userId : userId },
        success : function(data){
            if(data.result == "success"){
            	alert("User unblocked successfully.");
            	
            	window.location.reload();
            }
        }
    });
}
function onDisableUser (obj) {
	var userId = $(obj).parents("tr").eq(0).find("input#userId").val();
	$.ajax({
        url: "/admin/manage_user/disableUser",
        cache : false,
        dataType : "json",
        type : "POST",
        data : { userId : userId },
        success : function(data){
            if(data.result == "success"){
            	alert("User blocked successfully.");
            	window.location.reload();
            }
        }
    });
}