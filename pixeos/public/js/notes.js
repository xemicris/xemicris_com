
import { noteRoutes, noteConstants } from './projectData.js'
import { note } from "./note.js";
import { noNotes } from './noNotes.js';
import { validarEmail } from './validar.js';
import { useFetch } from "./useFetch.js";
import { alerts } from './alerts.js'
import { pdf } from "./pdf.js";

//rutas
const {
    todasNotas,
    creaProyecto,
    editaProyecto,
    enviaIdEditar,
    eliminaProyecto,
    urlCrear,
    urlDescargar,
    agregarNotaCompartida,
    eliminarNotaCompartida,
    buscarUsuariosCompartenNota,
    enviarNotaACorreo } = noteRoutes();

//dom
const {
    formulario,
    crear,
    nombre,
    tituloNota,
    body,
    botonCrearEditar,
    proyectos,
    tituloCrear,
    descripcionCrear,
    fechaCrear,
    tipoNotificacion,
    descripcionCaracteresInput,
    nombreCaracteresInput,
    descripcionCaracteresTextArea,
    radioNotas
} = noteConstants();


//Declaración de variables
let opcion = '';


(function () {
    window.onbeforeunload = function () {
        localStorage.setItem('tipoNota', 1);
    };
    mostrarProyectos();
})();

//Referenciar los modales
const modalNotaCrearEditar = new bootstrap.Modal(document.getElementById('modalNotaCrearEditar'), true);
const modalTareaCrear = new bootstrap.Modal(document.getElementById('modalTareaCrear'), true);


function mayuscula(texto) {
    const primeraLetra = texto.charAt(0);
    const resto = texto.slice(1);
    return primeraLetra.toUpperCase() + resto;
}

/**
 * Función que ordena las tareas por orden alfabético
 * @param {array} datos sin ordenar 
 * @param {string} nombre nombre de la propiedad
 * @returns {array} tareas ordenadas 
 */
function ordenar(datos, nombre) {
    datos.sort(function (a, b) {
        let primero = mayuscula(a[ nombre ]);
        let segundo = mayuscula(b[ nombre ]);
        if (primero > segundo) {
            return 1;
        }
        if (primero < segundo) {
            return -1;
        }
        // a must be equal to b
        return 0;
    });
    return datos;
}


/**
 * Función que muestra proyectos y tareas
 */
async function mostrarProyectos(tipoNota = 1) {

    let notasVacias = 0;
    try {
        //petición
        let respuestaProyectos = await useFetch(todasNotas);
        let comparteNota = false;
        let notaOriginal = true;
        let usuarioComparte = '';

        if (respuestaProyectos[ 'proyectos' ].length > 0) {
            //limpiar
            while (proyectos.hasChildNodes()) {
                proyectos.removeChild(proyectos.firstChild);
            }
            let notas = ordenar(respuestaProyectos[ 'proyectos' ], 'nombreProyecto');

            notas.forEach(nota => {
                if (nota[ 'compartida' ] > 0) {
                    comparteNota = true;
                } else {
                    comparteNota = false;
                }
                if (nota[ 'ko' ]) {
                    notaOriginal = false;
                } else {
                    notaOriginal = true
                }
                if (nota[ 'usuarioComparte' ]) {
                    usuarioComparte = nota[ 'usuarioComparte' ];
                }

                let tareas = ordenar(nota[ 'tareas' ], 'nombreTarea');

                tareas.forEach(tarea => {
                    if (tarea[ 'estado' ] == 1) {
                        tarea[ 'estado' ] = 'tarea-completada';
                    } else if (tarea[ 'estado' ] == 0) {
                        tarea[ 'estado' ] = '';
                    }
                })

                //notas sin complear
                if (nota[ 'completado' ] == "0" && tipoNota === 1) {
                    proyectos.appendChild(note(false, nota[ 'urlProyecto' ], nota[ 'colorProyecto' ], nota[ 'nombreProyecto' ], nota[ 'tareas' ], nota[ 'id' ], comparteNota, notaOriginal, usuarioComparte));
                    notasVacias = notasVacias + 1;
                    //notas completadas
                } else if (nota[ 'completado' ] == "1" && tipoNota === 2) {
                    proyectos.appendChild(note(true, nota[ 'urlProyecto' ], nota[ 'colorProyecto' ], nota[ 'nombreProyecto' ], nota[ 'tareas' ], nota[ 'id' ], comparteNota, notaOriginal, usuarioComparte));
                    notasVacias = notasVacias + 1;
                } else if (tipoNota === 3) {
                    const completado = (nota[ 'completado' ] == "1") ? true : false;
                    proyectos.appendChild(note(completado, nota[ 'urlProyecto' ], nota[ 'colorProyecto' ], nota[ 'nombreProyecto' ], nota[ 'tareas' ], nota[ 'id' ], comparteNota, notaOriginal, usuarioComparte));
                    notasVacias = notasVacias + 1;
                }
                usuarioComparte = '';
            })
            if (notasVacias === 0) {
                //limpiar
                while (proyectos.hasChildNodes()) {
                    proyectos.removeChild(proyectos.firstChild);
                }
                proyectos.appendChild(noNotes());
            }

            //No hay notas
        } else {
            //limpiar
            while (proyectos.hasChildNodes()) {
                proyectos.removeChild(proyectos.firstChild);
            }
            proyectos.appendChild(noNotes());
        }

    } catch (err) {
        alerts('error', 'Ha ocurrido un error, inténtalo de nuevo más tarde', false, 3000, '', '', '', 'Cerrar');
    }
}

