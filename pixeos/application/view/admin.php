<?php include_once("header.php"); ?>
<main>
    <div class="container-xl">
        <div class="row altura h-100 align-items-center justify-content-center">
            <div class="col-lg-12 w-100">
                <!-- MODAL -->
                <div class="modal fade" id="modalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="tarea-header-modal modal-header text-center">
                                <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formularioAdmin" method="POST">
                                    <div class="mb-3">
                                        <label for="nombre" class="col-form-label">Nombre:</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                                        <input type="text" name="apellidos" class="form-control" id="apellidos">
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo" class="col-form-label">Correo:</label>
                                        <input type="text" name="correo" class="form-control" id="correo">
                                    </div>
                                    <div class="mb-4 me-1 ms-1 d-flex justify-content-between">
                                        <div>
                                            <label for="confirmado" class="col-form-label">Estado:</label>
                                            <select id="confirmado" name="confirmado">
                                            
                                            </select>
                                        </div>
                                        <div>
                                            <label for="rol" class="col-form-label">Rol:</label>
                                            <select id="rol" name="rol">
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button id="botonAdmin" type="button" class="btn btn-success"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- fin modal-->

                <!-- Card Usuarios -->
                <div class="card sombra-formulario" style="margin-top:150px; margin-bottom: 25px">
                    <div class="card-header shadow-lg header-tareas mx-auto text-center fs-3 bg-secondary text-white rounded">Panel de Usuarios</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="usuarios" class="text-center">

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