<?php

include 'funcions.php';

function insertaUsuario($login, $pass, $email, $cPass, $rol)
{
    // Comprobación de que os contrasinais introducidos son correctos (validado tamén con jquery)
    if ($pass == $cPass) {
        //establecemos conexion coa bd
        $conexion = conexion();
        //declaramos a consulta para ver se o usuario xa existe
        $consulta = "SELECT * FROM usuarios WHERE EMAIL LIKE '$email' OR LOGIN LIKE '$login'";
        //realizamos a consulta
        $resultado = $conexion->query($consulta);
        if ($resultado->rowCount() > 0) {
            //en caso de que xa exista a dirección de correo ou o login non se permite rexistrar o usuario.
            echo 'O correo xa existe.';
        } else {
            //encriptamos o contrasinal introducido para insertalo na bd
            $passEnc = password_hash(
                    base64_encode(
                            hash('sha256', $pass, true)
                    ), PASSWORD_DEFAULT
            );
            try {
                date_default_timezone_set('Europe/Madrid');
                $fecha = 'Y-m-d H:i:s';
                $fechaActual = date($fecha);
                $consulta = "INSERT INTO `usuarios` (`LOGIN`, `PASS`,`EMAIL`,`ID_EQUIPO`,`ROL`,`FECHA_REXISTRO`) VALUES ('$login', '$passEnc','$email','0','$rol','$fechaActual')";
                $resultado = $conexion->query($consulta);
            } catch (PDOException $Exception) {
                // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
                // String.
                echo $Exception->getMessage();
            }
            if ($resultado) {
                sleep(2);
                header('Refresh: 3; URL=index.html');
                echo 'O usuario foi rexistrado correctamente, xa pode iniciar sesión.';
            } else {
                echo 'Erro ó rexistrar, intenteo de novo.';
            }
        }
    } else {
        echo 'O contrasinal non coincide.';
    }
}

$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cPass = $_POST['cpassword'];
$rol = $_POST['rol'];
insertaUsuario($login, $pass, $email, $cPass, $rol);
