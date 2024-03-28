<?php require_once INCLUDES . 'biblioteca/header.php' ?>

<ul id="autores">
    <!-- Mostramos una entrada por cada autor -->
    <?php foreach ($datos['autores'] as $autor) : ?>
        <li>
            <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
            <a href="<?php echo RUTABASE . "biblioteca/autor/" . $autor["id"]  ?>">
                <?php echo $autor["nombre"] . " " . $autor["apellidos"] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<p id="sug"><span id="sugerenciasAutores"></span></p>
<span class="error ocultar" id="error_texto">Formato incorrecto: solo se admiten letras</span>

<?php require_once INCLUDES . 'biblioteca/footer.php' ?>