var rec = document.getElementById('recover');
var lg = document.getElementById('loginf');
var recov = document.getElementById('recovery');
var logbtn = document.getElementById('lginacc');
var regbtn = document.getElementById('regacc');
var regst = document.getElementById('reg');
var backbtn = document.getElementById('backlg');
rec.addEventListener('click', function () {
    lg.classList.remove('active_form');
    recov.classList.add('active_form');
});

regbtn.addEventListener('click', function () {
    lg.classList.remove('active_form');
    regst.classList.add('active_form');
});

backbtn.addEventListener('click', function () {
    lg.classList.add('active_form');
    regst.classList.remove('active_form');
});

logbtn.addEventListener('click', function () {
    lg.classList.add('active_form');
    recov.classList.remove('active_form');
});

var lgForm = document.getElementById('loginSect');
function closeLoginForm(){
    lgForm.style.visibility = 'hidden';
}

function openForm(){
    lgForm.style.visibility = 'visible';
}