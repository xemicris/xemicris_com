import { getProjectRoute } from "./getProjectRoutes.js";
const server = getProjectRoute();

//Declarar variables
const urlEstadisticas = `${server}/pixeos/panel/statistics`;
const estadistic = document.getElementById('estadistica').getContext("2d");

/**
 * Función que añade o quita el cursor pointer al pasar por encima de las barras
 * @param {object} e 
 * @param {array} chartElement 
 */
const hover = (e, chartElement) =>{
    e.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
}

/**
 * Función que genera las estadísticas con Chart.js
 */
function estadisticas() {
    //petición
    fetch(urlEstadisticas)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            //generación de estadísticas
            var tabla = new Chart(estadistic, {
                type: "bar",
                data: {
                    labels: [ 'Notas' ],
                    datasets: [
                        {
                            label: 'Sin completar',
                            data: [ respuesta[ 'totales' ] ],
                            backgroundColor: [
                                'rgb(206, 39, 39)',
                            ],
                            borderColor: '#000',
                            borderWidth: 2,
                            borderRadius: 5,
                            hoverBackgroundColor: 'rgb(160, 32, 32)',
                        },
                        {
                            label: 'Completadas',
                            data: [ respuesta[ 'completados' ] ],
                            backgroundColor: [
                                'rgb(0, 255, 0)'
                            ],
                            borderColor: '#000',
                            borderWidth: 2,
                            borderRadius: 5,
                            hoverBackgroundColor: 'rgb(17, 185, 17)',
                            
                        }
                    ]
                },
                options: {
                    responsive: true,
                    aspectRatio: 1,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                    onHover: hover
                }
            })
        })

}

estadisticas();