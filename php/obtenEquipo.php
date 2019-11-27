<?php

include 'conexion.php';

function obtenUsuariosEquipo($idEquipo)
{
    try {
        $conexion = conexion();
        $idEquipo = $_SESSION['equipo'];

        $consulta = "SELECT idUsuario FROM usuarios_equipo where idEquipo like '$idEquipo'";

        $resultado = $conexion->query($consulta);

        $idsUsuario = $resultado->fetchAll();

        foreach ($idsUsuario as $id) {
            $consulta = "SELECT * FROM usuarios where id like '$id[0]'";

            $resultado = $conexion->query($consulta);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];
            echo '<p></p>';
            echo '<p>'.$resultado['login'].'</p>';
            echo '<p></p>';
            echo "<img src='../../imgUsuarios/".$resultado['login']."'  width='200' />";
            echo '<p></p>';
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenNombreEquipo($idEquipo)
{
    try {
        $conexion = conexion();
        $idEquipo = $_SESSION['equipo'];

        $consulta = "SELECT nombre FROM equipos where idEquipo like '$idEquipo'";

        $resultado = $conexion->query($consulta);

        $idsUsuario = $resultado->fetch()[0];

        return $idsUsuario;
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
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
            echo 'Non se atoparon tarefas.';
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
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}
