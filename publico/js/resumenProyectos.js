document.addEventListener('DOMContentLoaded', function(){
    iniciarGaleria();
});

function tipoProyecto(){
    const separador = '/';
    const buscar = 'resumenPixeos';
    let proyecto = window.location.pathname.split(separador);
    return proyecto.includes(buscar);
}

function iniciarGaleria(){
    let proyecto = tipoProyecto();
    crearGaleria(proyecto);
}

function crearGaleria(proyecto){
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i=1; i<= 10; i++){
       const imagen = document.createElement('picture');
       if(proyecto){
           imagen.innerHTML=`
                <img loading="lazy" class="imagen_pequena" src="publico/imagenes/resumenPixeos/pequenas/${i}.avif" alt="imagen galeria">
           `;
       }else{
        imagen.innerHTML=`
                <img loading="lazy" class="imagen_pequena" src="publico/imagenes/colaboraciones/pequenas/${i}.avif" alt="imagen galeria">
           `;
       }
       imagen.addEventListener('click',function(){ 
           mostrarImagen(i, proyecto)}, false);

       galeria.appendChild(imagen);
    }
}

function mostrarImagen(i, proyecto){
    const imagen = document.createElement('picture');
    if(proyecto){
        imagen.innerHTML = `
            <img loading="lazy" class="imagen_grande" src="publico/imagenes/resumenPixeos/grandes/${i}.avif" alt="imagen galeria">
        `;
    }else{
        imagen.innerHTML = `
            <img loading="lazy" class="imagen_grande" src="publico/imagenes/colaboraciones/grandes/${i}.avif" alt="imagen galeria">
        `;
    }

    const overlay = document.createElement('DIV');
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');//creo la clase overlay
    overlay.onclick = function(){ 
        const body = document.querySelector('body');
        body.classList.remove('fijar-body');
        overlay.remove();

    }

    //Botón para cerrar el Modal (X)
    const cerrarModal = document.createElement('P');
    //Propiedad que devuelve o cambia el contenido de texto de un elemento
    cerrarModal.textContent = 'X';
    cerrarModal.classList.add('btn-cerrar');
    cerrarModal.onclick = function(){ // para que cierre al hacer clic en la X
        overlay.remove(); 
        const body = document.querySelector('body');
        body.classList.remove('fijar-body'); 
    }
    overlay.appendChild(cerrarModal);

    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body'); 

}