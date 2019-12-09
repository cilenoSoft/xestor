<?php

include 'funcions.php';

$conexion = conexion();
$idUsuario = $_POST['idUsuario'];

$consulta = "SELECT * FROM tarefas WHERE ESTADO = 'SIN ASIGNAR'";
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
        echo "<input type = 'hidden' id='userTar' value = '$idUsuario'>";
        echo "<button class='btn btn-primary asignaTarefa' value='$idTarefa'>Asignar</button>";
        echo "<div class='line'></div>";
    }
}

echo '<script>';
 echo 'modalAsignarTarefas()';
echo '</script>';
