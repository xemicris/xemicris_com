<?php include_once ("header.php"); ?>

<main class="main">
    <div class="container-xl">
        <div class="altura row h-100 pt-5 align-items-center justify-content-center">
            <div class="col-md-10 espacio-perfil">
                <form id="formulario" enctype="multipart/form-data" action="<?php echo htmlentities(RUTA . 'panel/profile');?>" method="POST">
                    <div class="row z-depth-3">
                        <!-- columna izquierda -->
                        <div class="col-sm-4 cartel-izquierdo">
                            <div class="card-block text-center text-white h-25">

                                <!-- imagen -->
                                <?php if(isset($datos['usuario']['imagen']) && !empty($datos['usuario']['imagen'])){ ?>
                                    <img class="perfil-grande mt-5" src="<?php echo RUTA. "images/".$datos['usuario']['imagen'] ?>" >
                                <?php }else{?>
                                    <i class="fas fa-user-tie fa-7x mt-5"></i>
                                <?php } ?>

                                <!-- nombre -->
                                <h2 class="font-weight-bold mt-4"><?php echo $datos['usuario']['nombre']?></h2>

                                <!-- profesión -->
                                <div class="form-group text-left mb-2">
                                    <input type="text" id="profesion" name="profesion" class="entrada form-control border-0 text-center bg-transparent text-white"
                                        placeholder="Indica a qué te dedicas" required
                                        value='<?php isset($datos["usuario"]["profesion"]) ? print $datos["usuario"]["profesion"]: "";?>'/>
                                </div>
                                <!-- icono seleccionar imagen -->
                                <div>
                                    <label for="imagen"><i class="icono far fa-edit fa-2x mb-4"></i></label>
                                    <input id="imagen" type="file" name="imagen">
                                </div>
                                <div id="nombre-imagen"></div>
                            </div>
                        </div>
                        <!-- columna derecha -->
                        <div class="col-sm-8 text-center cartel-derecho">
                            <h3 class="mt-3 text-center">Información</h3>
                            <hr class="badge-primary mt-0 w-25 mx-auto mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- correo -->
                                    <div class="form-group text-left mb-2">
                                        <label class="perfil__label fw-bold mb-2" for="correo">Correo Electrónico: </label>
                                        <input type="email" id="correo" disabled name="correo" class="form-control border-0 text-center"
                                            placeholder="Correo Electrónico"
                                            value='<?php isset($datos["usuario"]["correo"]) ? print $datos["usuario"]["correo"]: "";?>'/>
                                    </div>

                                </div>
                                <hr class="bg-primary my-4">
                                <!-- nombre -->
                                <div class="form-group col-sm-6 mt-2">
                                    
                                    <label class="perfil__label fw-bold mb-1" for="nombre">Nombre: </label>
                                    <input type="text" id="nombre" name="nombre" class=" entrada form-control border-0 text-center"
                                        value='<?php isset($datos["usuario"]["nombre"]) ? print $datos["usuario"]["nombre"]: "";?>' 
                                        placeholder="Nombre" pattern="[A-Za-záéíóúü\s]+" title="Solo se admiten letras" required/>
                                </div>
                                <!-- apellidos -->
                                <div class="form-group col-sm-6 mt-2">
                                    <label class="perfil__label fw-bold mb-1" for="apellidos">Apellidos: </label>
                                    <input type="text" id="apellidos" name="apellidos" class="entrada form-control border-0 text-center"
                                        placeholder="Apellidos" pattern="[A-Za-záéíóúü\s]+" title="Solo se admiten letras" required
                                        value='<?php isset($datos["usuario"]["apellidos"]) ?
                                        print $datos["usuario"]["apellidos"]: "";?>'/>
                                </div>
                            </div>
                            <div class="form-group my-4">
                                <button id="actualizar" type="submit" class="btn btn-secondary" role="button" >Actualizar</button>
                            </div> 
                </form>
                <div class="mb-2 d-flex justify-content-end">
                    <form id="borrarUsuario" action="<?php echo htmlentities(RUTA . 'panel/deleteUser');?>" method="POST">
                        <button id="borrarU" type="submit" class="btn btn-danger btn-sm" role="button" >Eliminar cuenta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <?php include_once ("footer.php"); ?>