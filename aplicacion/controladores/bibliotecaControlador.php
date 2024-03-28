<?php

class bibliotecaControlador extends Controlador{
    private $dominio;

    function __construct(){
        $this->dominio = detectarDominioBiblioteca();
    }

    function indice(){
        $conexion = new bibliotecaModelo();
        $libros = $conexion->todosLibros();

        $datos = [
            'titulo' => 'Biblioteca | Lista de libros',
            'libros' => $libros,
        ];
        Vista::renderizar('indice', $datos);
    }

    function buscarLibros(){

        $conexion = new bibliotecaModelo();
        $libros = $conexion->todosLibros();
        $entradaBuscador = $_POST['input'];
        $sugerencias = "";

        if($entradaBuscador != "" && es_texto($entradaBuscador)){
            $entradaBuscador = strtolower($entradaBuscador);
            $longitud = strlen($entradaBuscador);
            foreach($libros as $libro){
                if (stristr($entradaBuscador, substr($libro["titulo"], 0, $longitud))) {
                    $ids = $conexion->obtener_ids_libros($libro["titulo"]);
                    foreach($ids as $id){
                        $sugerencias .=  "
                        <div id='libros2'>
                          <ul>
                            <div>
                              <li><a href='". $this->dominio . "biblioteca/libro/" . $id['id']. "'" . ">" .  $libro["titulo"] . "</a><br></li>
                            </div>
                          </ul>
                        </div>";
                    }
                }
            }
        }
        
        echo $sugerencias === "" ? "<ul><div class='noSugerencias'>No se encuentran sugerencias</div></ul>" : $sugerencias;  
    }

    function buscarAutores(){

        $conexion = new bibliotecaModelo();
        $autores = $conexion->todosAutores();
        $entradaBuscador = $_POST['input'];
        $sugerencias = "";

        if($entradaBuscador != "" && es_texto($entradaBuscador)){
            $entradaBuscador = strtolower($entradaBuscador);
            $longitud = strlen($entradaBuscador);
            foreach($autores as $autor){
                if (stristr($entradaBuscador, substr($autor["nombre"], 0, $longitud))) {
                    $ids = $conexion->obtener_ids_autores($autor["nombre"]);
                    foreach($ids as $id){
                        $sugerencias .=  "
                        <div id='libros2'>
                          <ul>
                            <div>
                              <li><a href='". $this->dominio . "biblioteca/autor/" . $id['id']. "'" . ">" .  $autor["nombre"] . " " . $autor["apellidos"] . "</a><br></li>
                            </div>
                          </ul>
                        </div>";
                    }
                }
            }
        }
        
        echo $sugerencias === "" ? "<ul><div class='noSugerencias'>No se encuentran sugerencias</div></ul>" : $sugerencias;  
    }

    
    function autores(){
        $conexion = new bibliotecaModelo();
        $autores = $conexion->todosAutores();

        $datos = [
            'titulo' => 'Biblioteca | Lista de Autores',
            'autores' => $autores,
        ];

        Vista::renderizar('autores', $datos);
    }

    function libro($parametro){
        $id = $parametro;
        $conexion = new bibliotecaModelo();
        $libros = $conexion->todosLibros();
        $datosLibro = $conexion->datos_libro($id);
       
        $datos = [
            'titulo' => 'Biblioteca | Libro',
            'libros' => $libros,
            'datosLibro' => $datosLibro
        ];

        Vista::renderizar('libro', $datos);

    }

    function autor($parametro){
        $idAutor = $parametro;
        $conexion = new bibliotecaModelo();
        $autor = $conexion->datos_autor($idAutor);
        $libros = $conexion->datos_libros_autor($idAutor);

        $datos = [
            'titulo' => 'Biblioteca | Autor',
            'autor' => $autor,
            'libros' => $libros
        ];

        Vista::renderizar('autor', $datos);
    }

}