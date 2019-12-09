<?php

session_start();
include 'funcions.php';

function creaEquipoUsuario($login, $nombre, $listaUsuariosEquipo) {
    try {
        $conexion = conexion();
        $i = 1;
        $consulta = "SELECT ID FROM usuarios where LOGIN like '$login'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "INSERT INTO `equipos` (`NOMBRE`,`USUARIO_XESTOR`) VALUES ('$nombre','$idUsuario')";
        $resultado = $conexion->query($consulta);
        $consulta = "SELECT ID FROM equipos where NOMBRE like '$nombre'";
        $resultado = $conexion->query($consulta);
        $idEquipo = $resultado->fetch()[0];

        foreach ($listaUsuariosEquipo as $usuarioAsignado) {
            if ($usuarioAsignado != null && $usuarioAsignado != '') {
                $consulta = "SELECT ID FROM usuarios where login like '$usuarioAsignado'";
                $resultado = $conexion->query($consulta);
                $idUsuario = $resultado->fetch()[0];

                $consulta = "INSERT INTO USUARIOS_EQUIPO (`ID_EQUIPO`, `ID_USUARIO`) VALUES ('$idEquipo', '$idUsuario')";
                $resultado = $conexion->query($consulta);

                $consulta = "UPDATE usuarios SET `ID_EQUIPO` = '$idEquipo' WHERE ID LIKE '$idUsuario'";

                $resultado = $conexion->query($consulta);
            }
            ++$i;
        }
        $user = $_SESSION['login'];
        $consulta = "UPDATE usuarios SET `ID_EQUIPO` = '$idEquipo' WHERE LOGIN LIKE '$user'";
        $resultado = $conexion->query($consulta);

        if ($resultado) {
            echo 'Equipo creado correctamente.';
            $_SESSION['equipo'] = $idEquipo;
        }

        header('Refresh: 3; URL=paxinaEquipo.php');
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}

$login = $_SESSION['login'];
$nombre = $_POST['nombreEquipo'];

for ($i = 1; $i <= 10; ++$i) {
    $usuario = 'usuario_' . $i;
    if (!isset($_POST[$usuario])) {
        break;
    }

    $listaUsuariosEquipo[$i] = $_POST[$usuario];
    echo $_POST[$usuario];
}

/*
  $usuarioAsignado = $_POST['usuario'];
 */

creaEquipoUsuario($login, $nombre, $listaUsuariosEquipo);
