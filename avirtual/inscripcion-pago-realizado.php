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
				<h3 id="nav-tabs">Fin de la Inscripci&oacute;n</h3>
				<div class="bs-component live-less-editor-hovercontainer" data-relatedvars="caret-width-base,dropdown-bg,dropdown-fallback-border,dropdown-border,dropdown-divider-bg,dropdown-link-color,dropdown-link-hover-color,dropdown-link-hover-bg,dropdown-link-active-color,dropdown-link-active-bg,dropdown-link-disabled-color,dropdown-header-color,nav-link-padding,nav-link-hover-bg,nav-disabled-link-color,nav-disabled-link-hover-color,link-color,nav-tabs-border-color,nav-tabs-link-hover-border-color,nav-tabs-active-link-hover-color,nav-tabs-active-link-hover-bg,nav-tabs-active-link-hover-border-color">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
						<li class=""><a href="#datospersonales" aria-expanded="true">Datos personales y del curso</a></li>
						<li class=""><a href="#formasdepago" aria-expanded="true">Formas de Pago</a></li>
						<li class="active"><a href="#fininscripcion" data-toggle="tab" aria-expanded="false">Fin de la Inscripci&oacute;n</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="fininscripcion">
							<div class="col-lg-offset-1 col-lg-10">
								<div class="well bs-component live-less-editor-hovercontainer" data-relatedvars="legend-color,legend-border-color,input-color,input-height-base,input-bg,input-border,input-border-radius,input-border-focus,input-color-placeholder,input-bg-disabled,input-height-small,input-height-large,state-success-text,state-success-bg,state-warning-text,state-warning-bg,state-danger-text,state-danger-bg,input-group-addon-bg,input-group-addon-border-color,input-border-radius-large,input-border-radius-small">
								<?php
									include_once 'templates/inscripcion-pago-realizado-ok.php';
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