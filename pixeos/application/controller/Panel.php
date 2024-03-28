<?php


/**
 * Clase controladora que permite mostrar y trabajar en el panel del usuario
 *  @author José Maria Calavia Rivera
 */
class Panel extends ControladorGeneral{
    /**
     * modelo
     * @var object
     */
    private $model;

    /**
     * Constructor que llama al modelo PanelModel
     */
    function __construct(){
        $this->model = $this->model("PanelModel");
    }


/****************************************NOTAS*************************************************** */

    /**
     * Método que redirecciona
     */
    function index(){
        header('location:' . RUTA . 'panel/panel');
    }

    /**
     * Método que gestiona la vista principal del panel
     */
    function panel(){

        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        //Vista por defecto
            $datos = [
                "titulo" => "Pixeos | Panel",
                "subtitulo" => "Notas",
                'usuario' => $usuario
            ];
        
            //llamar a la vista y pasarle los datos
            $this->view("projects", $datos);
    }

    /**
     * Método que muestra los proyectos y tareas
     */
    function taskInProject(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //declaración de variables
        $proyectos = [];
        $proyectosCompartidosCompletos = [];
        $idProyecto = [];

        //obtención de proyectos y tareas por proyecto
        $idUsuario = $_SESSION['usuario']['id'];
        $proyectosCompartidos = $this->model->obtenerProyectosCompartidosPorId($idUsuario);
        $proyectos = $this->model->obtenerProyectosPorIdUsuario($idUsuario);
        if(count($proyectosCompartidos) > 0){
            foreach($proyectosCompartidos as $proyectoCompartido){
                $proyectoCompartido['ko'] = 'si';
                $nombreUsuarioComparte = $this->model->obtenernombreUsuarioComparte($proyectoCompartido['idUsuario']);
                $proyectoCompartido['usuarioComparte'] = $nombreUsuarioComparte['nombre'];
                array_push($proyectosCompartidosCompletos, $proyectoCompartido);
            }
            $proyectos = array_merge($proyectos, $proyectosCompartidosCompletos);
        }
        $usuario = $this->model->obtenerUsuarioPorId($idUsuario);

        for($i=0; $i<sizeof($proyectos); $i++){
            $idProyecto[$i] = $proyectos[$i]['id'];
        }
        for($i=0; $i<sizeof($idProyecto); $i++){
            $proyectos[$i]['tareas'] = $this->model->obtenerTareasporIdProyecto($idProyecto[$i]);
        }

        $datos = [
            "proyectos" => $proyectos,
            "fondo" => $usuario['fondo']
        ];
        echo json_encode($datos);   
    }

