<!doctype html>
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <title>Xestor</title>
    </head>

    <body>

        <div class="container">

            <div class="signup-form-container">

                <!-- form start -->
                <form role="form" id="register-form" action="registraUsuario.php" method="POST">

                    <div class="form-header">
                        <h3 class="form-title"><i class="fa fa-user"></i> Sign Up</h3>

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
                                <input name="email" type="text" class="form-control" placeholder="Email">
                            </div> 
                            <span class="help-block" id="error"></span>                     
                        </div>

                        <div class="row">

                            <div class="form-group col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                                </div>  
                                <span class="help-block" id="error"></span>                    
                            </div>

                            <div class="form-group col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                    <input name="cpassword" type="password" class="form-control" placeholder="Retype Password">
                                </div>  
                                <span class="help-block" id="error"></span>                    
                            </div>

                        </div>


                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-info">
                            <span class="glyphicon glyphicon-log-in"></span> Registrame !
                        </button>
                    </div>


                </form>

            </div>

        </div>


<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="assets/jquery-1.11.2.min.js"></script>
<script src="assets/jquery.validate.min.js"></script>
<!-- javascript/jquery validations will be here  -->

</body>
</html>