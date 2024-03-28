<?php
/**
 * Clase que gestiona las imágenes 
 *  @author José Maria Calavia Rivera
 */
class Images {

     /**
      * Método que revisa que la imagen sea del tipo que se espera
      * @param archivo temporal de imagen
      * @return boolean true si el tipo de imagen que se quiere subir es el correcto y false en caso contrario
      */
     public static function revisarArchivoImagen($archivo){
        /*devuelve el tamaño de una imagen como un array. El índice 2 nos dice el tipo de 
        imagen (constante del tipo IMAGETYPE_XXX)*/
        $imagen_array = getimagesize($archivo);

        $imagenTipo = $imagen_array[2];

        //comprobar si las constantes que se pasan están en imagenTipo
        return (bool)(in_array($imagenTipo, array(IMAGETYPE_PNG, IMAGETYPE_JPEG)));
    }

    /**
     * Método que borra la imagen anterior
     * @param string $imagen la imagen almacenada en la BD
     */
    public static function borrarImagen($imagen){
        /*comprobar si existe el archivo con la constante de la carpeta imagenes 
          concatenado a la imagen*/
        $existeArchivo = is_file("images/" . $imagen);
            if($existeArchivo){
                unlink("images/" . $imagen);
            }
       }

    /**
    * Método que crea la nueva imagen
    * @param string $imagen nombre de la imagen
    * @param int $anchoNuevo nuevo ancho de la imagen
    */
    public static function imagen($imagen, $anchoNuevo){
        //acceder al archivo
        $archivo = "images/" . $imagen;
        
        //recuperar los datos del archivo físico
        $info = getimagesize($archivo);
        $ancho = $info[0];
        $alto = $info[1];
        $tipo = $info['mime'];

        //Calcular las nuevas dimensiones
        $nuevoAncho = $anchoNuevo;

        //factor de proporcionalidad
        $factor = $anchoNuevo / $ancho;
        $nuevoAlto = $alto * $factor;

        if ($tipo== 'image/jpg' || $tipo == 'image/jpeg') { 
            $imagen = imagecreatefromjpeg($archivo); 
        } else if ($tipo == 'image/png') { 
            $imagen = imagecreatefrompng($archivo); 
        } else if ($tipo == 'image/gif') { 

        }

        //Crear el lienzo para la nueva imagen
        $lienzo = imagecreatetruecolor((int)$nuevoAncho, (int)$nuevoAlto);
 
        /*Vaciar la imagen modificada al lienzo
        (destino, origen, coordenada x destino, coordenada y destino, coordenada x origen, 
         coordenada y origen, ancho destino, alto destino, ancho origen, alto origen)*/
        imagecopyresampled($lienzo, $imagen, (int)0, (int)0, (int)0, (int)0, (int)$nuevoAncho,
         (int)$nuevoAlto, (int)$ancho, (int)$alto);
 
        //crear el nuevo archivo (lienzo, ruta, calidad)
        if ($tipo== 'image/jpg' || $tipo == 'image/jpeg') { 
            imagejpeg($lienzo, $archivo);
        } else if ($tipo == 'image/png') { 
            imagejpeg($lienzo, $archivo); 

        } else if ($tipo == 'image/gif') { 
            imagegif($lienzo, $archivo);
        }
     }     
}