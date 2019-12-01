<?php

include 'conexion.php';

function compruebaContrasena($pass, $passBD, $user, $idEquipo, $idUsuario)
{
    if (password_verify(
                    base64_encode(
                            hash('sha256', $pass, true)
                    ), $passBD
            )) {
        logearUsuario($user, $idEquipo, $idUsuario);
        header('Location: paginaUsuario_1.php');
    } else {
        header('Location: logueo.php');
    }
}

function obtenerEmail($pass, $passBD, $user, $idEquipo, $idUsuario)
{
    if (password_verify(
                    base64_encode(
                            hash('sha256', $pass, true)
                    ), $passBD
            )) {
        logearUsuario($user, $idEquipo, $idUsuario);
        header('Location: paginaUsuario_1.php');
    } else {
        header('Location: logueo.php');
    }
}

function logearUsuario($user, $idEquipo, $idUsuario)
{
    session_start();
    session_regenerate_id();
    $_SESSION['login'] = $user;
    $_SESSION['equipo'] = $idEquipo;
    $_SESSION['idUsuario'] = $idUsuario;
}

try {
    $contraseñaCorrecta = false;

    $login = $_POST['login'];
    $pass = $_POST['password'];

    $conexion = conexion();

    $consulta = "SELECT * FROM usuarios where login like '$login'";

    $resultado = $conexion->query($consulta);

    if ($resultado->rowCount() == 0) {
        echo 'Nos se atopou o usuario';
    } else {
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datos as $fila) {
            $passBD = $fila['pass'];
            $equipo = $fila['idEquipo'];
            $idUsuario = $fila['id'];
            compruebaContrasena($pass, $passBD, $login, $equipo, $idUsuario);
        }
    }
} catch (PDOException $e) {
    echo 'Error conectando coa base de datos: '.$e->getMessage();
}
?>

