<form class="actualizarMovimiento" novalidate>
    <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
    <div class="form-group row">

        <div class="col-xl-4">
            <label class="centrarSubitulos subtitulos w-100" for="tipo">Tipo de movimiento</label>
            <select name="tipo" id="tipo" class="form-select d-block w-100 entradas" required>
                <?php foreach ([['ninguno', 'Selecciona...'], ['gastos', 'Gasto'], ['ingresos', 'Ingreso']] 
                    as $opcion): ?>
                        <option value="<?php echo $opcion[0] ?>" <?php echo $opcion[0] === $datos['tipo'] ? 'selected' : '';?> >
                            <?php echo $opcion[1] ?>
                        </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Selecciona un tipo de movimiento válido</div>
        </div>

        <div class="col-xl-4">
            <label class="centrarSubitulos subtitulos w-100" for="descripcion">Descripción</label>
            <input type="text" class="form-control entradas" id="descripcion" name="descripcion" placeholder="Caracteres: 5-15" 
                value="<?php echo $datos['descripcion']; ?>" required maxlength="15">
            <div class="invalid-feedback">Ingresa una descripción</div>
        </div>

        <div class="col-xl-4 mb-3">
        <label class="centrarSubitulos subtitulos w-100" for="Cantidad">Cantidad</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>
            <input type="text" class="form-control entradas" id="cantidad" name="cantidad" placeholder="Max: 10 números" required
                value="<?php echo $datos['cantidad']; ?>" maxlength="10">
        </div>
    </div>
    </div>
    <div class="actualizarContenedor ">
        <div class="captchaAgregarContenedor">
		    <div class="captcha" id="movcapact"></div>
		</div>
        <div class="botonesActualizarContenedor">
            <a  class="botonCancelar botones btn btn-danger btn btn-block">Cancelar</a>
            <button class="botonActualizar botones btn btn-primary btn btn-block" type="submit">Actualizar</button>
        </div>
    </div>
</form>