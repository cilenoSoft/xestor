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
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: ' . $e->getMessage();
    }
}

function obtenTarefasUsuarioAutorizado($usuario) {
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where email like '$usuario'";

        $resultado = $conexion->query($consulta);

        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT idTarea FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se encontraron tarefas.';
        } else {

            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $fila) {
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '" . $fila['idTarea'] . "'";

                $resultado2 = $conexion->query($consulta);


                $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datos2 as $fila2) {
                    echo '<h2>' . $fila2['titulo'] . '</h2>';
                    echo '<p>' . $fila2['descripcion'] . '<p>';
                    echo "<div class='line'></div>";
                }
            }
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
