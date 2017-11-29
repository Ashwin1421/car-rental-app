$(document).ready(function(){
	var loginbtn = $("#log-in");
	var logoutbtn = $("#log-out");
	var signupbtn = $("#sign-up");
	var btnlist = $("#btn-list");
	
	$("#pick-up-date").change(function(){
		console.log($("#pick-up-date").val());
	});

	$("#drop-off-date").change(function(){
		console.log($("#drop-off-date").val());
	});
});