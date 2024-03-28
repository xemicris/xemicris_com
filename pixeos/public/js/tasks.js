import { taskRoutes, taskConstants } from './projectData.js'
import { useFetch } from "./useFetch.js";
import { task } from './task.js';
import { tareasSeparadas } from './order.js';
import { convertirFechaEspanol, convertirFechaIngles } from './conversions.js';

//rutas
const {
    urlMostrar,
    urlCrear,
    urlEditar,
    urlCompletar,
    urlEliminar,
    urlEliminarTodo,
    urlPorcentaje
} = taskRoutes();

//constantes
const {
    contenedor,
    botonTareas,
    body,
    btnEliminarTodo,
    descripcionTarea,
    iconoNotificacionSi,
    iconoNotificacionNo,
    descripcionCaracteresInput,
    descripcionCaracteresTextArea,
    iconoNombre,
    iconoCalendario,
    maximoTextArea,
    maximoInput,
    formulario,
    modalTareaCrearEditar,
    modalTareaMostrar,
    tituloCrearEditar, 
    descripcionCrearEditar,
    fechaCrearEditar,
    tituloMostrar,
    fechaMostrar,
    descripcionMostrar,
    tipoNotificacion,
} = taskConstants();

let headerCrearEditar = document.getElementById('encabezadoCrearEditar');
let headerMostrar = document.getElementById('encabezadoMostrar');
let opcion = '';

/**
 * Función que permite detectar que botón se ha presionado tanto para editar como para borrar
 * @param {object} element 
 * @param {object} event 
 * @param {array} selectores 
 * @param {object} handler 
 */
const on = (element, event, selectores, handler) => {
    element.addEventListener(event, e => {
        selectores.forEach(selector => {
            if (e.target.closest(selector)) {
                handler(e)
            }
        })

    })
}

/**
 * Función que gestiona el orden de las tareas según se hace clic en el icono fechas o nombre
 */
on(document, 'click', [ '.icono--orden' ], async (e) => {

    const respuesta = await useFetch(urlMostrar)

    if (respuesta.length != 0) {
        let clasesIconosOrden = e.target.classList;
        if (clasesIconosOrden.contains('icono--orden__calendario')) {
            tareasSeparadas(respuesta, 'calendario');
            iconoCalendario.classList.add('iconosRojos');
            if (iconoNombre.classList.contains('iconosRojos')) iconoNombre.classList.remove('iconosRojos');
            if (iconoCalendario.classList.contains('iconoCalendario--claro')) iconoCalendario.classList.remove('iconoCalendario--claro');
        } else if (clasesIconosOrden.contains('icono--orden__nombre')) {
            tareasSeparadas(respuesta, 'nombreclic');
            iconoNombre.classList.add('iconosRojos');
            if (iconoCalendario.classList.contains('iconosRojos')) iconoCalendario.classList.remove('iconosRojos');
            if (!iconoCalendario.classList.contains('iconoCalendario--claro')) iconoCalendario.classList.add('iconoCalendario--claro');
        }
    }
        
})

/**
 * Función que muestra las tareas
 */
