<?php
	include 'data/datosConexionDB.php';
	//Datos del alumnos obtenidos del formulario
	$nombre = strtoupper($_POST["nombre"]);
	$apellido = strtoupper($_POST["apellido"]);
	$dni = $_POST["dni"];
	$tipoDni = $_POST["tipo_documento"];
	$provincia = $_POST["provincia"];
	$localidad = strtoupper($_POST["localidad"]);
	$direccion = strtoupper($_POST["direccion"]);
	$mail = strtoupper($_POST["mail"]);
	$telefonoparticular = $_POST["telefonoparticular"];
	$telefonomovil = $_POST["telefonomovil"];
	$codigocurso = $_POST["codigocurso"];
	
//	tomo la fecha del sistema
//	$fechaInscripcion = getdate();
//	$fecha = $fechaInscripcion[year]."-".$fechaInscripcion[mon]."-".$fechaInscripcion[mday]." ".
//			$fechaInscripcion[hours].":".$fechaInscripcion[minutes].":".$fechaInscripcion[seconds];
	
	$conexion = mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	mysql_select_db(BASE_DB, $conexion);
	
	// Da de ALTA el nuevo alumno
	$sqlInsertAlumno = 'INSERT INTO alumno (id_alumno,nombre,apellido,id_provincia,localidad,direccion,mail,
			telefono_particular,telefono_celular, numero_documento, tipo_documento) VALUES (null,\''.$nombre.'\',\''.$apellido.'\','.$provincia.',\''.
			$localidad.'\',\''.$direccion.'\',\''.$mail.'\',\''.$telefonoparticular.'\',\''.$telefonomovil.'\',\''.$dni.'\','.$tipoDni.');';
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		if (mysql_query($sqlInsertAlumno, $conexion)) {
			mysql_query('COMMIT',$conexion);
			
			// Hasta aca dio de alta el nuevo alumno, ahora lo inscribe
			// Busco el id del alumno por dni y tipo de dni
			$sqlBuscarAlumnoPorDni = 'SELECT id_alumno FROM alumno WHERE numero_documento = \'' . $dni .'\' AND tipo_documento = \'' . $tipoDni .'\';';
			$alumno = @mysql_query($sqlBuscarAlumnoPorDni, $conexion);
			$fila = mysql_fetch_array($alumno);
			$idAlumno = $fila['id_alumno'];
			if ($idAlumno != '') {
				// Busco el id de curso por su codigo
				$sqlBuscarCursoPorCodigo = 'SELECT id_curso FROM curso WHERE codigo = \'' . $codigocurso .'\';';
				$curso = @mysql_query($sqlBuscarCursoPorCodigo, $conexion);
				$fila = mysql_fetch_array($curso);
				$idCurso = $fila['id_curso'];
				if ($idCurso == '') {
					mysql_close($conexion);
					header("Location: inscripcion.php?sucess=error");
				}
				// Con el id de alumno generado se realiza la inscripcion, asocia alumno y curso
				$sqlInsertCurso = 'INSERT INTO inscripcion (id_inscripcion, id_alumno, id_curso, fecha_inscripcion) VALUES (null, '.$idAlumno.','.$idCurso.',\'\');';
				if ($conexion) {
					mysql_query('BEGIN WORK',$conexion);
					if (mysql_query($sqlInsertCurso, $conexion)) {
						mysql_query('COMMIT',$conexion);
					}
//					mysql_close($conexion);
				} else {
//					mysql_close($conexion);
					header("Location: inscripcion.php?sucess=error");
				}
//				mysql_close($conexion);
			} else {
//				mysql_close($conexion);
				header("Location: inscripcion.php?sucess=error");
			}
//			mysql_close($conexion);
			//	Guardo el dni del alumno para ejecutar la query y obtener los datos a imprimir
//			$_SESSION["dniAlumno"] = $dni;
//			$_SESSION["apellidoAlumno"] = $apellido;
			header("Location: inscripcion.php?sucess=ok");
		} else {
			header("Location: inscripcion.php?sucess=error");
		}
	} else {
		header("Location: inscripcion.php?sucess=error");			
	}
?>
