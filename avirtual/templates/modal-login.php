<script type="text/javascript">
$(document).ready(function() {
	$('#usuario').removeClass('hide');
	$('#clave').removeClass('hide');

	$("#btnLogin").click(function(event) {
		$('#usuario').removeClass('hide');
		$('#clave').removeClass('hide');

		var usuario = validateInput($('#usuario'));
		var clave = validateInput($('#clave'));
		var datosValidos = usuario && clave;

		if (datosValidos) {
			$.ajax({
				type: "POST",
				url:"login.php",
				data: $("#login").serialize(),
				success: function(response){
					if (response) {
						console.log("Login success");
						console.log(response);
						$("#usuario-activo").html($('#usuario').val());
						$("#loginModal").modal('hide');
					} else {
						showError($('#btnLogin'));
						console.log("Login error");
					}
				},
				error: function(response){
					console.log("Login error");
					console.log(response);
				}
			});
		} else {
			$('#usuario').addClass('show');
			$('#clave').addClass('show');
		}
	});
});
</script>
<!-- Modal Acceso Usuario -->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog modal-sm" style="margin: 100px auto;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Ingresar</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" name="login" id="login" method="post" action="">
					<div class="form-group">
						<div class="col-lg-6">
							<label name="usuario">Usuario</label>
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario*" maxlength="30">
							<span class="error">Completar este campo</span>
						</div>
						<div class="col-lg-6">
							<label name="clave">Clave</label>
							<input type="password" class="form-control" id="clave" name="clave" placeholder="Clave*" maxlength="8">
							<span class="error">Completar este campo</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-3 col-lg-6 col-lg-offset-3">
							<input type="button" id="btnLogin" class="btn btn-primary" value="Iniciar sesi&oacute;n"/>
							<span class="error">Usuario o clave incorrectos</span>
						</div>
					</div>
				</form>
			</div>
			<!--<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>-->
		</div>
	</div>
</div>