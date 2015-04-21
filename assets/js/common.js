function validateUsername( username ){
	var re = /[~!@\#$%^&*\()\=+_'\s]/gi;
	if( re.test(username) )
		return true;
	else
		return false;
	
}
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


function onUserLogOut( ){
	if( !confirm("Are you sure you want to log out?") ) return;
	$.ajax({
        url: "async-logOut.php",
        dataType : "json",
        type : "POST",
        data : { },
        success : function(data){	
        	if( data.result == "success" ){	
        		window.location.href = "index.php";
        		return;
        	}
        }
	});
}
function IsNumeric(num) {
    return (num >=0 || num < 0);
}
function onBlogDetail(obj){
	$(obj).find("#aForm").eq(0).attr("action", "blogDetail.php");
	$(obj).find("#aForm").submit();
}
function onPostComment(){
	var postCommentContent = $("#postCommentContent").val();
	var blogId = $("#blogId").val();

	$.ajax({
        url: "async-saveComment.php",
        dataType : "json",
        type : "POST",
        data : { blogId : blogId, postCommentContent : postCommentContent },
        success : function(data){	
        	if( data.result == "success" ){
        		$("#aForm").eq(0).attr("action", "blogDetail.php");
        		$("#aForm").submit();
        		return;
        	}
        }
	});
}