<?php require_once INCLUDES . 'home/header.php' ?>
    <div class="contenedor__perfil">
        <!--card-->
        <div class="card">
            <div class="card__borde">
                <div class="card__perfil">
                    <img src="<?php echo IMAGENES . "masinfo/perfil.avif"; ?>" alt="imagen perfil" width="300" height="400" class="card__imagen">
                </div>
            </div>
            <h2 class="card__nombre">José Maria Calavia Rivera</h2>
            <span class="card__profesion">Desarrollador Web</span>

            <!--Card info-->
            <div class="info">
                <div class="info__icono"><img src="<?php echo IMAGENES . "masinfo/info_perfil.svg"; ?>" class="info_perfil" alt="icono más información del perfil" width="20" height="20"></div>
                <div class="info__icono-cerrar"><img src="<?php echo IMAGENES . "masinfo/info_perfil_cerrar.svg"; ?>" alt="icono para cerrar más información del perfil" width="30" height="30" loading="lazy"></div>
            
                <div class="info__borde">
                    <div class="info__perfil">
                        <img src="<?php echo IMAGENES . "masinfo/perfil.avif"; ?>" alt="imagen card" class="info__imagen" loading="lazy">
                    </div>
                </div>
                <div class="info__datos">
                    <h3 class="info__nombre">José Maria Calavia Rivera</h3>
                    <span class="info__profesion">Desarrollador Web</span>
                    <span class="info__ubicacion">Huesca - Aragón - España</span>
                </div>
                <div class="info__social">
                    <a href="https://www.linkedin.com/in/jos%C3%A9-maria-c-477685273/" target="_blank" class="info__social-link">
                        <span class="info__social-icono">
                            <img class="info__social-icono--color" src="<?php echo IMAGENES . "masinfo/linkedin.svg"; ?>" alt="icono LinkedIn" width="30" height="30" loading="lazy">
                        </span>
                    </a>
                    <a href="https://github.com/xemicris" target="_blank" class="info__social-link">
                        <span class="info__social-icono">
                            <img class="info__social-icono--color" src="<?php echo IMAGENES . "masinfo/github.svg"; ?>" alt="icono github" width="30" height="30" loading="lazy">
                        </span>
                    </a>
                    <a href="<?php echo RUTABASE . "contacto"; ?>" target="_blank" class="info__social-link">
                        <span class="info__social-icono">
                            <img class="info__social-icono--color" src="<?php echo IMAGENES . "masinfo/mail.svg"; ?>" alt="icono mail" width="30" height="30" loading="lazy">
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="texto">
            <p>
                En este portafolio te mostraré algunos de los desarrollos que he ido realizando
                desde que me incribí en el ciclo de Desarrollo de Aplicaciones Web en el instituto Fomento Ocupacional 
                (FOC), el cual terminé a finales de 2022.
            </p>
            <p>
                Unos los podrás visualizar y/o descargar a través de videos que he grabado, ya que no se hicieron pensados en implementarse
                en un entorno web, mientras que otros los desplegaré para que puedas probarlos. Quiero destacar 
                <strong>Pixeos</strong>, el proyecto web en el que estoy trabajando actualmente.
            </p>
            <p>
                Tecnologías y herramientas con las que he trabajado: Java, HTML5, CSS, JavaScript, PHP, MySQL, 
                Spring Boot (prácticas en empresa), Apache Web Sever, Apache Tomcat, Git, Composer, Vite, React, Jest, 
                React Testing Library 
            </p>
        </div>
    </div>

    <script src="<?php echo JS . 'info.js' ?>"></script>
    <?php require_once INCLUDES . 'home/footer.php' ?>