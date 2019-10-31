<?php

function conexion() {
    try {
        global $basededatos;
        global $conexionBD;
        global $usuarioBD;
        global $contrasenaBD;

        $basededatos = "usuarios"; //base de datos dwes
        $conexionBD = 'mysql:host=localhost;dbname=' . $basededatos; //conexion con el servidor localhost y base de datos dwes
        $usuarioBD = "root"; //usuario de la base de datos
        $contrasenaBD = ""; //contraseña de la base de datos, en este caso no tiene

        $contraseñaCorrecta = false;

        return new PDO($conexionBD, $usuarioBD, $contrasenaBD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    } catch (PDOException $e) {//si falla la conexion lanzamos una excepcion
        echo 'Error conectando con la base de datos: ' . $e->getMessage();
    }
}

?>