//lanzar modal
crear.forEach(cr => {
    cr.addEventListener('click', () => {
        if ('.modal-backdrop') {
            body.classList.remove('.modal-backdrop');
        };
        //limpiar campos
        nombre.value = '';

        //mostrar modal
        tituloNota.textContent = "Nueva tarea";
        botonCrearEditar.textContent = "Crear";
        modalNotaCrearEditar.show();
        opcion = 'crear';
    });
})



/**
 * Función que permite detectar que botón se ha presionado tanto para editar como para borrar
 * @param {object} element 
 * @param {object} event 
 * @param {array} selectores 
 * @param {object} handler 
 */
const on = (element, event, selectores, handler) => {
    element.addEventListener(event, e => {
        for (const selector of selectores) {
            if (e.target.closest(selector)) {
                handler(e);
                break; // Terminar el bucle una vez que se haya manejado el evento
            }
        }
    });
};

/**
 * Función que detecta el radiobutton marcado
 * @param {object} e 
 */
const tipoNota = (e) => {
    localStorage.removeItem('tipoNota');
    const nota = e.target.value;
    if (nota === 'completadas') {
        mostrarProyectos(2);
        localStorage.setItem('tipoNota', 2);
    } else if (nota === 'noCompletadas') {
        mostrarProyectos(1);
        localStorage.setItem('tipoNota', 1);
    } else if (nota === 'todas') {
        mostrarProyectos(3);
        localStorage.setItem('tipoNota', 3);
    }
}

radioNotas.forEach(radioNota => {
    radioNota.addEventListener('change', tipoNota);
})



/**
 * Obtiene el id y mantiene los datos en edición
 */

on(document, 'click', [ '.editar' ], e => {

    opcion = 'editar';
    //Pone contenido a editar y llama a la función que envía el id del proyecto
    const inputEditar = document.getElementById("nombre");
    const fila = e.target.closest('.primero');
    const contenidoEditar = fila.firstElementChild?.firstElementChild?.textContent || '';
    inputEditar.value = contenidoEditar;
    enviarIdNotaAEditar(e);

    //mostrar modal
    tituloNota.textContent = "Editar tarea";
    botonCrearEditar.textContent = "Guardar";
    modalNotaCrearEditar.show();

})


/**
 * Función que permite crear o editar una nota
 */
CrearEditarNota.addEventListener('click', async (e) => {
    e.preventDefault();
    if (opcion == 'crear') {
        //petición crear
        const respuesta = await useFetch(creaProyecto, formulario)

        if (respuesta == 'valido') {
            modalNotaCrearEditar.hide();
            alerts('success', 'Nota creada correctamente', false, 1500, '', '', '', 'Cerrar');
            const tipoNota = parseInt(localStorage.getItem('tipoNota'));
            mostrarProyectos(tipoNota);
        } else if (respuesta == 'invalido') {
            alerts('', 'Nombre de nota no válida', '', '', '', '', '', 'Cerrar');
        } else {
            alerts('', 'Nombre de nota requerida', '', '', '', '', '', 'Cerrar');
        }
    }

    if (opcion == 'editar') {
        const tituloTarea = document.querySelector('#nombre').value;
        //titulo vacío
        if (!tituloTarea) {
            alerts('', 'Nombre de nota requerida', '', '', '', '', '', 'Cerrar');
            //hay título
        } else {
            //petición editar
            const respuesta = await useFetch(editaProyecto, formulario);
            if (respuesta.length > 0) {
                if (respuesta == 'valido') {
                    modalNotaCrearEditar.hide();
                    alerts('success', 'Nota editada correctamente', false, 1500, '', '', '', 'Cerrar');
                    const tipoNota = parseInt(localStorage.getItem('tipoNota'));
                    mostrarProyectos(tipoNota);
                } else if (respuesta == 'invalido') {
                    alerts('', 'Nombre de nota no válida', '', '', '', '', '', 'Cerrar');
                } else {
                    alerts('', 'Nombre de nota requerida', '', '', '', '', '', 'Cerrar');
                }
            }
        }
    }
})

