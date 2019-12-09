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

        <!-- CSS-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/xestor.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    

        <!-- JS -->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/formulario.js"></script>

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    </head>

    <body class="logueo">

        <div id="principal" class="row justify-content-center align-items-center">
            <div id="logueo" class="row justify-content-center align-items-center minh-80">
                <div id="contenedor">

                    <form id="formulario" action="php/usuarios.php" method="post">

                        <h3 id="xestorGal">XestorGAL</h3>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group-addon"><span class="fas fa-user"></span></div>
                                <input name="login" type="text" class="form-control" placeholder="Username">
                            </div>
                            <span class="help-block"></span>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group-addon"><span class="fas fa-lock"></span></div>
                                <input name="password" class="form-control" type="password" placeholder="******">
                            </div>
                            <span class="help-block"></span>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="enviar" value="enviar" class="btn btn-info">
                                    <span class="glyphicon glyphicon-log-in"></span> Entrar
                                </button>
                            </div>
                        </div>

                        <div id="pieLogueo" class="row">
                            <!-- Formulario para o reseteo de contrasinal -->
                            <div class="col-md-7 pieLogueo"><a href="html/formularioReseteo.html">Contrasinal olvidado</a></div>
                            <!-- Formulario para o rexistro de usuarios -->
                            <div class="col-md-5 pieLogueo"><a href="html/formularioRexistro.html">Rexístrate</a></div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>

</html>