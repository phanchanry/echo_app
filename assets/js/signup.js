$(document).ready( function(){
	
	$("#username").keyup( function(event){
		if( event.keyCode == 13 )
			$("#password").focus();
	});
	
	$("#password").keyup( function(event){
		if( event.keyCode == 13 )
			$("#confirmPassword").focus();
	});
	$("#confirmPassword").keyup( function(event){
		if( event.keyCode == 13 )
			onSignupSubmit();
	});
});
function onSignupSubmit(){
	
	var username = $("#username").val();
	//var email = $("#email").val();
	var password = $("#password").val();
	var confirmPassword = $("#confirmPassword").val();
	
	if( username == "" ){ alert("Please input the Username."); return; }
	//if( email == "" ){ alert("Please input the Email Address!"); return; }
	if( password == "" ){ alert("Please input the Password!"); return; }
	
	if( validateUsername(username) ){
		alert("Username mustn't include space, special characters."); return;
	}
	if( !validateEmail( email ) ){ alert("Please input the Email Address correctly!"); return; }
	if( !IsNumeric( phoneNumber ) ){ alert("Please input the Phone number correctly!"); return; }
	if( password != confirmPassword ){ alert( "Please input the Password correctly!" ); return; }
	
	$.ajax({
        url: "async-signupSubmit.php",
        dataType : "json",
        type : "POST",
        data : {
        		username : username, 
        		password : password },
        success : function(data){
            if(data.result == "success"){
                alert("Your account registered successfully.Please Log in");
                window.location.href = "index.php";
                return;
            }else if( data.result == "exits" ){
            	alert("Username is already registered.");
            	return;
            }else{
            	alert( "Failed" );
            }
        }
    });
}
