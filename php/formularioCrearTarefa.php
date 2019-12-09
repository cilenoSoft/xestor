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

        <?php
        include 'navBar.php';
        ?>

        <div>
            <div class="row">
                <div class="col-lg-5">
                    <h1>Crear Tarefa</h1>
                </div>
            </div>
        </div>

        <div id= "alerta"><div> 

        <form id="tarefa-form" onsubmit="return false" action="return false">   
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label>Titulo</label>
                        <input name="titulo" id= "titulo" type="text" class="form-control">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-5">
                        <label id="selectUsuarios">Asignar a usuario</label>

                        <select name="usuario" id ="usuario" class="form-control">

                            <?php
                            $conexion = conexion();
                            $equipo = $_SESSION['equipo'];
                            $consulta = "SELECT * FROM usuarios where ID_EQUIPO like '$equipo'";
                            $resultado = $conexion->query($consulta);

                            if ($resultado->rowCount() == 0) {
                                echo 'No se ha encontrado usuarios';
                                echo '<option>NA</option>';
                            } else {
                                $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                echo '<option selected>NA</option>';
                                foreach ($datos as $fila) {
                                    $usuario = $fila['LOGIN'];
                                    echo "<option>$usuario</option>";
                                }
                            }
                            ?>
                        </select>

                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-5">
                        <label>Descripción</label>
                        <textarea name='descripcion' id='descripcion' class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-footer col-lg-5">
                        <button class="btn btn-info crearTarefa" onclick="creaTarefa();"> Crear Tarefa </button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Cierre NavBar -->
    </div>  
</div>
<!-- Fin Cierre NavBar -->
<script>
    sideVarCollapse()
</script>
</body>

</html>