// 
/**
 * Función que envía el id de la nota a editar
 * @param {object} e event
 */
async function enviarIdNotaAEditar(e) {
    try {
        let idProyecto = obteneridProyecto(e);
        const simpleData = { 'idProyecto': idProyecto };
        await useFetch(enviaIdEditar, '', simpleData, [], false);

    } catch (err) {
        alerts('error', 'Ha ocurrido un error, inténtalo de nuevo más tarde', false, 3000, '', '', '', 'Cerrar');
    }
}

/**
 * Elimina una nota
 */
on(document, 'click', [ '.eliminar' ], (e) => {
    //obtención del id
    try {
        let idProyecto = obteneridProyecto(e);
        const simpleData = { 'idProyecto': idProyecto };
        alerts('warning', '¿Seguro que quieres eliminar la nota?', '', 1500, true, '#3085d6', '#d33', 'Si!', 'No')
            .then((result) => {
                //petición para eliminar
                if (result.isConfirmed) {
                    useFetch(eliminaProyecto, '', simpleData)
                        .then(respuesta => {
                            if (respuesta) {
                                //proyecto eliminado
                                if (respuesta) {
                                    alerts('', '¡Nota Eliminada!', '', '', '', '', '', 'Cerrar');
                                    const tipoNota = parseInt(localStorage.getItem('tipoNota'));
                                    mostrarProyectos(tipoNota);
                                } else {
                                    //proyecto no eliminado
                                    alerts('', '¡Nota no eliminada!', '', '', '', '', '', 'Cerrar');
                                }
                            }
                        })
                }
            })

    } catch (err) {
        alerts('error', 'Ha ocurrido un error, inténtalo de nuevo más tarde', false, 3000, '', '', '', 'Cerrar');
    }
});

/**
 * Función que obtiene el id del proyecto
 * @param {object} e event
 * @returns int idProyecto
 */
function obteneridProyecto(e) {
    let idProyecto = e.target.id;
    return idProyecto;
}

/**
 * Función que limpia el formulario de creación de notas
 */
on(document, 'click', [ '.cancelar' ], e => {
    formulario.reset();
    const cruzCancelar = document.querySelector(".btn-close");
    cruzCancelar.onclick = function () {
        formulario.reset();
    }
});

//lanzar modal tareas
on(document, 'click', [ '.nuevaT' ], e => {
    let headerCrear = document.getElementById('encabezadoCrear');
    let color = e.target.parentNode.parentNode.children[ 0 ].childNodes[ 0 ].classList[ 4 ];
    let urlPoryecto = e.target.parentNode.parentNode.childNodes[ 0 ].attributes[ 0 ].nodeValue;
    let arrayUrlProyecto = urlPoryecto.split('/');
    let proyecto = arrayUrlProyecto[ arrayUrlProyecto.length - 1 ];
    localStorage.setItem('urlProyecto', proyecto);
    const colorTitulo = document.querySelector('.tarea-header-modal');
    if ('.modal-backdrop') {
        body.classList.remove('.modal-backdrop');
    };
    //limpiar campos
    tituloCrear.value = '';
    descripcionCrear.value = '';
    fechaCrear.value = '';
    colorTitulo.classList.remove(color);

    //mostrar modal
    colorTitulo.classList.add(color);
    headerCrear.textContent = "Nueva tarea";
    botonTareas.textContent = "Crear";
    modalTareaCrear.show();
    opcion = 'crear'
    Array.from(tipoNotificacion, (option) => {
        option.removeAttribute('selected');
    })

});

/**
 * Función de limpieza del modal que crea o edita una nota
 */
on(document, 'click', [ '.cerrar' ], e => {
    let color = e.target.parentNode.parentNode.parentNode.parentNode.firstChild.nextElementSibling.classList[ 2 ];
    const colorTitulo = document.querySelector('.tarea-header-modal');
    colorTitulo.classList.remove(color);
    localStorage.removeItem('urlProyecto');
});


