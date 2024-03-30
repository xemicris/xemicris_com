import { darkMode } from "./projectData.js";
import { useFetch } from "./useFetch.js";

const{
    urlFondo,
    urlCambiarFondo,
    btnFondo,
    root
} = darkMode();


if (btnFondo) btnFondo.addEventListener('click', changeBackground);

initBackground();

/**
 * Función que obtiene el fondo y lo guarda con el método setItem de la interfaz localStorage
 */
async function initBackground() {
    try{
        const data = await useFetch(urlFondo)
        const darkMode = data.fondo === '1';
        setMode(darkMode);
        
    }catch(error){
        console.error('Ha habido un error al obtener el fondo', error);
    }
}

/**
 * Función que cambia el fondo de forma manual
 */
function setMode(darkMode) {
    if (darkMode) {
        root.classList.add('dark');
        if (btnFondo) btnFondo.textContent = "Modo claro";
        localStorage.setItem('darkMode', 'enabled');
    } else {
        root.classList.remove('dark');
        if (btnFondo) btnFondo.textContent = "Modo oscuro";
        localStorage.setItem('darkMode', 'disabled');
    }
}

/**
 * Función que obtiene el fondo actual con el método getItem y envía el valor contrario para el cambio
 */
async function changeBackground() {
    try {
        const actualMode = localStorage.getItem('darkMode') === 'enabled';
        const newMode = !actualMode;
        const simpleData = { 'fondo': newMode ? '1' : '0' };
        await useFetch(urlCambiarFondo, '', simpleData);
        setMode(newMode);

    } catch (error) {
        console.error('Ha habido un error al cambiar el fondo:', error);
    }
}




