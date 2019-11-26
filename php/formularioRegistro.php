<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf8">
        <title>XestorGal</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/xestor.css">
        <link type="text/css" rel="stylesheet" href="../css/style2.css" >
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <script src="../js/formulario.js"></script>

    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center minh-80">

                <form class="form-horizontal" id="formulario" action="registraUsuario.php" method="POST">
                    <div class="control-group">
                        <h2>Registrate!</h2>
                        <label class="control-label" for="inputName">Login :</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="login" placeholder="Login">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email :</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="email" placeholder="aaaa@gmail.com">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>

                    <div class="row">

                        <div class="form-group col-lg-6">
                            <div class="control-group">
                                <label class="control-label" for="inputPass">Contrasinal :</label>
                                <div class="controls">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="******">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <div class="control-group">
                                <label class="control-label" for="inputCPass">Repita o contrasinal :</label>
                                <div class="controls">
                                    <input type="password" class="form-control" name="cpassword" placeholder="******">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    </div>

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