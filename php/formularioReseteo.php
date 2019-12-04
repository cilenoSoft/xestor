<!doctype html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/xestor.css">
        <link type="text/css" rel="stylesheet" href="../css/style2.css" >
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <script src="../js/formulario.js"></script>
        <title>XestorGal</title>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center minh-80">

                <form class="form-horizontal" id="formulario" action="reseteaContraseña.php" method="POST">
                    <div class="control-group">
                        <h3>Introduce os datos para resetear o contrasinal!</h3>
                        <label class="control-label" for="inputName">Login :</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="login" placeholder="Login">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email :</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="email" placeholder="Email">
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

        </div>
    </body>

</html>