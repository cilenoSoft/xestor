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
            <div class="row">
                <div class="col-lg-5">
                    <?php
                    echo '<h1>' . strtoupper($login) . '</h1>';
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12">
                    <?php
                    $ruta = '../imgUsuarios/' . $login;
                    echo "<img src='$ruta' class='img-rounded img-responsive' alt='$loginImg' width='450'/>";
                    ?>
                </div>
                <div class="col-xl-5 col-lg-12 col-md-12">
                    <blockquote class="blockquote_User">
                        <?php
                        $login = $_SESSION['login'];
                        echo '<p>' . strtoupper($login) . '</p>';
                        ?> 
                    </blockquote>
                    <p> <i class="fas fa-envelope"></i> 
                        <?php
                        $email = obtenerEmail($_SESSION['login']);
                        echo "$email";
                        ?>
                        <br/>
                        <br/> <i class="fas fa-calendar"></i> 
                        <?php
                        $FECHA = obtenerFecha($_SESSION['login']);
                        echo "$FECHA";
                        ?>
                    </p>
                    <small>                                   
                        <a class ="enlace" href="formularioCambiaPass.php">Mudar Contrasinal</a>                           
                    </small>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <p></p>
            <p></p>
            <form action='cargar.php' method='post' enctype='multipart/form-data'>
                <div class="row">
                    <div class="col-5">
                        <small>Elixa unha imaxe para mudar a foto de perfil:</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 upload">
                        <input type='file' id='fileUpload' class="btn btn-info" name='file' />
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-5">
                        <input type='submit' class="btn btn-info" name='submit' value='Enviar' />
                    </div>
                </div>

            </form>
        </div>
        <!-- Cierre NavBar -->
    </div>  
</div>
<!-- Fin Cierre NavBar -->
<script>
    sideVarCollapse();
</script>
</body>

</html>