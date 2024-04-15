<!DOCTYPE html>
<html lang="es">

   
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self'; object-src 'self'">
    <meta name="description" content="Página de un profesor particular">
    <link rel="shortcut icon" href="<?php echo FAVICON . "favicon.ico"; ?>">
    <title><?php echo $datos['titulo']; ?></title>
    <link rel="preload" href="<?php echo CSS . 'normalice.css'; ?>" rel="stylesheet" as="style">
    <link href="<?php echo CSS . 'normalice.css'; ?>" rel="stylesheet" type="text/css">
    <link rel="preload" href="<?php echo CSS . 'clases.css'; ?>" as="style">
    <link href="<?php echo CSS . 'clases.css'; ?>" rel="stylesheet" type="text/css">
    <link rel="preload" as="image" href="./publico/imagenes/clases/principal.avif">
</head>

<body>
    <header>
        <h1 class="titulo">Tu profesor a distancia</h1>
    </header>
    <div class="navegacion__fondo">
        <nav class="navegacion__enlaces contenedor">

            <a href="#">Tarifas</a>
            <a href="#">Testimonios</a>
            <a href="#">Contacto</a>
            <a href="<?php echo RUTABASE . 'trabajos'; ?>">Volver</a>
        </nav>
    </div>
    <section class="imagen_principal">
        <div class="contenido_imagen_principal">
            <h2>Informática para adultos y niños</h2>
            <div class="contratar">
                <p>En cualquier lugar del mundo</p>
            </div>
            <a class="boton__contratar" href="#">Contratar</a>
            <div class="casa__contenedor">
                <a href="<?php echo RUTABASE . "trabajos"; ?>" aria-label="volver a xemicris">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </div>
        </div> 
    </section>
    <main class="contenedor__principal sombra">
        <h2>Qué ofrezco</h2>
        <div class="trabajos">
            <section class="trabajo">
                <h3>Sistema Operativo</h3>
                <div class="icono__fondo">
                    <img class="icono" src="<?php echo IMAGENES . 'clases/linux.svg'; ?>" width="50" height="50" alt="linux">
                </div>
                <p>
                    Aprenderás a utilizar con soltura el sistema operativo que tú prefieras, bien sea Windows o Linux a nivel
                    de usuario
                </p>
            </section>
            <section class="trabajo">
                <h3>Paquete ofimático</h3>
                <div class="icono__fondo">
                    <img class="icono" src="<?php echo IMAGENES . 'clases/office.svg'; ?>" width="50" height="50" alt="libre office">
                </div>
                <p>
                    Veremos las funcionalidades más importantes que incluye el Paquete Microsoft Office para que 
                    puedas sacarle el máximo partido y tu productividad se incremente
                </p>
            </section>
            <section class="trabajo">
                <h3>Internet</h3>
                <div class="icono__fondo">
                    <img class="icono icono__internet" src="<?php echo IMAGENES . 'clases/internet.svg'; ?>" width="50" height="50" alt="internet">
                </div>
                <p>
                    Profundizaremos en una navegación a través de internet segura deshechando malas prácticas
                    para prevenir posibles infecciones sobre todo de las redes sociales
                </p>
            </section>
        </div> 
        <section>
            <h2>Formulario de contacto</h2>
            <form class="formulario">
                    <div class="contenedor-campos">
                        <div class="campo">
                            <label>Nombre</label>
                            <input type="text" placeholder="Tu nombre" />
                        </div>
                        <div class="campo">
                            <label>Teléfono</label>
                            <!-- tel saca en móvil teclado de números  -->
                            <input type="tel" placeholder="Tu teléfono" />
                        </div>
                        <div class="campo">
                            <label>Correo</label>
                            <input type="email" placeholder="Tu correo" />
                        </div>
                        <div class="campo">
                            <label for="mensaje">Mensaje</label>
                            <textarea id="mensaje"></textarea>
                        </div>
                    </div> 
                    <div class="boton__enviar">
                        <input class="boton pequeno-width-100 width-100" type="submit" value="Enviar">
                    </div>
            </form>
        </section>
    </main>
    <footer class="footer">
        <p><a href="https://xemicris.com">xemicris.com</a></p>
    </footer>
</body>

</html>