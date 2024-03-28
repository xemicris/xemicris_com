import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();

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
 * Función que crea cada nota
 * @param {string} completado 
 * @param {*string} urlProyecto 
 * @param {string} colorProyecto 
 * @param {string} nombreProyecto 
 * @param {string} tareas 
 * @param {string} id 
 * @param {string} comparteNota
 * @param {string} notaOriginal
 * @returns {object} div1
 */
function cadaNota(completado, urlProyecto, colorProyecto, nombreProyecto, tareas, id, comparteNota, notaOriginal) {
    let comparteColor = (comparteNota) ? 'nota__compartir--verde' : '';

    // Crear elementos y anidarlos
    const div1 = document.createElement('div');
    div1.className = `col-md-4 nota ${completado ? 'mb-5 opacidad' : ''}`;

    const div2 = document.createElement('div');
    div2.className = `primero card text d-flex align-items-center anchoProyecto`;

    const link = document.createElement('a');
    link.href = `${server}/pixeos/panel/project/${urlProyecto}`;
    link.className = 'text-decoration-none';

    const header = document.createElement('div');
    header.className = `card-header mx-auto shadow-lg header-proyectos ${colorProyecto} text-center fs-4 rounded`;
    header.textContent = nombreProyecto;

    const contenedorIcono = document.createElement('div');
    contenedorIcono.className = "contenedor--icono";

    const iconoDescarga = document.createElement('img');
    iconoDescarga.src = `${server}/pixeos/public/images/descarga.svg`;
    iconoDescarga.id = id;
    iconoDescarga.alt = "icono descarga";
    iconoDescarga.className = "icono--pdf";
    contenedorIcono.appendChild(iconoDescarga);

    if (notaOriginal) {

        const iconoCompartir = document.createElement('img');
        iconoCompartir.src = `${server}/pixeos/public/images/compartir.svg`;
        iconoCompartir.id = id;
        iconoCompartir.alt = "icono para compartir una nota";
        iconoCompartir.className = `icono--compartir ${comparteColor}`;

        const iconoDescompartir = document.createElement('img');
        iconoDescompartir.src = `${server}/pixeos/public/images/descompartir.svg`;
        iconoDescompartir.id = id;
        iconoDescompartir.alt = "icono para dejar de compartir una nota";
        iconoDescompartir.className = "icono--descompartir";

        const iconoInfo = document.createElement('img');
        iconoInfo.src = `${server}/pixeos/public/images/informacion.svg`;
        iconoInfo.id = id;
        iconoInfo.alt = "icono que informa de los usuarios con los que compartes la nota";
        iconoInfo.className = "icono--informacion";

        const iconoMensaje = document.createElement('img');
        iconoInfo.src = `${server}/pixeos/public/images/mensaje.svg`;
        iconoInfo.id = id;
        iconoInfo.alt = "icono que envía la nota al correo que se ha introducido";
        iconoInfo.className = "icono--mensaje";

        contenedorIcono.appendChild(iconoCompartir);
        contenedorIcono.appendChild(iconoDescompartir);
        contenedorIcono.appendChild(iconoInfo);
        contenedorIcono.appendChild(iconoMensaje);
    }

    const contenedorTareas = document.createElement('div');
    contenedorTareas.className = "card-body";
    const ul = document.createElement('ul');
    for (let i = 0; i < tareas.length; i++) {
        const li = document.createElement('li');
        li.className = `tarea ${tareas[ i ].estado}`;
        li.textContent = tareas[ i ].nombreTarea;
        ul.appendChild(li);
    }

    const footer = document.createElement('div');
    footer.className = "card-footer w-100 d-flex justify-content-between align-items botonesProyecto";

    const eliminarBtn = document.createElement('button');
    eliminarBtn.id = id;
    eliminarBtn.type = "button";
    eliminarBtn.className = "eliminar btn btn-sm btn-danger";
    eliminarBtn.textContent = "Eliminar";

    const nuevaTareaBtn = document.createElement('button');
    nuevaTareaBtn.id = id;
    nuevaTareaBtn.type = "button";
    nuevaTareaBtn.className = "nuevaT btn btn-sm btn-primary";
    nuevaTareaBtn.textContent = "Nueva tarea";

    const editarBtn = document.createElement('button');
    editarBtn.id = id;
    editarBtn.type = "button";
    editarBtn.className = "editar btn btn-sm btn-success";
    editarBtn.dataset.bsToggle = "modal";
    editarBtn.dataset.bsTarget = "#modal";
    editarBtn.textContent = "Editar";

    // Anidar elementos
    link.appendChild(header);
    link.appendChild(contenedorIcono);
    link.appendChild(contenedorTareas);
    contenedorTareas.appendChild(ul);
    div2.appendChild(link);
    footer.appendChild(eliminarBtn);
    if (!completado) {
        footer.appendChild(nuevaTareaBtn);
    }
    footer.appendChild(editarBtn);
    div2.appendChild(footer);
    div1.appendChild(div2);

    // Agregar al documento
    return div1;
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
            if (respuesta.length != 0) {
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
                    proyectos.appendChild(cadaNota(
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
                icono.appendChild(enlace());

                activarInicio.appendChild(botonDinamico());
                //limpieza
                while (proyectos.hasChildNodes()) {
                    proyectos.removeChild(proyectos.firstChild);
                }
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