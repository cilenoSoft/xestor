
<?php
session_start();
include 'conexion.php';

function insertaComentario($idTarefa, $idUsuario, $comentario, $equipo, $estado, $login)
{
    $conexion = conexion();

    date_default_timezone_set('Europe/Madrid');
    $fecha = 'Y-m-d H:i:s';
    $fechaActual = date($fecha);
    $comentario = trim($comentario, ' ');
    $equipo = trim($equipo, ' ');
    if ($comentario != '') {
        if ($equipo != '') {
            $consulta = "INSERT INTO comentarios_tarefa (`idTarefa`, `idUsuario`,`comentario`,`idEquipo`,`fecha`) VALUES ('$idTarefa', '$idUsuario','$comentario','$equipo','$fechaActual')";
        } else {
            $consulta = "INSERT INTO comentarios_tarefa (`idTarefa`, `idUsuario`,`comentario`,`idEquipo`,`fecha`) VALUES ('$idTarefa', '$idUsuario','$comentario','0','$fechaActual')";
        }
        $resultado = $conexion->prepare($consulta);
    } else {
        $resultado = true;
        $comentarioVacio = true;
    }

    if ($estado == 'FINALIZADA') {
        $consulta = "UPDATE `tarefas` set `estado` = '$estado', `usuarioUltimoEstado` = '$login', `fechaFinalizacion` = '$fechaActual', `fechaUltimaModificacion` = '$fechaActual' WHERE `idTarefa` like '$idTarefa'";
    } else {
        $consulta = "UPDATE `tarefas` set `estado` = '$estado', `usuarioUltimoEstado` = '$login', `fechaUltimaModificacion` = '$fechaActual' WHERE `idTarefa` like '$idTarefa'";
    }
    $resultado2 = $conexion->prepare($consulta);

    if ($resultado2 && $resultado) {
        $resultado2->execute();
        if (!$comentarioVacio) {
            $resultado->execute();
        }
        echo 'Tarefa actualizada correctamente.';
    } else {
        echo "\nPDO::errorInfo():\n";
        print_r($conexion->errorInfo());
        echo 'Erro ó rexistrar o comentario, intenteo de novo.';
    }
}

$idUsuario = $_SESSION['idUsuario'];
$equipo = $_SESSION['equipo'];
$idTarefa = $_POST['idTarefa'];
$comentario = $_POST['comentario'];
$estado = $_POST['estado'];
$login = $_POST['usuario'];
insertaComentario($idTarefa, $idUsuario, $comentario, $equipo, $estado, $login);

header('Refresh: 3; URL=tarefasAsignadas.php');

?>