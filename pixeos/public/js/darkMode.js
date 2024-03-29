import { darkMode } from "./projectData.js";
import { useFetch } from "./useFetch.js";

const{
    urlFondo,
    urlCambiarFondo,
    btnFondo,
    root
} = darkMode();


if (btnFondo) btnFondo.addEventListener('click', changeBackground);
readBackground();

/**
 * Función que obtiene el fondo y lo guarda con el método setItem de la interfaz localStorage
 */
async function readBackground() {
    //petición
    await useFetch(urlFondo)
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

        background();
}

/**
 * Función que cambia el fondo de forma manual
 */
function background() {
    if (localStorage.getItem('modoOscuro') == 'desactivado') {

        root.classList.remove('dark');

        //Menú superior
        if (btnFondo) btnFondo.textContent = "Modo oscuro";

    } else if (localStorage.getItem('modoOscuro') == 'activado') {
        root.classList.add('dark');
        //Menú superior
        if (btnFondo) btnFondo.textContent = "Modo claro";
    }
}

/**
 * Función que obtiene el fondo actual con el método getItem y envía el valor contrario para el cambio
 */
async function changeBackground() {
    let fnd = 0;
    //cambio de fondo
    if (localStorage.getItem('modoOscuro') == 'activado') {
        fnd = 0;
        localStorage.setItem('modoOscuro', 'desactivado');
    } else {
        fnd = 1;
        localStorage.setItem('modoOscuro', 'activado');
    }
    const simpleData = { 'fondo': fnd };
    await useFetch(urlCambiarFondo, '', simpleData)

    background();
}




