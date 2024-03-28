<?php include_once("header.php"); ?>
<main>
    <div class="container-xl">
        <div class="altura row h-100 align-items-center justify-content-center">
            <div class="col-lg-12 w-100">
                <!-- MODAL -->
                <div class="modal fade" id="modalTec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="tarea-header-modal modal-header text-center">
                                <h5 class="modal-title" id="exampleModalLabel">Incidencia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formularioTec" method="POST">
                                    <div class="mb-4 me-1 ms-1 d-flex justify-content-between">
                                        <div>
                                            <label for="estado" class="col-form-label">Estado:</label>
                                            <select id="estado" name="estado">
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button id="botonTec" type="button" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- fin modal-->

                <!-- Card Usuarios -->
                <div class="card sombra-formulario" style="margin-top:150px; margin-bottom: 25px">
                    <div class="card-header shadow-lg header-tareas mx-auto text-center fs-3 bg-secondary text-white rounded">Panel de Incidencias</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">ID</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Comentario</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="incidencias" class="text-center">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
<?php include_once("footer.php"); ?>