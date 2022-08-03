function toggleSidebar() {
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
};

var drop = document.getElementById('drop');
var logcontent = document.getElementById('lg');
drop.addEventListener('click', function (){
    this.classList.toggle("drop-active");
    logcontent.classList.toggle("logout-active");
});

var accord = document.getElementsByClassName('sidedrop');
for (var i=0;i<accord.length;i++) {
    accord[i].addEventListener('click', function () {
        this.classList.toggle('sidebtn-active');
        this.nextElementSibling.classList.toggle('dropcont-active');
    });
};

var fade = document.querySelector('.page-loader');
var progress = document.querySelector('.progress-bar');
window.addEventListener('load', function () {
    progress.style.width = 100 + '%';
    this.setTimeout(fadeLoader, 4000);
});

function fadeLoader () {
    fade.style.display = 'none';
}

var load = document.querySelector('.page-loader2');
window.addEventListener('load', function () {
    load.classList.add('loader-active');
    this.setTimeout(function () {
        load.classList.remove('loader-active');
    }, 500)
});