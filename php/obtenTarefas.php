<?php

include 'conexion.php';

function obtenTarefasUsuario($usuario) {
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where login like '$usuario'";

        $resultado = $conexion->query($consulta);

        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT * FROM tarefas WHERE usuarioCreador like '$idUsuario'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Nos se atoparon tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $i = 0;
            foreach ($datos as $fila) {
                echo '<h2>' . $fila['titulo'] . '</h2>';
                echo '<p>' . $fila['descripcion'] . '<p>';
                echo "<div class='line'></div>";
            }
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

        $consulta = "SELECT idTarefa FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";
        $resultado = $conexion->query($consulta);
        if ($resultado->rowCount() == 0) {
            echo 'Non se atoparon tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datos as $fila) {
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '" . $fila['idTarefa'] . "'";
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
