<?php
include_once 'datosConexionDB.php';
include_once 'medio-de-pago.php';
//include_once 'provincias.php';

/**
* Genera HTML para el elemento option de un select con los campos value y description.
*/
function buildHTMLOption($value, $description) {
	return '<option value="'.$value.'">'.$description.'</option>\n';
}

/**
* Genera HTML para los options de un select de una lista con campo codigo y descripcion.
*/
function buildHTMLOptionsList($list) {
	$listAux = array();
	if ($list) {
		foreach ($list as $itemList) {
			$codeItem = $itemList["codigo"];
			$descriptionItem = $itemList["descripcion"];
			$optionHTML = buildHTMLOption($codeItem, $descriptionItem);
			$listAux[] = $optionHTML;
		}
	}
	//echo "-------------------------<br>";
	//echo $listAux[0]["codigo"] . ':'. $listAux[0]["descripcion"];
	//echo "-------------------------<br>";
	//die("fin");
	//$lista = join('', $listAux);
	//die("list:".$lista);
	return join('', $listAux);
}

function getPartnerBmedia() {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarPartner = 'SELECT id FROM partner WHERE nombre = "BMEDIA";';
	//die('sql->'.$sqlBuscarPartner);
	$partnerDB = @mysql_query($sqlBuscarPartner, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($partnerDB);
	if ($fila) {
		return $fila['id'];
	}
	return null;
}

/**
 * Validar usuario y clave
 */
function validarUsuario($usuario, $clave) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlValidarUsuario = 'SELECT id FROM partner WHERE usuario = \'' . $usuario . '\' AND clave = \'' . $clave . '\';';
	//echo $sqlValidarUsuario;
	$usuarioDB = @mysql_query($sqlValidarUsuario, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($usuarioDB);
	if ($fila) {
		return isset($fila['id']) ? $fila['id'] : '';
	}
	return false;
}

function linksDePago($idCursada) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarCursada = 'SELECT link_mp, link_mpos FROM cursada WHERE id = ' . $idCursada .';';
	//die('sql->'.$sqlBuscarCursada);
	$cursadaDB = @mysql_query($sqlBuscarCursada, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($cursadaDB);
	$linksPagos = array();
	if ($fila) {
		$linksPagos['link_mp'] = $fila['link_mp'];
		$linksPagos['link_mpos'] = $fila['link_mpos'];
		return $linksPagos;
	}
	return null;
}

/**
* Obtiene la modalidad disponible de los cursos
*/
function getModalidadCurso() {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$queryModalidadCursos = 'SELECT * FROM modalidad_cursada';
	$modalidadCursos = @mysql_query($queryModalidadCursos, $conexion);
	mysql_close($conexion);
	$modalidadCursosAux = array();
	if ($modalidadCursos) {
		$totalModalidadCursos = mysql_num_rows($modalidadCursos);
		for ($i = 0; $i < $totalModalidadCursos; $i++) {
			$modalidad = mysql_fetch_array($modalidadCursos);
			$modalidadAux = array();
			$modalidadAux['codigo'] = $modalidad['id'];
			$modalidadAux['descripcion'] = $modalidad['descripcion'];
			
			$modalidadCursosAux[] = $modalidadAux;
		}
	}
	return $modalidadCursosAux;
}

/*
* Obtiene los medios de pago.
*/
function getMedioPago() {
	$modalidadAux = array();
	$modalidadAux['codigo'] = 'MP';
	$modalidadAux['descripcion'] = 'Mercado Pago';
	$modalidadCursosAux[] = $modalidadAux;
	
	$modalidadAux = array();
	$modalidadAux['codigo'] = 'TP';
	$modalidadAux['descripcion'] = 'Todo Pago';
	$modalidadCursosAux[] = $modalidadAux;
	
	$modalidadAux = array();
	$modalidadAux['codigo'] = 'TB';
	$modalidadAux['descripcion'] = 'Transferencia Bancaria';
	$modalidadCursosAux[] = $modalidadAux;
	
	return $modalidadCursosAux;
}

/**
* Obtiene los cursos
*/
function getCursos() {
	$conexion = mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	mysql_select_db(BASE_DB, $conexion);
	//echo "erro:".mysql_error($conexion);
	/*$queryCursos = 'SELECT c.titulo, c1.codigo, c1.dias, c1.horarios, c1.fecha_inicio, c1.fecha_fin, c1.duracion, mc.descripcion '.
	'FROM cursada c1 '.
	'INNER JOIN curso c ON c.id = c1.curso_id '.
	'INNER JOIN modalidad_cursada mc ON mc.id = c1.modalidad_id '.
	'WHERE c1.activo = 1 '.
	'ORDER BY c.titulo ASC';*/
	$queryCursos = 'SELECT c1.titulo, c1.codigo, c1.dias, c1.horarios, c1.fecha_inicio, c1.fecha_fin, c1.duracion, mc.descripcion '.
	'FROM cursada c1 '.
	'INNER JOIN modalidad_cursada mc ON mc.id = c1.modalidad_id '.
	'WHERE c1.activo = 1 '.
	'ORDER BY c1.titulo ASC';
	$cursos = mysql_query($queryCursos, $conexion);
	mysql_close($conexion);
	//echo "queryCursos: ".$queryCursos."\n";
	//echo "sizeof:".sizeof($cursos)."\n";
	//echo "count:".count($cursos)."\n";
	//$totalCursos = mysql_num_rows($cursos);
	//die("totalCursos:".$totalCursos);
	$cursosAux = array();
	if ($cursos) {
		$totalCursos = mysql_num_rows($cursos);
		for ($i = 0; $i < $totalCursos; $i++) {
			$curso = mysql_fetch_array($cursos);
			$codigo = $curso['codigo'];
			$titulo = $curso['titulo'];
			$dias = $curso['dias'];
			$fechaInicio = $curso['fecha_inicio'];
			$fechaFin = $curso['fecha_fin'];
			$horario = $curso['horarios'];
			$duracion = $curso['duracion'];
			$modalidad = $curso['descripcion'];
			
			$cursoAux = array();
			$fecInicioAux = $fechaInicio != null ? date("d/m/Y", strtotime($fechaInicio)) : ' - ';
			$fecFinAux = $fechaFin != null ? date("d/m/Y", strtotime($fechaFin)) : ' - ';
			$diasAux = $dias != null ? $dias : ' - ';
			$horarioAux = $horario != null ? $horario.'Hs' : ' - ';
			$info = ' Inicia:'.$fecInicioAux.' | Finaliza:'.$fecFinAux.' | D&iacute;as:'.$diasAux.' '.$horarioAux.' | Duraci&oacute;n:'.$duracion.' | '.$modalidad;
			
			$cursoAux["codigo"] = $codigo;
			$cursoAux["descripcion"] = $titulo.' - '.$info;
			
			$cursosAux[] = $cursoAux;
		}
	}
	return $cursosAux;
}

/**
* Buscar id de curso por codigo.
*/
function buscarCursoPorCodigo($codidoCurso) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarCurso = 'SELECT * FROM curso WHERE codigo = \'' . $codidoCurso .'\'';
	$cursoDB = @mysql_query($sqlBuscarCurso, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($cursoDB);
	$idCurso = $fila['id'];
	if ($idCurso != '') {
		return $idCurso;
	}
	return null;
}

/**
* Buscar id de curso por codigo.
*/
function buscarIdCursoPorCodigo($codidoCurso) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarCurso = 'SELECT * FROM curso WHERE codigo = \'' . $codidoCurso .'\'';
	$cursoDB = @mysql_query($sqlBuscarCurso, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($cursoDB);
	$idCurso = $fila['id'];
	if ($idCurso != '') {
		return $idCurso;
	}
	return null;
}

/**
* Buscar id de cursada por id curso.
*/
function buscarIdCursadaPorCodigo($codigoCurso) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarIdCursada = 'SELECT id FROM cursada WHERE codigo = \'' . $codigoCurso .'\'';
	$cursadaDB = @mysql_query($sqlBuscarIdCursada, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($cursadaDB);
	$idCursada = $fila['id'];
	if ($idCursada != '') {
		return $idCursada;
	}
	return null;
}

/*
* Da de alta el alumno.
* esDocente: boolean que indica si la inscripcion es para un alumno o docente.
* Si es docente, no se efectua el pago.
*/
function altaAlumno($nombre,$apellido,$numeroDocumento,$email,$telefonoparticular,$telefonoCelular,$provincia,$localidad,
	$barrio,$direccion,$numero,$piso,$departamento,$codigoPostal,
	$esDocente,$provinciaDocente,$municipioDocente,$nivelDocente,$areaDocente,$cargoDocente,$legajoDocente) {//,
	//$datosAlumno1,$datosAlumno2,$datosAlumno3) {
	
	// Si provincia viene null, se setea en 0 para evitar error sql
	if (!$provincia) {
		$provincia = 0;
	}
	
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlInsertAlumno = 
		'INSERT INTO alumno (id,nombre,apellido,id_provincia,localidad,barrio,direccion,numero,piso,departamento,codigo_postal,mail,
			telefono_particular,telefono_celular,numero_documento,fecha_alta,
			es_docente,provincia_docente,municipio_docente,nivel_docente,area_docente,cargo_docente,legajo_docente) '.
		' VALUES (null,\''.$nombre.'\',\''.$apellido.'\','.$provincia.',\''.$localidad.'\',\''.$barrio.'\',\''.$direccion.'\',\''.$numero.'\',\''.
		$piso.'\',\''.$departamento.'\',\''.$codigoPostal.'\',\''.$email.'\',\''.$telefonoparticular.'\',\''.$telefonoCelular.'\',\''.$numeroDocumento.'\','.
		'\''.date('Y-m-d H:i:s').'\','.
		$esDocente.',\''.$provinciaDocente.'\',\''.$municipioDocente.'\',\''.$nivelDocente.'\',\''.$areaDocente.'\',\''.$cargoDocente.'\',\''.$legajoDocente.'\');';
		
	//echo $sqlInsertAlumno.'<br>';
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		if (mysql_query($sqlInsertAlumno, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Alta Alumno
			//echo 'Error: Alta Alumno1<br>';
			return false;
		}
	} else {
		// Error: Alta Alumno
		//echo 'Error: Alta Alumno2<br>';
		return false;
	}
}

