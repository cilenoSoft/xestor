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

        <div class="container">


            <form class="form-horizontal" id="formulario" action="enviarCorreoContacto.php" method="POST">
                <div class="control-group">
                    <h3>Contáctanos !</h3>
                    <label class="control-label" for="inputName">Asunto :</label>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <input type="text" class="form-control" name="asunto" placeholder="Asunto">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <p></p>
                <div class="control-group">
                    <label class="control-label" >Mensaxe :</label>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <textarea name='contido' class='form-control textAreaComentario' rows='3'></textarea>
                        </div>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <br>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-info">Enviar</button>
                    </div>
                </div>
            </form>
        </div>

    </body>

</html>