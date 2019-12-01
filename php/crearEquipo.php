<?php

session_start();
include 'conexion.php';

function creaEquipoUsuario($login, $nombre, $listaUsuariosEquipo)
{
    try {
        $conexion = conexion();
        $i = 1;
        $consulta = "SELECT id FROM usuarios where login like '$login'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "INSERT INTO equipos (`nombre`,`usuarioXestor`) VALUES ('$nombre','$idUsuario')";
        $resultado = $conexion->query($consulta);
        $consulta = "SELECT idEquipo FROM equipos where nombre like '$nombre'";
        $resultado = $conexion->query($consulta);
        $idEquipo = $resultado->fetch()[0];

        foreach ($listaUsuariosEquipo as $usuarioAsignado) {
            if ($usuarioAsignado != null && $usuarioAsignado != '') {
                $consulta = "SELECT id FROM usuarios where login like '$usuarioAsignado'";
                $resultado = $conexion->query($consulta);
                $idUsuario = $resultado->fetch()[0];

                $consulta = "INSERT INTO usuarios_equipo (`idEquipo`, `idUsuario`) VALUES ('$idEquipo', '$idUsuario')";
                $resultado = $conexion->query($consulta);

                $consulta = "UPDATE usuarios SET `idEquipo` = '$idEquipo' WHERE id LIKE '$idUsuario'";

                $resultado = $conexion->query($consulta);
            }
            ++$i;
        }
        if ($resultado) {
            echo 'Equipo creado correctamente.';
        }

        header('Refresh: 3; URL=paginaUsuario_1.php');
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

        $consulta = "SELECT idTarea FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se encontraron tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $fila) {
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '".$fila['idTarea']."'";

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

$login = $_SESSION['login'];
$nombre = $_POST['nombreEquipo'];

for ($i = 1; $i <= 10; ++$i) {
    $usuario = 'usuario_'.$i;
    if (!isset($_POST[$usuario])) {
        break;
    }

    $listaUsuariosEquipo[$i] = $_POST[$usuario];
    echo $_POST[$usuario];
}

/*
$usuarioAsignado = $_POST['usuario'];
*/

creaEquipoUsuario($login, $nombre, $listaUsuariosEquipo);
