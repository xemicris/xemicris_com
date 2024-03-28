import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();

import { note } from "./note.js";
import { noNotes } from "./noNotes.js";

document.getElementById("btnBuscar").addEventListener("click", getData);
document.getElementById("inputBuscar").addEventListener("keypress", enter);

/**
 * Función que permite buscar al presionar la tecla enter
 * @param {object} e 
 */
function enter(e) {
    if (e.key == "Enter") {
        e.preventDefault();
        getData();
    }
}

/**
 * Función que crea un aspa con la que cerrar el buscador
 * @returns {object} enlace
 */
function enlace() {
    const enlace = document.createElement('a');
    enlace.href = `${server}/pixeos/panel/index`;
    const imagen = document.createElement('img');
    imagen.className = 'aspa-buscador';
    imagen.src = `${server}/pixeos/public/images/cerrar.svg`;
    imagen.alt = 'aspa para cerrar el buscador';
    enlace.appendChild(imagen);
    return enlace;
}

/**
 * Función que crea un botón en la barra lateral para volver del menú de búsqueda
 * @returns {object} li
 */
function botonDinamico() {
    const li = document.createElement('li');
    li.className = 'barra-color';

    const a = document.createElement('a');
    a.href = `${server}/pixeos/panel/index`;
    a.id = 'crear'
    a.className = 'cambio-color nav-link px-3 active mb-3';

    const span1 = document.createElement('span');
    span1.className = 'me-1';

    const i = document.createElement('i');
    i.className = 'bi bi-house';

    const span2 = document.createElement('span');
    span2.textContent = 'Inicio';

    span1.appendChild(i);
    a.appendChild(span1);
    a.appendChild(span2);
    li.appendChild(a);
    return li;
}

/**
 * Función que muestra los proyectos que se están buscando por su nombre
 */
async function getData() {
    let comparteNota = false;
    let notaOriginal = true;
    let notaCompletada = false;
    const icono = document.getElementById("btnBuscar");
    let input = document.getElementById("inputBuscar").value;

    try {
        //Declaración de variables
        const activarInicio = document.getElementById("activarInicio");
        let proyectos = document.querySelector(".proyectos");
        const datos = new FormData();
        datos.append('nombre', input);

        //petición
        let peticion = await fetch(`${server}/pixeos/panel/search`, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let respuesta = await peticion.json();

        if (respuesta != false) {
            if (respuesta.proyecto.length != 0) {
                while (icono.hasChildNodes()) {
                    icono.removeChild(icono.firstChild);
                }
                icono.appendChild(enlace());
                //Botón dinámico para regresar al index en la barra lateral
                activarInicio.appendChild(botonDinamico());

                //limpieza
                while (proyectos.hasChildNodes()) {
                    proyectos.removeChild(proyectos.firstChild);
                }

                for (let i = 0; i < respuesta[ 'proyecto' ].length; i++) {
                    respuesta[ 'proyecto' ][ i ][ 'tareas' ].map(tarea => {
                        if (tarea[ 'estado' ] == 1) {
                        }
                    });

                    if (respuesta[ 'proyecto' ][ i ][ 'compartida' ] > 0) {
                        comparteNota = true;
                    } else {
                        comparteNota = false;
                    }
                    if (respuesta[ 'proyecto' ][ i ][ 'ko' ]) {
                        notaOriginal = false;
                    } else {
                        notaOriginal = true
                    }
                    if (respuesta[ 'proyecto' ][ i ][ 'completado' ] == '1') {
                        notaCompletada = true;
                    }else{
                        notaCompletada = false;
                    }
                    //proyectos
                    proyectos.appendChild(note(
                        notaCompletada,
                        respuesta[ 'proyecto' ][ i ][ 'urlProyecto' ],
                        respuesta[ 'proyecto' ][ i ][ 'colorProyecto' ],
                        respuesta[ 'proyecto' ][ i ][ 'nombreProyecto' ],
                        respuesta[ 'proyecto' ][ i ][ 'tareas' ],
                        respuesta[ 'proyecto' ][ i ][ 'id' ],
                        comparteNota,
                        notaOriginal));
                    
                }
                //Botón dinámico para regresar al index en la barra lateral
            } else {
                while (icono.hasChildNodes()) {
                    icono.removeChild(icono.firstChild);
                }
                while (proyectos.hasChildNodes()) {
                    proyectos.removeChild(proyectos.firstChild);
                }

                icono.appendChild(enlace());

                proyectos.appendChild(noNotes());

                activarInicio.appendChild(botonDinamico());
                //limpieza
                
            }
            //Botón dinámico para regresar al index en la barra lateral
        } else {
            while (icono.hasChildNodes()) {
                icono.removeChild(icono.firstChild);
            }
            icono.appendChild(enlace());

            activarInicio.appendChild(botonDinamico());
            //limpieza
            while (proyectos.hasChildNodes()) {
                proyectos.removeChild(proyectos.firstChild);
            }
        }

    } catch (err) {
        console.log("Ha ocurrido un error: " + err);
    }
}