<?php include_once ("header.php"); ?>
<main class='h-100 container-xl'>
    <div class="card p-4 bg-light sombra-formulario mt-5 mb-5">
        <div class="card-header">
            <!-- subtitulo -->
            <h2 class="fw-bold text-center"><?php echo $datos['subtitulo'] ?></h2>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p class="privacidad ">Responsable del Tratamiento<br></p>
                <ul class="interlineado-privacidad">
                    <li><span class="privacidad">Identidad:</span> PIXEOS SL</li>
                    <li><span class="privacidad">Correo electrónico:</span> pixeosweb@gmail.com</li>
                    <li><span class="privacidad">Actividad:</span> Gestión de proyectos y tareas.</li>
                </ul>
                <p class="privacidad">Finalidad del tratamiento de los datos</p>
                
                <p class="margen-privacidad interlineado-privacidad"><u>Formulario de contacto</u>: los datos que nos facilites se emplearán para gestionar tu consulta o petición de información sobre nuestra plataforma.</p>
                <p class="margen-privacidad interlineado-privacidad"><u>Formulario de registro</u>: los datos que solicitamos se emplearán para gestionar tu cuenta en la plataforma</p>

                <p class="privacidad">Base legal para el tratamiento de tus datos el consentimiento.</p>
                <p class="margen-privacidad interlineado-privacidad">La base legal para tratar tus datos se basa en el consentimiento que nos proporcionas al aceptar esta polícia de privacidad</p>
                
                <p class="privacidad">Duración del tratamiento de la información</p>
                
                <p class="margen-privacidad interlineado-privacidad">
                    En cualquier momento podrás revocar el consentimiento que nos estás otorgando a través
                    de nuestro correo de contacto <u>pixeosweb@gmail.com</u>. Dichos datos se conservarán hasta que solicites la baja o
                     en su defecto hasta el plazo máximo que determina la ley
                </p>
                
                <p><span class="privacidad">Destinatario de la información:</span> PIXEOS SL</p>
                
                <p class="privacidad">Reserva de derechos</p>
                
                <p class="margen-privacidad interlineado-privacidad">PIXEOS se reserva el derecho de modificar esta política de privacidad en cualquier momento.</p>
            </div>
        </div>
        <div class="mx-auto">
            <a href="<?php echo RUTA . '/access/registration';?>" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i> Regresar</a>
        </div>
    </div>
</main>
</body>
<footer>
    <?php include_once ("footer.php"); ?>