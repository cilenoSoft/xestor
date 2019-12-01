<?php

include 'conexion.php';

$conexion = conexion();
$consulta = 'SELECT * FROM usuarios';
$resultado = $conexion->query($consulta);
$numMembros = $_POST['numMembro'];

if ($resultado->rowCount() == 0) {
    echo 'No se ha encontrado usuarios';
} else {

    $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 1; $i <= $numMembros; ++$i) {

        $usuarioSel = 'usuario_' . $i;
        echo "<label for='membroEquipo'>Membro " . $i . '</label>';
        echo "<select name='$usuarioSel' id='$usuarioSel' class='form-control'>";
        foreach ($datos as $fila) {
            $usuario = $fila['login'];
            echo "<option>$usuario</option>";
        }
        echo '</select>';
        echo "<span class='help-block' id='error'></span>";
    }
}
