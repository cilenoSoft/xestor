<?php

include 'conexion.php';
function compruebaContrasena($pass, $passBD, $user)
{
    if (password_verify(
        base64_encode(
            hash('sha256', $pass, true)
        ), $passBD
    )) {
        logearUsuario($user);
        header('Location: paginaUsuario_1.php');
    } else {
        header('Location: logueo.php');
    }
}

function logearUsuario($user)
{
    session_start();
    session_regenerate_id();
    $_SESSION['email'] = $user;
}

try {
    $contraseñaCorrecta = false;

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $conexion = conexion();

    $consulta = "SELECT pass FROM usuarios where email like '$login'";

    $resultado = $conexion->query($consulta);

    if ($resultado->rowCount() == 0) {
        echo 'No se ha encontrado el usuario';
    } else {
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datos as $fila) {
            $passBD = $fila['pass'];
            compruebaContrasena($pass, $passBD, $login);
        }
    }
} catch (PDOException $e) {
    //si falla la conexion lanzamos una excepcion
    echo 'Error conectando con la base de datos: '.$e->getMessage();
}
?>

