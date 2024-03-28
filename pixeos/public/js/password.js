import { getProjectRoute } from "./getProjectRoutes.js";

const server = getProjectRoute();

const ojo = document.querySelectorAll(".ojo-contrasena");
const password = document.querySelectorAll(".contrasena");
if(ojo){
    ojo.forEach(element =>{
        element.addEventListener('click', mostrarOcultarContrasena);
    });
    
}

function mostrarOcultarContrasena(e){
    const tachado = e.target.alt;
    if(tachado == "icono ojo tachado"){
        e.target.src = `${server}/pixeos/public/images/ojo-no-tachado.svg`;
        e.target.alt = "icono ojo no tachado";
        e.target.previousSibling.parentNode.children[0].type = "text";

    }else if(tachado == "icono ojo no tachado"){
        e.target.src = `${server}/pixeos/public/images/ojo-tachado.svg`;
        e.target.alt = "icono ojo tachado";
        e.target.previousSibling.parentNode.children[0].type = "password";
    }
}

