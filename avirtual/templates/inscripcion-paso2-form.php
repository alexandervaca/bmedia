<form class="form-horizontal" name="inscripcion-paso-2" id="inscripcion-paso-2" method="post" action="validar-inscripcion-paso-2.php">
	<input type="hidden" name="mediopago" id="mediopago"/>
	<input type="hidden" name="idAlumno" id="idAlumno"/>
	<input type="hidden" name="idCursada" id="idCursada"/>
	<fieldset>
		<legend>Forma de Pago</legend>
		<!--<div class="form-group" style="border-bottom:#d4d4d4 1px solid;">
			<div class="col-lg-6">
				<div style="padding:8px 10px 8px 80px; background-image:url(images/medio-de-pago/icono-efectivo.jpg); 
					background-position:2px center; background-repeat:no-repeat; height:55px;">
					<div style="float:left; width:365px; position:relative; top:8px;">
						<strong>Efectivo en el instituto</strong>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-4 col-lg-2">
				<input type="button" class="btn btn-primary" value="Elegir" onclick="elegirMedioDePago('EF');"/>
			</div>
		</div>-->
		<div class="form-group" style="border-bottom:#d4d4d4 1px solid;">
			<div class="col-lg-6">
				<div style="padding:8px 10px 8px 80px; background-image:url(images/medio-de-pago/icono-transferencia-bancaria.jpg); 
					background-position:2px center; background-repeat:no-repeat; height:55px;">
					<div style="float:left; width:365px; position:relative; top:8px;">
						<strong>Transferencia Bancaria</strong>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-4 col-lg-2">
				<input type="button" class="btn btn-primary" value="Elegir" onclick="elegirMedioDePago('TB');"/>
			</div>
		</div>
		<?php
			//session_start();
			//$idCursada = $_SESSION["idCursada"];
			$idCursada = $_GET["idCursada"];
			$codigoCurso = $_SESSION["codigoCurso"];
			$pagos = linksDePago($_GET['crsd']);
			$linkMP = $pagos['link_mp'];
			$linkMPOS = $pagos['link_mpos'];
		// Los links de Mercado Pago y MPos se muestran si estan definidos en la base de datos
			if ($linkMP != null) {
		?>
		<div class="form-group" style="border-bottom:#d4d4d4 1px solid;">
			<div class="col-lg-6">
				<div style="padding:8px 10px 8px 80px; background-image:url(images/medio-de-pago/logo-mercadopago.jpg); 
					background-position:2px center; background-repeat:no-repeat; height:55px;">
					<div style="float:left; width:365px; position:relative; top:8px;">
						<strong>Mercado Pago</strong>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-4 col-lg-2">
				<a mp-mode="dftl" href="<?php echo $linkMP?>" name="MP-payButton" class='btn btn-primary'>Pagar</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>
			<!--
			PRUEBA JAVA INICIAL MP
			<div class="col-lg-offset-4 col-lg-2">
				<a mp-mode="dftl" href="https://www.mercadopago.com/mla/checkout/start?pref_id=98629217-212907e6-b01a-430a-a7b9-bf6d581b5586" name="MP-payButton" 
					class='btn btn-primary'>Pagar</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>-->
		</div>
		<?php
			}
			if ($linkMPOS != null) {
		?>
			<div class="form-group" style="border-bottom:#d4d4d4 1px solid;">
				<div class="col-lg-6">
					<div style="padding:8px 10px 8px 80px; background-image:url(images/medio-de-pago/logo-todo-pago.png); 
						background-position:2px center; background-repeat:no-repeat; height:55px;">
						<div style="float:left; width:365px; position:relative; top:8px;">
							<strong>Todo Pago</strong>
						</div>
					</div>
				</div>
				<div class="col-lg-offset-4 col-lg-2">
					<a href="<?php echo $linkMPOS; ?>" target="_blank" class="btn btn-primary">Pagar</a>
					<!--
					<a href='https://forms.todopago.com.ar/formulario/commands?command=formulario&m=b4c41ccf73f5c389220738436945ab88' 
						target="_blank" class="btn btn-primary">Pagar</a>
					-->
				</a>
				</div>
			</div>
		<?php
			}
		?>
		<!--
		PRUEBA JAVA INICIAL TODO PAGO
		<div class="form-group" style="border-bottom:#d4d4d4 1px solid;">
			<div class="col-lg-6">
				<div style="padding:8px 10px 8px 80px; background-image:url(images/medio-de-pago/logo-todo-pago.png); 
					background-position:2px center; background-repeat:no-repeat; height:55px;">
					<div style="float:left; width:365px; position:relative; top:8px;">
						<strong>Todo Pago</strong>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-4 col-lg-2">
				<a href='https://forms.todopago.com.ar/formulario/commands?command=formulario&m=b4c41ccf73f5c389220738436945ab88' 
					target="_blank" class="btn btn-primary">Pagar</a>
			</a>
			</div>
		</div>-->
		 <!--LINK ORIGINAL TODO PAGO
		 <meta charset="utf-8">
		 <link href="https://portal.todopago.com.ar/app/css/boton.css" rel="stylesheet">
		 <div class="boton-todopago-css">
			<a href='https://forms.todopago.com.ar/formulario/commands?command=formulario&m=b4c41ccf73f5c389220738436945ab88'>
				<div class="col-md-4 col-sm-4 col-xs-12 tipo-boton-class boton_solo" id="htmlBoton" style="display: block;">
					<input type="button" id="vistaPreviaBoton" class="btn aviso-boton-texto disabled" value="Pagar" 
						style="border: 1px solid rgb(46, 109, 164); color: rgb(255, 255, 255); font-family: Arial, Helvetica, sans-serif; width: 60px; height: 32px; background-color: rgb(51, 122, 183);">
				</div>
			</a>
		</div>-->
	</fieldset>
</form>