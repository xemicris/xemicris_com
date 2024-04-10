
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous" fetchpriority="low"></script>
          <script type="module" src="<?php echo RUTA ?>js/getProjectRoutes.js" fetchpriority="low" crossOrigin="anonymous"></script>
          <script type="module" src="<?php echo RUTA ?>js/password.js" fetchpriority="low" crossOrigin="anonymous"></script>
          <?php
            $urlActual = $_SERVER["REQUEST_URI"];
            $url = encabezado(($urlActual));
            if ($url == 'login' || $url == 'registration' || $url == 'recover') {
            ?>
              <div class="container-md">
                  <div class="card sombra-formulario">
                      <ul class="politicas gap-3 m-2">
                          <li><a href="<?php echo RUTA . '/access/legal'; ?>">Aviso Legal</a></li>
                          <li><a href="<?php echo RUTA . '/access/privacy'; ?>">Política de Privacidad</a></li>
                          <li><a href="<?php echo RUTA . '/access/cookies'; ?>">Política de Cookies</a></li>
                          <li><a href="<?php echo XEMICRIS . 'resumenPixeos'; ?>">Ir a xemicris</a></li>
                      </ul>
                  </div>
              </div>
          <?php } else if ($url === 'panel' || $url === 'profile' || $url === 'project' || $url === 'viewStatistics' || $url === 'contact' || $url === 'calendar' || $url === 'admin' || $url === 'tec') { ?>
              <script type="module" as="script" src="<?php echo RUTA ?>js/darkMode.js" fetchpriority="low" crossOrigin="anonymous"></script>
              <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" link as="style" fetchpriority="low"></script>
              <script type="module" src="<?php echo RUTA ?>js/ocultarPanelSuperior.js" fetchpriority="low" crossOrigin="anonymous"></script>
          <?php } ?>

          <?php
            $urlActual = $_SERVER["REQUEST_URI"];
            $url = encabezado(($urlActual));
            if ($url == 'panel') {
            ?>
              <script type="module" src="<?php echo RUTA ?>js/notes.js" fetchpriority="low" crossOrigin="anonymous"></script>
              <script type="module" src="<?php echo RUTA ?>js/searchNotes.js" fetchpriority="low" crossOrigin="anonymous"></script>

          <?php } else if ($url == 'profile') { ?>

              <script src="<?php echo RUTA ?>js/profile.js" fetchpriority="low"></script>

          <?php } else if ($url == 'project') { ?>

              <script type="module" src="<?php echo RUTA ?>js/tasks.js" fetchpriority="low" crossOrigin="anonymous"></script>

          <?php } else if ($url == 'viewStatistics') { ?>

              <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" fetchpriority="low"></script>
              <script type="module" src="<?php echo RUTA ?>js/statistics.js" fetchpriority="low" crossOrigin="anonymous"></script>

          <?php } else if ($url == 'admin') { ?>

              <script type="module" src="<?php echo RUTA ?>js/admin.js" fetchpriority="low"></script>

          <?php } else if ($url == 'tec') { ?>

              <script type="module" src="<?php echo RUTA ?>js/incidencias.js" fetchpriority="low"></script>

          <?php } else if ($url == 'calendar') { ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" fetchpriority="low"></script>
              <!--toastr-->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" fetchpriority="low"></script>
              <script type="module" src="<?php echo RUTA ?>js/calendar.js"></script>
          <?php } ?>
          </footer>
          </body>

          </html>