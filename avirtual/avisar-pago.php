<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" itemscope="" itemtype="http://schema.org/WebPage">
<head>
<?php
	require_once 'templates/head.php';
?>
</head>
<body>
<div class="container">
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
				<h3 id="nav-tabs">Aviso de Pago</h3>
				<?php
					include_once 'templates/avisar-pago-form.php';
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>