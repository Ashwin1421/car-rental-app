$(document).ready(function(){
	var loginbtn = $("#log-in");
	var logoutbtn = $("#log-out");
	var signupbtn = $("#sign-up");
	var btnlist = $("#btn-list");
	
	$.get('assets/php/login.php', function(data) {
    	var foo = data; // 'foo' in this case
    	console.log("login.php",foo);
	});


	$.get('assets/php/logout.php', function(data) {
    	var foo = data; // 'foo' in this case
    	console.log("logout.php",foo);
	});
});