async function mostrarTareas(todasTareas = '') {
    if (todasTareas == '') {
        let tareas;
        await useFetch(urlMostrar)
            .then(respuesta =>{
                //hay tareas
                if (respuesta.length != 0) {
                    //limpiar
                    while (contenedor.hasChildNodes()) {
                        contenedor.removeChild(contenedor.firstChild);
                    }
                    tareas = tareasSeparadas(respuesta);
                    tareas.forEach((tarea, indice, array) => {
                        let alturaInsertarMenu = '';
                        if (indice === array.length - 1) {
                            alturaInsertarMenu = 'insertar';
                        } else {
                            alturaInsertarMenu = '';
                        }
                        task(true, alturaInsertarMenu, tarea, contenedor);

                    })
                    //no hay tareas
                    btnEliminarTodo.classList.remove('btnEliminarTodoOculto');
                } else {
                    while (contenedor.hasChildNodes()) {
                        contenedor.removeChild(contenedor.firstChild);
                    }
                    task(false, contenedor);
                    btnEliminarTodo.classList.add('btnEliminarTodoOculto');
                }
            })
            .then(porcentaje())
            .then(navegacionFija())
    } else {
        if (todasTareas.length != 0) {
            //limpiar
            while (contenedor.hasChildNodes()) {
                contenedor.removeChild(contenedor.firstChild);
            }
            todasTareas.forEach((tarea, indice, array) => {
                let alturaInsertarMenu = '';
                if (indice === array.length - 1) {
                    alturaInsertarMenu = 'insertar';
                } else {
                    alturaInsertarMenu = '';
                }
                task(true, alturaInsertarMenu, tarea, contenedor);
            })
            //no hay tareas
            btnEliminarTodo.classList.remove('btnEliminarTodoOculto');
        } else {
            while (contenedor.hasChildNodes()) {
                contenedor.removeChild(contenedor.firstChild);
            }
            task(false, contenedor);
            btnEliminarTodo.classList.add('btnEliminarTodoOculto');
        }
    }
};

mostrarTareas();


//lanzar modal
btnCrear.addEventListener('click', () => {
    if ('.modal-backdrop') {
        body.classList.remove('.modal-backdrop');
    };
    //limpiar campos
    tituloCrearEditar.value = '';
    descripcionCrearEditar.value = '';
    fechaCrearEditar.value = '';


    //mostrar modal
    headerCrearEditar.textContent = "Nueva tarea";
    botonTareas.textContent = "Crear";
    modalTareaCrearEditar.show();
    opcion = 'crear'
    Array.from(tipoNotificacion, (option) => {
        option.removeAttribute('selected');
    })
});

/**
 * Función que obtiene el id y mantiene los datos en edición
 */
let idEditar = 0;
on(document, 'click', [ '.btn-editar' ], async (e) => {

    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode;
    idEditar = fila.children[ 0 ].value;
    Array.from(tipoNotificacion, (option) => {
        option.removeAttribute('selected');
    })

    opcion = 'editar';
    headerCrearEditar.textContent = "Editar tarea";
    fechaCrearEditar.value = '';

    const respuesta = await useFetch(urlMostrar);

    //hay tareas
    if (respuesta.length != 0) {
        respuesta.forEach(element => {
            if (idEditar === element[ 'id' ]) {
                tituloCrearEditar.value = element[ 'nombreTarea' ];
                descripcionCrearEditar.value = element[ 'descripcionTarea' ];

                if (element[ 'fecha' ] != null) {
                    fechaCrearEditar.value = convertirFechaIngles(element[ 'fecha' ]);
                }

                if (element[ 'notificacion' ] != "") {
                    Array.from(tipoNotificacion, (option) => {
                        if (element[ 'notificacion' ] == option.value) {
                            option.setAttribute('selected', true);
                        }
                    })
                }
            }
        })
    }

    //mostrar modal
    botonTareas.textContent = "Guardar";
    modalTareaCrearEditar.show();

})

/**
 * Función que muestra los datos de cada tarea
 */
on(document, 'click', [ '.btn-mostrar' ], async (e) => {

    descripcionTarea.classList.add('mostrarTarea');

    tituloMostrar.textContent = '';
    descripcionMostrar.textContent = '';

    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode;
    idEditar = fila.children[ 0 ].value;

    headerMostrar.textContent = "Tarea";

    const respuesta = await useFetch(urlMostrar)

    //hay tareas
    if (respuesta.length != 0) {
        respuesta.forEach(element => {
            if (idEditar === element[ 'id' ]) {
                tituloMostrar.textContent = element[ 'nombreTarea' ];
                descripcionMostrar.textContent = element[ 'descripcionTarea' ];
                if (element[ 'notificacion' ] == "unica" || element[ 'notificacion' ] == "diaria" || element[ 'notificacion' ] == "semanal" || element[ 'notificacion' ] == "mensual") {
                    if (iconoNotificacionSi) iconoNotificacionSi.classList.remove('iconoNotificacion__si');
                    if (iconoNotificacionNo) iconoNotificacionNo.classList.add('iconoNotificacion__no');
                } else {
                    if (iconoNotificacionSi) iconoNotificacionSi.classList.add('iconoNotificacion__si');
                    if (iconoNotificacionNo) iconoNotificacionNo.classList.remove('iconoNotificacion__no');
                }
                if (element[ 'fecha' ] == null) {
                    const fechaLabel = document.querySelector('#fechaLabel');
                    fechaLabel.classList.add('ocultarLabel');
                    element[ 'fecha' ] = null;
                } else {
                    fechaLabel.classList.remove('ocultarLabel');
                    if (element[ 'fecha' ] != null) {
                        fechaMostrar.textContent = convertirFechaEspanol(element[ 'fecha' ]);
                    }
                }

            }
        })

    }

    //mostrar modal
    modalTareaMostrar.show();
})

