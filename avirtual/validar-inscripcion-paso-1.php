<?php
include 'data/util.php';
session_start();

// valida los campos obligatorios
/*echo 'selectCurso: ' . $_POST['selectCurso'].'<br>';
echo 'nombre: ' . $_POST['nombre'].'<br>';
echo 'apellido:' . $_POST['apellido'].'<br>';
echo 'numeroDocumento:' . $_POST['numeroDocumento'].'<br>';
echo 'email: ' . $_POST['email'].'<br>';
echo '<br>';
die('die');*/
if (!isset($_POST['selectCurso']) || !isset($_POST['nombre']) || !isset($_POST['apellido']) ||
	!isset($_POST['numeroDocumento']) || !isset($_POST['email'])) {

	// TODO: VER!!!
	header("Location:inscripcion-paso1.php?error=cobl");
}

$esDocente = isset($_POST['checkDocente']) ? 1 : 0;
// Datos del docente
/*$provinciaDocente = $_POST['provinciaDocente'];
$municipioDocente = $_POST['municipio'];
$nivelDocente = $_POST['nivel'];
$areaDocente = $_POST['area'];
$cargoDocente = $_POST['cargo'];
$legajoDocente = $_POST['legajo'];*/
$provinciaDocente = '';
$municipioDocente = '';
$nivelDocente = '';
$areaDocente = '';
$cargoDocente = '';
$legajoDocente = '';

// campos obligatorios ok
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$numeroDocumento = $_POST['numeroDocumento'];
$email = $_POST['email'];

$telefonoParticular = $_POST['telefonoParticular'];
$telefonoCelular = $_POST['telefonoCelular'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$barrio = $_POST['barrio'];
$direccion = $_POST['direccion'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$departamento = $_POST['departamento'];
$codigoPostal = $_POST['codigoPostal'];

/*$datosAlumno1 = $_POST["datos_alumno_1"];
$datosAlumno2 = $_POST['datos_alumno_2'];
$datosAlumno3 = $_POST['datos_alumno_3'];*/
$datosAlumno1 = '';
$datosAlumno2 = ''; 
$datosAlumno3 = '';

// Busca el curso seleccionado
$codigoCurso = $_POST['selectCurso'];
//$idCurso = buscarIdCursoPorCodigo($codigoCurso);

//if ($idCurso) {
	$idCursada = buscarIdCursadaPorCodigo($codigoCurso);
	//echo 'idCursada:'.$idCursada.'-';
	//die ('idCursada:'.$idCursada.'-');
	if ($idCursada) {
		// Alta Alumno
		if (altaAlumno($nombre,$apellido,$numeroDocumento,$email,$telefonoParticular,$telefonoCelular,
			$provincia,$localidad,$barrio,$direccion,$numero,$piso,$departamento,$codigoPostal,
			$esDocente,$provinciaDocente,$municipioDocente,$nivelDocente,$areaDocente,$cargoDocente,$legajoDocente)) {

			// Busco el id del alumno generado por su email
			$idAlumno = buscarIdAlumnoPorEMail($email);
			
			if ($idAlumno != null) {
				// El atributo $_SESSION['partner'] guarda el ID del Partner logueado, si no esta logueado, busca el ID de Bmedia
				$idPartner = isset($_SESSION['partner']) ? $_SESSION['partner'] : getPartnerBmedia();
				
				// Inscribe al alumno en la cursada
				if (inscribirAlumno($idAlumno,$idCursada,$idPartner,$datosAlumno1,$datosAlumno2,$datosAlumno3)) {
					//die('<br>idCursada post inscr:'.$idCursada.'<br>');
					//echo '<br>idCursada post inscr:'.$idCursada.'<br>';
					// INSCRIPCION OK CON ESTADO 'PENDIENTE DE PAGO' -> REDIRIGE AL PAGO
					$_SESSION["idAlumno"] = $idAlumno;
					$_SESSION["idCursada"] = $idCursada;
					$_SESSION["codigoCurso"] = $codigoCurso;
					//die ('<br>idCursada post:'.$idCursada.'-');
					//die('Location: inscripcion-paso2.php?crsd='.$idCursada);
					
					// Si es docente debe ir al paso 3, el docente no paga el curso
					if ($esDocente) {
						// El archivo inscripcion-paso3.php sin parametros por GET muestra un mensaje generico 
						// de inscripcion correcta
						header('Location: inscripcion-paso3.php');
					} else {
						header('Location: inscripcion-paso2.php?crsd='.$idCursada.'&idAlumno='.$idAlumno.'&idCursada='.$idCursada);
					}
				} else {
					header('Location: inscripcion-paso1.php?error=e1');
					//echo 'error=e1.<br>';
				}
			} else {
				// Error: buscar alumno
				header("Location: inscripcion-paso1.php?error=e3");
				//echo 'buscar alumno<br>';
			}
		} else {
			// Error: alta alumno
			header("Location: inscripcion-paso1.php?error=e2");
			//echo 'alta alumno<br>';
		}
	} else {
		// Error: No existe cursada
		//echo 'Error: No existe cursada';
	}
//} else {
	// Error: No existe el curso.
//}
?>