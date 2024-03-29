import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();

//rutas
const urlFondo = `${server}/pixeos/panel/obtenerFondo`;
const urlCambiarFondo = `${server}/pixeos/panel/cambiarFondo`;

//Declaración de variables
//menú superior
let btnFondo = document.getElementById("fondo") ? document.getElementById("fondo") : '';
const barraSuperior = document.querySelector("#barraSuperior");
const logo = document.getElementsByClassName("color-logo")[ 0 ];
const sombraDesplegable = document.querySelectorAll(".dropdown-item");

//barra lateral
const barraLateral = document.querySelector('.barra-lateral');

//Notas
const proyectos = document.querySelector('.main');
const modalTareaCr = document.querySelector('#modalTareaCrear');
const zona = document.querySelector('footer');
const modalNotaCrearEditar = document.querySelector('#modalNotaCrearEditar');

//tareas
const tareas = document.querySelector('.tareas');

//Contacto
const contacto = document.querySelector('.contacto');

//perfil
const perfil = document.querySelector('.espacio-perfil');

//calendario
const calendario = document.querySelector('.espacio-calendario');

if (btnFondo) btnFondo.addEventListener('click', cambiarFondo);
leerFondo();

/**
 * Función que obtiene el fondo y lo guarda con el método setItem de la interfaz localStorage
 */
function leerFondo() {
    //petición
    fetch(urlFondo, {
        method: 'POST'
    })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            //guardado del fondo
            if (respuesta[ 'fondo' ] == '0') {
                localStorage.setItem('modoOscuro', 'desactivado');
            } else {
                localStorage.setItem('modoOscuro', 'activado');
            }
        })

    fondo();
}

/**
 * Función que genera una imagen
 */
function imagen(fondo) {
    while (logo.hasChildNodes()) {
        logo.removeChild(logo.firstChild);
    }
    const imagen = document.createElement('img');
    imagen.id = 'logo';
    imagen.alt = 'logo';
    if (fondo == 'claro') {
        imagen.src = `${server}/pixeos/public/images/logo-claro.avif`;
    } else if (fondo == 'oscuro') {
        imagen.src = `${server}/pixeos/public/images/logo-oscuro.avif`;
    }

    //Anidar elementos
    logo.appendChild(imagen);
    return logo;
}

/**
 * Función que cambia el fondo de forma manual
 */
function fondo() {
    if (localStorage.getItem('modoOscuro') == 'desactivado') {
        //Menú superior
        if (barraSuperior) barraSuperior.classList.remove('barraSuperior--oscuro');
        if (btnFondo) btnFondo.textContent = "Modo oscuro";
        imagen('claro');
        Array.from(sombraDesplegable).forEach(sombra => {
            sombra.classList.remove("sombraDesplegable");
        });

        //barra lateral
        if (barraLateral) barraLateral.classList.remove('barra-lateral--oscuro');
        if (barraLateral) barraLateral.classList.add("barra-lateral");

        //Notas
        if (proyectos) proyectos.classList.remove('proyectos--oscuro');
        if (modalNotaCrearEditar) modalNotaCrearEditar.classList.remove('modalNotaCrearEditar--oscuro');
        if (modalTareaCr) modalTareaCr.classList.remove('modalNuevaTareaNota--oscuro');
        if (zona) zona.classList.remove('footer--oscuro');

        //tareas
        if (tareas) tareas.classList.remove('tareas--oscuro');

        //contacto
        if (contacto) contacto.classList.remove('contacto--oscuro');

        //perfil
        if (perfil) perfil.classList.remove('perfil--oscuro');

        //calendario
        if (calendario) calendario.classList.remove('calendario--oscuro');

    } else if (localStorage.getItem('modoOscuro') == 'activado') {

        //Menú superior
        if (barraSuperior) barraSuperior.classList.add('barraSuperior--oscuro');
        if (btnFondo) btnFondo.textContent = "Modo claro";
        imagen('oscuro');

        //Barra lateral
        if (barraLateral) barraLateral.classList.add('barra-lateral--oscuro');
        if (barraLateral) barraLateral.classList.remove("barra-lateral");

        //Notas
        if (proyectos) proyectos.classList.add('proyectos--oscuro');
        if (modalNotaCrearEditar) modalNotaCrearEditar.classList.add("modalNotaCrearEditar--oscuro");
        if (modalTareaCr) modalTareaCr.classList.add('modalNuevaTareaNota--oscuro');
        if (zona) zona.classList.add('footer--oscuro');

        //tareas
        if (tareas) tareas.classList.add('tareas--oscuro');

        //contacto
        if (contacto) contacto.classList.add('contacto--oscuro');

        //perfil
        if (perfil) perfil.classList.add('perfil--oscuro');

        //calendario
        if (calendario) calendario.classList.add('calendario--oscuro');
    }
}

/**
 * Función que obtiene el fondo actual con el método getItem y envía el valor contrario para el cambio
 */
function cambiarFondo() {
    let fnd = 0;
    //cambio de fondo
    if (localStorage.getItem('modoOscuro') == 'activado') {
        fnd = 0;
        localStorage.setItem('modoOscuro', 'desactivado');
    } else {
        fnd = 1;
        localStorage.setItem('modoOscuro', 'activado');
    }

    const datos = new FormData();
    datos.append('fondo', fnd);

    //petición
    fetch(urlCambiarFondo, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    })
    fondo();
}