    /**
     * Método que crea un proyecto
     */
    function createproject(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();
         $usuarioSesion = $sesion->getUsuario();

         //declarar variables locales
         $datos = [];
         $completado = 0;

         //obtener datos
         $idUsuario = $usuarioSesion['id'];

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Obtener nombre del proyecto
            $nombreProyecto =  $_POST ?? "";

            //obtener la url del proyecto
            $urlProyecto = createUrl();

            $colorObtenido = $this->model->obtenerColorUltimoProyecto($idUsuario);
            
            //generar el color
            $color = ['granate', 'aqua', 'rosa', 'verde', 'marron', 'azul', 'naranja', 'gris'];
            if($colorObtenido !== []){
                if($colorEliminar = array_search($colorObtenido['colorProyecto'], array_values($color))){
                    unset($color[$colorEliminar]);
                }
            }
     
            $seleccionado = array_rand($color);
            
            //rellenar array
            $datos = [
                "nombreProyecto" => $nombreProyecto,
                "urlProyecto" => $urlProyecto,
                "colorProyecto" => $color[$seleccionado],
                "completado" => $completado,
                "idUsuario" => $idUsuario,
                "compartida" => 0
            ];

            //Crear proyecto
            if(!empty($nombreProyecto['nombre'])){
                if( es_texto($nombreProyecto['nombre']) == 1){
                    $proyectoCreado = $this->model->crearProyecto($datos);
                    if($proyectoCreado){
                        $proyectoCreado = 'valido';
                        echo json_encode($proyectoCreado);
                    }
                }else{
                    $nombreProyecto = 'invalido';
                    echo json_encode($nombreProyecto);
                }
                
            //envio sin nombre
            }else{
                $nombreProyecto = false;
                echo json_encode($nombreProyecto);
            }
        
        }

    }

    /**
     * Método que obtiene el id del proyecto y lo almacena en sesión
     */
    function idProject(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener id Proyecto a editar
        $idProyecto = $_POST["idProyecto"] ?? "";

        //Almacenar el id en sesión
        $_SESSION["usuario"]["idProyecto"] = $idProyecto; 
    }


    /**
     * Método que permite editar un proyecto
     */
    function updateProject(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();
         $usuarioSesion = $sesion->getUsuario();
         $idUsuario = $usuarioSesion['id'];

        $idProyecto = $usuarioSesion['idProyecto'];

        //declarar variables locales
        $datos = [];


       if($_SERVER['REQUEST_METHOD'] == "POST"){

           //Obtener nombre del proyecto
           $nombreProyecto =  $_POST ?? "";
           

           //rellenar array
           $datos =[
                "idProyecto" => $idProyecto,
                "nombreProyecto" => $nombreProyecto,
                "idUsuario" => $idUsuario
            ];

            //Todo ok
           if(!empty($nombreProyecto)){
               if(es_texto($nombreProyecto['nombre']) == 1){
                   $proyectoActualizado = $this->model->actualizarProyecto($datos);
                   if($proyectoActualizado){
                       $proyectoActualizado = 'valido';
                       echo json_encode($proyectoActualizado);
                   }
               }else{
                    $nombreProyecto = 'invalido';
                    echo json_encode($nombreProyecto);
               }
           }else{
                $nombreProyecto = false;
                echo json_encode($nombreProyecto);
           }
       }
    }

    /**
     * Método que permite eliminar un proyecto
     */
    function eliminateProject(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        //obtención de datos
        $idUsuario = $usuarioSesion['id'];
        $idProyecto = $_POST['idProyecto'] ?? "";

        //proyecto encontrado
        if($idProyecto){
            $proyectoBorrado = $this->model->eliminarProyecto($idProyecto, $idUsuario);
            if($proyectoBorrado){
                echo json_encode($proyectoBorrado);
            }
        }
    }

    /**
     * Método que permite buscar proyectos por su nombre
     */
    function search(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();
         $usuarioSesion = $sesion->getUsuario();

         //Declaración de variables
         $proyectoABuscar = [];

        //obtener datos
        $idUsuario = $usuarioSesion['id'];
        $nombreProyecto = $_POST['nombre'] ?? '';

        $proyectoABuscar = $this->model->obtenerProyectoPorNombre($nombreProyecto, $idUsuario);

        if($nombreProyecto != ''){
            for($i=0; $i<sizeof($proyectoABuscar); $i++){
                $proyectoABuscar[$i]['tareas'] = $this->model->obtenerTareasporIdProyecto($proyectoABuscar[$i]['id']);
            }
            
            //Pasar datos
            $datos = [
                'proyecto' => $proyectoABuscar
            ];
        }else{
            $datos = [];
        }
        
        echo json_encode($datos);
        
    }

    /**
     * Método que muestra un proyecto concreto
     * @param string $parametro con la url del proyecto
     */
    function project($parametro){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        //obtener datos
        $idUsuario = $usuarioSesion['id'];
        $usuario = $this->model->obtenerUsuarioPorId($idUsuario);

        //obtener url por parámetro
        $urlParametro = $parametro;
        
        //obtener urls proyectos en la BD
        $urlsBD = $this->model->obtenerUrlsProyectosUsuario($idUsuario);

        //obtener urls de proyectos compartidos 
        $urlsBDCompartidos = $this->model->obtenerUrlsProyectosCompartidosUsuario($idUsuario);

        $urlsBD = array_merge($urlsBD,  $urlsBDCompartidos);
        
        //ver si la url no se ha manipulado
        foreach($urlsBD as $urlBD){
           if(in_array($urlParametro, $urlBD)){
                $urlConfirmada = $urlBD['urlProyecto'];
           }
        }
        //url modificada
        if(!$urlConfirmada){
            header('location:' . RUTA . 'access/login');
        //url correcta
        }else{
            $_SESSION["usuario"]["urlProyecto"] = $urlParametro; 
            $proyecto = $this->model->obtenerProyectoUrl($urlConfirmada);
        }
        //Vista por defecto

            $datos = [
                "titulo" => "Pixeos | Panel",
                "subtitulo" => "Proyectos",
                "usuario" => $usuario,
                "proyecto" => $proyecto
            ];
    
            //llamar a la vista y pasarle los datos
            $this->view("project", $datos);
    }

    function descargarNota(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //obtener datos
            $idProyecto = $_POST['idProyecto'] ?? "";
            $nota = $this->model->obtenerNotaYTareasporIdProyecto($idProyecto);
            if(count($nota) > 0){
                $completada = ($nota[0]['completado'] == '1') ? 'Si' : 'No';
                $html = "<table  style='border: 1.3px solid black;' cellspacing='0' cellpadding='0'>";
                $html .= "<tr align='center'>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#3498db'>Usuario</th>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#fcbe41'>Nota</th>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#f0776c'>Completada</th>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#1abc9c'>Tareas</th>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#cd310d'>Fecha</th>";
                $html .= "<th style='border: 1.3px solid black;' bgcolor='#5d39fc'>Descripción</th>";
                $html .= "<th style='border: 1.3px solid black; 'bgcolor='#a6a6a6'>Completadas</th>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#3498db'  width='200px'>" . $nota[0]['nombre'] . ' ' . $nota[0]['apellidos'] . "</td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#fcbe41' width='200px'>" . $nota[0]['nombreProyecto']  . "</td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#f0776c'width='100px'>" .  $completada . "</td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#1abc9c' width='300px'><ol>";
                foreach($nota as $n){
                    $html .= "<li>" . $n['nombreTarea'] . "</li>";
                }
                $html .= "</ol></td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#cd310d' width='300px'><ol>";
                foreach($nota as $n){
                    $hayFecha = empty($n['fecha']) ? '-' : $n['fecha'];
                    $html .= "<li>" . $hayFecha . "</li>";
                }
                $html .= "</ol></td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#5d39fc' width='300px'><ol>";
                foreach($nota as $n){
                    $hayDescripcion = empty($n['descripcionTarea']) ? '-' : $n['descripcionTarea'];
                    $html .= "<li>" . $hayDescripcion . "</li>";
                }
                $html .= "</ol></td>";
                $html .= "<td style='border: 1.3px solid black;' bgcolor='#a6a6a6' width='100px'><ol>";
                foreach($nota as $n){
                    $completa = ($n['estado'] == '1') ? 'Si' : 'No';
                    $html .= "<li>" . $completa . "</li>";
                }
                $html .= "</ol></td>";
                $html .= "</tr>";
                $html .= "</table>";
                echo $html;

            }else{
                $nota = 'No hay notas';
                echo json_encode($nota);
            }
        }

    }

    function agregarNotaCompartida(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idNota = $_POST['idNota'] ?? "";
            $correoEntrada = $_POST['email'] ?? ""; 
            $correoValido = validarEnvioCorreo($correoEntrada);
            if(!empty($correoValido)){
                echo json_encode($correoValido);
            }else{
                $usuarioExiste = $this->model->obtenerUsuarioPorCorreo($correoEntrada);
                $validacionUsuario = validarAntesCompartir($usuarioExiste, $usuarioSesion['nombre']);
                if(!empty($validacionUsuario)){
                    echo json_encode($validacionUsuario);
                }else{
                    $datos = [
                        'idUsuario' => $usuarioExiste['id'],
                        'idNota' => $idNota
                    ];
                    $notaYaCompartida = $this->model->obtenerCompartidos($datos);
                    if(!empty($notaYaCompartida)){
                        echo json_encode("Nota ya compartida");
                    }else{
                        $this->model->compartirNota($datos);
                        echo json_encode(["Nota compartida correctamente", $usuarioExiste['nombre']]);
                    }
                   
                }
            }
        }
    }

    function eliminarNotaCompartida(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idNota = $_POST['idNota'] ?? "";
            //validar vacío o formato incorrecto
            $usuariosCompartenNota = $this->model->buscarUsuariosCompartenNota($idNota);
            foreach($usuariosCompartenNota as $usuarioComparteNota){
                $datos = [
                    'idUsuario' => $usuarioComparteNota['id'],
                    'idNota' => $idNota
                ];
                $notaYaCompartida = $this->model->obtenerCompartidos($datos);
                if(empty($notaYaCompartida)){
                    echo json_encode(["La nota no se está compartiendo con " . $usuarioComparteNota['nombre'], false]);
                }else{
                    $this->model->eliminarNotaCompartida($datos);
                    echo json_encode(["Nota dejada de compartir correctamente", $usuarioComparteNota['nombre']]);
                }  
            }
        }
    }

    function buscarUsuariosCompartenNota(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idNota = $_POST['idNota'] ?? "";
            $usuariosCompartenNota = $this->model->buscarUsuariosCompartenNota($idNota);
            echo json_encode($usuariosCompartenNota);
        }
    }

    function enviarNotaACorreo(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idNota = $_POST['idNota'] ?? "";
            $correoEntrada = $_POST['email'] ?? ""; 
            $correoValido = validarEnvioCorreo($correoEntrada);
            if(!empty($correoValido)){
                echo json_encode($correoValido);
            }else{
                $nota = $this->model->obtenerNotaYTareasporIdProyecto($idNota);
                if(empty($nota)){
                    echo json_encode('Nota no encontrada');
                }else{
                    $email = new Email($correoEntrada, $usuarioSesion['nombre'], '', $nota, '');
                    $correo = $email->enviarNota();
                    if(!$correo){
                        echo json_encode("Correo no enviado, por favor, inténtalo más tarde");
                    }else{
                        echo json_encode(["Correo enviado correctamente", $usuarioSesion['nombre'], $correoEntrada]);
                    }
                   
                }
            }
        }
    }


