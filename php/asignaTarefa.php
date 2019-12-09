
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
$consulta = "UPDATE `tarefas` set `ESTADO` = 'PENDIENTE', `USUARIO_ULTIMO_ESTADO` = '$userXestor' WHERE `ID` like '$tarefa'";
$conexion = conexion();
$resultado = $conexion->query($consulta);

$consulta = "INSERT INTO `usuarios_tarefa` (`ID_TAREFA`, `ID_USUARIO`) VALUES ('$tarefa','$idUsuarioAsignar')";
$conexion = conexion();
$resultado = $conexion->query($consulta);

echo '<script type="text/javascript">
alert("Tarea ' . $tarefa . ' asignada ó usuario ' . $idUsuarioAsignar . '.");
</script>';


