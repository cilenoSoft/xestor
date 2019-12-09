<?php
session_start();

include 'funcions.php';
comprobaSesion();

?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>XestorGal</title>
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="../css/xestor.css">
        <link type="text/css" rel="stylesheet" href="../css/style4.css" >

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <!-- JS -->
        <script src="../js/miJs.js"></script>

        <!-- jQuery AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        </script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script>

    </head>
    <body>

<div id= "alerta"></div>

        <?php
        include 'navBar.php';
        $nombreEquipo = obtenNombreEquipo($_SESSION['equipo']);
        echo'<h1>'.$nombreEquipo.'</h1>';
        echo '<p></p>';
        $login = $_SESSION['login'];
        obtenUsuariosEquipo($login);
        ?>
        <p></p>
        <form id="register-form" action="engadirUsuarioEquipo.php" method="POST">

            <div class="form-body">

                <div class='form-group' id= 'selectUsuarios'>
                    <?php
                    $conexion = conexion();
                    $consulta = 'SELECT * FROM usuarios WHERE ID_EQUIPO is NULL';
                    $resultado = $conexion->query($consulta);

                    if ($resultado->rowCount() == 0) {
                        echo "<div class='row'>";
                        echo "<div class='col-3'>";
                        echo '<label>Engadir Membro:</label>';
                        echo "<select name='usuario_1' id='usuario1' class='form-control'>";
                        echo '<option>Non se atoparon usuarios sen equipo.</option>';
                        echo '</select>';
                        echo "<span class='help-block' id='error'></span>";
                        echo '</div>';
                        echo '</div>';

                        echo "<div class='form-footer'>";
                        echo "<button type='submit' class='btn btn-info' disabled>";
                        echo 'Engadir membro';
                        echo '</button>';
                        echo '</div>';
                    } else {
                        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        echo "<div class='row'>";
                        echo "<div class='col-3'>";
                        echo '<label>Engadir Membro:</label>';
                        echo "<select name='usuario_1' id='usuario1' class='form-control'>";

                        foreach ($datos as $fila) {
                            $usuario = $fila['LOGIN'];
                            echo "<option>$usuario</option>";
                        }
                        echo '</select>';
                        echo "<span class='help-block' id='error'></span>";
                        echo '</div>';
                        echo '</div>';
                        echo "<div class='form-footer'>";
                        echo "<button type='submit' class='btn btn-info'>";
                        echo 'Engadir membro';
                        echo '</button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        </form>

        <!-- Cierre NavBar -->
    </div>  
</div>
<!-- Fin Cierre NavBar -->


<script>
    sideVarCollapse();
    modalAsignarTarefas();
</script>
</body>

</html>