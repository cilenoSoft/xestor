<?php

include 'funcions.php';

$conexion = conexion();
$tar = $_POST['tar'];

$consulta = "SELECT * FROM comentarios_tarefa WHERE ID_TAREFA = '$tar'";
$resultado = $conexion->query($consulta);

if ($resultado->rowCount() == 0) {
    echo 'Non se atoparon rexistros.';
} else {
    $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos as $fila) {
        $fecha = $fila['FECHA'];
        $estado = $fila['ESTADO'];
        $comentario = $fila['COMENTARIO'];
        $usuario = 'Usuario: '.$fila['LOGIN_USUARIO'];
        $fecha = 'Data: '.$fecha.'  Estado: '.$estado;
        echo "<p>$fecha</p>";
        echo "<p>$usuario</p>";
        echo "<p>$comentario</p>";
        echo "<div class='line'></div>";
    }
}