/*
* Busca el id de un alumno.
*/
function buscarIdAlumnoPorEMail($email) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarIdAlumno = 'SELECT * FROM alumno WHERE mail = \'' . $email .'\'';
	if ($conexion) {
		$alumnoDB = @mysql_query($sqlBuscarIdAlumno, $conexion);
		mysql_close($conexion);
		$fila = mysql_fetch_array($alumnoDB);
		$idAlumno = $fila['id'];
		return $idAlumno;
	} else {
		// Error: buscar alumno por mail
		return -1;
	}
}

/*
* Inscribe un alumno en una cursada. 
* El medio de pago se define en el paso dos. 
* El estado de la inscripcion es 'Pendiente de Pago'.
*/
function inscribirAlumno($idAlumno, $idCursada, $idPartner,$datosAlumno1,$datosAlumno2,$datosAlumno3) {
	//echo 'inscribirAlumno<br>';
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlInscribirAlumno = 'INSERT INTO inscripcion (id,alumno_id,cursada_id,fecha_inscripcion,medio_pago_id,estado_inscripcion_id,partner_id,
		datos_alumno_1,datos_alumno_2,datos_alumno_3)'.
		' VALUES (null,'.$idAlumno.','.$idCursada.',\''.date('Y-m-d H:i:s').'\',0,2,'.$idPartner.',\''.
		$datosAlumno1.'\',\''.$datosAlumno2.'\',\''.$datosAlumno3.'\');';
		
	//die ("sql:".$sqlInscribirAlumno);
		
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		//echo 'sqlInscribirAlumno->'.$sqlInscribirAlumno.'<br>';
		if (mysql_query($sqlInscribirAlumno, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Alta Inscripcion
			//echo 'err1<br>';
			return false;
		}
	} else {
		// Error: Alta Inscripcion
		//echo 'err2<br>';
		return false;
	}
}

