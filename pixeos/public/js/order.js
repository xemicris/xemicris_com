/**
 *  Función que ordena las tareas por nombre
 * @param {array} tareas 
 * @returns {array} tareas 
 */
function ordenarTareasPorNombre(tareas) {

    tareas.sort(function (a, b) {
        if (a.nombreTarea > b.nombreTarea) {
            return 1;
        }
        if (a.nombreTarea < b.nombreTarea) {
            return -1;
        }
        // a must be equal to b
        return 0;
    });
    return tareas;
}

/**
 * Función que ordena las tareas por fecha
 * @param {array} tareas 
 * @returns {array} ordenFecha
 */
function ordenarTareasPorFecha(tareas) {
    const ordenFecha = tareas.sort(({ fecha: a }, { fecha: b }) => a < b ? -1 : a > b ? 1 : 0)
    return ordenFecha;
}

/**
 * Función que separa las tareas y manda ordenarlas
 * @param {array} tareas 
 * @param {string} tipoOrden 
 * @returns {array} todasTareas
 */
export function tareasSeparadas(tareas, tipoOrden = 'nombre') {

    let tempCompFecha = [];
    let tempCompSnFecha = [];
    let tempIncompFecha = [];
    let tempIncompSnFecha = [];
    let completos = [];
    let incompletos = [];
    let todasTareas = [];

    tareas.forEach(tarea => {
        if (tarea[ 'estado' ] == 1) {
            tarea[ 'completada' ] = 'tarea-completada';
            tarea[ 'checked' ] = 'checked';
            completos.push(tarea);
        } else if (tarea[ 'estado' ] == 0) {
            tarea[ 'completada' ] = '';
            tarea[ 'checked' ] = '';
            incompletos.push(tarea);
        }
    });
    if (tipoOrden == 'calendario') {
        if (completos.length > 0) {
            completos.forEach(completo => {
                (completo[ 'fecha' ] != null) ? tempCompFecha.push(completo) : tempCompSnFecha.push(completo);
            })
        }
        if (incompletos.length > 0) {
            incompletos.forEach(incompleto => {
                (incompleto[ 'fecha' ] != null) ? tempIncompFecha.push(incompleto) : tempIncompSnFecha.push(incompleto);
            })
        }
        tempCompSnFecha = ordenarTareasPorNombre(tempCompSnFecha);
        tempIncompSnFecha = ordenarTareasPorNombre(tempIncompSnFecha);
        completos = tempCompFecha.concat(tempCompSnFecha)
        incompletos = tempIncompFecha.concat(tempIncompSnFecha)
        completos = ordenarTareasPorFecha(completos);
        incompletos = ordenarTareasPorFecha(incompletos);
        todasTareas = incompletos.concat(completos);
        mostrarTareas(todasTareas);
        return;
    } else if (tipoOrden == 'nombreclic') {
        completos = ordenarTareasPorNombre(completos);
        incompletos = ordenarTareasPorNombre(incompletos);
        todasTareas = incompletos.concat(completos);
        mostrarTareas(todasTareas);
        return;
    } else if (tipoOrden == 'nombre') {
        completos = ordenarTareasPorNombre(completos);
        incompletos = ordenarTareasPorNombre(incompletos);
    }
    todasTareas = incompletos.concat(completos);
    return todasTareas;
}