/**
 * Función que permite crear una tarea
 */
botonTareas.addEventListener('click', async () => {
    //referenciar al formulario de tareas
    const formularioTa = document.querySelector('#formularioTarea');

    if (opcion == 'crear') {
        const urlPoryecto = (localStorage.getItem('urlProyecto')) ? localStorage.getItem('urlProyecto') : '';
        const simpleData = { 'urlProyecto': urlPoryecto };
        const respuesta = await useFetch(urlCrear, formularioTa, simpleData);
        switch (respuesta) {
            case 'Afecha':
                alerts('error', 'Ha habido un error', '', '', '', '', '', 'Cerrar', '', '¡Establezca una fecha si quiere recibir la notificación por email!');
                break;
            case 'MenorFecha':
                alerts('error', 'Ha habido un error', '', '', '', '', '', 'Cerrar', '', '¡Para recibir una notificación, la fecha debe ser 24h posterior a hoy, como mínimo!');
                break;
            case true:
                alerts('success', 'Tarea creada', false, 1500, '', '', '', 'Cerrar');
                break;
            default:
                alerts('error', 'Ha habido un error', '', '', '', '', '', 'Cerrar', '', 'La tarea no se ha creado');
                break;
        }
        modalTareaCrear.hide();
        const tipoNota = parseInt(localStorage.getItem('tipoNota'));
        mostrarProyectos(tipoNota);
    }
})

/**
 * Función que permite detectar cuando se está tecleando para descontar caracteres
 */
on(document, 'keyup', [ '#descripcionCrear', '#tituloCrear', '#nombre' ], e => {
    const elementoHtml = e.target.localName;
    let caracteresEscritos = e.target.value.length;
    gestionarCaracteresTareas(caracteresEscritos, elementoHtml);
})

/**
 * Función que permite detectar los caracteres ya escritos en los input para descontarlos
 */
on(document, 'click', [ '.editar' ], e => {
    const elementoHtml = 'input';
    let caracteresEscritos = nombre.value.length;
    gestionarCaracteresTareas(caracteresEscritos, elementoHtml);
})

/**
 * Función que gestiona el número de caracteres escritos
 * @param {number} caracteresEscritos 
 * @param {string} elementoHtml 
 */
function gestionarCaracteresTareas(caracteresEscritos, elementoHtml) {
    let caracteres;
    const maximoTextArea = 1500;
    const maximoInput = 40;

    if (elementoHtml === 'input') {
        caracteres = maximoInput - caracteresEscritos;
        descripcionCaracteresInput.textContent = `${caracteres} caracteres restantes`;
        nombreCaracteresInput.textContent = `${caracteres} caracteres restantes`;
    } else if (elementoHtml === 'textarea') {
        caracteres = maximoTextArea - caracteresEscritos;
        descripcionCaracteresTextArea.textContent = `${caracteres} caracteres restantes`;
    }

    if (caracteres <= 0 && elementoHtml === 'input') {
        descripcionCaracteresInput.classList.add('caracteresRojo');
        nombreCaracteresInput.classList.add('caracteresRojo');
    } else if (caracteres <= 0 && elementoHtml === 'textarea') {
        descripcionCaracteresTextArea.classList.add('caracteresRojo');
    } else {
        if (descripcionCaracteresInput.classList.contains('caracteresRojo')) descripcionCaracteresInput.classList.remove('caracteresRojo');
        if (nombreCaracteresInput.classList.contains('caracteresRojo')) nombreCaracteresInput.classList.remove('caracteresRojo');
        if (descripcionCaracteresTextArea.classList.contains('caracteresRojo')) descripcionCaracteresTextArea.classList.remove('caracteresRojo');

    }
}

/**
 * Función que reinicia el número de caracteres por defecto
 */
on(document, 'click', [ '.cerrar' ], e => {
    descripcionCaracteresInput.textContent = `40 caracteres restantes`;
    nombreCaracteresInput.textContent = `40 caracteres restantes`;
    descripcionCaracteresTextArea.textContent = `1500 caracteres restantes`;

});

/**
 * Función que permite descargar una nota
 */
on(document, 'click', [ '.icono--pdf' ], async (e) => {
    e.preventDefault();
    let idProyecto = e.target.id;
    const simpleData = { 'idProyecto': idProyecto };
    const respuesta = await useFetch(urlDescargar, '', simpleData, [], true, false)
    if (respuesta) {
        pdf(respuesta);
    }
})

