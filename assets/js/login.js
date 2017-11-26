$( document ).ready(function(){
    var username = $("#username");
    var password = $("#password");
    var loginbtn = $("#login-btn");

    //check if username and password are set
    var isusernameset = false;
    var ispasswordset = false;


    username.blur(function(){
        var regex = /^[a-zA-Z0-9]+$/;
        var username_text = username.val();
        var username_div = $("#username-div");
        var username_span = $("#username-span");

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



});