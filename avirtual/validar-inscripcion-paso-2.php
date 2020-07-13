<?php
session_start();
include 'data/util.php';
include 'data/medio-de-pago.php';

// VALIDAR MEDIO DE PAGO - EF: Efectivo, MP: Mercado Pago
if (!isset($_POST['mediopago'])) {
	header("Location:inscripcion-paso2.php?error=medpag");
}

$medioPago = $_POST['mediopago'];
$idMedioPago = $mediosDePago[$medioPago];
//echo 'idMedioPago:'.$idMedioPago.'<br>';

// PAGO OK
$idAlumno = $_POST["idAlumno"];
$idCursada = $_POST["idCursada"];
//$idAlumno = $_SESSION["idAlumno"];
//$idCursada = $_SESSION["idCursada"];
// Busca y actualiza la inscripcion con el medio de pago
if (actualizarInscripcion($idAlumno,$idCursada,$idMedioPago)) {
	// REDIRIGE AL PAGO EXITOSO
	header('Location:inscripcion-paso3.php?mp='.$idMedioPago);
	//echo 'REDIRIGE AL PAGO EXITOSO mp:'.$medioPago.' mp='.$idMedioPago;
} else {
	// No se pudo actualizar el medio de pago
	header("Location:inscripcion-paso2.php?error=medpag3");
	//echo 'No se pudo actualizar el medio de pago';
}
?>