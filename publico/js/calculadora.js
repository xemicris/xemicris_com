
let numeros = document.querySelectorAll('.numero');
let calculadora = document.querySelector('.calculadora');
let igual = document.querySelector('.igual');
let borrar = document.querySelector('.borrar');
let imprimirPantalla = document.querySelector('.pantalla');
let numeroTecleado = '';
let resultado = '';

numeros.forEach(function(numero) {
    numero.addEventListener('click', function(){
        numeroTecleado = numeroTecleado + numero.getAttribute('value');
        if(numeroTecleado.substring(numeroTecleado.length - 1, numeroTecleado.length) == ' '){
            imprimirPantalla.value= '';
            numeroTecleado = '';
        }else{
            if(borrar.onclick = function(){
                numeroTecleado = numeroTecleado.toString();
                numeroTecleado = numeroTecleado.substring(0, numeroTecleado.length - 1);
                imprimirPantalla.value= numeroTecleado;
            });
            imprimirPantalla.value= numeroTecleado;
           
        }
    });
});

igual.addEventListener('click', calcular, false);



function calcular(){
    numeroTecleado=calc(numeroTecleado);
    imprimirPantalla.value = numeroTecleado;
}

function calc(numeroTecleado) {
    return new Function('return ' + numeroTecleado)();
}


//cambiar fondo
let body = document.querySelector('body');
let boton = document.querySelector('.boton__fondo');
boton.addEventListener('click', cambio, false);

function cambio(){
    body.classList.toggle('claro');
}
    

