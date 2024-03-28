document.addEventListener('DOMContentLoaded', function(){
    iniciarGaleria();
});


function iniciarGaleria(){
    crearGaleria();
}

function crearGaleria(){
    const galeria = document.querySelector('.galeria-imagenes');
    for(let i=1; i<= 10; i++){
       const imagen = document.createElement('picture');
       imagen.innerHTML=`
            <img class="imagen_pequena" src="publico/imagenes/resumenPixeos/pequenas/${i}.png" alt="imagen galeria">
       `;
       imagen.addEventListener('click',function(){ 
           mostrarImagen(i)}, false);

       galeria.appendChild(imagen);
    }
}

function mostrarImagen(i){
    const imagen = document.createElement('picture');
    imagen.innerHTML = `
        <img class="imagen_grande" src="publico/imagenes/resumenPixeos/grandes/${i}.png" alt="imagen galeria">
    `;

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