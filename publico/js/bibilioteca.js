$(document).ready(function () {
    $("input:text:visible:first").focus();

    $(".mostrar_sugerencias_libros").on('keyup', mostrar_sugerenciasLibros);
    $(".mostrar_sugerencias_autores").on('keyup', mostrar_sugerencias_autores);

    function mostrar_sugerenciasLibros() {

        let inputLibros = $(this).val();
        let url = "biblioteca/buscarLibros";

        if (inputLibros.length == 0) {
            document.getElementById("sugerenciasLibros").innerHTML = "";
            $("#libros").removeClass("ocultar");
            return;
        } else {
            var asyncRequest = new XMLHttpRequest();
            asyncRequest.open("POST", url, true);
            var datos = new FormData();
            datos.append('input', inputLibros);
            asyncRequest.send(datos);
            asyncRequest.onreadystatechange = cambioEstadoLibros;
           
            
            function cambioEstadoLibros() {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
                    $("#libros").addClass("ocultar");
                    document.getElementById("sugerenciasLibros").innerHTML = asyncRequest.responseText;
                }
            }
        }
    }

    function mostrar_sugerencias_autores() {

        let input = $(this).val();
        let url = "buscarAutores";

        if (input.length == 0) {
            document.getElementById("sugerenciasAutores").innerHTML = "";
            $("#autores").removeClass("ocultar");
            return;
        } else {
            var asyncRequest = new XMLHttpRequest();
            asyncRequest.open("POST", url, true);
            var datos = new FormData();
            datos.append('input', input);
            asyncRequest.send(datos);
            asyncRequest.onreadystatechange = cambioEstadoAutores;
           
            
            function cambioEstadoAutores() {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
                    $("#autores").addClass("ocultar");
                    document.getElementById("sugerenciasAutores").innerHTML = asyncRequest.responseText;
                }
            }
        }
    }
});