/**
 * Función que permite crear o editar una tarea
 */
botonTareas.addEventListener('click', async () => {

    if (opcion == 'crear') {
        //petición crear
        const respuesta = await useFetch(urlCrear, formulario)

        if (respuesta == 'Afecha') {
            Swal.fire({
                icon: 'error',
                title: 'Ha habido un error',
                text: '¡Establezca una fecha si quiere recibir la notificación por email!',
            });
            modalTareaCrearEditar.hide();
            mostrarTareas();
        } else if (respuesta == 'MenorFecha') {
            Swal.fire({
                icon: 'error',
                title: 'Ha habido un error',
                text: '¡Para recibir una notificación, la fecha debe ser 24h posterior a hoy, como mínimo!',
            });
            modalTareaCrearEditar.hide();
            mostrarTareas();
        } else if (respuesta == true) {
            Swal.fire({
                icon: 'success',
                title: 'Tarea creada',
                showConfirmButton: false,
                timer: 1500
            })
            modalTareaCrearEditar.hide();
            btnEliminarTodo.classList.remove('btnEliminarTodoOculto');
            mostrarTareas();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Ha habido un error',
                text: 'La tarea no se ha creado!',
            })
            modalTareaCrearEditar.hide();
        }      
    }

    if (opcion == 'editar') {

        const tituloTarea = tituloCrearEditar.value;
        fechaCrearEditar.textContent = '';

        //titulo vacío
        if (!tituloTarea) {
            Swal.fire('Nombre de tarea requerida');

        //hay título
        } else {

            //petición editar
            const simpleData = { 'idTarea': idEditar };
            const respuesta = await useFetch(urlEditar, formulario, simpleData)

            if (respuesta) {
                if (respuesta == 'Afecha') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha habido un error',
                        text: '¡Establezca una fecha si quiere recibir la notificación por email!',
                    })
                    modalTareaCrearEditar.hide();
                    mostrarTareas();
                } else if (respuesta == 'MenorFecha') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha habido un error',
                        text: '¡Para recibir una notificación, la fecha debe ser 24h posterior a hoy, como mínimo!',
                    });
                    modalTareaCrearEditar.hide();
                    mostrarTareas();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tarea editada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

                modalTareaCrearEditar.hide();
                mostrarTareas();

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Ha habido un error',
                    text: '¡La tarea no se ha editado!',
                })

                modalTareaCrearEditar.hide();
            }     
        }
    }
})


/**
 * Función que permite editar una tarea
 */
