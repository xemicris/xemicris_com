<?php

class ajaxControlador extends Controlador{

    private $accionesPermitidas = ['agregar', 'obtener', 'cargar', 'actualizar', 'borrar'];

    private $parametrosRequeridos = ['validacion', 'accion'];

    function __construct(){

        //Validaciones
        foreach ($this->parametrosRequeridos as $parametro) {
            if(!isset($_POST[$parametro])){
                jsonSalida(jsonConstruir(403));
            }
        }

        if(!in_array($_POST['accion'], $this->accionesPermitidas)){
            jsonSalida(jsonConstruir(403));
        }
    }
    function indice(){
        /**200 OK
            201 Created
            300 Multiple Choices
            301 Moved Permanently
            302 Found
            304 Not Modified
            307 Temporary Redirect
            400 Bad Request
            401 Unauthorized
            403 Forbidden
            404 Not Found
            410 Gone
            500 Internal Server Error
            501 Not Implemented
            503 Service Unavailable
            550 Permission denied*/

      jsonSalida(jsonConstruir(403));
    }

    function agregarMovimiento(){

        if(captcha() != false){
            try {
                //Obtener datos
                $movimiento = new movimientosModelo();
                $datos = [
                    'descripcion' => strip_tags(htmlentities($_POST['descripcion'])),
                    'cantidad' => strip_tags(htmlentities($_POST['cantidad']))
                ];
    
                $movimiento->tipo =  htmlentities($_POST['tipo']);
                $movimiento->descripcion =  validarString(html_entity_decode($datos['descripcion']));
                $movimiento->cantidad =  validarNumero($datos);
                $movimiento->creado_el = strip_tags(htmlentities($_POST['fecha'])) != "NaN-aN-aN" ? strip_tags(htmlentities($_POST['fecha'])) : date("Y-m-d");
    
                if($movimiento->descripcion != false && $movimiento->cantidad != false){
                    $movimiento->cantidad = (float)$datos['cantidad'];
                    if(!$id = $movimiento->anadir()){
                        jsonSalida(jsonConstruir(400, null, 'Hubo un error al guardar el registro'));
                    }
        
                    //Se ha guardado con éxito
                    $movimiento->id = $id;
                    jsonSalida(jsonConstruir(201, $movimiento->uno(), 'Movimiento agregado con éxito'));
    
                }else{
                    $datos = false;
                    jsonSalida(jsonConstruir(201, $datos, 'Datos no válidos'));
                }
                
            } catch (\Exception $e) {
                jsonSalida(jsonConstruir(400, null, $e->getMessage()));
            }

        }else{
            jsonSalida(jsonConstruir(200, null, 'Captcha no válido'));
        }
    }

    function mostrarMovimientos(){

        try {
            $movimientos = new movimientosModelo;
            $mov = $movimientos->todosPorFecha();
            $movTotal = $movimientos->todos();

            if($mov){
                $impuesto = (float)obtenerOpcion('impuestos') < 0 ? 21 : obtenerOpcion('impuestos');
                $usarImpuesto = obtenerOpcion('calcularImpuestos') === 'Si' ? true:false;

                $totalMovimientos = $mov[0]['total'];
                $total = $mov[0]['ingresos_totales'] - $mov[0]['gastos_totales'];
                $subtotal = $usarImpuesto ? $total / (1.0 + ($impuesto/100)):$total;
                $impuestos = $subtotal * ($impuesto/100);

                $totalGlobal = $movTotal[0]["ingresos_totales"] - $movTotal[0]["gastos_totales"];

                $calculos = [
                    'totalGlobal'=> $totalGlobal,
                    'totalMovimientos' => $totalMovimientos,
                    'subtotal' => $subtotal,
                    'impuestos' => $impuestos,
                    'total' => $total
                ];
                $datos = obtenerPlantillaHtml('movimientos', ['movimientos' => $mov, 'cal' => $calculos]);
                jsonSalida((jsonConstruir(200, $datos)));

            }else if($movTotal){

                $totalGlobal = $movTotal[0]["ingresos_totales"] - $movTotal[0]["gastos_totales"];

                $calculos = [
                    'totalGlobal'=> $totalGlobal,
                ];
                $datos = obtenerPlantillaHtml('movimientos', ['movimientos' => false, 'cal' => $calculos]);
                jsonSalida((jsonConstruir(200,$datos)));
                
            }else{
                $datos = false;
                jsonSalida((jsonConstruir(200, $datos, 'No hay registros todavía')));
            }
            

        } catch (Exception $e) {
            jsonSalida((jsonConstruir(400, $e->getMessage())));
        }
    }

