import { getProjectRoute } from "./getProjectRoutes.js";

const server = getProjectRoute();


//Notas
export function noteRoutes() {
    const todasNotas = `${server}/pixeos/panel/taskInProject`;
    const creaProyecto = `${server}/pixeos/panel/createproject`;
    const editaProyecto = `${server}/pixeos/panel/updateProject`;
    const enviaIdEditar = `${server}/pixeos/panel/idProject`;
    const eliminaProyecto = `${server}/pixeos/panel/eliminateProject`;
    const urlCrear = `${server}/pixeos/panel/createTask`;
    const urlDescargar = `${server}/pixeos/panel/descargarNota`;
    const agregarNotaCompartida = `${server}/pixeos/panel/agregarNotaCompartida`;
    const eliminarNotaCompartida = `${server}/pixeos/panel/eliminarNotaCompartida`;
    const buscarUsuariosCompartenNota = `${server}/pixeos/panel/buscarUsuariosCompartenNota`;
    const enviarNotaACorreo = `${server}/pixeos/panel/enviarNotaACorreo`;

    return {
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
        enviarNotaACorreo
    }
}


export function taskRoutes(){
    const urlMostrar = `${server}/pixeos/panel/tasks`;
    const urlCrear = `${server}/pixeos/panel/createTask`;
    const urlEditar = `${server}/pixeos/panel/updateTask`;
    const urlCompletar = `${server}/pixeos/panel/completeTask`;
    const urlEliminar = `${server}/pixeos/panel/eliminateTask`;
    const urlEliminarTodo = `${server}/pixeos/panel/eliminateAllTasks`;
    const urlPorcentaje = `${server}/pixeos/panel/percentagem`;

    return{
        urlMostrar,
        urlCrear,
        urlEditar,
        urlCompletar,
        urlEliminar,
        urlEliminarTodo,
        urlPorcentaje
    }
}


export function noteConstants() {
    const formulario = document.querySelector('#formularioModalCrearEditar');
    const crear = document.querySelector('.crear');
    const nombre = document.querySelector('#nombre');
    const tituloNota = document.querySelector('.tituloNota');
    const body = document.getElementsByTagName("body")[ 0 ];
    const botonCrearEditar = document.querySelector('#CrearEditarNota');
    const proyectos = document.querySelector('.proyectos');
    const tituloCrear = document.getElementById('tituloCrear');
    const descripcionCrear = document.getElementById('descripcionCrear');
    const fechaCrear = document.getElementById("fechaCrear");
    const tipoNotificacion = document.getElementById("notif");
    const descripcionCaracteresInput = document.querySelector('#descripcionCaracteresInput');
    const nombreCaracteresInput = document.querySelector('#nombreCaracteresInput');
    const descripcionCaracteresTextArea = document.querySelector('#descripcionCaracteresTextArea');
    const radioNotas = document.querySelectorAll('.radioNota');

    return {
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
    }

}

export function taskConstants(){
    const contenedor = document.querySelector('#tareas');
    const botonTareas = document.querySelector('#botonTareas');
    const body = document.getElementsByTagName("body")[ 0 ];
    const btnEliminarTodo = document.getElementById('btnEliminarTodo');
    const descripcionTarea = document.querySelector('.descripcionTarea');
    const iconoNotificacionSi = document.querySelector('.iconoNotificacion__si');
    const iconoNotificacionNo = document.querySelector('.iconoNotificacion__no');
    const descripcionCaracteresInput = document.querySelector('#descripcionCaracteresInput');
    const descripcionCaracteresTextArea = document.querySelector('#descripcionCaracteresTextArea');
    const iconoNombre = document.querySelector('.icono--orden__nombre');
    const iconoCalendario = document.querySelector('.icono--orden__calendario');
    const maximoTextArea = 1500;
    const maximoInput = 40;
    const formulario = document.querySelector('form');
    const modalTareaCrearEditar = new bootstrap.Modal(document.getElementById('modalTareaCrearEditar'), true);
    const modalTareaMostrar = new bootstrap.Modal(document.getElementById('modalTareaMostrar'), true);
    const tituloCrearEditar = document.getElementById('tituloCrearEditar');
    const descripcionCrearEditar = document.getElementById('descripcionCrearEditar');
    const fechaCrearEditar = document.getElementById("fechaCrearEditar");
    const tituloMostrar = document.getElementById('tituloMostrar');
    const fechaMostrar = document.getElementById("fechaMostrar");
    const descripcionMostrar = document.getElementById('descripcionMostrar');
    const tipoNotificacion = document.getElementById("notif");

    return {
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
    }
}

export function darkMode(){
    const urlFondo = `${server}/pixeos/panel/obtenerFondo`;
    const urlCambiarFondo = `${server}/pixeos/panel/cambiarFondo`;
    const btnFondo = document.getElementById("fondo") ? document.getElementById("fondo") : '';
    const root = document.querySelector(":root");

    return{
        urlFondo,
        urlCambiarFondo,
        btnFondo,
        root
    }
}
