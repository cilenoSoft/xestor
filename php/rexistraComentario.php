
<?php
session_start();
include 'funcions.php';

function insertaComentario($idTarefa, $idUsuario, $comentario, $equipo, $estado, $login)
{
    $conexion = conexion();

    date_default_timezone_set('Europe/Madrid');
    $fecha = 'Y-m-d H:i:s';
    $fechaActual = date($fecha);
    $comentario = trim($comentario, ' ');
    $equipo = trim($equipo, ' ');
    $comentarioVacio = false;
    echo $fechaActual;
    if ($comentario != '') {
        if ($equipo != '') {
            $consulta = "INSERT INTO `comentarios_tarefa` (`ID_TAREFA`, `LOGIN_USUARIO`,`COMENTARIO`,`ID_EQUIPO`,`FECHA`,`ESTADO`) VALUES ('$idTarefa', '$login','$comentario','$equipo','$fechaActual','$estado')";
        } else {
            $consulta = "INSERT INTO comentarios_tarefa (`ID_TAREFA`, `ID_USUARIO`,`COMENTARIO`,`ID_EQUIPO`,`FECHA`,`ESTADO`) VALUES ($idTarefa, '$login','$comentario',0,$fechaActual,$estado)";
        }
        $resultado = $conexion->prepare($consulta);

        if (!$resultado) {
            echo "\nPDO::errorInfo():\n";
            print_r($resultado->errorInfo());
        }
    } else {
        $resultado = true;
        $comentarioVacio = true;
    }

    if ($estado == 'FINALIZADA') {
        $consulta = "UPDATE `tarefas` set `ESTADO` = '$estado', `USUARIO_ULTIMO_ESTADO` = '$login', `FECHA_FINALIZACION` = '$fechaActual', `FECHA_ULTIMA_MODIFICACION` = '$fechaActual' WHERE `ID` like '$idTarefa'";
    } else {
        $consulta = "UPDATE `tarefas` set `ESTADO` = '$estado', `USUARIO_ULTIMO_ESTADO` = '$login', `FECHA_ULTIMA_MODIFICACION` = '$fechaActual' WHERE `ID` like '$idTarefa'";
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

echo 'ID usuario '.$idUsuario;
echo '</br>Equipo '.$equipo;
echo '</br>ID tarefa '.$idTarefa;
echo '</br>Comentario '.$comentario;
echo '</br>Estado '.$estado;
echo '</br>Login '.$login;

insertaComentario($idTarefa, $idUsuario, $comentario, $equipo, $estado, $login);

header('Refresh: 3; URL=tarefasAsignadas.php');

?>