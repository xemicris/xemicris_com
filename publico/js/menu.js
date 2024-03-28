//obtener botones
let boton = document.querySelector('.boton_movil');
let botonIcono = document.querySelector('.boton_movil i');
let botonMenu = document.querySelector('.menu');

//Evento
boton.addEventListener("click", AbrirCerrar);

function AbrirCerrar(){
  botonMenu.classList.toggle('desplegar');
  let estaAbierto = botonMenu.classList.contains('desplegar');

  //cambiar entre iconos
  botonIcono.classList = estaAbierto 
    ? 'fa-sharp fa-solid fa-xmark':'fa-sharp fa-solid fa-bars';
}
