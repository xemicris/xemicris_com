<?php require_once INCLUDES . 'home/header.php' ?>
    <main class="proyecto">
        <header class="proyecto-titulo">
            <h1>Firos</h1>
        </header>
        <article id="galeria" class="galeria contenedor proyecto-contenido">
            <div class="proyecto-texto">
                <h2 class="proyecto-sbt2">Breve descripción:</h2>
                <p class="proyecto-parrafo1">
                    Firos es una aplicación web que implementa un sistema de fichaje, permitiendo al usuario registrar sus entradas y salidas del trabajo
                    de una forma cómoda y rápida.  Puede, además, consultar en cualquier momento el balance de horas trabajadas, las horas extras, las
                    que le quedan pendientes así como reservar sus vacaciones anuales. Por su parte el empresario dispone de la 
                    información necesaria para el control del cumplimiento de la jornada laboral de sus empleados.
                </p>
                <h2 class="proyecto-sbt2">Tecnologías aplicadas:</h2>
                <div class="proyecto-contenedor-lista">
                    <ul class="-ul">
                        <li class="">HTML</li>
                        <li class="">CSS</li>
                        <li class="">BOOTSTRAP 5</li>
                        <li class="">MySQL</li>
                        <li class="">PHP</li>
                    </ul>
                </div>
                <h2 class="proyecto-sbt2">Creadores del proyecto:</h2>
                <div class="proyecto-autores">
                    <p>Roseanne Aline Souza Da Silva</p>
                    <p>José Maria Calavia Rivera</p> 
                </div>
                <h2 class="proyecto-sbt2">Características destacadas:</h2>
                <div class="proyecto--lista--caracteristicas">
                    <ol>
                        <li class="proyecto--lista--li1">Espacio con interfaz dinámica y adaptable a dispositivos móviles.</li>
                        <li class="proyecto--lista--li1">Sistema de login para un acceso seguro y diferenciado según el rol del usuario.</li>
                        <li class="proyecto--lista--li1">Panel del trabajador, donde podrá:
                            <ol>
                                <li  class="proyecto--lista--li2">Registrar el inicio y fin de su jornada laboral.</li>
                                <li  class="proyecto--lista--li2">Visualizar una estimación horaria de lo que lleva trabajado y el tiempo que le resta para su salida.</li>
                                <li  class="proyecto--lista--li2">Llevar un control de sus fichajes pasados a través de su Informe mensual.</li>
                                <li  class="proyecto--lista--li2">Reservar sus vacaciones anuales (días disponibles, días gastados,...).</li>
                                <li  class="proyecto--lista--li2">Gestionar ciertos datos propios y modificar su foto desde el perfil.</li>
                                <li  class="proyecto--lista--li2">Cambiar el color de la interfaz eligiendo entre un modo oscuro o claro.</li>
                            </ol>
                        </li>
                        <li class="proyecto--lista--li1">Panel del empresario, donde podrá:
                            <ol>
                                <li class="proyecto--lista--li2">Visualizar los datos más relevantes de una forma sencilla (los empleados que faltan
                                    por fichar o las horas mensuales que lleva cada uno, por ejemplo).</li>
                                <li class="proyecto--lista--li2">Comprobar el histórico de fichajes de cada trabajador en el informe mensual de la empresa.</li>
                                <li class="proyecto--lista--li2">Modificar ciertos datos de sus empleados así como los suyos propios.</li>
                                <li  class="proyecto--lista--li2">Cambiar el color de la interfaz eligiendo entre un modo oscuro o claro.</li>
                            </ol>
                        </li>
                    </ol>          
                </div>
            </div>
            <!--Aquí se inyectan con JS -->
            <div>
                <div>
                    <h2 class="proyecto-sbt">Galería</h2>
                </div>
                <div class="galeria-imagenes"></div>
            </div>
        </article>
        <footer class="proyecto-pie">
            <a href="<?php echo PDF . 'Manual Usuario Firos.pdf' ?>"  class="boton" download="Manual de usuario proyecto.pdf">Manual Usuario</a>
            <a href="https://firos.xemicris.com" class="boton">Ir a Firos</a>
        </footer>
    </main>
    <script type="text/javascript" src="<?php echo JS . "resumenProyectos.js"; ?>"></script>
<?php require_once INCLUDES . 'home/footer.php' ?>
