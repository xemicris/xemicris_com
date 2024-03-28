let cartel_informacion = document.querySelector('.info');
let boton_informacion = document.querySelector('.info__icono');
let boton_cerrar = document.querySelector('.info__icono-cerrar');
let info_borde = document.querySelector('.info__borde');
let info_datos = document.querySelector('.info__datos');
let info_social = document.querySelector('.info__social');


cartel_informacion.addEventListener('click', desplegar);

function desplegar(){
    cartel_informacion.classList.toggle('info_cartel-abajo');
    boton_informacion.classList.toggle('.info__icono-aplicar');
    boton_cerrar.classList.toggle('info__icono-cerrar-aplicar');
    info_borde.classList.toggle('datos');
    info_datos.classList.toggle('datos');
    info_social.classList.toggle('datos');

}