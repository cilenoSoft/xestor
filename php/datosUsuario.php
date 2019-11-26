<?php

include 'conexion.php';

function obtenerEmail($login) {
    try {
        $conexion = conexion();

        $consulta = "SELECT email FROM usuarios where login like '$login'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atopou o usuario';
        } else {
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            $email = $datos['email'];

            return $email;
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}

function obtenerPass($login) {
    try {
        $conexion = conexion();

        $consulta = "SELECT pass FROM usuarios where login like '$login'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atopou o usuario';
        } else {
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            $email = $datos['pass'];

            return $email;
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}
?>

