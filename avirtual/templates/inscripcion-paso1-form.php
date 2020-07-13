<form class="form-horizontal" name="inscripcion-paso-1" id="inscripcion-paso-1" method="post" action="validar-inscripcion-paso-1.php">
	<fieldset>
		<legend>Datos del curso</legend>
		<div class="form-group">
			<div class="col-lg-12">
				<?php
					$codcurso = isset($_GET['codcurso']) ? $_GET['codcurso'] : '';
					if ($codcurso != '') {
						$cursosDB = getCursos();
						if ($cursosDB) {
							$cursoDescripcion = '';
							foreach ($cursosDB as $cursoDB) {
								if ($cursoDB['codigo'] == $codcurso) {
									$cursoDescripcion = '<label style="font-weight: initial;">' . $cursoDB['descripcion'] . '</label>' .
									'<input type="hidden" id="selectCurso" name="selectCurso" value="' . $codcurso . '">';
									break;
								}
							}
							if ($cursoDescripcion) {
								echo $cursoDescripcion;
							} else {
								echo '<select class="form-control" id="selectCurso" name="selectCurso">';
								echo buildHTMLOptionsList(getCursos());
								echo '</select>';
							}
						} else {
							echo '<select class="form-control" id="selectCurso" name="selectCurso">';
							echo buildHTMLOptionsList(getCursos());
							echo '</select>';
						}
					} else {
						// Crea los options de un select HTML, de una lista con elemento del tipo
						// array["codigo"],array["descripcion"]
						echo '<select class="form-control" id="selectCurso" name="selectCurso">';
						echo buildHTMLOptionsList(getCursos());
						echo '</select>';
					}
				?>
			</div>
		</div>

		<?php
			//include_once 'paso1-datos-docente.php';
		?>
		
		<legend>Datos Personales</legend>
		<div class="form-group">
			<div class="col-lg-6">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre*" maxlength="50">
				<span class="error">Completar este campo</span>
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido*" maxlength="50">
				<span class="error">Completar este campo</span>
			</div>
		</div>
		
		<div class="form-group">	
			<div class="col-lg-6">
				<input type="email" class="form-control" id="email" name="email" placeholder="e-Mail*" maxlength="100">
				<span class="error">Completar este campo con un e-mail v&aacute;lido.</span>
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" placeholder="Documento*" minlength="7" maxlength="15">
				<span class="error">Completar este campo</span>
			</div>
		</div>
		<div class="form-group">	
			<div class="col-lg-6">
				<input type="text" class="form-control" id="telefonoParticular" name="telefonoParticular" placeholder="Tel. Particular">
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="telefonoCelular" name="telefonoCelular" placeholder="Tel. Celular">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-lg-6">
				<select class="form-control" id="provincia" name="provincia">
					<option value="">Seleccione una Provincia</option>
					<?php
						echo buildHTMLOptionsList($provinciasList);
					?>
				</select>
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="localidad" name="localidad" placeholder="Localidad">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-lg-6">
				<input type="text" class="form-control" id="barrio" name="barrio" placeholder="Barrio">
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direcci&oacute;n">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-lg-3">
				<input type="text" class="form-control" id="numero" name="numero" placeholder="Nro">
			</div>
			<div class="col-lg-3">
				<input type="text" class="form-control" id="piso" name="piso" placeholder="Piso">
			</div>
			<div class="col-lg-3">
				<input type="text" class="form-control" id="departamento" name="departamento" placeholder="Dto">
			</div>
			<div class="col-lg-3">
				<input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="CP">
			</div>
		</div>
		
		<?php
			// El parametro promocion puede ser:
			// 1: se agrega un campo de texto para completar con los datos del alumno ingresado por promocion 2x1
			// 2: se agregan dos campos de texto para completar con los datos de los alumnos ingresados por promocion 3x2
			// 3: se agregan tres campos de texto para completar con los datos de los alumnos ingresados por promocion 4x3
			/* if (isset($_GET['promocion'])) {
				$tipoPromocion = $_GET['promocion'];
				if ($tipoPromocion == 1) { */
		?>
			<!-- <div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_1" name="datos_alumno_1" form="inscripcion-paso-1" 
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div> -->
		<?php
				/* }
				if ($tipoPromocion == 2) { */
		?>
			<!-- <div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_1" name="datos_alumno_1" form="inscripcion-paso-1"
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_2" name="datos_alumno_2" form="inscripcion-paso-1"
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div> -->
		<?php
				/* }
				if ($tipoPromocion == 3) { */
		?>
			<!-- <div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_1" name="datos_alumno_1" form="inscripcion-paso-1"
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_2" name="datos_alumno_2" form="inscripcion-paso-1"
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12">
					<textarea class="form-control" rows="3" id="datos_alumno_3" name="datos_alumno_3" form="inscripcion-paso-1"
					placeholder="Nombre, apellido, e-mail y documento"></textarea>
					<span class="error">Completar este campo</span>
				</div>
			</div> -->
		<?php	
				/* }
			} */
		?>
		
		<div class="form-group">
			<div class="col-lg-offset-3">
				<br>
				<div class="col-lg-offset-1">
					<div class="g-recaptcha" data-sitekey="6Lf1hSITAAAAAJ0jLn1G4k46Q8IXEn-TSbetsxlL"></div>
				</div>
			</div>
		</div>
		
		<div class="form-group">	
			<div class="col-lg-offset-4 col-lg-8">
				<br>
				<input type="button" id="inputInscribir" class="btn btn-primary" value="Continuar con la inscripci&oacute;n"/>
			</div>
		</div>
	</fieldset>
</form>