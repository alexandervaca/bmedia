<!--SI EL PAGO ES ONLINE POR MP HAY QUE AVISAR QUE SE REALIZO EL PAGO DIRECCIONANDO A UN FORM APARTE-->
<form class="form-horizontal">
	<fieldset>
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
				<input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" placeholder="Documento*" minlength="7" maxlength="15">
				<span class="error">Completar este campo</span>
			</div>
			<div class="col-lg-6">
				<input type="text" class="form-control" id="telefonoCelular" name="telefonoCelular" placeholder="Tel. Celular">
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-12">
				<input type="email" class="form-control" id="email" name="email" placeholder="e-Mail*" maxlength="100">
				<span class="error">Completar este campo con un e-mail v&aacute;lido.</span>
			</div>
		</div>
		<legend>Datos del Curso</legend>
		<div class="form-group">
			<div class="col-lg-12">
				<select class="form-control" id="selectCurso" name="selectCurso">
				<?php
					// Crea los options de un select HTML, de una lista con elemento del tipo
					// array["codigo"],array["descripcion"]
					echo buildHTMLOptionsList(getCursos());
				?>
				</select>
			</div>
		</div>
		
		<legend>Forma de Pago</legend>
		<div class="form-group">
			<div class="col-lg-12">
				<select class="form-control" id="selectMedioPago" name="selectMedioPago">
				<?php
					// Crea los options de un select HTML, de una lista con elemento del tipo
					// array["codigo"],array["descripcion"]
					echo buildHTMLOptionsList(getMedioPago());
				?>
				</select>
			</div>
		</div>
		
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
				<input type="button" id="avisoPago" class="btn btn-primary" value="Enviar"/>
			</div>
		</div>
	</fieldset>
</form>