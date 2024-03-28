var entrada;
var numeros = [];
var numeros_pares =[];
var numeros_impares = [];
var numeros_ordenados = [];

function guardarArray(){

    entrada = document.getElementById("entrada").value;
    /*La función predefinida isNaN() me permitirá saber si el 
    dato introducido es un número o no. Si no lo es devuelve 
    true y ejecuta el alert*/
    if(isNaN(entrada)){
        alert("El valor introducido no es un valor numérico");
        //vacío el input con con id="entrada"
        document.getElementById("entrada").value = "";
        //pone el foco en el input con id="entrada"
        document.getElementById("entrada").focus();
    //Si es un número es entero, el resto de dividirlo por 1 es 0  
    }else if(entrada % 1 == 0){
        //añado cada valor en la última posición con el método push()
        numeros.push(entrada);
        var entrada = document.getElementById("entrada").value = "";
        document.getElementById("entrada").focus();
    }else{
        /*si no es un entero ejecuta un alert, vacía el input con 
        id="entrada" y pone el foco*/
        alert("El valor introducido no es un número entero");
        var entrada = document.getElementById("entrada").value = "";
        document.getElementById("entrada").focus();
    }
}    
//función que ordena los números
function ordenar(){
    /*ordena los números con el método sort() y los almacena en el 
    array numeros_ordenados*/
    numeros_ordenados = numeros.sort(function(a,b){return a - b});
    //muestra los números en el input con id="ordenados"
    document.getElementById("ordenados").value = numeros_ordenados;
    //Recorre el array hasta su longitud con la propiedad length
    for (var i = 0; i<numeros_ordenados.length; i++){
        //Si son par, los almacena en el array numeros_pares
        if(numeros_ordenados[i] %2 == 0){
            numeros_pares.push(numeros_ordenados[i]);
        //sino, en el array numeros_impares
        }else{
            numeros_impares.push(numeros_ordenados[i]);
        }
    }
    //Muestra los arrays en los input correspondientes
    document.getElementById("pares").value = numeros_pares;
    document.getElementById("impares").value = numeros_impares;
}
//función que se ejecuta al hacer clic en el botón mostrar
function mostrar(){
    //recorre el array numeros y los muestra en el input con id="arr"
    for (i=0; i<numeros.length; i++){
        document.getElementById("arr").value = numeros;
    }  
    //ejecuta la función setTimeout() con una espera de 10 ms
    setTimeout(ordenar,10);
    //almacena mi nombre y apellidos en la variable nombre
    var nombre = document.getElementById("nombre");
    //si el array numeros tiene números almacenados
    if(numeros.length != 0){
        //muestra mi nombre y apellidos
        nombre.style.display='';
        //muestra el botón de reinciar
        reinicio.style.display='';
        //oculta los botones Guardar y Mostrar
        guarda.style.display='none';
        muestra.style.display='none';  
    } 
}
//reinicia todo al estado inicial
function reiniciar(){
    //con la propiedad length = 0 reinicia los arrays
    numeros.length = 0;
    numeros_ordenados.length = 0;
    numeros_pares.length = 0;
    numeros_impares.length = 0;
    //hace visible los botones Guardar y Mostrar
    guarda.style.display='';
    muestra.style.display='';
    //Oculta el botón reinicio y mi nombre
    reinicio.style.display='none'; 
    nombre.style.display='none';
    //borra todos los valores mostrados en los inputs
    document.getElementById("arr").value = "";
    document.getElementById("ordenados").value = "";
    document.getElementById("pares").value = "";
    document.getElementById("impares").value = "";
    document.getElementById("entrada").focus();

}