<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" itemscope="" itemtype="http://schema.org/WebPage">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="title" content="INGRESAR AL SISTEMA - Freuba &amp; BmediaStudio">
<meta itemprop="name" content="INGRESAR AL SISTEMA - Freuba &amp; BmediaStudio">
<meta property="og:title" content="INGRESAR AL SISTEMA - Freuba &amp; BmediaStudio">
<style type="text/css">
@font-face {
	font-family: 'Open Sans';
	font-style: italic;
	font-weight: 700;
	src: local('Open Sans Bold Italic'), local('OpenSans-BoldItalic'),
		url(//fonts.gstatic.com/s/opensans/v13/PRmiXeptR36kaC0GEAetxolIZu-HDpmDIZMigmsroc4.woff2)
		format('woff2');
}

@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Open Sans'), local('OpenSans'),
		url(//fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2)
		format('woff2');
}

@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 700;
	src: local('Open Sans Bold'), local('OpenSans-Bold'),
		url(//fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzOgdm0LZdjqr5-oayXSOefg.woff2)
		format('woff2');
}

@font-face {
	font-family: 'Architects Daughter';
	font-style: normal;
	font-weight: 400;
	src: local('Architects Daughter'), local('ArchitectsDaughter'),
		url(//fonts.gstatic.com/s/architectsdaughter/v6/RXTgOOQ9AAtaVOHxx0IUBM3t7GjCYufj5TXV5VnA2p8.woff2)
		format('woff2');
}

@font-face {
	font-family: 'Open Sans';
	font-style: italic;
	font-weight: 400;
	src: local('Open Sans Italic'), local('OpenSans-Italic'),
		url(//fonts.gstatic.com/s/opensans/v13/xjAJXh38I15wypJXxuGMBo4P5ICox8Kq3LLUNMylGO4.woff2)
		format('woff2');
}
</style>
<link rel="stylesheet" type="text/css" href="bmedia/standard-css-ski-ltr-ltr.css">
<!--<link rel="stylesheet" type="text/css" href="bmedia/overlay.css">-->
<link rel="stylesheet" type="text/css" href="bmedia/allthemes-view.css"><!--[if IE]>
          <link rel="stylesheet" type="text/css" href="/a/bmediastudio.com/freuba%2dbmediastudio/system/app/css/camelot/allthemes%2die.css" />
        <![endif]-->
<title>INGRESAR AL SISTEMA - Freuba &amp; BmediaStudio</title>
<script src="jquery/jquery-1.12.4.js"></script>
<script src="jquery/jquery-validation-1.15.0/dist/jquery.validate.js"></script>

<script type="text/javascript">
$("#nombre").hide();
<!--
function MM_validateForm() { //v4.0
	if (document.getElementById){
		var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
		for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
		  if (val) { nm=val.name; if ((val=val.value)!="") {
			if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
			  if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe contener una direccion de e-mail.\n';
			} else if (test!='R') { num = parseFloat(val);
			  if (isNaN(val)) errors+='- '+nm+' debe contener un numero.\n';
			  if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
				min=test.substring(8,p); max=test.substring(p+1);
				if (num<min || max<num) errors+='- '+nm+' debe contener un numero entre '+min+' y '+max+'.\n';
		  } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
		} if (errors) alert('Error en los siguientes campos:\n'+errors);
		document.MM_returnValue = (errors == '');
	}
}
//-->
</script>
</head>
<body xmlns="http://www.google.com/ns/jotspot" id="body" class="es">				
<!-- Formulario de preinscripcion -->
<div class="formuPre">
	<!--<form action="inscribir.php" method="post" name="preinscripcion" onsubmit="MM_validateForm('nombre','','R','apellido','','R','dni','','RisNum','mail','','RisEmail','telefonoparticular','','RisNum');return document.MM_returnValue">-->
	<form method="post" id="formid">	
		<div id="ok"></div>
		<p><span>Datos del Curso</span></p>
		
		<p>
			<span>Nombre (*)</span>
			<input type="text" name="nombre" id="nombre" />
		</p>
		
		<table align="center" width="99%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td colspan="4" align="left">Datos del alumno</td>
			</tr>
			<tr>
				<td>Nombre (*)</td>
				<td><input name="nombre" type="text" id="nombre" size="20"title="nombre" /></td>
				<td>Apellido (*)</td>
				<td><input name="apellido" type="text" id="apellido" size="20"title="apellido" /></td>
			</tr>
			<tr>
				<td>Dni (*)</td>
				<td><input name="dni" type="text" id="dni" size="20" title="dni" /></td>
				<td>Tipo Documento</td>
				<td>
					<select name="tipo_documento" id="tipo_documento">
						<option value="1">DNI</option>
						<option value="2">LC</option>
						<option value="3">CI</option>
					</select>
				</td>
			</tr>
			<tr>
			<?php
			include 'data/datosConexionDB.php';
			include 'data/provincias.php';
			?>
				<td>Provincia</td>
				<td align="left">
					<select name="provincia" id="provincia">
					<?php
					if ($provincias) {
						foreach ($provincias as $provincia) {
							$codCursoSelec = $provincia["codigo"];
							$descripcionCursoSelec = $provincia["descripcion"];
							echo "<option value=\"".$codCursoSelec."\">".$descripcionCursoSelec."</option>"."\n";
						}
					}
					?>
					</select>
				</td>
				<td>Localidad</td>
				<td><input type="text" name="localidad" size="20" title="localidad" /></td>
			</tr>
			<tr>
				<td>Direcci&oacute;n</td>
				<td><input type="text" name="direccion" size="20" title="direccion" /></td>
				<td>E-mail (*)</td>
				<td><input name="mail" type="text" id="mail" size="20" title="e-mail" /></td>
			</tr>
			<tr>
				<td>Teléfono particular (*)</td>
				<td><input name="telefonoparticular" type="text" id="telefonoparticular" size="20" title="telefono particular" /></td>
				<td>Tel&eacute;fono m&oacute;vil</td>
				<td><input type="text" name="telefonomovil" id="telefonomovil" size="20" title="telefono movil" /></td>
			</tr>
			<tr>
				<td>Curso</td>
				<td>
					<select name="codigocurso" id="codigocurso">
						<?php
						$conexion = null;
						$conexion = @mysql_connect(HOST_DB, USUARIO_DB, PASS_DB);// or die("<h3>".mysql_errno()."&nbsp;".mysql_error()."</h3>");
						@mysql_select_db(BASE_DB, $conexion);// or die("<h3>".mysql_errno()."&nbsp;".mysql_error()."</h3>");
						$cursos = @mysql_query('select * from curso', $conexion);// or die("<h3>".mysql_errno()."&nbsp;".mysql_error()."</h3>");
						mysql_close($conexion);
						//	Si no puede cerrar la conexion die() con el error de mysql
					//	if (!mysql_close($conexion))
					//		die("<h3>".mysql_errno()."&nbsp;".mysql_error()."</h3>");
						if ($cursos) {
							$totalCursos = mysql_num_rows($cursos);
							for ($i = 0; $i < $totalCursos; $i++) {
								$fila = mysql_fetch_array($cursos);
								$codCursoSelec = $fila['codigo'];
								$descripcionCursoSelec = $fila['descripcion'];
								echo "<option value=\"".$codCursoSelec."\">".$descripcionCursoSelec."&nbsp;(c&oacute;digo:&nbsp;".$codCursoSelec.")"."</option>"."\n";
							}
						}
						?>
					</select>
				</td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="4">Campos obligatorios (*)</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="inscribir" value="Inscribir" size="20" /></td>
				<td colspan="2" align="center"><input type="reset" name="cancelar" value="Cancelar" size="20" /></td>
			</tr>
			<!--<tr>
				<td colspan="4">-->
				<?php 
					//if ($_GET['sucess'] == 'ok') {
						?>
					<!--<a class="sites-system-link" href="http://www.bmediastudio.com/aulavirtual/inscripciones.php">Ver inscripciones</a>-->
				<?php 
					//}
				?><!--
				</td>
			</tr>-->
		</table>
	</form>
	<br /><br />
</div>

<!--	Inicio lista cursos	-->
<div id="listaCursos" align="center">
	<table align="center" border="1" cellspacing="0" cellpadding="10">
		<tr bgcolor="#B9DCFF">
			<td>C&oacute;digo</td>
			<td>Descripci&oacute;n</td>
			<td>D&iacute;as</td>
			<td>Horarios</td>
			<td>Fecha de Inicio</td>
			<td>Fecha de Finalizaci&oacute;n</td>
			<td>Observaciones</td>
		</tr>
		<?php
		//Valores fijos auxiliares
		$codigoCurso = "";
		$nombreCurso = "";
		$horario = "";
		$dias = "";
		$fechaInicio = "";
		$fechaFin = "";
		$duracion = "";
		$observaciones = "";
		//	Posiciona el puntero del registro en la posicion 0, al principio del resultado de la consulta ejecutada
		@mysql_data_seek($cursos, 0);
		if (@mysql_num_rows($cursos)) {
			while ($fila = mysql_fetch_array($cursos)) {
				$codigoCurso = $fila['codigo'];
				$descripcionCurso = $fila['descripcion'];
				$dias = $fila['dias'];
				$horario  = $fila['horarios'];
				$fechaInicio = $fila['fecha_inicio'];
				$fechaInicio = $fechaInicio[8].$fechaInicio[9].$fechaInicio[4].
				$fechaInicio[5].$fechaInicio[6].$fechaInicio[7].
				$fechaInicio[0].$fechaInicio[1].$fechaInicio[2].$fechaInicio[3];

				$fechaFin = $fila['fecha_fin'];
				$fechaFin = $fechaFin[8].$fechaFin[9].$fechaFin[4].$fechaFin[5].
				$fechaFin[6].$fechaFin[7].$fechaFin[0].$fechaFin[1].
				$fechaFin[2].$fechaFin[3];

				if ($fila['observaciones'] != "")
					$observaciones = $fila['observaciones'];
				else
					$observaciones = "sin observaciones";
					
				echo "\t<td>".$codigoCurso."</td>\n";
				echo "\t<td>".$descripcionCurso."</td>\n";
				echo "\t<td>".$dias."</td>\n";
				echo "\t<td>".$horario."</td>\n";
				echo "\t<td>".$fechaInicio."</td>\n";
				echo "\t<td>".$fechaFin."</td>\n";
				echo "\t<td>".$observaciones."</td>\n";
				echo "</tr>\n";
			}
		} else { ?>
		<tr>
			<td align="left" bgcolor="#ffffff" colspan="7" height="45">No se encontraron cursos activos.</td>
		</tr>
		<? 	} ?>
	</table>
	<br /><br />
</div>
<!-- Formulario de preinscripcion -->
</body>
</html>