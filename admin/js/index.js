var username = document.getElementById('username');
var loginForm = document.getElementById('login-id');
var usernameErrPara = document.getElementById('username-err');
username.addEventListener('input', function(e){

    console.log(e.target.value);
    var pattern = /^[\w]{1,8}$/;    
    var currentValue = e.target.value;
    var valid = pattern.test(currentValue)

    if(valid){

        usernameErrPara.style.display = 'block';
    }else{

        usernameErrPara.style.display = 'none';
    }
})