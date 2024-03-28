<?php require_once INCLUDES . 'biblioteca/header.php' ?>

<div class="datos" id="datos">
    <table>
        <tr>
            <td>Nombre: </td>
            <td> <?php echo $datos['autor'][0]['nombre'] ?></td>
        </tr>
        <tr>
            <td>Apellidos: </td>
            <td> <?php echo $datos['autor'][0]['apellidos'] ?></td>
        </tr>
        <tr>
            <td>Nacionalidad: </td>
            <td> <?php echo $datos['autor'][0]['nacionalidad'] ?></td>
        </tr>
        <tr>
            <td>Libros: </td>
            <td><?php foreach ($datos['libros'] as $libro) : ?>
                    <a href="<?php echo RUTABASE . 'biblioteca/libro/' . $libro['id']; ?>">
                        <?php echo $libro['titulo']; ?>
                    </a>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
    <br />
</div>

<?php require_once INCLUDES . 'biblioteca/footer.php' ?>