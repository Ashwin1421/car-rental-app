$(document).ready(function(){
	var username = $("#username");
	var password = $("#password");
	var confirmpassword = $("#confirm-password");
	var firstname = $("#fname");
	var lastname = $("#lname");

	//check if all fields are set or not
	//by default none of them are set.
	var isusernameset = false;
	var isusernameavailable = false;
	var ispasswordset = false;
	var isconfirmpasswordset = false;
	var isfnameset = false;
	var islnameset = false;
	//check if both password fields are equal
	var equalpasswords = false;

	//submit button
	var registerbtn = $("#register-btn");
	registerbtn.attr("disabled","disabled");

	firstname.blur(function(){
		var regex = /^[a-zA-Z]/;
		var firstnametext = firstname.val();
		var firstnamediv = $("#name-div");
		var firstnamespan = $("#fname-span");
		if(!firstnametext){
			firstnamediv.addClass("has-error");
			firstnamespan.addClass("glyphicon-remove");
		}
		if(regex.test(firstnametext) && firstnametext.length>0){
			firstnamediv.removeClass("has-error");
			firstnamediv.addClass("has-success");
			firstnamespan.removeClass("glyphicon-remove");
			firstnamespan.addClass("glyphicon-ok");
			isfnameset = true;
		}
	});

	lastname.blur(function(){
		var regex = /^[a-zA-Z]/;
		var lastnametext = lastname.val();
		var lastnamediv = $("#name-div");
		var lastnamespan = $("#lname-span");
		if(!lastnametext){
			lastnamediv.addClass("has-error");
			lastnamespan.addClass("glyphicon-remove");
		}
		if(regex.test(lastnametext) && lastnametext.length>0){
			lastnamediv.removeClass("has-error");
			lastnamediv.addClass("has-success");
			lastnamespan.removeClass("glyphicon-remove");
			lastnamespan.addClass("glyphicon-ok");
			islnameset = true;
		}
	});

	username.blur(function(){
		var regex = /^[a-zA-Z0-9]+$/;
		var username_text = username.val();
		var username_div = $("#username-div");
		var username_span = $("#username-span");
		var username_available_span = $("#username-available");

		$.ajax({
			url: '../php/useravailability.php',
			type: 'POST',
			data: {
				'username': username.val()
			},
			success: function(data){
				if(data == 'not available'){
					username_div.addClass("has-error");
					username_span.addClass("glyphicon-remove");
					username_available_span.text("Not available");
					isusernameavailable = false;
				}
				if(data == 'available'){
					username_div.removeClass("has-error");
					username_div.addClass("has-success");
					username_span.removeClass("glyphicon-remove");
					username_span.addClass("glyphicon-ok");
					username_available_span.text("Available");
					isusernameavailable = true;
				}
			},
			error: function(data){
				console.log("error",data);
			}
		});

		if(username_text.length<8){
			username_div.addClass("has-error");
			username_span.addClass("glyphicon-remove");
		}
		if(regex.test(username_text) && username_text.length>8){
			username_div.removeClass("has-error");
			username_div.addClass("has-success");
			username_span.removeClass("glyphicon-remove");
			username_span.addClass("glyphicon-ok");
			isusernameset = true;
		}
	});

	password.focus(function(){
		password.popover({
			content: 'At least 1 lowercase, 1 uppercase, 1 numeric value and 8 characters long',
			placement: 'left'
		});
	});

	password.blur(function(){
		var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
		var password_text = password.val();
		var password_div = $("#password-div");
		var password_span = $("#password-span");

		if(password_text.length<8){
			password_div.addClass("has-error");
			password_span.addClass("glyphicon-remove");
		}
		if(regex.test(password_text) && password_text.length>8){
			password_div.removeClass("has-error");
			password_div.addClass("has-success");
			password_span.removeClass("glyphicon-remove");
			password_span.addClass("glyphicon-ok");
			ispasswordset = true;
		}
	});

	confirmpassword.blur(function(){
		console.log('inside confirmpassword blur');
		var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
		var confirmpassword_text = confirmpassword.val();
		var confirmpassword_div = $("#confirm-password-div");
		var confirmpassword_span = $("#confirm-password-span");


		if(confirmpassword_text.length<8){
			confirmpassword_div.addClass("has-error");
			confirmpassword_span.addClass("glyphicon-remove");
		}
		if(regex.test(confirmpassword_text) && confirmpassword_text.length>8){
			confirmpassword_div.removeClass("has-error");
			confirmpassword_div.addClass("has-success");
			confirmpassword_span.removeClass("glyphicon-remove");
			confirmpassword_span.addClass("glyphicon-ok");
			isconfirmpasswordset = true;
		}

		if(password.val() === confirmpassword.val()){
			equalpasswords = true;
			
		}

		if(
			isfnameset &&
			islnameset && 
			isusernameset && 
			isusernameavailable &&
			ispasswordset && 
			isconfirmpasswordset && 
			equalpasswords){

			registerbtn.removeAttr("disabled");
		}
	});


});