<?php

include 'funcions.php';

$conexion = conexion();
$idUsuario = $_POST['idUsuario'];

$consulta = "SELECT * FROM `tarefas` WHERE `ID` IN (SELECT ID_TAREFA FROM `usuarios_tarefa` WHERE `ID_USUARIO` = '$idUsuario')";

$resultado = $conexion->query($consulta);

if ($resultado->rowCount() == 0) {
    echo 'Non se atoparon rexistros.';
} else {
    $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos as $fila) {
        $idTarefa = $fila['ID'];
        $fecha = $fila['FECHA_CREACION'];
        $estado = $fila['ESTADO'];
        $descripcion = $fila['DESCRIPCION'];
        $titulo = 'Titulo: '.$fila['TITULO'];
        $fecha = 'Data: '.$fecha.'  Estado: '.$estado;
        echo "<p>$titulo</p>";
        echo '<p>Estado: '.$estado.'</p>';
        echo "<p>$descripcion</p>";
        echo "<input type = 'hidden' id='userTar' value = '$idUsuario'>";
        echo "<button class='btn btn-primary desAsignaTarefa' value='$idTarefa'>Desasignar</button>";
        echo "<div class='line'></div>";
    }
}

echo '<script>';
 echo 'modalTarefasAsignadas()';
echo '</script>';
