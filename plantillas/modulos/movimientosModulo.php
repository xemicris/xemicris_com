<h2 class="d-flex justify-content-center align-items-center mt-3 mt-lg-0 mb-3 gap-3">
    <div class="mb-1">
    <span class="titulos text-muted">Movimientos</span>
    </div>
    <span class="badge bg-warning text-dark rounded-pill"><?php echo isset($datos['cal']['totalMovimientos']) ? $datos['cal']['totalMovimientos'] : ''; ?></span>
</h2>
<ul class="list-group mb-3">
    <?php if($datos && isset($datos['movimientos']) && $datos['movimientos'] != false):?>
        <?php foreach ($datos['movimientos'] as $movimiento): ?>
            <li class="list-group-item d-flex justify-content-between
                <?php echo $movimiento['tipo'] === 'ingresos' ? '' : 'bg-light'; ?> actualizar" 
                    data-id="<?php echo $movimiento['id']; ?>"
            >
                <div class="<?php echo $movimiento['tipo'] === 'ingresos' ? 'text-success' : 'text-danger'; ?>">
                    <h3 class="my-0 titulos"><?php echo $movimiento['tipo'] === 'ingresos' ? 'Ingreso' : 'Gasto'; ?></h3>
                    <small class="text-muted subtitulos"><?php echo $movimiento['descripcion']; ?></small>
                </div>
                <div class="d-flex align-items-center justify-content-start w-25">
                    <span class=" <?php echo $movimiento['tipo'] === 'ingresos' ? 'text-success' : 'text-danger'; ?>">
                        <?php echo $movimiento['tipo'] === 'ingresos' ? '+' : '-';
                        echo moneda($movimiento['cantidad']); ?>
                    </span>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <button class="botonEditar btn btn-sm btn-primary float-right mt-1 mb-1" data-id="<?php echo $movimiento['id']; ?>">
                        <i class="bot bi bi-pencil-square fs-5"></i>
                    </button>

                    <button class="botonBorrar btn btn-sm btn-danger float-right mt-1 mb-1" data-id="<?php echo $movimiento['id']; ?>">
                        <i class="bot bi bi-trash3 fs-5"></i>
                    </button>
                </div>
                
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Hoy no hay registrados movimientos</p>
    <?php endif; ?>
</ul>
    

<ul class="list-group mb-3">
    
    <?php 
        if(isset($datos['cal']['total'])){
            if(obtenerOpcion('calcularImpuestos') === 'Si'){
    ?>
                <li class="sombraParcial subtitulos list-group-item d-flex justify-content-between">
                    <span>Subtotal (<?php echo obtenerOpcion('moneda'); ?>)</span>
                    <strong><?php echo moneda($datos['cal']['subtotal']); ?></strong>
                </li>
                <li class="sombraParcial subtitulos list-group-item d-flex justify-content-between">
                    <span>Impuestos (<?php echo obtenerOpcion('impuestos').'%' ?>)</span>
                    <strong><?php echo moneda($datos['cal']['impuestos']); ?></strong>
                </li>
            <?php }; ?>

            <li class="sombraTotales fondoTotalDiario subtitulos list-group-item d-flex justify-content-between">
                <span>Total diario (<?php echo obtenerOpcion('moneda'); ?>)</span>
                <strong><?php echo (isset($datos['cal']['total']) ? moneda($datos['cal']['total']) : ''); ?></strong>
            </li>
        <?php }; ?>
    <li class="sombraTotales fondoTotalGlobal titulos list-group-item d-flex justify-content-between">
        <span>Total (<?php echo obtenerOpcion('moneda'); ?>)</span>
        <strong><?php echo moneda($datos['cal']['totalGlobal']); ?></strong>
    </li>
</ul>