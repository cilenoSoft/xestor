<?php

session_start();
include 'funcions.php';

function engadirUsuario($idEquipo, $suarioEquipo) {
    try {
        $conexion = conexion();

        $idEquipo = $idEquipo;

        if ($suarioEquipo != null && $suarioEquipo != '') {
            $consulta = "SELECT ID FROM usuarios where LOGIN like '$suarioEquipo'";
            $resultado = $conexion->query($consulta);
            $idUsuario = $resultado->fetch()[0];

            $consulta = "INSERT INTO `usuarios_equipo` (`ID_EQUIPO`, `ID_USUARIO`) VALUES ('$idEquipo', '$idUsuario')";
            $resultado = $conexion->query($consulta);

            $consulta = "UPDATE `usuarios` SET `ID_EQUIPO` = '$idEquipo' WHERE ID LIKE '$idUsuario'";

            $resultado = $conexion->query($consulta);
        }

        if ($resultado) {
            echo 'Usuario '. $suarioEquipo .' engadido correctamente.';
        }

        header('Refresh: 3; URL=paxinaEquipo.php');
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}

$idEquipo = $_SESSION['equipo'];
$suarioEquipo = $_POST['usuario_1'];

engadirUsuario($idEquipo, $suarioEquipo);
