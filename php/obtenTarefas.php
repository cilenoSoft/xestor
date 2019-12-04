<?php

include 'conexion.php';

function obtenTarefasUsuario($usuario)
{
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
                echo "<div class='row'>";
                echo "<div class='col-lg-6'>";
                echo '<h2>'.$fila['titulo'].'</h2>';
                echo '</div></div>';

                echo "<div class='row'>";
                echo "<div class='col-lg-6'>";
                echo '<p>'.$fila['descripcion'].'<p>';
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

        $consulta = "SELECT id FROM usuarios where login like '$usuario'";
        $resultado = $conexion->query($consulta);
        $idUsuario = $resultado->fetch()[0];

        $consulta = "SELECT idTarefa FROM tarefas_asignadas WHERE idUsuario like '$idUsuario'";
        $resultado = $conexion->query($consulta);
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

                foreach ($datos2 as $fila2) {
                    $estadoTarefa = $fila2['estado'];

                    echo "<div class='row'>";
                    echo "<div class='col-lg-4'>";
                    echo '<h2>'.$fila2['titulo'].'</h2>';
                    echo '</div>';

                    echo "<div class='col-lg-4'>";
                    echo "<form id='formulario' action='../html/historialTarefas.html' method='POST'>";
                    echo '<input id="idTarefa" name="idTarefa" type="hidden" value="'.$idTarefa.'">';
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
                    echo '<p class="etiqueta">Estado Actual:<label></p>';
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
                    echo '<p class="etiqueta">Engadir comentario:<label></p>';
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

                    echo '<input id="idTarefa" name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo '<input id="usuario" name="usuario" type="hidden" value="'.$usuario.'">';

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
        echo '<input id="idTarefa" name="idTarefa" type="hidden" value="'.$idTarefa.'">';
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
                    echo '<input id="idTarefa" name="idTarefa" type="hidden" value="'.$idTarefa.'">';
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
                    echo '<p class="etiqueta">Estado Actual:<label></p>';
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
                    echo '<p class="etiqueta">Engadir comentario:<label></p>';
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

                    echo '<input id="idTarefa" name="idTarefa" type="hidden" value="'.$idTarefa.'">';
                    echo '<input id="usuario" name="usuario" type="hidden" value="'.$usuario.'">';

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

        $consulta = "SELECT * FROM `usuarios`.`tarefas` WHERE `usuarioUltimoEstado` = '$usuario' AND `estado` = 'FINALIZADA' ";
        $resultado2 = $conexion->query($consulta);
        $datos2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datos2 as $fila2) {
            $idTarefa = $fila2['idTarefa'];
            $consulta = "SELECT comentario FROM comentarios_tarefa WHERE idTarefa like '".$idTarefa."' ORDER BY `fecha` DESC";
            $resultado3 = $conexion->query($consulta);
            $comentario = $resultado3->fetch()[0];

            echo '<h2>'.$fila2['titulo'].'</h2>';
            echo '<p>'.$fila2['descripcion'].'</p>';
            echo '<p>UltimoComentario:</p>';
            echo '<p>'.$comentario.'</p>';
            echo '<p></p>';
            echo "<div class='line'></div>";
        }
    } catch (PDOException $e) {
        echo 'Error conectando coa base de datos: '.$e->getMessage();
    }
}
