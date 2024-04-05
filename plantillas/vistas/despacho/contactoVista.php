<?php require_once INCLUDES . 'despacho/header.php' ?>
<?php require_once INCLUDES . 'despacho/nav.php' ?>
<section class="formulario-contenedor">
	<FORM id="formulario" action="#" method="GET">
		<fieldset>
			<legend>
				<h2 id="formt">Consulte sin compromiso:</h2>
			</legend>
			<label for="nombre">*Nombre:</label><input type="text" id="nombre" required autofocuspattern="[A-Za-z]+" /><br>
			<label for="apellidos">*Apellidos:</label><input type="text" id="apellidos" required /><br>
			<label for="edad">*Fecha de nacimiento:</label><input type="date" id="edad" required /><span class="ayuda">Formato: "01/01/1990"</span><br>
			<label for="email">*Email:</label><input type="email" id="email" placeholder="cr@example.com" required autocomplete="on" /><span class="ayuda">Formato: "nombre@dominio.com"</span><br>
			<label for="especialidad">Especialidad:</label><select id="especialidad">
				<option>Herencias</option>
				<option>Divorcios</option>
				<option>Mediación familiar</option>
				<option>Adopciones</option>
			</select><br>
			<label for="masinfo">Objeto de la consulta:</label><textarea id="masinfo" cols="50" rows="5"></textarea><br><br>
			<button type="submit" value="enviar informacion">Enviar datos</button>
			<button type="reset" value="borrar datos">Borrar datos</button><br>
			<div id="privacidad">
				<input id="checkbox" type="checkbox" value="privacidad" required="required" />
				<label for="checkbox">He leído y acepto el aviso legal y la política de privacidad*.</label>
			</div><br>
			<h3 id="asterisco">*Campos obligatorios</h3>
		</fieldset>
	</FORM>
	<h2 id="tf">También puedes pedir cita llamando al 345167983</h2>
</section>
<?php require_once INCLUDES . 'despacho/footer.php' ?>
</body>

</html>