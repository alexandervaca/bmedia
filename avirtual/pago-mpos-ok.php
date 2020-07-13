<?php
include 'data/util.php';
include 'data/medio-de-pago.php';
session_start();

// En este paso, se registra el pago por Mercado Pago
$idAlumno = $_SESSION["idAlumno"];
$idCursada = $_SESSION["idCursada"];
// Busca la inscripcion
$inscripcion = buscarInscripcion($idAlumno,$idCursada);
if ($inscripcion) {
	$idInscripcion = $inscripcion['id'];
	
	// Busca y actualiza la inscripcion con el medio de pago
	$idMedioPago = $mediosDePago['TP'];// Todo Pago (MPOS)
	if (actualizarInscripcionPago($idAlumno,$idCursada,$idMedioPago)) {
	
		// Valida medio de pago MPOS
		if ($idMedioPago == 4) {// Todo Pago
			
			// Se registra el pago realizado en la base de datos
			if (!isset($_GET['Answer'])) {
				// Error: de las variables de Mercado Pago
				echo 'Error: Faltan variables de Todo Pago';
				/*
				Todo Pago redirige a la url:
				http://freuba.com/avirtual/pago-mpos-ok.php?Answer=2f0d7808-b32b-2e61-73f8-c2677031ae2f
				*/
			} else {
				$answer = $_GET['Answer'];
				
				// Registra el pago de la inscripcion por MP
				if (registrarPagoMPOS($idInscripcion,$answer)) {
					// Se registro con exito el pago realizado por Mercado Pago
					header('Location:inscripcion-pago-realizado.php');
				} else {
					// El pago se realizo correctamente con Mercado Pago, pero no se pudo registrar en el sistema
					header('Location:inscripcion-pago-realizado.php?err=mpos');
				}
			}
		} else {
			// Error: solo se procesan pagos por Mercado Pago o MPOS
			echo 'Error: solo se procesan pagos por Mercado Pago o MPOS';
		}
	} else {
		// Error: No se pudo actualizar el medio de pago de la inscripcion
		echo 'Error: No se pudo actualizar el medio de pago de la inscripcion';
	}
} else {
	// Error: inscripcion no encontrada para el alumno y curso
	echo 'Error: inscripcion no encontrada para el alumno y curso';
}
?>