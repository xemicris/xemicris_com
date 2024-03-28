/*DATOS*/
//Contador
let tiempo = new Date();
let contadorSegundos = 0;

//modificación DOM
let contenedor = document.querySelector('.contenedor');
let dinosaurio = document.querySelector('.dinosaurio');
let puntuacionTexto = document.querySelector('.puntuacion');
let suelo = document.querySelector('.suelo');
let finJuego = document.getElementById('finJuego');
let obstaculo;
let arrancar = document.querySelector(".arrancar");
let reiniciar = document.querySelector(".reiniciar");
let puntosFinales = document.getElementById("puntuacionFinal");
reiniciar.style.display = 'none';

//posicionamiento
let sueloX = 0;
let sueloY = 22;
let velocidadY = 0;
let impulso = 900;
let gravedad = 3000;
let posDinoX = 42;
let posDinoY = sueloY;
let velocidadEscenario = 500
let velJuego = 1;
let puntuacion = 0;
let parado = true;
let saltando = false;

//obstaculos
let tiempoHastaObstaculo = 2;
let tiempoObstaculoMin = 0.7;
let tiempoObstaculoMax = 1.8;
let posObstaculoY = 16;
let obstaculos = [];
let tipoCactus;

//cielo
let nubes = [];
let nube;
let tiempoHastaNube = 3;
let tiempoNubeMin = 0.3;
let tiempoNubeMax = 2.1;


/**FUNCIONES */
animacionInicio(); 

function es_tactil() {
    return !!('ontouchstart' in window);
  }

function inicializar(){

    //Reiniciar datos
    velocidadEscenario = 1280/3;
    puntuacionTexto.innerHTML = 0;
    puntuacion = 0;

    //Añadir o quitar clases
    dinosaurio.classList.add("dinosaurio");
    puntuacionTexto.classList.remove('difuminar');
    dinosaurio.classList.add("patas-arriba-abajo");

    //Eventos
    document.addEventListener("keydown", teclaEspaciadora);
    contenedor.addEventListener("touchstart", teclaEspaciadora);
}
function actualizar(){

    if(parado) return;
    moverSuelo();
    moverDinosaurio();
    tiempoCrearObstaculos();
    moverObstaculos();
    detectarColision();
    tiempoCrearNubes();
    moverNubes();

    velocidadY -= gravedad * contadorSegundos;
}

function animacionInicio(){
    setTimeout(() => {
        dinosaurio.classList.remove('dinosaurio_salto');
      }, "1500");
}

function calcularDesplazamientoSuelo(){
    return velocidadEscenario * contadorSegundos * velJuego;
}

function moverSuelo(){
    sueloX += calcularDesplazamientoSuelo();
    suelo.style.left = -(sueloX % contenedor.clientWidth) + "px";
}

function teclaEspaciadora(e){
    if(e.keyCode == 32 || es_tactil()){
        saltar();
    }
}

function saltar(){
    if(posDinoY === sueloY){
        saltando = true;
        velocidadY = impulso;
        dinosaurio.classList.remove("patas-arriba-abajo");
    }
}

function moverDinosaurio(){
    posDinoY += velocidadY * contadorSegundos;
    if(posDinoY < sueloY){
        tocarSuelo();
    }
    dinosaurio.style.bottom= posDinoY + "px";
}

function tocarSuelo(){
    posDinoY = sueloY;
    velocidadY = 0;
    if(saltando){
        dinosaurio.classList.add("patas-arriba-abajo")
    }
    saltando = false;
}

function tiempoCrearObstaculos(){
    tiempoHastaObstaculo -= contadorSegundos;

    if(tiempoHastaObstaculo < 0){
        crearObstaculos();
    }
}

function tiempoCrearNubes(){
    tiempoHastaNube -= contadorSegundos;

    if(tiempoHastaNube <= 0){
        crearNubes();
    }
}

function crearObstaculos(){
    tipoCactus = Math.round(Math.random());
    obstaculo = document.createElement('div');
    contenedor.appendChild(obstaculo);
    if(tipoCactus === 0){
        obstaculo.classList.add('cactus_grande');
    }else{
        obstaculo.classList.add('cactus_pequeno');
    }
    obstaculo.posX = contenedor.clientWidth;
    obstaculo.style.left = contenedor.clientWidth + "px";
    obstaculos.push(obstaculo);
    tiempoHastaObstaculo = tiempoObstaculoMin + Math.random() * (tiempoObstaculoMax - tiempoObstaculoMin) / velJuego;
}

