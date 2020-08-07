var password = document.getElementById('password');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');


function checkpassword(password) {
    var strength = 0;
    if (password.match(/[a-z]+/)) {
        strength += 1;
    }
    if (password.match(/[A-Z]+/)) {
        strength += 1;
    }
    if (password.match(/[0-9]+/)) {
        strength += 1;
    }
    if (password.match(/[$@#&!]+/)) {
        strength += 1;

    }
    if (password.length < 6) {
        text.innerHTML = "minimum number of characters is 6";
    }else{
        text.innerHTML = "";
    }

    switch (strength) {
        case 0:
            meter.value = 0;
            break;
        case 1:
            meter.value = 1;
            break;
        case 2:
            meter.value = 2;
            break;
        case 3:
            meter.value = 3;
            break;
        case 4:
            meter.value = 4;
            break;
    }
    // return strength;
}
password.addEventListener('keyup', function(){
    var passVal = password.value;
    checkpassword(passVal);
});