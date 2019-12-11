<?php

function conexion()
{
    try {
        global $basededatos;
        global $conexionBD;
        global $usuarioBD;
        global $contrasenaBD;

        $basededatos = 'XestorGal'; //base de datos dwes
        $conexionBD = 'mysql:host=localhost;dbname='.$basededatos; //conexion co servidor localhost e base de datos usuarios
        $usuarioBD = 'root'; //usuario da base de datos
        $contrasenaBD = ''; //contraseal da base de datos, en este caso non ten

        $contraseñaCorrecta = false;

        return new PDO($conexionBD, $usuarioBD, $contrasenaBD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function comprobaSesion()
{
    if (!isset($_SESSION['login'])) {
        header('Location: sesionNonIniciada.php');
    }
}

/**
 * TAREFAS.
 */
function obtenTarefasUsuario($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT ID FROM usuarios where login like '$usuario'";

        $resultado = $conexion->query($consulta);

        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT * FROM tarefas WHERE USUARIO_CREADOR like '$idUsuario'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Nos se atoparon tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $i = 0;
            foreach ($datos as $fila) {
                $idTarefa = $fila['ID'];
                echo "<div class='row'>";
                echo "<div class='col-lg-4'>";
                echo '<h2>'.$fila['TITULO'].'</h2>';
                echo '</div>';

                echo "<div class='col-lg-4'>";
                echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                echo "<button class='btn btn-primary verHistorial' data-toggle='modal' data-target='#myModal' value='$idTarefa'>Ver Historial</button>";

                include '../html/historialTarefas.html';
                echo '</div>';
                echo '</div>';

                echo "<div class='row'>";
                echo "<div class='col-lg-6'>";
                echo '<p>'.$fila['DESCRIPCION'].'<p>';
                echo '</div></div>';

                echo "<div class='row'>";
                echo "<div class='col-lg-6'>";
                echo "<div class='line'></div>";
                echo '</div></div>';
            }
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenTarefasUsuarioAutorizado($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT ID FROM usuarios where LOGIN like '$usuario'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT ID_TAREFA FROM usuarios_tarefa WHERE ID_USUARIO like '$idUsuario'";
        $resultado = $conexion->query($consulta);
        if ($resultado->rowCount() == 0) {
            echo 'Non se atoparon tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datos as $fila) {
                $idTarefa = $fila['ID_TAREFA'];
                $consulta = "SELECT * FROM tarefas WHERE ID like '".$idTarefa."' and ESTADO not like '%FINALIZADA%'";
                $resultado2 = $conexion->query($consulta);
                $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

                $consulta = "SELECT comentario FROM COMENTARIOS_TAREFA WHERE ID_TAREFA like '".$idTarefa."' ORDER BY `fecha` DESC";
                $resultado3 = $conexion->query($consulta);

                if ($resultado3->rowCount() > 0) {
                    $comentario = $resultado3->fetch()[0];
                } else {
                    $comentario = 'Sin comentarios.';
                }

                foreach ($datos2 as $fila2) {
                    $estadoTarefa = $fila2['ESTADO'];

                    echo "<div class='row'>";
                    echo "<div class='col-lg-4'>";
                    echo '<h2>'.$fila2['TITULO'].'</h2>';
                    echo '</div>';

                    echo "<div class='col-lg-4'>";
                    echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo "<button class='btn btn-primary verHistorial' data-toggle='modal' data-target='#myModal' value='$idTarefa'>Ver Historial</button>";

                    include '../html/historialTarefas.html';
                    echo '</div>';
                    echo '</div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p>'.$fila2['DESCRIPCION'].'</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Ultimo Comentario:</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    if ($comentario == null || $comentario == '') {
                        echo '<p>Sin comentario</p>';
                    } else {
                        echo '<p>'.$comentario.'</p>';
                    }
                    echo '</div></div>';

                    echo "<form action='rexistraComentario.php' method='post'>";
                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Estado Actual:</p>';
                    echo "<select name='estado' class='form-control'>";

                    $consulta = 'SELECT * FROM ESTADOS_TAREFA';
                    $resultado = $conexion->query($consulta);

                    if ($resultado->rowCount() == 0) {
                        echo 'Non se atoparon estados.';
                    } else {
                        $estados = $resultado->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($estados as $est) {
                            $estado = $est['ESTADO'];
                            if ($estadoTarefa == $estado) {
                                echo "<option selected>$estado</option>";
                            } else {
                                echo "<option >$estado</option>";
                            }
                        }
                    }
                    echo '</select>';
                    echo '</div></div>';

                    echo '<p></p>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Engadir comentario:</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<textarea name='comentario' class='form-control textAreaComentario' rows='3'></textarea>";
                    echo '</div></div>';

                    echo '<p></p>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<button type='submit' class='btn btn-info'>";
                    echo 'Actualizar Tarefa';
                    echo '</button>';
                    echo '</div></div>';

                    echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo '<input name="usuario" type="hidden" value="'.$usuario.'">';

                    echo '</form>';
                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<div class='line'></div>";
                    echo '</div></div>';
                }
            }
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenHistorialTarefa($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT id FROM usuarios where login like '$usuario'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT idTarefa FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";
        $resultado = $conexion->query($consulta);

        echo "<div class='row'>";
        echo "<div class='col-lg-4'>";
        echo '<h2>'.$fila2['titulo'].'</h2>';
        echo '</div>';

        echo "<div class='col-lg-4'>";
        echo "<form id='formulario' action='../html/historialTarefas.html' method='POST'>";
        echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
        echo "<button type='submit' name = 'btnHistorial' class='btn btn-info historial'>Ver Historial</button>";
        echo '</form>';
        echo '</div>';
        echo '</div>';

        echo "<div class='row'>";
        echo "<div class='col-lg-6'>";
        echo '<p>'.$fila2['descripcion'].'</p>';
        echo '</div></div>';

        echo "<div class='row'>";
        echo "<div class='col-lg-6'>";
        echo '<p class="etiqueta">Ultimo Comentario:</p>';
        echo '</div></div>';

        if ($resultado->rowCount() == 0) {
            echo 'Non se atoparon tarefas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datos as $fila) {
                $idTarefa = $fila['idTarefa'];
                $consulta = "SELECT * FROM tarefas WHERE idTarefa like '".$idTarefa."' and estado not like '%FINALIZADA%'";
                $resultado2 = $conexion->query($consulta);
                $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

                $consulta = "SELECT comentario FROM comentarios_tarefa WHERE idTarefa like '".$idTarefa."' ORDER BY `fecha` DESC";
                $resultado3 = $conexion->query($consulta);
                $comentario = $resultado3->fetch()[0];
                $i = 1;
                foreach ($datos2 as $fila2) {
                    $estadoTarefa = $fila2['estado'];

                    echo "<div class='row'>";
                    echo "<div class='col-lg-4'>";
                    echo '<h2>'.$fila2['titulo'].'</h2>';
                    echo '</div>';

                    echo "<div class='col-lg-4'>";
                    echo "<form id='formulario' action='../html/historialTarefas.html' method='POST'>";
                    echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo "<button type='submit' name = 'btnHistorial' class='btn btn-info historial'>Ver Historial</button>";
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p>'.$fila2['descripcion'].'</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Ultimo Comentario:</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    if ($comentario == null || $comentario == '') {
                        echo '<p>Sin comentario</p>';
                    } else {
                        echo '<p>'.$comentario.'</p>';
                    }
                    echo '</div></div>';

                    echo "<form action='rexistraComentario.php' method='post'>";
                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Estado Actual:</p>';
                    echo "<select name='estado' class='form-control'>";

                    $consulta = 'SELECT * FROM estados_tarefa';
                    $resultado = $conexion->query($consulta);

                    if ($resultado->rowCount() == 0) {
                        echo 'Non se atoparon estados.';
                    } else {
                        $estados = $resultado->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($estados as $est) {
                            $estado = $est['estado'];
                            if ($estadoTarefa == $estado) {
                                echo "<option selected>$estado</option>";
                            } else {
                                echo "<option >$estado</option>";
                            }
                        }
                    }
                    echo '</select>';
                    echo '</div></div>';

                    echo '<p></p>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo '<p class="etiqueta">Engadir comentario:</p>';
                    echo '</div></div>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<textarea name='comentario' class='form-control' id='textAreaComentario' rows='3'></textarea>";
                    echo '</div></div>';

                    echo '<p></p>';

                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<button type='submit' class='btn btn-info'>";
                    echo "<span class='glyphicon glyphicon-log-in'></span> Actualizar Tarefa";
                    echo '</button>';
                    echo '</div></div>';

                    echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo '<input name="usuario" type="hidden" value="'.$usuario.'">';

                    echo '</form>';
                    echo "<div class='row'>";
                    echo "<div class='col-lg-6'>";
                    echo "<div class='line'></div>";
                    echo '</div></div>';

                    ++$i;
                }
            }
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenTarefasFinalizadas($usuario)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT * FROM `tarefas` WHERE `USUARIO_ULTIMO_ESTADO` = '$usuario' AND `ESTADO` = 'FINALIZADA' ";
        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atoparon tarefas finalizadas.';
        } else {
            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datos as $fila) {
                $idTarefa = $fila['ID'];
                $fechaFinalizacion = $fila['FECHA_FINALIZACION'];
                $consulta = "SELECT COMENTARIO FROM comentarios_tarefa WHERE ID_TAREFA like '".$idTarefa."' ORDER BY `fecha` DESC";
                $resultado3 = $conexion->query($consulta);
                $comentario = $resultado3->fetch()[0];

                echo "<div class='row'>";
                echo "<div class='col-lg-4'>";
                echo '<h2>'.$fila['TITULO'].'</h2>';
                echo '</div>';

                echo "<div class='col-lg-4'>";
                echo '<input name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                echo "<button class='btn btn-primary verHistorial' data-toggle='modal' data-target='#myModal' value='$idTarefa'>Ver Historial</button>";

                include '../html/historialTarefas.html';
                echo '</div>';
                echo '</div>';

                echo "<div class = 'row'>";
                echo "<div class='col-lg-4'>";
                echo '<blockquote class="blockquote_User">';
                echo '<small> Fecha fin: '.$fechaFinalizacion.'</small>';
                echo '</blockquote>';
                echo '</div>';
                echo '</div>';

                echo '<p>'.$fila['DESCRIPCION'].'</p>';
                echo '<p>UltimoComentario:</p>';
                echo '<p>'.$comentario.'</p>';
                echo '<p></p>';

                echo "<div class='line'></div>";
            }
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

/**
 * FIN TAREFAS.
 */

/**
 * EQUIPO.
 */
function obtenUsuariosEquipo($login)
{
    try {
        $conexion = conexion();
        $idEquipo = $_SESSION['equipo'];

        $consulta = "SELECT ID_USUARIO FROM usuarios_equipo where ID_EQUIPO like '$idEquipo'";

        $resultado = $conexion->query($consulta);

        $idsUsuario = $resultado->fetchAll();
        echo '<div class="tz-gallery">';
        echo '<div class="row">';

        foreach ($idsUsuario as $id) {
            $consulta = "SELECT * FROM usuarios where ID like '$id[0]'";

            $resultado = $conexion->query($consulta);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC)[0];

            echo '<div class="col-lg-4">';

            $loginImg = 'img_'.$resultado['LOGIN'];
            echo "<a class='lightbox' href='../imgUsuarios/".$resultado['LOGIN']."'>";
            echo "<img src='../imgUsuarios/".$resultado['LOGIN']."' height='150' alt='$loginImg'/>";
            echo '</a>';

            echo '<blockquote class="blockquote_User">';
            $login = $resultado['LOGIN'];
            echo strtoupper($login);
            echo '<small>';
            echo '<br/> <i class="fas fa-envelope"></i>';
            echo $resultado['EMAIL'];
            echo '<br/> <i class="fas fa-calendar"></i>';
            $FECHA = $resultado['FECHA_REXISTRO'];
            echo "$FECHA";

            echo '</small>';
            echo '</blockquote>';

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

        $consulta = "SELECT NOMBRE FROM equipos where ID like '$idEquipo'";

        $resultado = $conexion->query($consulta);

        $idsUsuario = $resultado->fetch()[0];

        return $idsUsuario;
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

/**
 * FIN EQUIPO.
 */

/**
 * DATOS USUARIO.
 */
function compruebaContrasena($pass, $passBD, $user, $idEquipo, $idUsuario)
{
    if (password_verify(
                    base64_encode(
                            hash('sha256', $pass, true)
                    ), $passBD
            )) {
        logearUsuario($user, $idEquipo, $idUsuario);
        header('Location: tarefasAsignadas.php');
    } else {
        header('Location: logueo.php');
    }
}

function logearUsuario($user, $idEquipo, $idUsuario)
{
    session_start();
    session_regenerate_id();
    $_SESSION['login'] = $user;
    $_SESSION['equipo'] = $idEquipo;
    $_SESSION['idUsuario'] = $idUsuario;
}

function obtenerEmail($login)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT email FROM usuarios where login like '$login'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atopou o usuario';
        } else {
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            $email = $datos['email'];

            return $email;
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenerFecha($login)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT FECHA_REXISTRO FROM usuarios where login like '$login'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atopou o usuario';
        } else {
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            $fecha = $datos['FECHA_REXISTRO'];

            return $fecha;
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

function obtenerPass($login)
{
    try {
        $conexion = conexion();

        $consulta = "SELECT pass FROM usuarios where login like '$login'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() == 0) {
            echo 'Non se atopou o usuario';
        } else {
            $datos = $resultado->fetch(PDO::FETCH_ASSOC);

            $email = $datos['pass'];

            return $email;
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}

/*
 * FIN DATOS USUARIO
 */

/*
 * subir_fichero().
 *
 * Sube una imagen al servidor  al directorio especificado teniendo el Atributo 'Name' del campo archivo.
 *
 * @param string $directorio_destino Directorio de destino dónde queremos dejar el archivo
 * @param string $nombre_fichero     Atributo 'Name' del campo archivo
 *
 * @return boolean
 */

/*
function subir_fichero($directorio_destino, $nombre_fichero) {
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name)) {
        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];
        echo 1;
        // Si se trata de una imagen
        if (((strpos($img_type, 'gif') || strpos($img_type, 'jpeg') ||
                strpos($img_type, 'jpg')) || strpos($img_type, 'png'))) {
            //¿Tenemos permisos para subir la imágen?
            echo 2;
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file)) {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}

if (!empty($_POST)) {
    if (subir_fichero('imagenes', 'campofotografia')) {
        echo 'Archivo recibido correctamente';
    }
}
*/