/*
* Busca la inscripcion por idAlumno y idCursada.
*/
function buscarInscripcion($idAlumno,$idCursada) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlBuscarInscripcion = 'SELECT * FROM inscripcion WHERE alumno_id = \''.$idAlumno.'\' AND cursada_id = \''.$idCursada.'\'';
	$inscripcionDB = @mysql_query($sqlBuscarInscripcion, $conexion);
	mysql_close($conexion);
	$fila = mysql_fetch_array($inscripcionDB);
	if ($fila) {
		$inscripcion = array();
		$inscripcion['id'] = $fila['id'];
		$inscripcion['alumno_id'] = $fila['alumno_id'];
		$inscripcion['cursada_id'] = $fila['cursada_id'];
		$inscripcion['fecha_inscripcion'] = $fila['fecha_inscripcion'];
		$inscripcion['medio_pago_id'] = $fila['medio_pago_id'];
		$inscripcion['estado_inscripcion_id'] = $fila['estado_inscripcion_id'];
		$inscripcion['pago_id'] = $fila['pago_id'];
		return $inscripcion;
	}
	return null;
}

/*
* Actualiza el medio de pago de la inscripcion.
*/
function actualizarInscripcion($idAlumno,$idCursada,$idMedioPago) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlInscripcion = 'UPDATE inscripcion SET medio_pago_id = '.$idMedioPago.' WHERE alumno_id = '.$idAlumno.' AND cursada_id = '.$idCursada.';';
	//die('sql:'.$sqlInscripcion);
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		if (mysql_query($sqlInscripcion, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Actualizando Inscripcion
			return false;
		}
	} else {
		// Error: Actualizando Inscripcion
		return false;
	}
}

