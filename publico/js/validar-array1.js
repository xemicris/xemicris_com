
const ojo = document.querySelector(".ojo__contrasena");
const password = document.querySelector(".contrasena");

ojo.addEventListener('click', mostrarOcultarContrasena);


function mostrarOcultarContrasena(){
    const tachado = ojo.alt;
    if(tachado == "icono ojo tachado"){
        ojo.src = "publico/imagenes/validar/ojo-no-tachado.svg";
        ojo.alt = "icono ojo no tachado";
        password.type = "text";

    }else if(tachado == "icono ojo no tachado"){
        ojo.src = "publico/imagenes/validar/ojo-tachado.svg";
        ojo.alt = "icono ojo tachado";
        password.type = "password";
    }
}


/*función que devuelve true si los datos introducidos 
en los campos son correctos y false en otro caso*/
function validar(){
    /*en estas variables almaceno un valor booleano true o false
    proviniente de las funciones de validación*/
    var nombre = validarNombre();
    var contrasena = validarContrasena();
    //si ambas son true, devuelve true. Sino false
    if(nombre && contrasena){
        ventana();
        return true;
    }else{
        return false;
        
    }
}

//función que valida el nombre
function validarNombre(){
    //variables
    var comprobar = true;
    var mensajeError = "";
    var n = document.getElementById("usuario").value; 
    var dvN= document.getElementById("dusu");
    var error = document.getElementById("errorNombre");
    var errores = document.querySelector(".errores");
    //reseteo del borde y el mensaje de error
    dvN.style.border = "";
    error.innerHTML = "";
    //comprueba que el campo nombre no queda vacío antes de enviar
    if(/^$/.test(n)){   
        comprobar = false;
        mensajeError = "¡Atención!: Es obligatorio rellenar el campo usuario";
    //comprueba que no se introducen sólo espacios (caracteres en blanco)
    }else{
        if(/^\s+$/.test(n)){
            comprobar = false;
            mensajeError = "¡Atención!: el campo usuario "+
                            "no puede tener sólo espacios en blanco";
        //comprueba que no se introduce un número
        }else{
            if(/^\d+$/.test(n)){ 
                comprobar = false;
                mensajeError = "¡Atención!: El campo usuario no puede "+
                                "estar formado por números";
            }else{
                //comprueba si se ha introducido entre 3 y 12 letras en minúscula
                if(!/^([a-záéíóú]\s*){3,12}$/.test(n)){   
                    comprobar = false;
                    mensajeError = "¡Atención!: El campo usuario sólo puede contener"+
                        " letras en minúscula y entre 3 y 12 caracteres";
                    
                }else{
                    comprobar= true;
                }
            }     
        }      
    }
    /*si la comprobación es erronea (false) crea un borde rojo al rededor del campo 
    usuario, muestra un  mensaje de advertencia y devuelve false. Si la comprobación 
    es verdadera devueve true*/       
    if(!comprobar){
        dvN.style.border = "3px solid red";
        errores.style= "margin-bottom:-60px";
        error.innerHTML = mensajeError;
        return false;
    }
    return true;
}

//función que valida la contraseña
function validarContrasena(){
    //variables
    var comprobar = true;
    var mensajeError = "";
    var c = document.getElementById("contra").value; 
    var dvC= document.getElementById("dcon");
    var error = document.getElementById("errorContrasena");
    //reseteo del borde y mensaje de error
    dvC.style.border = "";
    error.innerHTML = "";
    //comprueba que el campo nombre no queda vacío antes de enviar
    if(/^$/.test(c)){  
        comprobar = false;
        mensajeError = "¡Atención!: Es obligatorio rellenar el campo contraseña";
    }else{
        //comprueba que no se introducen sólo espacios (caracteres en blanco)
        if(/^\s+$/.test(c)){
            comprobar = false;
            mensajeError = "¡Atención!: el campo contraseña no puede tener sólo"+
                        " espacios en blanco";
        }else{
            /*comprueba si se ha introducido 1 letra mayúscula + 
            un punto/coma/guión + 6 números y/o letras en minúscula*/
            if(!/^[A-Z](\.|\,|\-|)([a-z]|\d){6}$/.test(c)){
                comprobar = false;
                mensajeError = "¡Atención!: el campo constraseña debe tener el"+
                " siguiente formato:<br> 1 letra mayúscula + (./,/-) + 6 números"+
                " y/o letras(minúsucula)";
            }else{
                comprobar = true;
            }     
        }      
    }
    /*si la comprobación es erronea (false) crea un borde rojo al rededor del campo 
    contraseña, muestra un  mensaje de advertencia y devuelve false. Si la comprobación 
    es verdadera devueve true*/ 
    if(!comprobar){
        dvC.style.border = "3px solid red";
        error.innerHTML = mensajeError;
        return false;
    }
    return true;
}

function ventana(){

    // Obtenemos el tamaño dinamico y lo divimos en 4, obteniendo 1/4 de la panatalla.
    var height = (parseInt(window.innerHeight) / 2);
    var width = (parseInt(window.innerWidth) / 2);

    // Ajuste horizontal
    var x = parseInt((screen.width - width) / 2);
    // Ajustae vertical
    var y = parseInt((screen.height - height) / 2);
    // inicializamos un función de apertura de la ventana
    // No es necesario realizar más cálculos
    // Basta con incluir las variables donde corresponde
    window.open('https://xemicris.com/validar/array', 'Validación correcta',
        `scrollbars=yes
        width=${width}
        height=${height}
        top=${y}
        left=${x}
        Menubar=yes`
    );
}



