<?php require_once INCLUDES . 'home/header.php' ?>
    <main class="proyecto">
        <header class="proyecto-titulo">
            <h1>Proyecto web</h1>
        </header>
        <article id="galeria" class="galeria contenedor proyecto-contenido">
            <div class="proyecto-texto">
                <h2 class="proyecto-sbt2">Breve descripción:</h2>
                <p class="proyecto-parrafo1">Pixeos permite al usuario, tras registrarse y activar su cuenta, disponer de un 
                    espacio propio donde puede crear, editar y eliminar notas. Cada nota estará
                    compuesta por el número de tareas que  el usuario considere necesarias para concluir la nota. 
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
                <h2 class="proyecto-sbt2">Características destacadas:</h2>
                <div class="proyecto--lista--caracteristicas">
                    <ol>
                        <li class="proyecto--lista--li1">Espacio con interfaz dinámica y adaptable a dispositivos móviles.</li>
                        <li class="proyecto--lista--li1">Espacio propio donde crear tus notas y asignarles tareas. En concreto podrás:
                            <ol>
                                <li  class="proyecto--lista--li2">Crear, editar o eliminar una nota</li>
                                <li  class="proyecto--lista--li2">Compartir y descargar una nota</li>
                                <li  class="proyecto--lista--li2">Crear, editar o eliminar una o más tareas dentro de una nota</li>
                                <li  class="proyecto--lista--li2">Completar las tareas. Cuando todas estén completas la nota automáticamente también lo estará</li>
                                <li  class="proyecto--lista--li2">Darle una descripción a tus tareas</li>
                                <li  class="proyecto--lista--li2">Establecer una fecha</li>
                                <li  class="proyecto--lista--li2">Asignar a una tarea un recordatorio por email, bien sea único, diario, semanal o mensualmente</li>
                            </ol>
                        </li>
                        <li class="proyecto--lista--li1">Posibilidad de Seguimiento del progreso de tus notas mediante barra de progreso y estadísticas.</li>
                        <li class="proyecto--lista--li1">Funciones adicionales.
                            <ol>
                                <li class="proyecto--lista--li2">Descarga de notas en formato .pdf.</li>
                                <li class="proyecto--lista--li2">Comparte una nota con otro miembro de Pixeos para que pueda trabajar en ella.</li>
                                <li class="proyecto--lista--li2">Envia una nota a tu correo electrónico de una forma sencilla.</li>
                            </ol>
                        </li>
                        <li class="proyecto--lista--li1">Podrás ver tus notas a las que les has asignado una fecha en un calendario dinámico.</li>
                        <li class="proyecto--lista--li1">Sistema de contacto con la administración técnica de Pixeos mediante un formulario integrado.</li>
                        <li class="proyecto--lista--li1">Pefil propio con posiblidad de añadir imagen</li>
                        <li class="proyecto--lista--li1">Modo oscuro</li>
                    </ol>          
                </div>

                <h2 class="proyecto-sbt2">Actualizaciones:</h2>
                <div class="proyecto--lista--actualizaciones"><b>Versión 1.01</b>: 
                    <ol>
                        <li class="proyecto--lista--li3">Se ha añadido un apartado <strong>Calendario</strong> desde donde el usuario puede 
                            visualizar las tareas creadas. Al hacer clic aparecerá una ventana modal con el título de la/s tarea/s y si se 
                            clica encima de ella Pixeos le llevará a la nota donde ha creado el proyecto.
                        </li>
                        <li class="proyecto--lista--li3">Para complementar la funcionalidad anterior ahora el usuario en el momento de creación de
                            cada tarea la fecha de creación.
                        </li>
                        <li class="proyecto--lista--li3">Se ha incluido un botón <strong>Eliminar todo</strong> que permite borrar todas las tareas de una
                            nota de una vez
                        </li>
                        <li class="proyecto--lista--li3">Se han modificado estilos visuales.
                        </li>
                    </ol>  
                </div>
                <div class="proyecto--lista"><b>Versión 1.02</b>: 
                    <ol>
                        <li class="proyecto--lista--li3">Nueva <strong>ventana</strong> modal de información de cada tarea añadida.</li>
                        <li class="proyecto--lista--li3">Estilos visuales modificados</li>
                    </ol>  
                </div>
                <div class="proyecto--lista"><b>Versión 1.03</b>: 
                    <ol>
                        <li class="proyecto--lista--li3">Mejoras en la codificación.</li>
                        <li class="proyecto--lista--li3">Sistema de <strong>ordenación de tareas</strong> por nombre o fecha</li>
                        <li class="proyecto--lista--li3">Ahora el usuario puede <strong>recibir notificaciones</strong> en su correo electrónico de las tareas que desee en una fecha determinada o con periodicidad</li>
                        <li class="proyecto--lista--li3">Mejora del fondo oscuro</li>
                        <li class="proyecto--lista--li3">Algunos cambios visuales menores</li>
                    </ol>  
                </div>
                <div class="proyecto--lista"><b>Versión 1.04</b>: 
                    <ol>
                        <li class="proyecto--lista--li3">Posibilidad de <strong>descargar una nota</strong> en formato .pdf</li>
                        <li class="proyecto--lista--li3">Mejoras en la codificación.</li>
                        <li class="proyecto--lista--li3">Mejora del fondo oscuro.</li>
                        <li class="proyecto--lista--li3">Modificación visual para ir al portafolio.</li>
                    </ol>  
                </div>
                <div class="proyecto--lista"><b>Versión 1.05</b>:
                    <ol>
                        <li class="proyecto--lista--li3">Añadido sistema de <strong>compartición de notas</strong> con otros usuarios</li>
                        <li class="proyecto--lista--li3">Mejoras en la codificación y corrección de errores.</li>
                        <li class="proyecto--lista--li3">Cambio visual en la presentación de notas y buscador estando ahora más centralizado.</li>
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
            <a href="<?php echo PDF . 'Manual de usuario Pixeos.pdf' ?>"  class="boton" download="Manual de usuario Pixeos.pdf">Manual Usuario</a>
            <a href="<?php echo RUTABASE . 'pixeos' ?>" class="boton">Ir a Pixeos</a>
        </footer>
    </main>
    <script type="text/javascript" src="<?php echo JS . "resumenProyectos.js"; ?>"></script>
<?php require_once INCLUDES . 'home/footer.php' ?>
