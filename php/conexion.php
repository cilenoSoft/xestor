<?php

function conexion() {
    try {
        global $basededatos;
        global $conexionBD;
        global $usuarioBD;
        global $contrasenaBD;

        $basededatos = 'usuarios'; //base de datos dwes
        $conexionBD = 'mysql:host=localhost;dbname=' . $basededatos; //conexion co servidor localhost e base de datos usuarios
        $usuarioBD = 'root'; //usuario da base de datos
        $contrasenaBD = ''; //contraseal da base de datos, en este caso non ten

        $contraseñaCorrecta = false;

        return new PDO($conexionBD, $usuarioBD, $contrasenaBD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}