function moverObstaculos(){
    for(let i = obstaculos.length -1; i>=0; i--){
        if(obstaculos[i].posX <= obstaculos[i].clientWidth - 150){
            obstaculos[i].parentNode.removeChild(obstaculos[i]);
            obstaculos.splice(i, 1);
            ganarPuntos();
        }else{
            obstaculos[i].posX -= calcularDesplazamientoSuelo();
            obstaculos[i].style.left = obstaculos[i].posX + "px";
        }
    }
}

function crearNubes(){
    nube = document.createElement('div');
    contenedor.appendChild(nube);
    nube.classList.add('nube');

    nube.posX = contenedor.clientWidth;
    nube.style.left = contenedor.clientWidth + "px";
    nubes.push(nube);
    tiempoHastaNube = tiempoNubeMin + Math.random() * (tiempoNubeMax - tiempoNubeMin) / velJuego;
}

function moverNubes(){
    for(let i = nubes.length -1; i>=0; i--){
        if(nubes[i].posX <= nubes[i].clientWidth - 150){
            nubes[i].parentNode.removeChild(nubes[i]);
            nubes.splice(i, 1);
        }else{
            nubes[i].posX -= calcularDesplazamientoSuelo();
            nubes[i].style.left = nubes[i].posX + "px";
        }
    }
}

function detectarColision(){
    for(let i = 0; i < obstaculos.length; i++){
        if(obstaculos[i].posX > posDinoX + dinosaurio.clientWidth){
            break;
        }else{
            if(hayColision(dinosaurio, obstaculos[i], 10, 30, 15, 20)){
                estrellarse();
            }
        }
    }
}

function hayColision(a, b, paddingTop, paddingRight, paddingBottom, paddingLeft) {
    var aRect = a.getBoundingClientRect();
    var bRect = b.getBoundingClientRect();

    return !(
        ((aRect.top + aRect.height - paddingBottom) < (bRect.top)) ||
        (aRect.top + paddingTop > (bRect.top + bRect.height)) ||
        ((aRect.left + aRect.width - paddingRight) < bRect.left) ||
        (aRect.left + paddingLeft > (bRect.left + bRect.width))
    );
}

function ganarPuntos(){
    puntuacion++;
    puntuacionTexto.innerHTML = puntuacion;
}
reiniciar.addEventListener('click', reiniciarJuego);

function reiniciarJuego(){
    parado = true;
    velocidadEscenario = 0
    obstaculos.length = 0;
    let cactusGrande = document.querySelectorAll('.cactus_grande');
    let cactusPequeno = document.querySelectorAll('.cactus_pequeno');
    let nubes = document.querySelectorAll('.nube');

    cactusGrande.forEach((cat) => {
        cat.classList.remove('cactus_grande');
    });
    cactusPequeno.forEach((cat) => {
        cat.classList.remove('cactus_pequeno');
    });
    nubes.forEach((nube) => {
        nube.classList.remove('nube');
    });
    dinosaurio.classList.remove("patas-arriba-abajo");
    dinosaurio.classList.remove("dinosaurio");
    posDinoX = 42;
    tiempoHastaObstaculo = 2;
    posObstaculoY = 16;
    finJuego.classList.add('finJuego');
    reiniciar.style.display = 'none';
    arrancar.style.display = 'block';
    puntuacionTexto.classList.add('difuminar');
    puntuacionFinal();
}

function estrellarse(){
    dinosaurio.classList.add("dinosaurio-choque");
    puntuacionTexto.innerHTML = puntuacion;
    reiniciarJuego();
}

function puntuacionFinal(){
    puntosFinales.innerHTML = "Puntuación Final: " + puntuacion;  
}

arrancar.addEventListener('click', inicio);

function inicio(){
    parado = false;
    tiempo = new Date();
    puntosFinales.innerHTML = " ";
    arrancar.style.display = 'none';
    reiniciar.style.display = 'block';
    let claseFinJuego = document.querySelector('.finJuego');
    if(claseFinJuego){
        finJuego.classList.remove('finJuego');
    }
    inicializar();
    loop();
}

function loop(){
    contadorSegundos = (new Date() - tiempo) / 1000;
    tiempo = new Date();
    actualizar()
    requestAnimationFrame(loop);
}

