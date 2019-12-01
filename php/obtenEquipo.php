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
        echo '<div class="tz-gallery">';
        echo '<div class="row">';
        foreach ($idsUsuario as $id) {
            $consulta = "SELECT * FROM usuarios where id like '$id[0]'";

            $resultado = $conexion->query($consulta);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

            echo '<div class="col-sm-6 col-md-4">';
            echo "<a class='lightbox' href='../../imgUsuarios/".$resultado['login']."'>";
            echo '<p>'.$resultado['login'].'</p>';
            echo "<img src='../../imgUsuarios/".$resultado['login']."'  width='200' />";
            echo '</a>';
            echo '<p></p>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
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
