<?php

session_start();
include 'conexion.php';

function engadirUsuario($idEquipo, $suarioEquipo)
{
    try {
        $conexion = conexion();

        $idEquipo = $idEquipo;

        if ($suarioEquipo != null && $suarioEquipo != '') {
            $consulta = "SELECT id FROM usuarios where login like '$suarioEquipo'";
            $resultado = $conexion->query($consulta);
            $idUsuario = $resultado->fetch()[0];

            $consulta = "INSERT INTO usuarios_equipo (`idEquipo`, `idUsuario`) VALUES ('$idEquipo', '$idUsuario')";
            $resultado = $conexion->query($consulta);

            $consulta = "UPDATE usuarios SET `idEquipo` = '$idEquipo' WHERE id LIKE '$idUsuario'";

            $resultado = $conexion->query($consulta);
        }

        if ($resultado) {
            echo 'Usuario engadido correctamente.';
        }

        header('Refresh: 3; URL=paxinaEquipo.php');
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

$idEquipo = $_SESSION['equipo'];
echo $idEquipo;
    $suarioEquipo = $_POST['usuario_1'];
    echo $suarioEquipo;
/*
$usuarioAsignado = $_POST['usuario'];
*/

engadirUsuario($idEquipo, $suarioEquipo);
