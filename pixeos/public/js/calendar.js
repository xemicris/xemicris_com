import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();

let mesActual = (new Date().getMonth() + 1).toString();
let anoActual = (new Date().getFullYear());
let anterior = document.getElementById('anterior');
let siguiente = document.getElementById('siguiente');
const main = document.querySelector('.main');
let dias;
let diaClicado;
let ventanasModales;
anterior.addEventListener('click', reducirMes);
siguiente.addEventListener('click', aumentarMes);

toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-center",
    "onclick": null,
    "preventDuplicates": true,
    "preventOpenDuplicates": true,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "0",
    "extendedTimeOut": "0",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "hide",
    "tapToDismiss": true
}

var wrap, label,
    months = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];

function reducirMes() {
    if (mesActual.substring(0, 1) === '0') {
        mesActual = mesActual.slice(1, 2);
    }
    mesActual = mesActual - 1;
    if (mesActual < 1) {
        mesActual = 12;
        anoActual = anoActual - 1;
    }

    mostrarTareasEnCalendario();
}

function aumentarMes() {
    if (mesActual.substring(0, 1) === '0') {
        mesActual = (mesActual.slice(1, 2));
    }

    mesActual = Number(mesActual) + 1;
    mesActual.toString();
    if (mesActual > 12) {
        mesActual = 1;
        anoActual = anoActual + 1;
    }
    mostrarTareasEnCalendario();
}

function init(newWrap) {
    wrap = $(newWrap || "#calendario");
    label = wrap.find("#label");
    wrap.find("#anterior").bind("click.calendar", function () { switchMonth(false); });
    wrap.find("#siguiente").bind("click.calendar", function () { switchMonth(true); });
    label.bind("click", function () { switchMonth(null, new Date().getMonth(), new Date().getFullYear()); });
    label.click();
    mostrarTareasEnCalendario();
}

function switchMonth(next, month, year) {

    var curr = label.text().trim().split(" "), calendar, tempYear = parseInt(curr[ 1 ], 10);
    month = month || ((next) ? ((curr[ 0 ] === "Diciembre") ? 0 : months.indexOf(curr[ 0 ]) + 1) : ((curr[ 0 ] === "Enero") ? 11 : months.indexOf(curr[ 0 ]) - 1));
    year = year || ((next && month === 0) ? tempYear + 1 : (!next && month === 11) ? tempYear - 1 : tempYear);

    calendar = createCal(year, month);
    $("#calendario_grid", wrap)
        .find(".actual")
        .removeClass("actual")
        .addClass("temp")
        .end()
        .prepend(calendar.calendar())
        .find(".temp")
        .fadeOut(1, function () { $(this).remove(); });

    $('#label').text(calendar.label);

    dias = document.querySelectorAll(".dia");
}

function createCal(year, month) {
    var day = 1, i, j, haveDays = true,
        startDay = new Date(year, month, day).getDay(),
        daysInMonths = [ 31, (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ],
        calendar = [];

    if (createCal.cache[ year ]) {
        if (createCal.cache[ year ][ month ]) {
            return createCal.cache[ year ][ month ];
        }
    } else {
        createCal.cache[ year ] = {};
    }
    i = 0;
    while (haveDays) {
        calendar[ i ] = [];
        for (j = 0; j < 7; j++) {
            if (i === 0) {
                if (j + 1 === startDay) {
                    calendar[ i ][ j ] = day++;
                    startDay++;
                }
            } else if (day <= daysInMonths[ month ]) {
                calendar[ i ][ j ] = day++;
            } else {
                calendar[ i ][ j ] = "";
                haveDays = false;
            }
            if (day > daysInMonths[ month ]) {
                haveDays = false;
            }
        }
        i++;
    }
    if (calendar[ 5 ]) {
        for (i = 0; i < calendar[ 5 ].length; i++) {
            if (calendar[ 5 ][ i ] !== "") {
                calendar[ 4 ][ i ] = "<span>" + calendar[ 4 ][ i ] + "</span><span>" + calendar[ 5 ][ i ] + "</span>";
            }
        }
        calendar = calendar.slice(0, 5);
    }

    for (i = 0; i < calendar.length; i++) {
        calendar[ i ] = "<tr><td>" + calendar[ i ].join("</td><td>") + "</td></tr>";
    }
    calendar = $("<table>" + calendar.join("") + "</table>").addClass("actual");

    $("td:empty", calendar).addClass("vacio");

    $("td", calendar).addClass("dia");

    if (month === new Date().getMonth()) {
        $('td', calendar).filter(function () { return $(this).text() === new Date().getDate().toString(); }).addClass("hoy");
    }
    createCal.cache[ year ][ month ] = { calendar: function () { return calendar.clone() }, label: months[ month ] + " " + year };

    dias = document.querySelectorAll(".dia");

    return createCal.cache[ year ][ month ];
}

createCal.cache = {};

/**
 * Método que mostrar tareas en el calendario
 */
async function obtenerTareas() {
    //declaración de variables
    let fechasTareas = [];
    let nombreTareas = [];
    let descripcionTareas = [];
    let estado = [];
    let id = [];

    //petición
    let peticion = await fetch(`${server}/pixeos/panel/mostrarTareasCalendario`, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
    });
    let respuestas = await peticion.json();

    //Se ha actualizado
    if (respuestas) {

        for (let respuesta in respuestas) {
            id.push(respuestas[ respuesta ][ 'id' ]);
            fechasTareas.push(respuestas[ respuesta ][ 'fecha' ]);
            nombreTareas.push(respuestas[ respuesta ][ 'nombreTarea' ]);
            descripcionTareas.push(respuestas[ respuesta ][ 'descripcionTarea' ]);
            estado.push(respuestas[ respuesta ][ 'estado' ]);
        }

    }
    //quitar duplicados
    // const dataArr = new Set(fechasTareas);
    // let resultado = [...dataArr];
    let resultado = {
        "id": id,
        "fechaTareas": fechasTareas,
        "nombreTareas": nombreTareas,
        "descripcionTareas": descripcionTareas,
        "estado": estado,
    }
    return resultado;
}

