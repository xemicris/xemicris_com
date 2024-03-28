<?php require_once INCLUDES . 'biblioteca/header.php' ?>
<div class="datos">
    <table>
        <tr>
            <td>Titulo: </td>
            <td> <?php echo $datos['datosLibro'][0]['titulo']; ?></td>
        </tr>
        <tr>
            <td>ID del libro: </td>
            <td> <?php echo $datos['datosLibro'][0]['id']; ?></td>
        </tr>
        <tr>
            <td>Fecha de publicación: </td>
            <td><?php echo $datos['datosLibro'][0]['f_publicacion']; ?></td>
        </tr>
        <tr>
            <td>ID del autor: </td>
            <td><?php echo $datos['datosLibro'][0]['id_autor']; ?></td>
        </tr>
        <tr>
        <tr>
            <td>Autor: </td>
            <td> <a href="<?php echo RUTABASE . "biblioteca/autor/"
                                . $datos['datosLibro'][0]['id_autor'];  ?>"> <?php echo $datos['datosLibro'][0]['nombre'] . " " . $datos['datosLibro'][0]['apellidos']; ?></a></td>
        </tr>
    </table>

    <br />
</div>
<?php require_once INCLUDES . 'biblioteca/footer.php' ?>