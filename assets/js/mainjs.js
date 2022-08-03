var bheader = document.getElementById('bheader');
window.addEventListener('load', function () {
    bheader.classList.add('banner-active');
});

var topBtn = document.getElementById('top');
window.addEventListener('scroll', function () {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        topBtn.classList.add('top-active');
    } else {
        topBtn.classList.remove('top-active');
    }
});

topBtn.addEventListener('click', function () {
    document.documentElement.scrollTop = 0;
});

/*window.addEventListener('scroll', reveal);
function reveal () {
    var reveals = document.querySelectorAll('.list-container');

    for (var i=0;i<reveals.length;i++) {
        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 90;

        if (revealtop < windowheight - revealpoint) {
            reveals[i].classList.add('section-active');
        } else {
            reveals[i].classList.remove('section-active');
        }
    }
}*/

var descbtn = document.getElementsByClassName('descbtn');
for (var i=0; i<descbtn.length; i++) {
    descbtn[i].addEventListener('click', function () {
        this.classList.toggle('descbtn-active');
        this.nextElementSibling.classList.toggle('desc-active');
    });
}