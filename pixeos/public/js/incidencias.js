import { getProjectRoute} from "./getProjectRoutes.js";
const server = getProjectRoute();
/**
 * Rutas
 */
const urlMostrar = `${server}/pixeos/tec/MostrarIncidencias`;
const selectEstado = `${server}/pixeos/tec/selectEstado`;
const urlEditar = `${server}/pixeos/tec/modificarEstadoIncidencia`;

/**
* Definición de variables
*/
const contenedor = document.querySelector('#incidencias');
let incidenciaValor = '';
let fechaCorregida = '';
let com = '';
let idIncidencia;

/**
* Refenecia al modal
*/
const modalTec = new bootstrap.Modal(document.getElementById('modalTec'));

/**
 * Referencia al formulario
 */
const formulario = document.querySelector('form');

/**
 * Capturar campos
 */
const select = document.getElementById('estado');
const botonTec = document.getElementById('botonTec');

/**
* Función que convierte un texto de la forma año-mes-dia a la forma
* dia-mes-año
*
* @param {string} texto Texto de la forma original
* @return {string} texto de la forma a ser mostrada
*
*/
function formato(texto) {
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
}

/**
 * Función que crea una incidencia
 * @param {object} incidencia 
 * @param {string} fechaCorregida 
 * @param {string} incidenciaValor 
 * @param {string} resuelta 
 * @returns {object} tr
 */
function incidencia(incidencia, fechaCorregida, incidenciaValor, resuelta) {
    const tr = document.createElement('tr');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.value = incidencia.id;
    const tdId = document.createElement('td');
    tdId.className = resuelta;
    tdId.textContent = incidencia['id'];
    const tdfecha = document.createElement('td');
    tdfecha.className = resuelta;
    tdfecha.textContent = fechaCorregida;
    const tdComentario = document.createElement('td');
    tdComentario.className = resuelta;
    tdComentario.textContent = incidencia['comentario'];
    const incidenciaVal = document.createElement('td');
    incidenciaVal.textContent = incidenciaValor;
    const tdUsuario = document.createElement('td');
    tdUsuario.textContent = incidencia['usuario']['nombre'];
    const tdContenedor = document.createElement('td');
    tdContenedor.className = 'text-center';

    const div = document.createElement('div');
    div.className = 'd-flex justify-content-center gap-2';

    const enlace = document.createElement('a');
    enlace.className = 'btn-editar btn btn-sm btn-primary mt-2';
    enlace.textContent = 'Editar';

    //Anidar elementos
    tr.appendChild(input);
    tr.appendChild(tdId);
    tr.appendChild(tdfecha);
    tr.appendChild(tdComentario);
    tr.appendChild(incidenciaVal);
    tr.appendChild(tdUsuario);
    tr.appendChild(tdContenedor);
    tdContenedor.appendChild(div);
    div.appendChild(enlace);
    return tr;
}

/**
 * Función que devuelve un mensaje cuando no hay ninguna incidencia
 */
function noUsuario() {
    while (contenedor.hasChildNodes()) {
        contenedor.removeChild(contenedor.firstChild);
    }
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.setAttribute('colspan', 6);
    const h3 = document.createElement('h3');
    h3.textContent = 'No hay incidencias';

    //anidar elementos
    tr.appendChild(td);
    td.appendChild(h3);
    return tr;
    
}

/**
* Función que muestra las incidencias registrados por los usuarios
*/
function mostrarIncidencias() {
    fetch(urlMostrar, {
        method: "POST"
    })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if (respuesta.length != 0) {
                while (contenedor.hasChildNodes()) {
                    contenedor.removeChild(contenedor.firstChild);
                }
                respuesta.forEach(element => {
                    if (element[ 'estado' ] == '0') {
                        incidenciaValor = 'No resuelta';
                        com = '';
                    } else if (element[ 'estado' ] == '1') {
                        incidenciaValor = 'Resuelta';
                        com = 'tarea-completada';
                    }
                    fechaCorregida = formato(element[ 'fecha' ]);
                    while (contenedor.hasChildNodes()) {
                        contenedor.removeChild(contenedor.firstChild);
                    }
                    contenedor.appendChild(incidencia(element,fechaCorregida,incidenciaValor,com));
                })
            } else {
                contenedor.appendChild(noUsuario());
            }

        });
}

mostrarIncidencias();

/**
 * Función que permite detectar que botón de editar o eliminar se está utilizando
 * @param {object} element elemento del DOM
 * @param {String} event evento que desencadena la acción
 * @param {String} selector referencia al elemento DOM que se usa para iniciar el evento
 * @param {object} handler objeto event
 */
const on = (element, event, selector, handler) => {
    element.addEventListener(event, e => {
        if (e.target.closest(selector)) {
            handler(e)
        }
    })
}

function estados(estados) {
    while (select.hasChildNodes()) {
        select.removeChild(select.firstChild);
    }
    const option1 = document.createElement('option');
    option1.setAttribute('value', 0);
    option1.textContent = 'No resuelta';
    const option2 = document.createElement('option');
    option2.setAttribute('value', 1);
    option2.textContent = 'Resuelta';
    if (estados === '0') {
        option1.setAttribute('selected', '');
    } else if (estados === '1') {
        option2.setAttribute('selected', '');
    }
    //Anidar elementos
    select.appendChild(option1);
    select.appendChild(option2);
    return select;
}

/**
 * Función que permite obtener el estado de una incidencia
 */
on(document, 'click', '.btn-editar', e => {
    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode;
    idIncidencia = fila.children[ 0 ].value;

    const datos = new FormData();
    datos.append('idIncidencia', idIncidencia);
    //petición
    fetch(selectEstado, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            estados(respuesta[ 'estado' ]);
            modalTec.show()
        })
})

/**
 * Función que permite editar el estado de una incidencia
 */
botonTec.addEventListener('click', () => {
    const datos = new FormData(formulario);
    datos.append('idIncidencia', idIncidencia);
    //petición
    fetch(urlEditar, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if (respuesta) {
            Swal.fire({
                icon: 'success',
                title: 'Estado de la incidencia modificado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
            modalTec.hide();
            mostrarIncidencias();

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Ha habido un error',
                text: respuesta[ 0 ] + ' y ' + respuesta[ 1 ],
            })
            modalTarea.hide();

        }
    })
}) 
