let captcha = document.querySelector('.h-captcha');
function getResolution() {
    var ancho = window.innerWidth;
    return ancho;
}

if(getResolution() < '768'){
    captcha.setAttribute('data-size','compact')
}