on(document, 'click', [ '.btn-eliminar' ], async (e) => {
    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode
    const id = fila.firstElementChild.value

    Swal.fire({
        title: '¿Seguro que quieres eliminar la tarea',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then(async (result) => {
        if (result.isConfirmed) {
            //petición eliminar
            const simpleData = { 'idTarea': id };
            const respuesta = await useFetch(urlEliminar, formulario, simpleData)

            //tarea eliminada
            if (respuesta) {
                Swal.fire(
                    'Eliminada!'
                )
                mostrarTareas();
            } else {
                Swal.fire(
                    'No Eliminada!'
                )
            }
        }
    })
});

/**
 * Función que permite eliminar todas las tareas de un proyecto
 */
on(document, 'click', [ '#btnEliminarTodo' ], e => {

    Swal.fire({
        title: '¿Seguro que quieres eliminar todas las tareas?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then(async (result) => {
        if (result.isConfirmed) {
            //petición eliminar
            const respuesta = await useFetch(urlEliminarTodo)

            //tarea eliminada
            if (respuesta) {
                Swal.fire(
                    'Eliminadas!'
                )
                btnEliminarTodo.classList.add('btnEliminarTodoOculto');
                mostrarTareas();
            } else {
                Swal.fire(
                    'No Eliminadas!'
                )
            }
        }
    })
});


/**
 * Función que permite saber si una tarea está marcada o no y su id
 */
on(document, 'change', [ '.completado' ], async (e) => {
    let idTarea = 0;
    let estado;
    const fila = e.target.parentNode.parentNode;

    if (e.target.checked) {
        estado = 1;
    } else {
        estado = 0;
    }
    idTarea = fila.children[ 0 ].value;

    //petición
    const datos = [
        { 'estado': estado },
        { 'idTarea': idTarea }
    ]
    const respuesta = await useFetch(urlCompletar, '', '', datos);

    if(respuesta){
        if (iconoCalendario.classList.contains('iconosRojos')) {
            fetch(urlMostrar, {
                method: "POST"
            })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    tareasSeparadas(respuesta, 'calendario');
                })
        } else {
            mostrarTareas();
        }
    }   
})

/**
 * Función que crea la barra de progreso
 * @param {string} porcentaje 
 * @param {string} color 
 * @param {string} letra 
 * @param {string} progreso 
 * @returns {object} div
 */
function barraProgreso(porcentaje, color, letra, progreso) {
    let barra = document.getElementById('barra-progreso');
    while (barra.hasChildNodes()) {
        barra.removeChild(barra.firstChild);
    }
    const div = document.createElement('div');
    div.style = `width: ${porcentaje}%`;
    div.className = `progress-bar progress-bar-striped bg-${color} fs-4 fw-bold pb-1 text-${letra}`;
    div.setAttribute('role', 'progressbar');
    div.setAttribute('aria-label', 'Default striped example');
    div.setAttribute('aria-valuenow', '100');
    div.setAttribute('aria-valuemin', '0');
    div.setAttribute('aria-valuemax', '100');
    div.textContent = progreso
    return div;
}

/**
 * Función que calcula y muestra la barra de progreso
 */
async function porcentaje() {

    let barra = document.getElementById('barra-progreso');
    let porcent = 0;
    let color = '';
    let progreso = '';
    let letra = '';

    //petición
    const respuesta = await useFetch(urlPorcentaje)

    porcent = respuesta;
    progreso = respuesta + '%';

    if (porcent < 25) {
        color = 'danger';
        letra = 'white';
    } else if (porcent <= 50) {
        color = 'warning';
        letra = 'dark';
    } else if (porcent <= 75) {
        color = 'info'
        letra = 'dark';
    } else if (porcent == 100) {
        color = 'success';
        progreso = '¡Completado!';
        letra = 'white';

    }
    barra.appendChild(barraProgreso(porcent, color, letra, progreso));  
}

/**
 * Función para que el menú de navegación se quede ajustado al hacer scroll
 */
function navegacionFija() {
    setTimeout(() => {
        const anchuraVantana = window.innerWidth;
        if (anchuraVantana < 568) {
            //seleccionar la barra superior
            const barra = document.querySelector('.panelTareas');
            //elemento que una vez hagamos scroll hacia él se ejecutará el código
            const titulosTareas = document.querySelector('.insertar');
            //soluciona el scroll en el body
            const body = document.querySelector('body');
            //ponemos el scroll a la escucha y con getBoundingClientRect para detectar que se 
            //dio scroll hasta ese elemento o lo pasó
            window.addEventListener('scroll', function () {
                //<0 es que ya pasó el elemento. Se puede poner bottom
                if (titulosTareas.getBoundingClientRect().top > 700) {

                    barra.classList.add('fijo');
                    //añade la clase que pone espacio arriba para que no desborde el resto de 
                    body.classList.add('body-scroll');
                } else {
                    barra.classList.remove('fijo');
                    body.classList.remove('body-scroll');
                }
            });
        }
    }, 500);
}