/****************************************TAREAS*************************************************** */

    /**
     * Método que muestra las tareas
     */
    function tasks(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        
        //obtener datos
        $urlProyecto =  $_SESSION["usuario"]["urlProyecto"];
        $proyecto = $this->model->obtenerProyectoUrl($urlProyecto);
        $proyectoId = $proyecto[0]['id'];
        $tareas = $this->model->obtenerTareasporIdProyecto($proyectoId);
        echo json_encode($tareas);
    }

    /**
     * Método para crear tareas
     */
    function createTask(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //declarar variables locales
        $datos = [];
        $estado = 0;
       

       if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['urlProyecto'])){
                $urlProyecto = $_POST['urlProyecto'];
                
            }else if($_SESSION["usuario"]["urlProyecto"]){
                $urlProyecto =  $_SESSION["usuario"]["urlProyecto"];
            }
            $proyecto = $this->model->obtenerProyectoUrl($urlProyecto);
            $proyectoId = $proyecto[0]['id'];
           //Obtener datos de las tareas
           $nombreTarea =  ucfirst($_POST['nombreTarea']) ?? "";
           $descripcionTarea = $_POST['descripcionTarea'] ?? "";
           if($_POST['fecha'] == ""){
                $fecha = 'null';
           }else{
                $fecha = "'" . $_POST['fecha'] . "'";
           }
           $notificacion = $_POST['notificacion'] ?? "";

           //rellenar array
           $datos = [
               "nombreTarea" => $nombreTarea,
               "descripcionTarea" => $descripcionTarea,
               "estado" => $estado,
               "proyectoId" => $proyectoId,
               "fecha" => $fecha,
               "notificacion" => $notificacion
           ];

           //validar que haya nombre de tarea
           if(!empty($nombreTarea)){
                if($fecha == 'null' && !empty($notificacion)){
                    echo json_encode('Afecha');
                }else if($fecha != 'null' && !empty($notificacion) &&fechaMenorIgual($fecha)){
                    echo json_encode('MenorFecha');
                }else{
                    $idTareaCreada = $this->model->crearTarea($datos);
                    if($idTareaCreada){
                        $tarea = $this->model->obtenerTareaporIdTarea($idTareaCreada);
                        if($tarea){
                            $tarea = true;
                            echo json_encode($tarea);
                        }else{
                            $tarea = false;
                            echo json_encode($tarea);
                        }
                    } 
                }
            //no hay nombre de tarea
            }else{
               $tarea = false;
               echo json_encode($tarea);
            }
        }
    }

    /**
     * Método que permite editar tareas
     */
    function updateTask(){
             //Sesión
             $sesion = new Sesion();
             $sesion->comprobarSesion();

            //declarar variables locales
            $datos = [];
    
           if($_SERVER['REQUEST_METHOD'] == "POST"){
    
               //Obtener datos de las tareas
                $idTarea = $_POST['idTarea'];
                $nombreTarea =  $_POST['nombreTarea'] ?? "";
                $descripcionTarea = $_POST['descripcionTarea'] ?? "";
                if($_POST['fecha'] == ""){
                    $fecha = 'null';
               }else{
                    $fecha = "'" . $_POST['fecha'] . "'";
               }
               $notificacion = $_POST['notificacion'] ?? "";

               //rellenar array
               $datos =[
                    "idTarea" => $idTarea,
                    "nombreTarea" => $nombreTarea,
                    "descripcionTarea" => $descripcionTarea,
                    "fecha" => $fecha,
                    "notificacion" => $notificacion
                ];
    
                //La tarea existe
               if(!empty($idTarea)){
                    if($fecha == 'null' && !empty($notificacion)){
                        echo json_encode('Afecha');
                    }else if($fecha != 'null' && !empty($notificacion) &&fechaMenorIgual($fecha)){
                        echo json_encode('MenorFecha');
                    }else{
                        $tareaActualizada = $this->model->actualizarTarea($datos);
                        if($tareaActualizada){
                            echo json_encode($tareaActualizada);
                        }
                    }
               }
           }
    }

    /**
     * Método que cambia el estado de una tarea (completada/no completada)
     */
    function completeTask(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();

         if($_SERVER['REQUEST_METHOD'] == "POST"){
            //obtener datos
            $estado = $_POST['estado'];
            $idTarea = $_POST['idTarea'];

            $datos = [
                "estado" => $estado,
                "idTarea" => $idTarea
            ];

            if(!empty($idTarea)){
                $resultado = $this->model->tareaEstado($datos);
                if($resultado){
                    $tareaChecked = $this->model->obtenerTareaporIdTarea($idTarea);
                    echo json_encode($tareaChecked);
                }
            }      
        }
    }

    /**
     * Método que permite eliminar una tarea
     */
    function eliminateTask(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener datos
        $idTarea =  $_POST["idTarea"] ?? "";
        $urlProyecto =  $_SESSION["usuario"]["urlProyecto"];
        $proyecto = $this->model->obtenerProyectoUrl($urlProyecto);
        $proyectoId = $proyecto[0]['id'];

        $tareaEliminada = $this->model->eliminarTarea($idTarea, $proyectoId);
        if($tareaEliminada){
            echo json_encode($tareaEliminada);
        }else{
            echo json_encode($tareaEliminada);
        }
    }


    /**
     * Método que permite eliminar todas las tareas
     */
    function eliminateAllTasks(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //obtener datos
        $urlProyecto =  $_SESSION["usuario"]["urlProyecto"];
        $proyecto = $this->model->obtenerProyectoUrl($urlProyecto);
        $proyectoId = $proyecto[0]['id'];

        $tareaEliminada = $this->model->eliminarTareas($proyectoId);
        if($tareaEliminada){
            echo json_encode($tareaEliminada);
        }else{
            echo json_encode($tareaEliminada);
        }
    }
    
    /**
     * Método que calcula el porcentaje de la barra de progreso de un proyecto
     */
    function percentagem(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //Declaración de variables
        $tareas = [];
        $tareasMarcadas = 0;
        $totalTareas = 0;
        $porcentaje = 0;

        //obtener datos
        $idUsuario = $_SESSION["usuario"]["id"];
        $urlProyecto =  $_SESSION["usuario"]["urlProyecto"];
        $proyecto = $this->model->obtenerProyectoUrl($urlProyecto);
        $proyectoId = $proyecto[0]['id'];

        $tareas = $this->model->obtenerTareasporIdProyecto($proyectoId);
        for($i=0; $i<sizeof($tareas); $i++){
            if($tareas[$i]['estado'] == "1"){
                $tareasMarcadas++;
            }
        }
  
        $numeroTareas = $this->model->numeroTareasUnProyecto($proyectoId);
        $totalTareas = (int) $numeroTareas['COUNT(nombreTarea)'];

        //cálculos
        if($totalTareas !=0){
            $porcentaje = $tareasMarcadas * 100 /$totalTareas;
            $porcentaje = number_format($porcentaje,0);
        }else{
            $porcentaje = 0;
        }

        //rellenar array
        $datos = [
            'idUsuario' => $idUsuario,
            'idProyecto' => $proyectoId
        ];
        
        if($porcentaje == 100){
            $this->model->proyectoCompletado($datos);
        }else if($porcentaje != 100){
            $this->model->proyectoNoCompletado($datos);
        }

        echo json_encode($porcentaje);

    }

    /**
     * Método que permite calcular las estadísticas totales
     */
    function statistics(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //Obtención de datos
        $idUsuario = $_SESSION['usuario']['id'];

        $numeroProyectosPorUsuario = $this->model->numeroProyectosPorUsuario($idUsuario);
        $numeroProyectosPorUsuario = (int) $numeroProyectosPorUsuario[0]['COUNT(id)'];
        
        $numeroProyectosCompletados = $this->model->numeroProyectosCompletadosPorUsuario($idUsuario);
        $numeroProyectosCompletados = (int) $numeroProyectosCompletados[0]['COUNT(completado)'];

        $numeroProyectosPorUsuario = $numeroProyectosPorUsuario - $numeroProyectosCompletados;

        $datos =[
            'totales' => $numeroProyectosPorUsuario,
            'completados' => $numeroProyectosCompletados
        ];

        echo json_encode($datos);
    }

    /**
     * Método que muestra la vista de las estadísticas
     */
    function viewStatistics(){

        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        //obtener datos
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        //Vista por defecto
            $datos = [
                "titulo" => "Pixeos | Panel",
                "subtitulo" => "Estadísticas",
                'usuario' => $usuario
            ];
            $this->view("estadisticas", $datos); 
    }

    /**
     * Método que muestra el perfil, carga los datos del usuario y los actualiza
     */
    function profile(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        
        //declarar variables locales
        $datosActualizados = [];
        $nuevoNombreImagen = "";

        //obtener datos
        $usuarioSesion = $sesion->getUsuario();
        $id = $usuarioSesion['id'];
        $usuario = $this->model->obtenerUsuarioPorId($id);

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Imagen
            if($_FILES['imagen']['name']){
                //obtener datos imagen
                $archivoImagen = $_FILES['imagen']['tmp_name'];
                
                //revisar imagen
                if(Images::revisarArchivoImagen($archivoImagen)){
                    //nombrar imagen
                    $nuevoNombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                    /*Si el archivo está en la zona temporal copiarlo al directorio con el 
                    nombre nuevo*/
                    if(is_uploaded_file($archivoImagen)){
                        Images::borrarImagen($usuario['imagen']);
                        copy($archivoImagen, "images/".$nuevoNombreImagen);
                        Images::imagen($nuevoNombreImagen, 400);
                    }
                }
                
            }
        
            //Datos a modificar desde el formulario
            $nombre = $_POST["nombre"] ?? $_SESSION["usuario"]["nombre"];
            $apellidos = $_POST["apellidos"] ?? $_SESSION["usuario"]["apellidos"];
            $profesion = $_POST["profesion"] ?? $_SESSION["usuario"]["profesion"];
            
            if(empty($nuevoNombreImagen)){
                $imagen = $usuario['imagen'];
            }else{
                $imagen = $nuevoNombreImagen;
            }

            $datosActualizados = [
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "profesion" => $profesion,
                "imagen" => $imagen,
                "id" => $id
            ];

            $actualizadoCorrectamente = $this->model->actualizarPerfil($datosActualizados);
            if($actualizadoCorrectamente){
                $sesion->actualizarDatosSesion($datosActualizados);
                header("Refresh:0");
            }
        }
        
        $usuario = $this->model->obtenerUsuarioPorId($id);
        
        $datos = [
            "titulo" => "Pixeos | Panel",
            "subtitulo" => "Perfil",
            'usuario' => $usuario
        ];
        $this->view("profile", $datos);  
    }

    /**
     * Método que gestiona el formulario de contacto
     */
    function contact(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        //Declarar variable
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //obtener datos del formulario
            $nombre = $_POST['nombre'] ?? $usuarioSesion['nombre'];
            $apellidos = $_POST['apellidos'] ?? $usuarioSesion['apellidos'];
            $correo = $_POST['correo'] ?? $usuarioSesion['correo'];
            $mensaje = $_POST['mensaje'] ?? '';
            $consulta = $_POST['consulta'] ?? '';

            $alertas = validarContacto($nombre, $apellidos, $correo, $consulta);

            //todo ok
            if(empty($alertas)){
                if($consulta == "1"){
                    $email = new Email($correo, $nombre, '', $mensaje);
                    $correo = $email->contactoAdmin();
                    $email->contactoUsuario();

                    //correo enviado
                    if($correo){
                        $datos = [
                            "titulo" => "Pixeos | Contacto",
                            "subtitulo" => "Pixeos | contacto", 
                            "alertas" => [],
                            "usuario" => $usuarioSesion,
                            "texto" => "Mensaje enviado correctamente ",
                            "color" => "alert-success",
                            "url" => "panel/panel",
                            "colorBoton" => "btn-success",
                            "textoBoton" => "Volver"
                        ];
                        $this->view("messages", $datos);
                    }
                }else if($consulta == "2"){
                    date_default_timezone_set("Europe/Madrid");
                    $fecha = date('Y-m-d');
                    $datos = [
                        'fecha' => $fecha,
                        'comentario' => $mensaje,
                        'estado' => 0,
                        'usuarioId' => $usuarioSesion['id']
                    ];

                    $incidencia = $this->model->incidencia($datos);
                    if($incidencia){
                        $email = new Email($correo, $nombre, '', $mensaje);
                        $incidencia = 'Incidencia enviada, revisa el panel técnico';
                        $correo = $email->contactoAdmin($incidencia);
                        $email->contactoUsuario();

                        //correo enviado
                        if($correo){
                            $datos = [
                                "titulo" => "Pixeos | Contacto",
                                "subtitulo" => "Pixeos | contacto", 
                                "alertas" => [],
                                "usuario" => $usuarioSesion,
                                "texto" => "Mensaje enviado correctamente ",
                                "color" => "alert-success",
                                "url" => "panel/panel",
                                "colorBoton" => "btn-success",
                                "textoBoton" => "Volver"
                            ];
                            $this->view("messages", $datos);
                        }else{
                            $datos = [
                                "titulo" => "Pixeos | Contacto",
                                "subtitulo" => "Pixeos | contacto", 
                                "alertas" => [],
                                "usuario" => $usuarioSesion,
                                "texto" => "El mensaje no se ha enviado. Revisa los datos ",
                                "color" => "alert-danger",
                                "url" => "panel/contact",
                                "colorBoton" => "btn-danger",
                                "textoBoton" => "Volver"
                            ];
                            $this->view("messages", $datos);
                        }
                    }
                }


            //correo no enviado    
            }else{
                $datos = [
                    "titulo" => "Pixeos | Contacto",
                    "subtitulo" => "Pixeos | contacto", 
                    "alertas" => [],
                    "usuario" => $usuarioSesion,
                    "texto" => "El mensaje no se ha enviado. Revisa los datos ",
                    "color" => "alert-danger",
                    "url" => "panel/contact",
                    "colorBoton" => "btn-danger",
                    "textoBoton" => "Volver"
                ];
                $this->view("messages", $datos);
            }
    
        //vista por defecto    
        }else{
            $datos = [
                "subtitulo" => "Perfil",
                "usuario" => $usuarioSesion,
                "titulo" => "Pixeos | Panel",
            ];
            
            $this->view("contact", $datos);
        }  
        
    }

    /**
     * Método que obtiene el tipo de fondo del usuario (claro/oscuro) 
     */
    function obtenerFondo(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        //Obtener datos
        $idUsuario = $_SESSION['usuario']['id'];

        $fondo = $this->model->obtenerFondo($idUsuario);

        echo json_encode($fondo);
    }

    /**
     * Método que cambia el fondo del usuario
     */
    function cambiarFondo(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        $fondo = 0;

        $idUsuario = $_SESSION['usuario']['id'];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //obtener datos
            $fondo = $_POST['fondo'];
        }
        $datos = [
            'fondo' => $fondo,
            'idUsuario' => $idUsuario
        ];

        $this->model->cambiarFondo($datos);
        $fondo = $this->model->obtenerFondo($idUsuario);

        echo json_encode($fondo);

    }


    /**
     * Método que muestra el calendario
     */
    function calendar(){

        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();

        //obtener datos
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        //Vista por defecto
            $datos = [
                "titulo" => "Pixeos | Panel",
                "subtitulo" => "Calendario",
                'usuario' => $usuario
            ];
            $this->view("calendar", $datos); 
    }

    /**
     * Método que envía las tareas 
     */
    function mostrarTareasCalendario(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();
         $usuarioSesion = $sesion->getUsuario();

         $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);
         $datosTareas = $this->model->datosTareas($usuario['id']);

         echo json_encode($datosTareas);
    }

    function obtenerIdsSegunFecha(){
         //Sesión
         $sesion = new Sesion();
         $sesion->comprobarSesion();
         $usuarioSesion = $sesion->getUsuario();
         $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);
 
         if($_SERVER['REQUEST_METHOD'] == "POST"){
             
             //Obtener datos de las tareas
             $fecha =  $_POST['fecha'] ?? "";
 
             $idsTareas = $this->model->obtenerIdTareas($fecha, $usuario['id']);
             
             echo json_encode($idsTareas);
         }
    }


    function llevarAProyectoDesdeCalendario(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();
        $usuarioSesion = $sesion->getUsuario();
        $usuario = $this->model->obtenerUsuarioPorId($usuarioSesion['id']);

        
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            //Obtener datos de las tareas
            $idTarea =  $_POST['idTarea'] ?? "";

            $urlProyecto = $this->model->obtenerUrlProyectoSegunTarea($usuario['id'], $idTarea);
            
            echo json_encode($urlProyecto);
        }

    }


    /**
     * Método que cierra la sesión del usuario
     */
    function closeSesion(){
        //Sesión
        $sesion = new Sesion();
        $sesion->finalizarLogin();
    }

    /**
     * Método que borra el usuario
     */
    function deleteUser(){
        //Sesión
        $sesion = new Sesion();
        $sesion->comprobarSesion();

        $idUsuario = $_SESSION['usuario']['id'];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $usuarioEliminado = $this->model->eliminarUsuario($idUsuario);
            //Una vez eliminado redirecciona
            if($usuarioEliminado){
                header('location:' . RUTA . 'access/login');
            }
        }
    }
}



