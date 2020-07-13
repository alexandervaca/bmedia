<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" itemscope="" itemtype="http://schema.org/WebPage">
<head>
<?php
	require_once 'templates/head.php';
?>
<!-- GOOGLE API RECAPTCHA -->
<!--<script src='https://www.google.com/recaptcha/api.js?hl=es-419'></script>-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- GOOGLE API RECAPTCHA -->
<script src='js/util.js'></script>
<script type="text/javascript">
$(document).ready(function() {

	<?php
		$promocion = '';
		if (isset($_GET['promocion'])) {
			$promocion = $_GET['promocion'];
		}
	?>
	var tipoPromocion = '<?php echo $promocion;?>';

	<?php
		/*$codcurso = '';
		if (isset($_GET['codcurso'])) {
			$codcurso = $_GET['codcurso'];
		}*/
	?>
	/*var codCurso = '<?php /*echo $codcurso;*/ ?>';
	if (codCurso != '') {
		$('#selectCurso').val(codCurso);
	} else {
		$('#selectCurso').css('display','none');
	}*/
	
	// Evento para mostrar u ocultar datos para el docente
	$('#checkDocente').click(function() {
		if ($('#checkDocente').is(':checked')) {
			$('#docente-dato1').removeClass('hide');
			$('#docente-dato2').removeClass('hide');
			$('#docente-dato3').removeClass('hide');
			$('#docente-dato1').addClass('show');
			$('#docente-dato2').addClass('show');
			$('#docente-dato3').addClass('show');
		} else {
			$('#docente-dato1').removeClass('show');
			$('#docente-dato2').removeClass('show');
			$('#docente-dato3').removeClass('show');
			$('#docente-dato1').addClass('hide');
			$('#docente-dato2').addClass('hide');
			$('#docente-dato3').addClass('hide');
		}
	});
	
	//$.post('validar-inscripcion-paso-1.php', $('#inscripcion-paso-1').serialize());
	/*var formInscripcion = $("#inscripcion-paso-1").serialize();
	$.ajax({
		type: "POST",
		url:"validar-inscripcion-paso-1.php",
		data: $("#inscripcion-paso-1").serialize(),
		success: function(response){
			console.log(response);
			//alert(response);
		}
	});*/
	

	var errorNombre = true;
	var errorApellido = true;
	var errorEmail = true;
	var errorNroDoc = true;
	
	$('#nombre').blur(function() {
		validateInput($('#nombre'));
	});

	$('#apellido').blur(function() {
		validateInput($('#apellido'));
	});
	
	$('#numeroDocumento').blur(function() {
		validateInput($('#numeroDocumento'));
	});
	
	$('#email').blur('input', function() {
		validateEmail($('#email'));
	});
	
	$("#inputInscribir").click(function(event) {
		//event.preventDefault();
		var nombreValido = validateInput($('#nombre'));
		var apellidoValido = validateInput($('#apellido'));
		var nroDocValido = validateInput($('#numeroDocumento'));
		var emailValido = validateEmail($('#email'));
		var validDatosPersonales = nombreValido && apellidoValido && nroDocValido && emailValido;
		
		var datos_alumno_1 = true;
		var datos_alumno_2 = true;
		var datos_alumno_3 = true;
		if (tipoPromocion == 1) {
			datos_alumno_1 = validateInput($('#datos_alumno_1'));
		}
		if (tipoPromocion == 2) {
			datos_alumno_1 = validateInput($('#datos_alumno_1'));
			datos_alumno_2 = validateInput($('#datos_alumno_2'));
		}
		if (tipoPromocion == 3) {
			datos_alumno_1 = validateInput($('#datos_alumno_1'));
			datos_alumno_2 = validateInput($('#datos_alumno_2'));
			datos_alumno_3 = validateInput($('#datos_alumno_3'));
		}
		var validDatosAlumno = datos_alumno_1 && datos_alumno_2 && datos_alumno_3;
		
		var provinciaValido = validateInput($('#provinciaDocente'));
		var municipioValido = validateInput($('#municipio'));
		var nivelValido = validateInput($('#nivel'));
		var areaValido = validateInput($('#area'));
		var cargoValido = validateInput($('#cargo'));
		var legajoValido = validateInput($('#legajo'));
		var validDatosDocente = provinciaValido && municipioValido && nivelValido && areaValido && cargoValido && legajoValido;
		if ($('#checkDocente').is(':checked')) {
			if (validDatosPersonales && validDatosDocente && validDatosAlumno) {
				$("#inscripcion-paso-1").submit();
			}
		} else {
			if (validDatosPersonales && validDatosAlumno) {
				$("#inscripcion-paso-1").submit();
			}
		}
	});
	
});
</script>
<?php
	include_once 'data/provincias.php';
	include_once 'data/municipios.php';
	require_once 'data/util.php';
?>
</head>
<body>
<div class="container">
	
	<!-- modal login -->
	<?php
		include_once 'templates/modal-login.php';
	?>

	<!-- menu section -->
	<div class="bs-docs-section clearfix">
		<div class="row" style="background-color: #000;">
			<div class="col-lg-12">
				<?php
					include_once 'templates/menu.php';
				?>
			</div>
		</div>
	</div>
	<!-- docs section -->
	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-12">
				<!--<h4 id="nav-tabs">Comprobante de inscripci&oacute;n</h4>-->
				<br>
				<div class="bs-component live-less-editor-hovercontainer" data-relatedvars="caret-width-base,dropdown-bg,dropdown-fallback-border,dropdown-border,dropdown-divider-bg,dropdown-link-color,dropdown-link-hover-color,dropdown-link-hover-bg,dropdown-link-active-color,dropdown-link-active-bg,dropdown-link-disabled-color,dropdown-header-color,nav-link-padding,nav-link-hover-bg,nav-disabled-link-color,nav-disabled-link-hover-color,link-color,nav-tabs-border-color,nav-tabs-link-hover-border-color,nav-tabs-active-link-hover-color,nav-tabs-active-link-hover-bg,nav-tabs-active-link-hover-border-color">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
						<li class="active"><a href="#datospersonales" data-toggle="tab" aria-expanded="false">Datos personales y del curso</a></li>
						<li class=""><a href="#formasdepago" aria-expanded="true">Formas de Pago</a></li>
						<li class=""><a href="#fininscripcion" aria-expanded="true">Fin de la Inscripci&oacute;n</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="datospersonales">
							<div class="col-lg-offset-1 col-lg-10">
								<div class="well bs-component live-less-editor-hovercontainer" data-relatedvars="legend-color,legend-border-color,input-color,input-height-base,input-bg,input-border,input-border-radius,input-border-focus,input-color-placeholder,input-bg-disabled,input-height-small,input-height-large,state-success-text,state-success-bg,state-warning-text,state-warning-bg,state-danger-text,state-danger-bg,input-group-addon-bg,input-group-addon-border-color,input-border-radius-large,input-border-radius-small">
									<?php
										require_once 'templates/inscripcion-paso1-form.php';
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>