/**
 * Función que calcula los carácteres cuando se escriben
 */
on(document, 'keyup', [ '#descripcionCrearEditar', '#tituloCrearEditar' ], e => {
    const elementoHtml = e.target.localName;
    let caracteresEscritos = e.target.value.length;
    gestionarCaracteresTareas(caracteresEscritos, elementoHtml);
})

/**
 * Función que detecta los carácteres escritos en los inputs
 */
on(document, 'click', [ '.btn-editar' ], e => {
    setTimeout(() => {
        const elementoHtml = '';
        let caracteresEscritos = { 'tituloCrearEditar': tituloCrearEditar.value.length, 'descripcionCrearEditar': descripcionCrearEditar.value.length };
        gestionarCaracteresTareas(caracteresEscritos, elementoHtml);
    }, 470);
})

/**
 * Función que gestiona los caracteres
 * @param {object} caracteresEscritos 
 * @param {string} elementoHtml 
 */
function gestionarCaracteresTareas(caracteresEscritos, elementoHtml = '') {

    let caracteresInput = 0;
    let caracteresTextArea = 0;

    if (typeof caracteresEscritos === 'object') {

        caracteresInput = maximoInput - caracteresEscritos[ 'tituloCrearEditar' ];
        caracteresTextArea = maximoTextArea - caracteresEscritos[ 'descripcionCrearEditar' ];
        descripcionCaracteresInput.textContent = `${caracteresInput} caracteres restantes`;
        descripcionCaracteresTextArea.textContent = `${caracteresTextArea} caracteres restantes`;

        if(caracteresInput <= 0){
            descripcionCaracteresInput.classList.add('caracteresRojo');
        }else{
            if (descripcionCaracteresInput.classList.contains('caracteresRojo')) descripcionCaracteresInput.classList.remove('caracteresRojo');
        }

        if(caracteresTextArea <= 0){
            descripcionCaracteresTextArea.classList.add('caracteresRojo');
        }else{
            if (descripcionCaracteresTextArea.classList.contains('caracteresRojo')) descripcionCaracteresTextArea.classList.remove('caracteresRojo');
        }
    } else {
        if (elementoHtml === 'input') {
            caracteresInput = maximoInput - caracteresEscritos;
            descripcionCaracteresInput.textContent = `${caracteresInput} caracteres restantes`;
        } else if (elementoHtml === 'textarea') {
            caracteresTextArea = maximoTextArea - caracteresEscritos;
            descripcionCaracteresTextArea.textContent = `${caracteresTextArea} caracteres restantes`;
        }
        if (caracteresInput <= 0 && elementoHtml === 'input') {
            descripcionCaracteresInput.classList.add('caracteresRojo');
        } else if (caracteresTextArea <= 0 && elementoHtml === 'textarea') {
            descripcionCaracteresTextArea.classList.add('caracteresRojo');
        } else {
            if (descripcionCaracteresInput.classList.contains('caracteresRojo')) descripcionCaracteresInput.classList.remove('caracteresRojo');

            if (descripcionCaracteresTextArea.classList.contains('caracteresRojo')) descripcionCaracteresTextArea.classList.remove('caracteresRojo');
        }
    }
}

/**
 * Función que resetea los caracteres a su valor por defecto
 */
on(document, 'click', [ '#btnCrear' ], e => {
    descripcionCaracteresInput.textContent = `40 caracteres restantes`;
    descripcionCaracteresTextArea.textContent = `1500 caracteres restantes`;
    if (descripcionCaracteresInput.classList.contains('caracteresRojo')) descripcionCaracteresInput.classList.remove('caracteresRojo');
    if (descripcionCaracteresTextArea.classList.contains('caracteresRojo')) descripcionCaracteresTextArea.classList.remove('caracteresRojo');

});

