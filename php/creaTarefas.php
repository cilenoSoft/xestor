<?php

session_start();
include 'conexion.php';

function creaTarefaUsuario($login, $titulo, $descripcion, $usuarioAsignado) {
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where login like '$login'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];
        date_default_timezone_set('Europe/Madrid');
        $fecha = 'Y-m-d H:i:s';
        $fechaActual = date($fecha);
        $consulta = "INSERT INTO tarefas (`titulo`, `usuarioCreador`,`fechaCreacion`,`descripcion`) VALUES ('$titulo', '$idUsuario','$fechaActual','$descripcion')";
        $resultado = $conexion->query($consulta);

        if ($usuarioAsignado != null && $usuarioAsignado != '') {
            $consulta = "SELECT idTarefa FROM tarefas where titulo like '$titulo' AND usuarioCreador LIKE '$idUsuario' AND fechaCreacion = '$fechaActual'";

            $resultado = $conexion->query($consulta);
            $idTarefa = $resultado->fetch()[0];

            $consulta = "SELECT id FROM usuarios where login like '$usuarioAsignado'";
            $resultado = $conexion->query($consulta);
            $idUsuario = $resultado->fetch()[0];

            $consulta = "INSERT INTO tarefas_asignadas (`idTarefa`, `idUsuario`) VALUES ('$idTarefa', '$idUsuario')";
            $resultado = $conexion->query($consulta);

            echo '<p>Tarefa ' . $titulo . ' creada correctamente.</p>';
            header('Refresh: 3; URL=paginaUsuario_1.php');
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}

$login = $_SESSION['login'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$usuarioAsignado = $_POST['usuario'];
creaTarefaUsuario($login, $titulo, $descripcion, $usuarioAsignado);
