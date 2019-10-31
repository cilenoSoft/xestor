<?php
session_start();
?>

<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
              shrink-to-fit=no">
        <meta name="author" content="Parzibyte">
        <title>Xestor</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <main role="main" class="container my-auto">
            <div class="row">
                <div id="logueo" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
                     col-12">
                    <h2 class="text-center">Xestor Online</h2>
                    <img class="img-fluid mx-auto d-block rounded"
                         src="https://picsum.photos/id/870/300/200" />

                    <form action="usuarios.php" method="post">
                        <div class="form-group">
                            <label for="usuario">Correo</label>
                            <input id="login" name="login"
                                   class="form-control" type="email"
                                   placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="palabraSecreta">Contraseña</label>
                            <input id="pass" name="pass"
                                   class="form-control" type="password"
                                   placeholder="Contraseña">
                        </div>
                        <div class="form-footer">
                        <button type="submit" name ="enviar" value = "enviar" class="btn btn-info">
                            <span class="glyphicon glyphicon-log-in"></span> Entrar
                        </button>
                    </div>
          
                        <div id="pieLogueo" class="row">
                            <div class="col-md-7"><a href="formularioReseteo.php">Contraseña olvidada</a></div>
                            <div class="col-md-5"><a href="formularioRegistro.php">Registrate</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>