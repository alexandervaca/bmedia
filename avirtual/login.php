<?php
require_once 'data/util.php';

    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    $idUsuario = validarUsuario($usuario, $clave);
    if ($idUsuario) {
        session_start();
        $_SESSION['partner'] = $idUsuario;
        echo 'true';
    } else {
        echo 'false';
    }
?>