/*
* Actualiza el estado de la inscripcion a Aprobada
*/
function actualizarInscripcionPago($idAlumno,$idCursada,$idMedioPago) {
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlInscripcion = 
		'UPDATE inscripcion SET medio_pago_id = '.$idMedioPago.', estado_inscripcion_id = 1 '.
		'WHERE alumno_id = '.$idAlumno.' AND cursada_id = '.$idCursada.';';
	//echo 'sql:'.$sqlInscripcion;
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		if (mysql_query($sqlInscripcion, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Actualizando Inscripcion
			return false;
		}
	} else {
		// Error: Actualizando Inscripcion
		return false;
	}
}

/*
* Registra el pago realizado en Mercado Pago.
*/
function registrarPagoMP($idInscripcion,$collection_id,$collection_status,$preference_id,$external_reference,
	$payment_type,$merchant_order_id) {
	
	//echo 'registrarPagoMP<br>';
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlRegistrarPagoMP = 
		'INSERT INTO pago (id,collection_id,collection_status,preference_id,external_reference,payment_type,merchant_order_id,inscripcion_id,fecha_pago)'.
		' VALUES (null,'.$collection_id.',\''.$collection_status.'\',\''.$preference_id.'\',\''.$external_reference.'\',\''.$payment_type.'\''.
		','.$merchant_order_id.','.$idInscripcion.',\''.date('Y-m-d H:i:s').'\');';
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		//echo 'sqlRegistrarPagoMP->'.$sqlRegistrarPagoMP.'<br>';
		if (mysql_query($sqlRegistrarPagoMP, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Registro Pago
			//echo 'Error: Registro Pago<br>';
			return false;
		}
	} else {
		// Error: Registro Pago
		//echo 'Error: Registro Pago -> sin conexion';
		return false;
	}
}

/*
* Registrad el pago realizado en Todo Pago
*/
function registrarPagoMPOS($idInscripcion,$answer) {
	//echo 'registrarPagoMPOS<br>';
	$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);
	@mysql_select_db(BASE_DB, $conexion);
	$sqlRegistrarPagoMPOS = 
		'INSERT INTO pago (id,collection_id,collection_status,preference_id,external_reference,payment_type,merchant_order_id,inscripcion_id,fecha_pago,answer)'.
		' VALUES (null,null,null,null,null,null,null,'.$idInscripcion.',\''.date('Y-m-d H:i:s').'\',\''.$answer.'\');';
	if ($conexion) {
		mysql_query('BEGIN WORK',$conexion);
		//echo 'sqlRegistrarPagoMP->'.$sqlRegistrarPagoMP.'<br>';
		if (mysql_query($sqlRegistrarPagoMPOS, $conexion)) {
			mysql_query('COMMIT',$conexion);
			mysql_close($conexion);
			return true;
		} else {
			// Error: Registro Pago
			//echo 'Error: Registro Pago<br>';
			return false;
		}
	} else {
		// Error: Registro Pago
		//echo 'Error: Registro Pago -> sin conexion';
		return false;
	}
}
?>