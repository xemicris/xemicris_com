//Mostrar archivo imagen a subir
let nombreImagen = null;
if(document.getElementById('imagen')){
    document.getElementById('imagen').onchange = function () {
        nombreImagen = document.getElementById('imagen').files[0].name;
        if(nombreImagen != null){
            foco();
        }else{
            sinfoco();
        }
        document.getElementById('nombre-imagen').textContent = "Imagen selecionada";
    }
}

var imagen = document.getElementById('imagen');
var nombre = document.querySelectorAll('.entrada');



/**
 * Funcion que colorea el botón al hacer foco en uno de los inputs
 */
function colorBotonActualizar() {
    nombre.forEach(function (userItem) {
        userItem.addEventListener('focus', foco);
        userItem.addEventListener('blur', sinfoco);
        imagen.addEventListener('click', foco);
        imagen.addEventListener('click', sinfocoImagen)

    });
};

/**
 * Función que añade estilo
 */
function foco() {
    document.getElementById('actualizar').style.background = "#1616ff";
}

/**
 * Función que quita estilo
 */
function sinfoco() {
    document.getElementById('actualizar').style.background = "";
}

colorBotonActualizar();

/**
 * Función que llama a sinfoco para que quite el estilo cuando se hace foco en el documento
 */
function sinfocoImagen() {
    document.body.onfocus = sinfoco;
}










