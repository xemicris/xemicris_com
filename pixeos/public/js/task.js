import { convertirFechaEspanol } from './conversions.js';

/**
 * Función que crea una tarea
 * @param {boolean} hayTareas 
 * @param {string} alturaInsertarMenu 
 * @param {object} tarea 
 * @returns {object} contenedor
 */
export function task(hayTareas, alturaInsertarMenu, tarea, contenedor) {
    if (hayTareas) {
        const tr1 = document.createElement('tr');
        tr1.className = `datosTareas ${alturaInsertarMenu}`;

        const input1 = document.createElement('input');
        input1.setAttribute('type', 'hidden');
        input1.value = `${tarea[ 'id' ]}`;

        const td1 = document.createElement('td');
        td1.className = `${tarea[ 'completada' ]} col-3`;
        td1.textContent = `${tarea[ 'nombreTarea' ]}`;

        const td2 = document.createElement('td');
        td2.className = `${tarea[ 'completada' ]} col-4`;
        td2.textContent = `${(tarea[ 'fecha' ] === null) ? 'sin fecha' : convertirFechaEspanol(tarea[ 'fecha' ])}`;

        const td3 = document.createElement('td');
        const inputCheck = document.createElement('input');
        inputCheck.setAttribute('type', 'checkbox');
        inputCheck.checked = ('', tarea[ 'checked' ]);
        inputCheck.className = `completado form-check-input col-1`;
        inputCheck.setAttribute('name', 'check');

        const tr2 = document.createElement('tr');

        const input2 = document.createElement('input');
        input2.setAttribute('type', 'hidden');
        input2.value = `${tarea[ 'id' ]}`;

        const td = document.createElement('td');
        td.setAttribute('colspan', 4);

        const div = document.createElement('div');
        div.className = `d-flex align-items-center justify-content-center gap-5`;

        const aEliminar = document.createElement('a');
        aEliminar.className = `botonTarea btn-eliminar btn btn-sm btn-danger mb-3`;
        aEliminar.textContent = `Eliminar`;

        const aEditar = document.createElement('a');
        aEditar.className = `botonTarea btn-editar btn btn-sm btn-primary mb-3`;
        aEditar.textContent = `Editar`;

        const aMostrar = document.createElement('a');
        aMostrar.className = `botonTarea btn-mostrar btn btn-sm btn-success mb-3`;
        aMostrar.textContent = `Mostrar`;

        //Anidar elementos
        tr1.appendChild(input1);
        tr1.appendChild(td1);
        tr1.appendChild(td2);
        td3.appendChild(inputCheck);
        tr1.appendChild(td3);

        tr2.appendChild(input2);
        div.appendChild(aEliminar);
        div.appendChild(aEditar);
        div.appendChild(aMostrar);
        td.appendChild(div);
        tr2.appendChild(td);

        contenedor.appendChild(tr1);
        contenedor.appendChild(tr2);

        return contenedor;

    } else {
        const tr1 = document.createElement('tr');
        const td = document.createElement('td');
        td.setAttribute('colspan', 5);
        const h3 = document.createElement('h3');
        h3.className = `noTareas`;
        h3.textContent = `No hay tareas`;

        //Anidar elementos
        td.appendChild(h3);
        tr1.appendChild(td);

        if(contenedor) contenedor.appendChild(tr1);
        return contenedor;
    }

}