<?php

session_start();
include 'funcions.php';

function creaTarefaUsuario($login, $titulo, $descripcion, $usuarioAsignado)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where LOGIN like '$login'";

        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];
        date_default_timezone_set('Europe/Madrid');
        $fecha = 'Y-m-d H:i:s';
        $fechaActual = date($fecha);
        if ($usuarioAsignado != 'NA') {
            $consulta = "INSERT INTO `tarefas` (`TITULO`, `DESCRIPCION`, `COMENTARIO`, `ESTADO`, `USUARIO_ULTIMO_ESTADO`, `USUARIO_CREADOR`,`FECHA_CREACION`, `FECHA_ULTIMA_MODIFICACION`, `FECHA_FINALIZACION`, `FECHA_ENTREGA`) VALUES ('$titulo', '$descripcion','','PENDIENTE', '$login', '$idUsuario','$fechaActual','$fechaActual',null,null)";
        } else {
            $consulta = "INSERT INTO `tarefas` (`TITULO`, `DESCRIPCION`, `COMENTARIO`, `ESTADO`, `USUARIO_ULTIMO_ESTADO`, `USUARIO_CREADOR`,`FECHA_CREACION`, `FECHA_ULTIMA_MODIFICACION`, `FECHA_FINALIZACION`, `FECHA_ENTREGA`) VALUES ('$titulo', '$descripcion','','SIN ASIGNAR', null, '$idUsuario','$fechaActual','$fechaActual',null,null)";
        }
        $resultado = $conexion->query($consulta);

        if ($usuarioAsignado != null && $usuarioAsignado != '' && $usuarioAsignado != 'NA') {
            $consulta = "SELECT ID FROM TAREFAS where TITULO like '$titulo' AND USUARIO_CREADOR LIKE '$idUsuario' AND FECHA_CREACION = '$fechaActual'";

            $resultado = $conexion->query($consulta);
            $idTarefa = $resultado->fetch()[0];

            $consulta = "SELECT ID FROM usuarios where LOGIN like '$usuarioAsignado'";
            $resultado = $conexion->query($consulta);
            $idUsuario = $resultado->fetch()[0];

            $consulta = "INSERT INTO `usuarios_tarefa` (`ID_TAREFA`, `ID_USUARIO`) VALUES ('$idTarefa', '$idUsuario')";
            $resultado = $conexion->query($consulta);
            echo "<div class='row align-items-center'>";
            echo "<div class='col'>";
            echo '<p>Tarefa: '.$titulo.' creada correctamente.</p>';
            echo '</div></div>';
            header('Refresh: 3; URL=tarefasCreadas.php');
        } elseif ($resultado) {
            echo "<div class='row align-items-center'>";
            echo "<div class='col'>";
            echo '<p>Tarefa: '.$titulo.' creada correctamente.</p>';
            echo '</div></div>';
            header('Refresh: 3; URL=tarefasCreadas.php');
        } else {
            echo "<div class='row align-items-center'>";
            echo "<div class='col'>";
            echo '<p>Non se puido crear a tarefa: '.$titulo.' tenteo de novo.</p>';
            echo '</div></div>';
            header('Refresh: 3; URL=formularioCrearTarefa.php');
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

if (isset($_SESSION['login']) && isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_POST['usuario'])) {
    $login = $_SESSION['login'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $usuarioAsignado = $_POST['usuario'];
    creaTarefaUsuario($login, $titulo, $descripcion, $usuarioAsignado);
}
