<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $datos['titulo']; ?></title>
    <link href="<?php echo CSS . 'administracion.css'; ?>" rel="stylesheet" type="text/css">
    <script>
        function preguntar(){
            return confirm("¿Deseas Continuar?");
        }
    </script>
</head>
<body>
    <header id="imagen_principal">
        <div id="contenido_imagen_principal">
            <a href="<?php echo RUTABASE . 'administracion'; ?>">
                <div id= logo >
                    <img src="<?php echo IMAGENES . "administracion/logo.png"; ?>" alt="logotipo">
                </div>
                <div id="titulo">
                    <h1>e-Administración<div id="titulo2">Trámites</div></h1>
                </div>
            </a>
        </div>
    </header>
    <section id="cuerpo_principal">
        
        <div id="botones">
            <div id="portada"><p>Página Principal</p></div>
            <div class="casa__contenedor">
                <a href="<?php echo RUTABASE . "trabajos"; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </div>
            <div class="boton"><a onclick="return preguntar()" href="https://portal.seg-social.gob.es/wps/portal/importass/importass/Categorias/Vida+laboral+e+informes/Informes+sobre+tu+situacion+laboral/Informe+de+tu+vida+laboral" target="blank"><button>Informe de vida laboral</button></a></div>
            <div class="boton"><a onclick="return preguntar()" href="https://sede.mjusticia.gob.es/es/tramites/certificado-registro-central" target="blank"><button>Certificado de delitos sexuales</button></a></div>
            <div class="boton"><a onclick="return preguntar()" href="https://sede.seg-social.gob.es/wps/portal/sede/sede/Ciudadanos/CiudadanoDetalle/!ut/p/z1/rVJdT4MwFP01PLLeDsbANzTLNhxOs-EGL4SPwmpGy2g3_PmWqYkmyjTah6a9uffcc889KEJbFLHkRMtEUs6SvfqHkRUb2DKxA3gxhfkE3MC_DRzjwZjOMdr0JYADKPpJPXxz3Iv1jyhCUcZkLXcoFCQnccaZJIzmXGjQBTTI6DFP8oR1kZowoUYj6imPQsSUqSsjjYzrhggZp1R0iHVGcxQaDhkXGR7peWqAbgJg3bHNTE-xmWAwExssgrxeikOr03DY-Dd-qWATudMpKzja3r8TURJEfRBnEc8JfSpdIqFYlnuevq7UZalhKzoNKUhDmsGxUeGdlLW40kCDtm0HJeflngwyXmnwVcmOC4m2nzPRSk0TqoWOPzDB1ya4eLm2hrMJhqWJNidKWhQw3lSKzeqXas_grcNoaQP2YLgAy7fBdR5WweIOG1PAf-zgXbKcUoM-HQ6Rq4zXee1ZCfFPzqurIKhsY7Q_1ZPCl6PUDL1T266LauO-AGc4iI0!/dz/d5/L2dBISEvZ0FBIS9nQSEh/" target="blank"><button>Certificado de no pensionista</button></a></div>
            <div class="boton"><a onclick="return preguntar()" href="https://sede.seg-social.gob.es/wps/portal/sede/sede/Ciudadanos/CiudadanoDetalle/!ut/p/z1/rVLBboJAEP0Ve_BIdhaQwhGtQa1ojKXKXsi6LLqNLgir1r_vQprUS7FNu4dN5uXNzMubhwhaIyLpWWypErmke13HxEks7NjYAzwNYDwEPwqfI89aWMEYo1UbATxA5Cf98M3z7_a_IoIIk6pQOxRXPOUJy6XiUqR51YUa6AITp5SmVNaIkFleHnjVuXYYL5XIBKMNVZ2qKhFSfzWeFCWvVD27YCJF8camGPc800gxBcNObc_wKHaNzGKuLtgGuIUmrWJNp3bTLMNBuNVjqdoZtRi0Hn9JGtxI0taQtoGNuQ2hzb17kpa8QrG-weMNCfdt8PH8xTFHQwxzG63Ogl9QJLVMnYnlL20ZweeG3twFPAFzCk7ogu8tltF0hq0A8B83TO6lRBsv3o5H4uus1PF4V2j972EpDlF0cK3e_lwMs6f-zAgGG_d6efgA2pid4A!!/dz/d5/L2dBISEvZ0FBIS9nQSEh/" target="blank"><button>Certificado de prestaciones</button></a></div>
            <div class="boton"><a onclick="return preguntar()" href="https://rdeinaem.aragon.es/" target="blank"><button>Renovar demanda de empleo</button></a></div>
            <div class="boton"><a onclick="return preguntar()" href="https://sede.agenciatributaria.gob.es/Sede/procedimientoini/G229.shtml" target="blank"><button id="ultimo_boton">Obtener declaración de la renta</button></a></div>
            <div id="busqueda">Más opciones</div>
        </div>
    </section>
    <hr>
    <footer id="pie">
            <p class="footer" href="#">Teléfono de contacto <span><svg id="tf" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg></span></p>
        <a class="footer" href="<?php echo RUTABASE . 'contacto'; ?>">e-mail <span><svg id="mail" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg></span></a>
        <div class="footer"><a href="#imagen_principal">Ir arriba </a><span><svg id="arriba" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
          </svg></span></div>
        <div class="footer"><a href="<?php echo RUTABASE . 'trabajos'; ?>">volver </a><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg></span></div>
    </footer>
</body>
</html>