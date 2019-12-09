<?php

include 'funcions.php';

try {
    $contraseñaCorrecta = false;

    $login = $_POST['login'];
    $pass = $_POST['password'];

    $conexion = conexion();

    $consulta = "SELECT * FROM usuarios where LOGIN like '$login'";

    $resultado = $conexion->query($consulta);

    if ($resultado->rowCount() == 0) {
        echo 'Nos se atopou o usuario';
    } else {
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datos as $fila) {
            $passBD = $fila['PASS'];
            $equipo = $fila['ID_EQUIPO'];
            $idUsuario = $fila['ID'];
            compruebaContrasena($pass, $passBD, $login, $equipo, $idUsuario);
        }
    }
} catch (PDOException $e) {
    echo 'Error conectando coa base de datos: ' . $e->getMessage();
}
?>

