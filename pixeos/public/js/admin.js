import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();
/**
 * Rutas
 */
const urlMostrar = `${server}/pixeos/admin/mostrarUsuarios`;
const urlEditar = `${server}/pixeos/admin/updateUser`;
const urlEliminar = `${server}/pixeos/admin/eliminateUser`;
const urlSelect = `${server}/pixeos/admin/selectRol`;

/**
 * Definición de variables
 */
const contenedor = document.querySelector('#usuarios');
const botonAdmin = document.querySelector('#botonAdmin');
let fila;
let idUsuario;
let nombreValor;
let apellidosValor;
let correoValor;
let estado = '';
let rolValor = '';

/**
 * Refenecia al modal
 */
const modalAdmin = new bootstrap.Modal(document.getElementById('modalAdmin'));

/**
 * Referencia al formulario
 */
const formulario = document.querySelector('form');

/**
 * Capturar campos
 */
const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const correo = document.getElementById('correo');
const rol = document.getElementById('rol');
const select = document.getElementById('confirmado');

mostrarUsuarios();

/**
 * Función que crea un usuario
 * @param {object} usuario 
 * @param {string} rolValor 
 * @param {string} estado 
 * @returns {object} tr
 */
function usuario(usuario, rolValor, estado) {
    const tr = document.createElement('tr');

    const input = document.createElement('input');
    input.type = 'hidden';
    input.value = usuario.id;

    const tdNombre = document.createElement('td');
    tdNombre.textContent = usuario[ 'nombre' ];
    const tdApellidos = document.createElement('td');
    tdApellidos.textContent = usuario[ 'apellidos' ];
    const tdCorreo = document.createElement('td');
    tdCorreo.textContent = usuario[ 'correo' ];
    const tdRol = document.createElement('td');
    tdRol.textContent = rolValor;
    const tdEstado = document.createElement('td');
    tdEstado.textContent = estado;

    const tdEnlaces = document.createElement('td');
    tdEnlaces.className = 'text-center';

    const div = document.createElement('div');
    div.className = 'd-flex justify-content-center gap-2';

    const enlace1 = document.createElement('a');
    enlace1.className = 'btn-editar btn btn-sm btn-primary mt-2';
    enlace1.textContent = 'Editar';
    const enlace2 = document.createElement('a');
    enlace2.className = 'btn-eliminar btn btn-sm btn-danger mt-2';
    enlace2.textContent = 'Eliminar';

    //Anidar elementos

    tr.appendChild(input);
    tr.appendChild(tdNombre);
    tr.appendChild(tdApellidos);
    tr.appendChild(tdCorreo);
    tr.appendChild(tdRol);
    tr.appendChild(tdEstado);
    div.appendChild(enlace1);
    div.appendChild(enlace2);
    tdEnlaces.appendChild(div);
    tr.appendChild(tdEnlaces);

    return tr;
}

function noUsuario() {
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.setAttribute('colspan', 4);
    const h3 = document.createElement('h3');
    h3.textContent = 'No hay usuarios';

    //anidar elementos
    tr.appendChild(td);
    td.appendChild(h3);

    return tr;
}
/**
 * Función que muestra los usuarios registrados en una tabla dinámica
 */
function mostrarUsuarios() {
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
                    (element[ 'confirmado' ] == '1') ? estado = "Activado" : estado = "No activado";
                    if (element[ 'rol' ] == '1') {
                        rolValor = "Administrador";
                    } else if (element[ 'rol' ] == '2') {
                        rolValor = "Usuario";
                    } else if (element[ 'rol' ] == '3') {
                        rolValor = "Técnico";
                    }
                    contenedor.appendChild(usuario(element, rolValor, estado));
                })

            } else {
                while (contenedor.hasChildNodes()) {
                    contenedor.removeChild(contenedor.firstChild);
                }
                contenedor.appendChild(noUsuario());
            }
        })
}
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