/**
 * Función que permite compartir una nota
 */
on(document, 'click', [ '.icono--compartir' ], e => {
    e.preventDefault();
    const idNota = e.target.id;

    Swal.fire({
        title: "Correo del usuario para compartir la nota",
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        cancelButtonColor: '#dc3545',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonText: "Compartir",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async (login) => {
            if (validarEmail(login)) {
                try {
                    const datos = [
                        { 'idNota': idNota },
                        { 'email': login }
                    ]
                    const respuesta = await useFetch(agregarNotaCompartida, '', '', datos);
                    if (respuesta[ 0 ] != "Nota compartida correctamente") {
                        Swal.showValidationMessage(`
                            Atención: ${respuesta}
                        `);
                    } else {
                        alerts('success', 'Nota compartida con ' + respuesta[ 1 ] + ' correctamente', false, 3000, '', '', '', 'Cerrar');
                        const tipoNota = parseInt(localStorage.getItem('tipoNota'));
                        mostrarProyectos(tipoNota);
                    }

                } catch (error) {
                    Swal.showValidationMessage(`
                    Request failed: ${error}
                    `);
                }
            } else {
                Swal.showValidationMessage(`
                    Atención: Email no válido
                `);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})

/**
 * Función que permite dejar de compartir una nota
 */
on(document, 'click', [ '.icono--descompartir' ], e => {
    e.preventDefault();
    const idNota = e.target.id;
    Swal.fire({
        title: "¿Está seguro que desea dejar de compartir la nota?",
        cancelButtonColor: '#dc3545',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonText: "Dejar de compartir",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            try {
                const anadir = { 'idNota': idNota };
                const respuesta = await useFetch(eliminarNotaCompartida, '', anadir);
                if (respuesta[ 1 ] == false) {
                    Swal.showValidationMessage(`
                            Atención: ${respuesta[ 0 ]}
                        `);
                } else {
                    alerts('success', 'Nota dejada de compartir con ' + respuesta[ 1 ] + ' correctamente', false, 3000, '', '', '', 'Cerrar');
                    const tipoNota = parseInt(localStorage.getItem('tipoNota'));
                    mostrarProyectos(tipoNota);
                }

            } catch (error) {
                Swal.showValidationMessage(`
                    Request failed: ${error}
                `);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})

/**
 * Función que indica los usuarios con los que una nota se está compartiendo
 */
on(document, 'click', [ '.icono--informacion' ], async (e) => {
    try {
        let usuarios = '';
        e.preventDefault();
        const idNota = e.target.id;
        const simpleData = { 'idNota': idNota };
        const respuesta = await useFetch(buscarUsuariosCompartenNota, '', simpleData);
        if (respuesta.length <= 0) {
            alerts('info', 'No está compartiendo esta nota', '', '', '', '', '', 'Cerrar', '', '', false, false);
        } else {
            respuesta.forEach(res => {
                usuarios += res[ 'nombre' ] + '\n';
            })
            alerts('info', 'Comparte la nota con los siguientes usuarios:', '', '', '', '', '', 'Cerrar', '', usuarios, false, false);
        }
    } catch (error) {
        Swal.showValidationMessage(`
            Request failed: ${error}
        `);
    }
})

/**
 * Función que permite enviar una nota a un correo electrónico
 */
on(document, 'click', [ '.icono--mensaje' ], e => {
    e.preventDefault();
    const idNota = e.target.id;
    Swal.fire({
        title: "Introduce el correo para enviar la nota",
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        cancelButtonColor: '#dc3545',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonText: "Enviar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async (login) => {
            if (validarEmail(login)) {
                try {
                    const datos = [
                        { 'idNota': idNota },
                        { 'email': login }
                    ]
                    const respuesta = await useFetch(enviarNotaACorreo, '', '', datos);
                    if (respuesta[ 0 ] != "Correo enviado correctamente") {
                        Swal.showValidationMessage(`Tu nota debe tener al menos una tarea`);
                    } else {
                        alerts('success', respuesta[ 1 ] + ', el correo se ha enviado a ' + respuesta[ 2 ], false, 3000, '', '', '', 'Cerrar', '', '', false, false);
                        const tipoNota = parseInt(localStorage.getItem('tipoNota'));
                        mostrarProyectos(tipoNota);
                    }
                } catch (error) {
                    Swal.showValidationMessage(`
                        Request failed: ${error}
                    `);
                }
            } else {
                Swal.showValidationMessage(`
                    Atención: Email no válido
                `);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})
