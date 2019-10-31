<?php

session_start();
include 'conexion.php';

function creaTarefaUsuario($email, $titulo, $descripcion, $usuarioAsignado)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where email like '$email'";
        //realizamos la consulta y obtenemos los resultados
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];
        $fecha = 'Y-m-d h:m:s';
        $fechaActual = date($fecha);
        $consulta = "INSERT INTO tarefas (`titulo`, `usuarioCreador`,`fechaCreacion`,`descripcion`) VALUES ('$titulo', '$idUsuario','$fechaActual','$descripcion')";
        $resultado = $conexion->query($consulta);

        if ($usuarioAsignado != null && $usuarioAsignado != '') {
            $consulta = "SELECT idTarefa FROM tarefas where titulo like '$titulo' AND usuarioCreador LIKE '$idUsuario' AND fechaCreacion = '$fechaActual'";
            //realizamos la consulta y obtenemos los resultados
            $resultado = $conexion->query($consulta);
            $idTarefa = $resultado->fetch()[0];

            $consulta = "SELECT id FROM usuarios where login like '$usuarioAsignado'";
            $resultado = $conexion->query($consulta);
            $idUsuario = $resultado->fetch()[0];

            $consulta = "INSERT INTO tarefas_asignadas (`idTarefa`, `idUsuario`) VALUES ('$idTarefa', '$idUsuario')";
            $resultado = $conexion->query($consulta);
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
        //realizamos la consulta y obtenemos los resultados
        $resultado = $conexion->query($consulta);

        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT idTarea FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";
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
            foreach ($datos as $fila) {
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '".$fila['idTarea']."'";
                //realizamos la consulta y obtenemos los resultados
                $resultado2 = $conexion->query($consulta);

                //Volcamos los datos en un array asociativo
                $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);
                //recorremos las filas y las añadimos al html
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
    $email = $_SESSION['email'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $usuarioAsignado = $_POST['usuario'];
    creaTarefaUsuario($email, $titulo, $descripcion, $usuarioAsignado);
