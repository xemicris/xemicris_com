import { getProjectRoute } from "./getProjectRoutes.js";

const server = getProjectRoute();

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
export function note(completado, urlProyecto, colorProyecto, nombreProyecto, tareas, id, comparteNota, notaOriginal, usuarioComparte = '') {
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

    //Subtitulo compartir
    if (usuarioComparte) {
        const subheader = document.createElement('div');
        subheader.className = `subtituloNota`;
        subheader.textContent = `(Compartida por ${usuarioComparte})`;
        header.appendChild(subheader);
    }

    const contenedorIcono = document.createElement('div');
    contenedorIcono.className = "contenedor--icono";

    const iconoDescarga = document.createElement('img');
    iconoDescarga.src = `${server}/pixeos/public/images/descarga.svg`;
    iconoDescarga.id = id;
    iconoDescarga.alt = "icono descarga";
    iconoDescarga.className = "icono--pdf";
    contenedorIcono.appendChild(iconoDescarga);

    const iconoDescompartir = document.createElement('img');
    iconoDescompartir.src = `${server}/pixeos/public/images/descompartir.svg`;
    iconoDescompartir.id = id;
    iconoDescompartir.alt = "icono para dejar de compartir una nota";
    iconoDescompartir.className = `icono--descompartir ${comparteColor}`;

    const iconoInfo = document.createElement('img');
    iconoInfo.src = `${server}/pixeos/public/images/informacion.svg`;
    iconoInfo.id = id;
    iconoInfo.alt = "icono que informa de los usuarios con los que compartes la nota";
    iconoInfo.className = "icono--informacion";

    if (notaOriginal) {
        const iconoCompartir = document.createElement('img');
        iconoCompartir.src = `${server}/pixeos/public/images/compartir.svg`;
        iconoCompartir.id = id;
        iconoCompartir.alt = "icono para compartir una nota";
        iconoCompartir.className = `icono--compartir`;

        const iconoMensaje = document.createElement('img');
        iconoMensaje.src = `${server}/pixeos/public/images/mensaje.svg`;
        iconoMensaje.id = id;
        iconoMensaje.alt = "icono que envía la nota al correo que se ha introducido";
        iconoMensaje.className = "icono--mensaje";

        if (comparteNota) {
            contenedorIcono.appendChild(iconoDescompartir);
        } else {
            contenedorIcono.appendChild(iconoCompartir);
        }
        contenedorIcono.appendChild(iconoInfo);
        contenedorIcono.appendChild(iconoMensaje);
    } else {
        contenedorIcono.appendChild(iconoInfo);
    }

    if (usuarioComparte) {
        contenedorIcono.appendChild(iconoDescompartir);
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