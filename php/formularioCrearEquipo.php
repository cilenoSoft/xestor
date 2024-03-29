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
                <div class="col-lg-6">
                    <h1>Crear Equipo</h1>
                </div>
            </div>
        </div>

        <form id="equipo-form" action="crearEquipo.php" method="POST">

            <div class="form-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="nombreEquipo">Nombre</label>
                        <input id="nombreEquipo" name="nombreEquipo" type="text" class="form-control">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Numero de membros</label>
                        <input id="numMembros" name="numeroMembros" type="text" class="form-control">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="row">
                    <div class='form-group col-lg-6' id= 'selectUsuarios'>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <button type="submit" id = "botonCrearEquipo" class="btn btn-info" disabled>
                            <span class="glyphicon glyphicon-log-in"></span> Crear Equipo
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</div>
<!-- Fin Cierre NavBar -->


<script>
    sideVarCollapse();
    creaSelect();
</script>

</body>

</html>