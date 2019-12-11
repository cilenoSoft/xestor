
<?php

session_start();

include 'funcions.php';
comprobaSesion();
$tarefa = $_POST['idTarefa'];
$idUsuarioAsignar = $_POST['user'];
$userXestor = $_SESSION['login'];
$equipo = $_SESSION['equipo'];

$fecha = 'Y-m-d H:i:s';
$fechaActual = date($fecha);
$consulta = "UPDATE `tarefas` SET `ESTADO` = 'SIN ASIGNAR', `USUARIO_ULTIMO_ESTADO` = '$userXestor' WHERE `ID` like '$tarefa'";
$conexion = conexion();
$resultado = $conexion->query($consulta);

$consulta = "DELETE FROM `usuarios_tarefa` WHERE `ID_TAREFA` = '$tarefa' AND `ID_USUARIO` = '$idUsuarioAsignar'";
$conexion = conexion();
$resultado = $conexion->query($consulta);

echo '<script type="text/javascript">
alert("Tarefa '.$tarefa.' desasignada do usuario '.$idUsuarioAsignar.'.");
</script>';
