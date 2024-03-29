<?php include_once("header.php"); ?>

<main class="main mt-5 pt-3 mx-auto">
  <div class="contenedor container-fluid">
    <div class="row">
      <div class="altura-proyectos col-md-12 fw-bold fs-1 text-center">
        <!-- subtítulo -->
        <h1><?php echo $datos['subtitulo'] ?></h1>
      </div>
    </div>
    <!-- búsquedas -->
    <div class="sugerencias">

    </div>
    <div class="notas__tarjeta--contenedor">
      <div class="notas__radio--contenedor">
        <div class="form-check">
          <input class="form-check-input radioNota" type="radio" name="radioNotas" id="radioNotas1" value="noCompletadas" checked>
          <label class="form-check-label" for="radioNotas1">Sin Completar</label>
        </div>
        <div class="form-check">
          <input class="form-check-input radioNota" type="radio" name="radioNotas" id="radioNotas2" value="completadas">
          <label class="form-check-label" for="radioNotas2">Completadas</label>
        </div>
        <div class="form-check">
          <input class="form-check-input radioNota" type="radio" name="radioNotas" id="radioNotas3" value="todas">
          <label class="form-check-label" for="radioNotas3">Todas</label>
        </div>
      </div>
      <form class="notas__formulario d-flex ms-auto" role="search" method="POST">
        <div class="input-group">
          <input type="text" name="buscar" id="inputBuscar" class="form-control text-center" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-primary" type="button" id="btnBuscar"><i class="bi bi-search"></i></button>
        </div>
      </form>
      <div class="notas__nuevaTarea--contenedor">
        <i class="crear bi bi-plus-circle-fill fs-2 border-0" data-bs-toggle="modal" data-bs-target="#modal1"></i>
      </div>
    </div>

    <!-- Notas -->
    <div class="zona">
      <h3 class=" titSin text-center mt-2"></h3>
      <div class="mx-auto proyectos row mt-5"></div>
    </div>
  </div>
  <!-- elementos modales de creación y edición -->
  <div class="project">
    <div id="modalNotaCrearEditar" class="modal fade">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="tituloNota modal-title text-center"></h2>
            <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
          </div>
          <div class="modal-body">
            <form id="formularioModalCrearEditar" method="POST">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la nota</label>
                <input id="nombre" name="nombre" type="text" class="form-control" maxlength="40">
                <span id="nombreCaracteresInput">40 caracteres restantes</span>
              </div>
              <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="cancelar btn btn-danger cerrar" data-bs-dismiss="modal">Cancelar</button>
                <button id="CrearEditarNota" type="submit" class="prueba btn btn-primary cerrar"><i class="bi bi-plus-circle-fill"></i> </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL CREAR TAREA -->
  <div class="modal fade" id="modalTareaCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="tarea-header-modal modal-header">
          <h2 class="modal-title text-center" id="encabezadoCrear"></h2>
          <button type="button" id="aspaTareas" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formularioTarea" method="POST">
            <div class="tituloCrear--contenedor">
              <label for="tituloCrear" class="col-form-label">Título:</label>
              <input type="text" name="nombreTarea" class="form-control" id="tituloCrear" maxlength="40">
              <span id="descripcionCaracteresInput">40 caracteres restantes</span>
            </div>
            <div class="descripcionCrear--contenedor">
              <label for="descripcionCrear" class="col-form-label">Descripción:</label>
              <textarea name="descripcionTarea" class="form-control resize-none" id="descripcionCrear" rows="8" maxlength="1500"></textarea>
              <span id="descripcionCaracteresTextArea">1500 caracteres restantes</span>
            </div>
            <label for="fechaCrear" class="col-form-label">Fecha:</label>
            <div class="fechas">
              <input type="date" id="fechaCrear" name="fecha" class="form-control" />
              <select class="form-select tarea-casilla" id="notif" name="notificacion" aria-label="Default select example">
                <option value="">Notificación por correo</option>
                <option value="unica">Única</option>
                <option value="diaria">Diaria</option>
                <option value="semanal">Semanal</option>
                <option value="mensual">Mensual</option>
              </select>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <button type="button" class="btn btn-danger cerrar" data-backdrop="false" data-bs-dismiss="modal">Cancelar</button>
              <button id="botonTareas" type="button" class="btn-crear btn btn-success cerrar"></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="project2"></div> -->

</main>
<script src="<?php echo RUTA ?>js/profileHeight.js"></script>
<script src="<?php echo RUTA ?>js/html2pdf.bundle.min.js"></script>
<footer>
  <?php include_once("footer.php"); ?>