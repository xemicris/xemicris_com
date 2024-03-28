<?php require_once INCLUDES . 'home/header.php' ?>
    <section class="formulario__contenedor">
        <form action="<?php echo RUTABASE . 'contacto' ?>" method="POST" class="formulario">
            <h2 class="formulario__titulo">Formulario de contacto</h2>
            <div class="formulario__info">
                <div class="formulario__inputs">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" value="" name="nombre" class="formulario__input">
                    <span class="formulario__input-inferior"></span>
                </div>
                <div class="formulario__inputs">
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" value=""  name="apellidos" class="formulario__input">
                    <span class="formulario__input-inferior"></span>
                </div>
                <div class="formulario__inputs">
                    <label for="correo">Correo electrónico *</label>
                    <input type="text" id="correo" value="" name="correo" class="formulario__input">
                    <span class="formulario__input-inferior"></span>
                </div>
                <div class="formulario__inputs">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" value="" name="telefono" class="formulario__input">
                    <span class="formulario__input-inferior"></span>
                </div>
                <div class="formulario__inputs">
                    <label for="mensaje">Mensaje *</label>
                    <textarea id="mensaje" value="" name="mensaje" class="formulario__textarea"></textarea>
                </div>
            </div>
            <div class="formulario__boton">
                <p class="formulario__obligatorio">*Campos obligatorios</p>
                <input type="submit" value="Enviar mensaje" id="botonEnvioFormulario">
            </div>
        </form>
    </section>
<?php require_once INCLUDES . 'home/footer.php' ?>
