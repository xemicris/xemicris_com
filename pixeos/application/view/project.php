<?php include_once("header.php"); ?>

<main>
    <div class="container-xl">
        <div class="row altura ancho-tareas h-100 align-items-center justify-content-center">
            <div class="col-lg-12 w-100 tareas">
                <!-- MODAL CREAR | EDITAR -->
                <div class="modal fade" id="modalTareaCrearEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="tarea-header-modal modal-header <?php echo $dato['colorProyecto'] ?>">
                                <h2 class="modal-title text-center" id="encabezadoCrearEditar"></h2>
                                <button type="button" id="aspaTareas" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formularioTarea" method="POST">
                                    <div>
                                        <label for="tituloCrearEditar" class="col-form-label">Título:</label>
                                        <input type="text" name="nombreTarea" class="form-control" id="tituloCrearEditar" maxlength="40">
                                        <span id="descripcionCaracteresInput">40 caracteres restantes</span>
                                    </div>
                                    <div>
                                        <label for="descripcionCrearEditar" class="col-form-label">Descripción:</label>
                                        <textarea name="descripcionTarea" class="form-control resize-none" id="descripcionCrearEditar"  maxlength="1500" rows="8"></textarea>
                                        <span id="descripcionCaracteresTextArea">1500 caracteres restantes</span>
                                    </div>
                                    <label for="fechaCrearEditar" class="col-form-label">Fecha:</label>
                                    <div class="fechas">
                                        <input type="date" id="fechaCrearEditar" name="fecha" class="form-control" />
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
                <!-- MODAL MOSTRAR -->
                <div class="modal fade" id="modalTareaMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="tarea-header-modal modal-header <?php echo $dato['colorProyecto'] ?>">
                                <h2 class="modal-title text-center" id="encabezadoMostrar"></h2>
                                <button type="button" id="aspaTareas" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <h6><b>Título:</b> <span id="tituloMostrar"></span></h6>
                                </div>
                                <div class="mb-3">
                                    <p><b class="descripcionTarea">Descripción:</b> <span id="descripcionMostrar"></span></p>
                                </div>
                                <div class="mb-3">
                                    <p id="fechaLabel"><b>Fecha:</b> <span id="fechaMostrar"></span></p>
                                </div>
                                <div class="mb-3">
                                    <p id="iconoNotificacion"><b>Notificación:</b>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="iconoNotificacion__tamano iconoNotificacion__si icon icon-tabler icon-tabler-checkbox" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 11l3 3l8 -8" />
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="iconoNotificacion__tamano iconoNotificacion__no icon icon-tabler icon-tabler-square-letter-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                            <path d="M10 8l4 8" />
                                            <path d="M10 16l4 -8" />
                                        </svg>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAREAS -->
                <div class="card sombra-formulario" style="margin-top:150px; margin-bottom: 25px">
                    <?php
                    foreach ($datos['proyecto'] as $dato) : ?>
                        <div class="card-header shadow-lg header-tareas mx-auto text-center fs-3 rounded <?php echo $dato['colorProyecto'] ?>"><?php echo $dato['nombreProyecto'] ?></div>
                    <?php endforeach; ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="titulosTareas text-center">
                                        <th class="col col-3 titulosTareas--primero">Titulo <i class="bi bi-sort-alpha-down icono--orden icono--orden__nombre"></i></th>
                                        <!-- <th class="col col-4">Descripción</th> -->
                                        <th class="col col-3">Fecha <img src="<?php echo RUTA . 'public/images/calendario_abajo.svg'; ?>" alt="icono calendario" class="icono--orden icono--orden__calendario"></th>
                                        <th class="col col-2">Completado</th>
                                    </tr>
                                </thead>
                                <!-- parte dinámica -->
                                <tbody id="tareas" class="text-center">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="barra-progreso" class="progress" style="height: 30px;">

                        </div>
                        <div class="panelTareas d-flex justify-content-between">
                            <div>
                                <a href="<?php echo RUTA . 'panel/index' ?>" class="botonTarea botonTarea__izq  btn btn-secondary btn-sm mt-3 mb-3"><i class="bi bi-arrow-return-left"></i> Regresar</a>
                            </div>
                            <div>
                                <button id="btnEliminarTodo" class=" botonTarea btnEliminarTodoOculto btn btn-danger btn-sm mt-3 mb-3">Eliminar todo</button>
                            </div>
                            <div>
                                <i id="btnCrear" class="bi bi-plus-circle-fill fs-2 btn btn-sm btn-outline-primary border-0 mt-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <?php include_once("footer.php"); ?>