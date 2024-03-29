var pathname = window.location.pathname;
var altura = document.querySelector('.navbar-nav');
if(pathname.substring(14,19) == 'panel'){
    altura.style.marginTop= 0 + 'px';
}