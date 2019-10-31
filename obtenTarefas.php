<?php

include 'conexion.php';

function obtenTarefasUsuario($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where email like '$usuario'";
        //realizamos la consulta y obtenemos los resultados
        $resultado = $conexion->query($consulta);

        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT * FROM tarefas WHERE usuarioCreador like '$idUsuario'";
        //realizamos la consulta y obtenemos los resultados
        $resultado = $conexion->query($consulta);

        //si no existen productos de la familia
        if ($resultado->rowCount() == 0) {
            echo 'No se ha encontrado tareas.';
        }
        //si existen productos de la familia
        else {
            //Volcamos los datos en un array asociativo
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            //recorremos las filas y las añadimos al html
            $i = 0;
            foreach ($datos as $fila) {
                echo '<h2>'.$fila['titulo'].'</h2>';
                echo '<p>'.$fila['descripcion'].'<p>';
                echo "<div class='line'></div>";
            }
        }
    } catch (PDOException $e) {//si falla la conexion lanzamos una excepcion
        echo 'Error conectando con la base de datos: '.$e->getMessage();
    }
}

function obtenTarefasUsuarioAutorizado($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where email like '$usuario'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT idTarefa FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";
        $resultado = $conexion->query($consulta);
        if ($resultado->rowCount() == 0) {
            echo 'No se ha encontrado tareas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datos as $fila) {
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '".$fila['idTarefa']."'";
                $resultado2 = $conexion->query($consulta);
                $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($datos2 as $fila2) {
                    echo '<h2>'.$fila2['titulo'].'</h2>';
                    echo '<p>'.$fila2['descripcion'].'<p>';
                    echo "<div class='line'></div>";
                }
            }
        }
    } catch (PDOException $e) {//si falla la conexion lanzamos una excepcion
        echo 'Error conectando con la base de datos: '.$e->getMessage();
    }
}
