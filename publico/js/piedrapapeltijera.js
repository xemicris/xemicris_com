//Roseanne Aline Souza da Silva
// Este array no se puede modificar,
var posibilidades = ["piedra", "papel", "tijera"];

let body = document.getElementsByTagName("body")[0];
var imagenes = document.getElementsByClassName('ima');
var imagenMaquina = document.getElementsByTagName('img')[4];
let seleccionJugador;
let puntuacionJugador = document.querySelector(".puntuacion__jugador");
let puntuacionMaquina = document.querySelector(".puntuacion__maquina");
let puntosJugador = 0;
let puntosMaquina = 0;
let fin = document.querySelector(".fin");
let resultado = document.querySelector(".resultado");
let botonJugar = document.querySelector(".boton__jugar");
let bloqueImagenes = document.querySelector(".imagenes");
let botonReiniciar = document.querySelector(".contenedor");
let alturaCargar = bloqueImagenes.clientHeight;
let alturaJugar = botonReiniciar.clientHeight;
console.log(alturaJugar)
console.log(alturaCargar)



function fadeOut(elemento) {
    elemento.style.opacity = 1;
    (function fade() {
        // cambiando el valor 0.1 se puede afectar la velocidad del efecto
        if ((elemento.style.opacity -= 0.05) < 0) {
        elemento.style.display = "none";
      } else {
        requestAnimationFrame(fade);
      }
    })();
  }

  function fadeIn(elemento) {
    elemento.style.opacity = 0;
    elemento.style.display = "flex";
    (function fade() {
      let val = parseFloat(elemento.style.opacity);
      // cambiando el valor 0.01 se puede afectar la velocidad del efecto
      if (!((val += 0.005) > 1)) { 
        elemento.style.opacity = val;
        requestAnimationFrame(fade);
      }
    })();
  }


function cargarImagenes(){
    for (var i = 0; i <posibilidades.length; i++){
        imagenes[i].src = "publico/imagenes/piedrapapeltijera/" + posibilidades[i] + "Jugador.png";
        imagenes[i].alt = posibilidades[i];
        imagenes[i].addEventListener("click", ponerBorde, false);
        imagenes[i].addEventListener("click", jugar, false);
        seleccionJugador = posibilidades[0];
    }
}

function ponerBorde(evento){
	for (var j = 0; j <posibilidades.length ; j++) {
		if (imagenes[j] == evento.target) {
            imagenes[j].classList.add("seleccionado");
            imagenes[j].classList.remove("noSeleccionado");
		}else{
            imagenes[j].classList.remove("seleccionado");
            imagenes[j].classList.add("noSeleccionado");
        } 
	} 
}

function comienzoPartida () {
    var nombre = document.getElementsByTagName('input')[0].value;
    var partidas = document.getElementsByTagName('input')[1].value;
    var etiquetaJugador = document.getElementsByTagName('input')[0];
    var etiquetaPartidas = document.getElementsByTagName('input')[1];
    const validarNombre = /^\D{1}.{3,}/g;
    const validarPartida = /^[1-9]/g;
	if (nombreVerdadero = validarNombre.test(nombre)) {
		etiquetaJugador.classList.remove("fondoRojo");
	} else {
		etiquetaJugador.classList.add("fondoRojo"); 
	}
    if (partidaVerdadera = partidas>0 && validarPartida.test(partidas)) {
        etiquetaPartidas.classList.remove("fondoRojo");
    }else {
        etiquetaPartidas.classList.add("fondoRojo"); 
    }
    if(nombreVerdadero && partidaVerdadera){
        etiquetaJugador.disabled = true;
        etiquetaPartidas.disabled = true;
        botonJugar.disabled = false;
        total.innerHTML = partidas;
        window.scrollTo(0, alturaCargar, {behavior: 'smooth'});
    }
}

function tiradaAleatoria() {
    for (var i = 0; i <posibilidades.length; i++){
        var numeroAleatorio = Math.floor(Math.random() * posibilidades.length);
        imagenMaquina.src = "publico/imagenes/piedrapapeltijera/" + posibilidades[numeroAleatorio] + "Ordenador.png";
        imagenMaquina.alt = posibilidades[numeroAleatorio];
    }
    return imagenMaquina.alt;
}

