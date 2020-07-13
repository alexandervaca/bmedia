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
	$idMedioPago = $mediosDePago['MP'];// Mercado Pago
	if (actualizarInscripcionPago($idAlumno,$idCursada,$idMedioPago)) {
	
		// Valida medios de pago MP o MPOS
		if ($idMedioPago == 2) {// Mercado Pago
			
			// Se registra el pago realizado en la base de datos
			if (!isset($_GET['collection_id']) && !isset($_GET['collection_status']) && !isset($_GET['preference_id']) &&
				!isset($_GET['external_reference']) && !isset($_GET['payment_type']) && !isset($_GET['merchant_order_id'])) {
				// Error: de las variables de Mercado Pago
				echo 'Error: Faltan variables de Mercado Pago';
				/*
				Mercado Pago redirige a la url:
				http://freuba.com/avirtual/pago-ok.php?
				collection_id=2196551823&
				collection_status=approved&
				preference_id=98629217-212907e6-b01a-430a-a7b9-bf6d581b5586&
				external_reference=001&
				payment_type=credit_card&
				merchant_order_id=355576858
				*/
			} else {
				$collection_id = $_GET['collection_id'];
				$collection_status = $_GET['collection_status'];
				$preference_id = $_GET['preference_id'];
				$external_reference = $_GET['external_reference'];
				$payment_type = $_GET['payment_type'];
				$merchant_order_id = $_GET['merchant_order_id'];
				
				// Registra el pago de la inscripcion por MP
				if (registrarPagoMP($idInscripcion,$collection_id,$collection_status,$preference_id,$external_reference,$payment_type,$merchant_order_id)) {
					// Se registro con exito el pago realizado por Mercado Pago
					header('Location:inscripcion-pago-realizado.php');
				} else {
					// El pago se realizo correctamente con Mercado Pago, pero no se pudo registrar en el sistema
					header('Location:inscripcion-pago-realizado.php?err=mp');
				}
			}
		} else if ($idMedioPago == 3) {// MPOS
			// TODO: Falta probar el pago
			echo 'TODO: Falta probar el pago MPOS';
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