async function mostrarTareasEnCalendario() {
    let tareas = await obtenerTareas();

    if (mesActual < 10) {
        mesActual = "0" + mesActual;
    } else {
        mesActual = "" + mesActual;
    }

    let di;

    if (tareas) {
        tareas.fechaTareas.forEach(tarea => {
            if(tarea !== null){
                dias.forEach(dia => {
                    if (dia.textContent < 10) {
                        di += "0" + dia.textContent;
                    } else {
                        di += dia.textContent;
                    }
    
                   let m = tarea.substring(5, 7);
                   let d = tarea.substring(8, tarea.length);
                   let a = tarea.substring(0, 4);
    
                    if (anoActual == a && mesActual == m && di == d) {
                        dia.classList.add('tarea-calendario');
                        dia.addEventListener('click', tareasModal); 
                    }
                    di = "";
                })
            }
        })
    }
}

const tareasModal = async (e) => {
    let nombresFechas = [];
    let nsFs = [];
    let diaTarea;
    let mesTarea;
    let nombreTarea = '';
    diaClicado = e.target.textContent;

    if (diaClicado < 10) {
        diaClicado = "0" + diaClicado;
    }

    if (diaClicado) {

        let tareas = await obtenerTareas();

        for (let i = 0; i < tareas.fechaTareas.length; i++) {
            //Formato esperado(string): 1judías10-1zumo27-0reloj27-
            nombresFechas += tareas.estado[ i ] + tareas.nombreTareas[ i ] + tareas.fechaTareas[ i ] + "|";
        }

        //Formato esperado(array): 1: "0compresor12"  2: "0compra dia 5 de septiembre05"
        nsFs = (nombresFechas.split("|")).reverse();
        nsFs.forEach(nF => {
            diaTarea = nF.substring(nF.length - 2);
            mesTarea = (nF.substring(nF.length - 5)).substring(0, 2);
            nombreTarea = nF.substring(1, nF.length - 10);
            if (diaClicado == diaTarea && mesActual == mesTarea) {
                if (nF.substring(0, 1) == 0) {
                    toastr.info(nombreTarea, 'TAREA');
                } else {
                    toastr.info(nombreTarea, 'TAREA', {
                        messageClass: "tarea_completada"
                    });
                }
            }
        })

        ventanasModales = document.querySelectorAll('.toast');
        insertarId();
        crearBotonCerrarModales();
        ventanasModales.forEach(ventanaModal => {
            ventanaModal.addEventListener("click", enviarId);
            ventanaModal.children[0].addEventListener('click', function(){
                ventanasModales = document.querySelectorAll('.toast');
                if(ventanasModales.length -1 < 1){
                    cerrarModales();
                }
            });
            
        });
    }
}

const insertarId = async () => {
    //declaración de variables
    let tareas = await obtenerTareas();
    let fecha = "";
    let diaTarea = '';
    tareas.fechaTareas.forEach(fechaTarea => {
        if(fechaTarea != null){
            diaTarea = fechaTarea.substring(fechaTarea.length - 2);
            if (diaClicado == diaTarea) {
                fecha = fechaTarea;
            }
        } 
    })

    if(fecha !== ""){
        const datos = new FormData();
        datos.append('fecha', fecha);

        //petición
        let peticion = await fetch(`${server}/pixeos/panel/obtenerIdsSegunFecha`, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let idsTareas = await peticion.json();
        for (let i = 0; i < idsTareas.length; i++) {
            ventanasModales[ i ].id = idsTareas[ i ].id;
        }
    }
}

const enviarId = async (e) => {

    //id obtenido de la ventana modal generada dinámicamente (toastr)
    let id;
    id = (e.target.parentNode.getAttribute("id") == "toast-container") ? e.target.getAttribute("id") : id = e.target.parentNode.getAttribute("id");

    if(id != ""){
        const datos = new FormData();
        datos.append('idTarea', id);

        //petición
        let peticion = await fetch(`${server}/pixeos/panel/llevarAProyectoDesdeCalendario`, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let respuesta = await peticion.json();
        location.href = `${server}/pixeos/panel/project/${respuesta[ "urlProyecto" ]}`;
    }
}

const crearBotonCerrarModales = () => {
    if (!document.querySelector('.botonCerrarModales')) {
        const boton = document.createElement('button');
        boton.setAttribute('class', 'botonCerrarModales')
        boton.textContent = "Cerrar";
        main.insertBefore(boton, main.firstChild);

        const botonCerrarTodosModales = document.querySelector('.botonCerrarModales');
        botonCerrarTodosModales.addEventListener('click', cerrarModales);
    }

}

const cerrarModales = () => {
    const botonCerrarTodosModales = document.querySelector('.botonCerrarModales');
    window.toastr.clear();
    setTimeout(() => {
        main.removeChild(botonCerrarTodosModales);
    }, 300);
}

init();
createCal();



