<?php
session_start();

include 'comprobaSesionIniciada.php';
comprobaSesion();

?>
<!DOCTYPE html>
<html>

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

    </head>

    <body>

        <?php
        include '../html/navBar.html';
        ?>

        <h1>Crear Equipo</h1>

        <form role="form" id="register-form" action="crearEquipo.php" method="POST">

            <div class="form-body">

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Nombre</label>
                    <input name="nombre" type="text" class="form-control">
                    <span class="help-block" id="error"></span>
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Engadir membro</label>

                    <select name="usuario" class="form-control">

                        <?php
                        include 'conexion.php';
                        $conexion = conexion();

                        $consulta = 'SELECT * FROM usuarios';
                        $resultado = $conexion->query($consulta);

                        if ($resultado->rowCount() == 0) {
                            echo 'No se ha encontrado usuarios';
                        } else {
                            $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($datos as $fila) {
                                $usuario = $fila['login'];
                                echo "<option>$usuario</option>";
                            }
                        }
                        ?>
                    </select>

                    <span class="help-block" id="error"></span>
                </div>

                <!--
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripción</label>
                    <textarea name='descripcion' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
                    -->
            <div class="form-footer">
                <button type="submit" class="btn btn-info">
                    <span class="glyphicon glyphicon-log-in"></span> Crear Equipo
                </button>
            </div>
        </form>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>