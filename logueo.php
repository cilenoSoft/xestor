<?php
session_start();
?>

<!doctype html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
              shrink-to-fit=no">
        <title>XestorGal</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/xestor.css">
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/formulario.js"></script>
    </head>

    <body>
        <style>
            body {
                background-image: url("img/background_team.jpg");
                background-image: no-repeat;
                background-image: fixed;
                background-image: center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
        <div id="principal" class="row justify-content-center align-items-center">
            <div id="logueo" class="row justify-content-center align-items-center minh-80">
                <div id="contenedor">
                    <form id="formulario" action="php/usuarios.php" method="post">
                        <h3 id="xestorGal">XestorGAL</h3>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input name="login" type="text" class="form-control" placeholder="Username">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                <input name="password" class="form-control" type="password" placeholder="******">
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="enviar" value="enviar" class="btn btn-info">
                                    <span class="glyphicon glyphicon-log-in"></span> Entrar
                                </button>
                            </div>
                        </div>

                        <div id="pieLogueo" class="row">
                            <div class="col-md-7 pieLogueo"><a href="php/formularioReseteo.php">Contrasinal olvidado</a></div>
                            <div class="col-md-5 pieLogueo"><a href="php/formularioRegistro.php">Rexístrate</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>