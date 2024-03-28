<?php require_once INCLUDES . 'biblioteca/header.php' ?>

<div id="libros">
    <ul>
    <!-- Mostramos una entrada por cada autor -->
        <?php foreach ($datos['libros'] as $libro): ; ?>
        <div>
            <li>
                <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                    <a href="<?php echo RUTABASE . 'biblioteca/libro/' . $libro['id']; ?>">
                        <?php echo $libro['titulo']; ?>
                    </a>
            </li>
        </div>
        <?php endforeach; ?>
    </ul>
</div>
<p id="sug"><span id="sugerenciasLibros"></span></p>
<span class="error ocultar" id="error_texto">Formato incorrecto: solo se admiten letras</span>

<?php require_once INCLUDES . 'biblioteca/footer.php' ?>
