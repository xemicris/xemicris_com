<?php include_once 'header.php' ?>

<main class="main">
    <div class="container-xl">
        <div class="altura row h-100 pt-5 align-items-center justify-content-center">
            <div class="col-lg-9 pt-5">
                <!-- card contacto -->
                <div class="card mt-5 mb-3 contacto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="head text-center py-3">
                                    <h3>Contacto</h3>
                                </div>
                            </div>
                        </div>
                        <div>
                            <form action="<?php echo htmlentities(RUTA . 'panel/contact/');?>" method="POST" class="p-3">
                                <div class="my-5 d-flex gap-3">
                                    <!-- nombre -->
                                    <div class="col-lg-6">
                                        <input type="text" name="nombre" value="<?php echo $datos['usuario']['nombre'] ?>" class="contact-input text-center" placeholder="Nombre" required>
                                        <span class="borde-animado"></span>
                                    </div>
                                    <!-- apellidos -->
                                    <div class="col-lg-6">
                                        <input type="text" name="apellidos" value="<?php echo $datos['usuario']['apellidos'] ?>" class="contact-input text-center" placeholder="Apellidos" required>
                                        <span class="borde-animado"></span>
                                    </div>
                                </div>
                                <div class="pb-5">
                                    <div class="col-lg-12">
                                        <!-- correo -->
                                        <input type="email" name="correo" value="<?php echo $datos['usuario']['correo'] ?>" class="contact-input text-center " placeholder="Correo" required>
                                        <span class="borde-animado"></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-lg-12">
                                        <!-- mensaje -->
                                        <input type="text" name="mensaje" class="contact-input" placeholder="Escribe tu mensaje" required>
                                        <span class="borde-animado"></span>
                                    </div>
                                </div>
                                <div class="pt-4 d-flex align-items-center justify-content-between align-items-center mt-2">
                                    <div class="col-lg-4">
                                        <select name="consulta" required class="motivo-consulta form-select me-2">
                                            <option selected>Motivo</option>
                                            <option value="1">Consulta</option>
                                            <option value="2">Incidencia</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="robot"><input type="checkbox" required class="form-check-input me-2">No soy un robot</p>
                                    </div>
                                </div>
                                <div class="enviar-mensaje">
                                        <button type="submit" class="btn btn-primary boton-enviar">Enviar Mensaje</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div><!--fin card contacto-->
            </div>
        </div>
    </div>
</main>
<footer>
    <?php include_once 'footer.php'?>