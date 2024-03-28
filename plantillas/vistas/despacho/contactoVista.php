<?php require_once INCLUDES . 'despacho/header.php' ?>
	<body>
		<?php require_once INCLUDES . 'despacho/nav.php' ?>
		<FORM id="formulario" action="#" method="GET">
			<fieldset>
				<legend><h3 id="formt">Consulte sin compromiso:</h3></legend>
					<label for="nombre">*Nombre:</label><input type="text" id="nombre"required autofocuspattern="[A-Za-z]+" /><br>
					<label for="apellidos">*Apellidos:</label><input type="text" id="apellidos"required /><br>
					<label for="edad">*Fecha de nacimiento:</label><input type="date" id="fecha" required /><span class="ayuda">Formato: "01/01/1990"</span><br>
					<label for="email">*Email:</label><input type="email" id="email"placeholder="cr@example.com"required /><span class="ayuda">Formato: "nombre@dominio.com"</span><br>
					<label for="especialidad">Especialidad:</label><select id="opcion">
						<option>Herencias</option>
						<option>Divorcios</option>
						<option>Mediación familiar</option>
						<option>Adopciones</option>
					</select><br>
					<label for="masinfo">Objeto de la consulta:</label><textarea id="mensaje" cols="50" rows="5"></textarea><br><br>
					<button type="submit" value="enviar informacion">Enviar datos</button>
					<button type="reset" value="borrar datos">Borrar datos</button><br>
					<div id="privacidad"><input type="checkbox" value="privacidad" required="required" />He leído y acepto el aviso legal y la política de privacidad*.</div><br>
					<h6 id="asterisco">*Campos obligatorios</h6>
			</fieldset>
		</FORM>
		<h3 id="tf">También puedes pedir cita llamando al 345167983</h3>
		<?php require_once INCLUDES . 'despacho/footer.php' ?>
	</body>
</html>