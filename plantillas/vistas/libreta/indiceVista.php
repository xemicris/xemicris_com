<?php require_once INCLUDES . '/libreta/header.php' ?>
<body>
    <div class="container-xl">
        <div class="py-4 py-lg-5 text-center">
            <h2 class="logo">Libreta de ingresos y gastos</h2>
            <p class="text-muted">LLeva un control de tus ingresos y gastos</p>
        </div>
        <!--opciones-->
        <div class="row">
            <div class="contenedor_casa">
                <a href="<?php echo RUTABASE . "trabajos"; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="casa w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </div>
            <div class="col-xl-8">
                <div class="card mb-3 curved curved-hz-2">
                    <div class="card-header text-center"><h5 class="titulos">Opciones de visualización de los movimientos</h5></div>
                    <div class="card-body">
                        <form id="opciones">
                            <div class="form-group row">
                                <div class="col-4">
                                    <label class="subtitulos centrarSubtitulos w-100" for="calcularImpuestos">¿Impuestos?</label>
                                    <select class="entradas form-select" name="calcularImpuestos" id="calcularImpuestos">
                                        <?php foreach (['Si', 'No'] as $opcion): ?>
                                            <option value="<?php echo $opcion; ?>" <?php echo obtenerOpcion('calcularImpuestos') === $opcion ? 'selected' : ''; ?> >
                                                <?php echo $opcion; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="centrarSubtitulos subtitulos w-100" for="impuestos">Porcentaje</label>
                                    <div class="input-group">
                                        <span class="entradas input-group-text" id="basic-addon1">%</span>
                                        <input type="text" class="entradas form-control" id="impuestos" name="impuestos" value="<?php echo obtenerOpcion('impuestos'); ?>" maxlength="2">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="centrarSubtitulos subtitulos w-100" for="moneda">Moneda</label>
                                    <select name="moneda" id="moneda" class="entradas form-select">
                                        <?php foreach(obtenerMonedas() as $moneda): ?>
                                            <option value="<?php echo $moneda; ?>" <?php echo obtenerOpcion('moneda') === $moneda ? 'selected' : ''; ?> >
                                                <?php echo $moneda; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="captchaOpcionesContenedor">
		                            <div class="captcha" id="opcapguar"></div>
		                        </div>
                                <div class="botonGuardarContenedor d-flex justify-content-end">
                                    <button class="botones btn btn btn-success mt-3" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-3">
                    <div class="card-header text-center"><h5 class="titulos">Seleccionar Fecha</h5></div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <label class="subtitulos" for="calcularImpuestos">Fecha</label>
                        <div class="fecha">
                            <input type="date"  class="entradas form-control" id="calendario" name="calendario">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--formulario-->

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="titulos tituloForm text-center">Agregar nuevo movimiento</h5>
                    </div>
                    <div class="card-body">
                        <form class="agregarMovimiento" novalidate>
                            <div class="form-group row">
                                <div class="col-xl-4 bajarPequeno">
                                    <label class="centrarSubitulos subtitulos w-100" for="tipo">Tipo de movimiento</label>
                                    <select name="tipo" id="tipo" class="entradas form-select w-100" required>
                                        <option value="ninguno">Selecciona...</option>
                                        <option value="gastos">Gasto</option>
                                        <option value="ingresos">Ingreso</option>
                                    </select>
                                    <div class="invalid-feedback">Selecciona un tipo de movimiento válido</div>
                                </div>
                                <div class="col-xl-4 bajarPequeno">
                                    <label class="centrarSubitulos subtitulos w-100" for="descripcion">Descripción</label>
                                    <input type="text" class="form-control entradas" id="descripcion" name="descripcion" 
                                    placeholder="Caracteres: 5-15" value="" required maxlength="15">
                                    <div class="invalid-feedback">Ingresa una descripción</div>
                                </div>
                                <div class="col-xl-4 mb-3">
                                <label class="centrarSubtitulos subtitulos w-100" for="Cantidad">Cantidad</label>
                                <div class="input-group">
                                    <span class=" tipoMoneda input-group-text"><?php echo obtenerOpcion('moneda'); ?></span>
                                    <input type="text" class="form-control entradas" id="cantidad" name="cantidad" placeholder="Max: 10 números"
                                        required maxlength="10">
                                </div>
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="captchaAgregarContenedor">
		                            <div class="captcha" id="movcapagr"></div>
		                        </div>
                                <div class="botonAgregarContenedor">
                                    <button class="botones botonAgregar btn btn-primary btn" type="submit">Agregar</button>
                                </div>
                            </div>
                        </form>
                        <div class="movimientosActualizar">
                            <!--ajax-->
                        </div>
                    </div>
                </div>
            </div>

            <!--lista de movimientos-->
            <div class="col-xl-4">
                <div class="movimientos">
                    <!--ajax-->
                </div>
            </div>
        </div>
    </div>
<?php require_once INCLUDES . '/libreta/footer.php' ?>
