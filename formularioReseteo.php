<!doctype html>
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/xestor.css">
        <title>Xestor</title>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center minh-80">
                <div class="col-lg-7">
                    <!-- form start -->
                    <form role="form" id="register-form" action="reseteaContraseña.php" method="POST">

                        <div class="form-header">
                            <h3 class="form-title"><i class="fa fa-user"></i>Reseteo de Contraseña</h3>

                            <div class="pull-right">
                                <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
                            </div>

                        </div>

                        <div class="form-body">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input name="login" type="text" class="form-control" placeholder="Username">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                    <input id="emailReseteo" name="email" type="text" class="form-control" placeholder="Email">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>

                            <div class="row">

                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-info">
                                    <span class="glyphicon glyphicon-log-in"></span>Enviar
                                </button>
                            </div>


                    </form>

                </div>
            </div>
        </div>


        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/jquery-1.11.2.min.js"></script>
        <script src="assets/jquery.validate.min.js"></script>
        <!-- javascript/jquery validations will be here  -->

    </body>
</html>