function confirmado(confirmado) {
    while (select.hasChildNodes()) {
        select.removeChild(select.firstChild);
    }
    const option1 = document.createElement('option');
    option1.setAttribute('value', 1);
    option1.textContent = 'Activado';
    const option2 = document.createElement('option');
    option2.setAttribute('value', 0);
    option2.textContent = 'No activado';
    if (confirmado == '1') {
        option1.setAttribute('selected', '');
    } else if (confirmado == '0') {
        option2.setAttribute('selected', '');
    }
    //Anidar elementos
    select.appendChild(option1);
    select.appendChild(option2);
    return select;
}

function roles(roles) {
    while (rol.hasChildNodes()) {
        rol.removeChild(rol.firstChild);
    }
    const option1 = document.createElement('option');
    option1.setAttribute('value', 1);
    option1.textContent = 'Administrador';
    const option2 = document.createElement('option');
    option2.setAttribute('value', 2);
    option2.textContent = 'Usuario';
    const option3 = document.createElement('option');
    option3.setAttribute('value', 3);
    option3.textContent = 'Técnico';

    if (roles === '1') {
        option1.setAttribute('selected', '');
    } else if (roles === '2') {
        option2.setAttribute('selected', '');
    } else if (roles ==='3') {
        option3.setAttribute('selected', '');
    }

    //Anidar elementos
    rol.appendChild(option1);
    rol.appendChild(option2);
    rol.appendChild(option3);

    return rol;
}

//Obtener id y mantener datos en edición
/**
 * Función que permite editar un usuario
 */
on(document, 'click', '.btn-editar', e => {
    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode;
    idUsuario = fila.children[ 0 ].value;
    nombreValor = fila.children[ 1 ].textContent;
    apellidosValor = fila.children[ 2 ].textContent;
    correoValor = fila.children[ 3 ].textContent;

    nombre.value = nombreValor;
    apellidos.value = apellidosValor;
    correo.value = correoValor;
    botonAdmin.textContent = "Guardar";

    const datos = new FormData();
    datos.append('idUsuario', idUsuario);
    //petición
    fetch(urlSelect, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            confirmado(respuesta[ 'confirmado' ]);
            roles(respuesta[ 'rol' ]);
            modalAdmin.show()
        })
})

/**
 * Función que permite editar un usuario
 */
botonAdmin.addEventListener('click', () => {
    const datos = new FormData(formulario);
    datos.append('idUsuario', idUsuario);
    //petición
    fetch(urlEditar, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            //validación
            if (respuesta != 'Nombre requerido' && respuesta != 'Nombre incorrecto' && respuesta != 'Apellidos requeridos' && respuesta != 'Apellidos incorrectos' && respuesta != 'Correo requerido' && respuesta != 'El correo electrónico no es válido') {
                if (respuesta[ 0 ] != 'Nombre requerido' && respuesta[ 1 ] != 'Apellidos incorrectos') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario modificado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    modalAdmin.hide();
                    mostrarUsuarios();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha habido un error',
                        text: respuesta[ 0 ] + ' y ' + respuesta[ 1 ],
                    })
                    modalTarea.hide();

                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ha habido un error',
                    text: respuesta,
                })
                modalTarea.hide();
            }
        })
})

/**
 * Función que permite eliminar un usuario
 */
on(document, 'click', '.btn-eliminar', e => {
    //captura la fila
    const fila = e.target.parentNode.parentNode.parentNode
    const idUsuario = fila.firstElementChild.value
    const datos = new FormData();
    datos.append('idUsuario', idUsuario);

    Swal.fire({
        title: '¿Seguro que quieres eliminar la tarea',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(urlEliminar, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: datos
            })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                if (respuesta) {
                    Swal.fire(
                        'Usuario eliminado correctamente!'
                    )
                    mostrarUsuarios();
                } else {
                    Swal.fire(
                        'Usuario no eliminado!'
                    )
                }

            })
        }
    })
});