    function cambiarFecha(){

        try {
            
            $fecha = strip_tags(htmlentities($_POST['fecha']));

            $movimientos = new movimientosModelo;
            $mov = $movimientos->todosPorFecha($fecha);
            $movTotal = $movimientos->todos();

            if($mov){
                $impuesto = (float)obtenerOpcion('impuestos') < 0 ? 21 : obtenerOpcion('impuestos');
                $usarImpuesto = obtenerOpcion('calcularImpuestos') === 'Si' ? true:false;

                $totalMovimientos = $mov[0]['total'];
                $total = $mov[0]['ingresos_totales'] - $mov[0]['gastos_totales'];
                $subtotal = $usarImpuesto ? $total / (1.0 + ($impuesto/100)):$total;
                $impuestos = $subtotal * ($impuesto/100);
                $totalGlobal = $movTotal[0]["ingresos_totales"] - $movTotal[0]["gastos_totales"];

                $calculos = [
                    'totalGlobal' => $totalGlobal,
                    'totalMovimientos' => $totalMovimientos,
                    'subtotal' => $subtotal,
                    'impuestos' => $impuestos,
                    'total' => $total
                ];

                

                $datos = obtenerPlantillaHtml('movimientos', ['movimientos' => $mov, 'cal' => $calculos]);
                jsonSalida((jsonConstruir(200, $datos)));

            }else if($movTotal){
                $movTotal = $movimientos->todos();
                $totalGlobal = $movTotal[0]["ingresos_totales"] - $movTotal[0]["gastos_totales"];
                $calculos = [
                    'false' => false,
                    'totalGlobal' => $totalGlobal
                ];
                $datos = obtenerPlantillaHtml('movimientos', ['cal' => $calculos]);
                jsonSalida((jsonConstruir(200,$datos)));

            }else{
                $datos = false;
                jsonSalida((jsonConstruir(200, $datos, 'No hay registros todavía')));
            }
            

        } catch (Exception $e) {
            jsonSalida((jsonConstruir(400, $e->getMessage())));
        }
    }

    function borrarMovimiento(){
        try {
            $movimiento = new movimientosModelo;
            $movimiento->id =  strip_tags(htmlentities($_POST['id']));
            
            if(!$movimiento->borrar()){
                jsonSalida((jsonConstruir(400, null, 'Ha habido un error al borrar el registro')));
            }

            //null-> porque ya no hay un registro que devolver
            jsonSalida((jsonConstruir(200, null, 'Movimiento borrado con éxito')));

        } catch (Exception $e) {
            jsonSalida((jsonConstruir(400, null, $e->getMessage())));
        }
    }

    function mostrarMovimiento(){
        try {
            $movimientos = new movimientosModelo;
            $movimientos->id =  htmlentities($_POST['id']);
            $movimiento = $movimientos->uno();


            if(!$movimiento){
                jsonSalida((jsonConstruir(400, null, 'No existe ese movimiento')));
            }
            
            $datos = obtenerPlantillaHtml('actualizacion', $movimiento);

            jsonSalida((jsonConstruir(200, $datos)));

        } catch (Exception $e) {
            jsonSalida((jsonConstruir(400, $e->getMessage())));
        }
    }

    function actualizarMovimiento(){
        if(captcha() != false){
            try {
                $datos = [
                    'descripcion' =>  strip_tags(htmlentities($_POST['descripcion'])),
                    'cantidad' =>  strip_tags(htmlentities($_POST['cantidad']))
                ];
    
                //Obtener datos
                $movimiento = new movimientosModelo();
                //id oculto
                $movimiento->id =  htmlentities($_POST['id']);
                $movimiento->tipo =  htmlentities($_POST['tipo']);
                $movimiento->descripcion =  validarString(html_entity_decode($datos['descripcion']));
                $movimiento->cantidad =  validarNumero($datos);
                $movimiento->creado_el = strip_tags(htmlentities($_POST['fecha'])) != "NaN-aN-aN" ? strip_tags(htmlentities($_POST['fecha'])) : date("Y-m-d");
    
                  if($movimiento->descripcion != false && $movimiento->cantidad != false){
    
                    $movimiento->cantidad = (float)$datos['cantidad'];
    
                    if(!$id = $movimiento->actualizar()){
                        jsonSalida(jsonConstruir(400, null, 'Hubo un error al actualizar'));
                    }
        
                    //Se ha guardado con éxito
                    $movimiento->id = $id;
                    jsonSalida(jsonConstruir(200, $movimiento->uno(), 'Movimiento actualizado con éxito'));
    
                  }else{
                    $datos = false;
                    jsonSalida(jsonConstruir(201, $datos, 'Datos no válidos'));
                }
         
            } catch (\Exception $e) {
                jsonSalida(jsonConstruir(400, null, $e->getMessage()));
            }
        }else{
            jsonSalida(jsonConstruir(201, null, 'Captcha no válido'));
        }
        
    }

    function opciones(){

        if(captcha() != false){
            $datos =  strip_tags(htmlentities($_POST['impuestos']));

            if(validarImpuesto($datos) != false){
                $opciones = [
                    'calcularImpuestos' =>  htmlentities($_POST['calcularImpuestos']),
                    'impuestos' =>  htmlentities($datos),
                    'moneda' =>  htmlentities($_POST['moneda'])
                ];
        
                foreach ($opciones as $clave => $opcion) {
                
                    try {
                        $id = opcionesModelo::opcion($clave, $opcion);
        
                        if(!$id){
                            jsonSalida(jsonConstruir(400, null, sprintf('Hubo un error al guardar la opción %s', $clave)));
                        }
            
                        
                    } catch (\Exception $e) {
                        jsonSalida(jsonConstruir(400, null, $e->getMessage()));
                    }
                }
                
                //Se ha guardado con éxito
                $datos = $opciones['moneda'];
                jsonSalida(jsonConstruir(200, $datos, 'Opciones actualizadas con éxito'));

            }else{
                $datos = false;
                jsonSalida(jsonConstruir(202, $datos, 'Porcentaje no válido'));
            }

        } jsonSalida(jsonConstruir(202, null, 'Captcha no válido'));

        

        
    }
}