function jugar(evento){
    window.scrollTo(0, alturaJugar, {behavior: 'smooth'});
	for (var j = 0; j < posibilidades.length; j++) {
		if (imagenes[j] == evento.target) {
            seleccionJugador = imagenes[j].alt; 
            imagenes[i].removeEventListener("click", jugar, false);
            //imagenes[i].preventDefault;
        } 
	}
    var nombre = document.getElementsByTagName('input')[0].value;
    if (Number(total.innerHTML) == Number(actual.innerHTML)){ 
        if(Number(total.innerHTML) == 0 && Number(actual.innerHTML) == 0){
            botonJugar.disabled = true;
        }else{
                fadeOut(bloqueImagenes);
            if(puntosJugador > puntosMaquina){
                resultado.innerHTML = "Gana " + nombre;
            }else if(puntosJugador == puntosMaquina){
                resultado.innerHTML = "Empate";
            }else{
                resultado.innerHTML = "Gana la máquina";
            }
        }
    }else{
        seleccionMaquina = tiradaAleatoria();
        actual.innerHTML = Number(actual.innerHTML) +1;

        if(seleccionJugador == posibilidades[0] && seleccionMaquina == posibilidades[2]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML = nombre + ": " + puntosJugador;

        }else if(seleccionJugador ==  posibilidades[0] && seleccionMaquina ==  posibilidades[1]){
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " + puntosMaquina;

        }else if (seleccionJugador ==  posibilidades[0] && seleccionMaquina ==  posibilidades[0]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML = nombre + ": " + puntosJugador;
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " + puntosMaquina;
           
        }else if (seleccionJugador ==  posibilidades[1] && seleccionMaquina ==  posibilidades[2]){
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " +  puntosMaquina;
    
        }else if(seleccionJugador ==  posibilidades[1] && seleccionMaquina ==  posibilidades[1]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML = nombre + ": " +  puntosJugador;
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " +puntosMaquina;
           
        }else if (seleccionJugador ==  posibilidades[1] && seleccionMaquina ==  posibilidades[0]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML = nombre + ": " + puntosJugador;
            
        }else if (seleccionJugador ==  posibilidades[2] && seleccionMaquina ==  posibilidades[2]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML =  nombre + ": " + puntosJugador;
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " + puntosMaquina;
             
        }else if(seleccionJugador ==  posibilidades[2] && seleccionMaquina ==  posibilidades[1]){
            puntosJugador += 1;
            puntuacionJugador.innerHTML = nombre + ": " + puntosJugador;
            
        }else if (seleccionJugador ==  posibilidades[2] && seleccionMaquina ==  posibilidades[0]){
            puntosMaquina += 1;
            puntuacionMaquina.innerHTML = "máquina: " + puntosMaquina;
            
        }
    } 
}
 
function resetear() {
    var etiquetaJugador = document.getElementsByTagName('input')[0];
    var etiquetaPartidas = document.getElementsByTagName('input')[1];
    imagenMaquina.src = "publico/imagenes/piedrapapeltijera/robot.svg";
    etiquetaJugador.disabled = false;
    etiquetaPartidas.disabled = false;
    document.getElementsByTagName('input')[1].value = 0;
    total.innerHTML = 0;
    actual.innerHTML = 0;
    puntosJugador = 0;
    puntosMaquina = 0;
    puntuacionJugador.innerHTML = "";
    puntuacionMaquina.innerHTML = "";
    resultado.innerHTML = "";
    fadeIn(bloqueImagenes);
    
}

document.addEventListener("DOMContentLoaded", cargarImagenes, false);
document.getElementsByTagName('button')[0].addEventListener("click", comienzoPartida, true);
document.querySelector(".boton__jugar").addEventListener("click", jugar, false); 
document.getElementsByTagName('button')[2].addEventListener("click", resetear, true);




