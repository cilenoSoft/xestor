<?php

include 'conexion.php';
function insertaUsuario($login, $pass, $email, $cPass)
{
    if ($pass == $cPass) {
        $conexion = conexion();

        $consulta = "SELECT * FROM usuarios where email like '$email'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() > 0) {
            echo 'El email ya existe.';
        } else {
            $consulta = "SELECT * FROM usuarios where login like '$login'";

            $resultado = $conexion->query($consulta);

            if ($resultado->rowCount() > 0) {
                echo 'El login ya existe.';
            } else {
                $passEnc = password_hash(
                base64_encode(
                        hash('sha256', $pass, true)
                ), PASSWORD_DEFAULT
                );

                $consulta = "INSERT INTO usuarios (`login`, `pass`,`email`) VALUES ('$login', '$passEnc','$email')";

                //realizamos la consulta y obtenemos los resultados
                $resultado = $conexion->query($consulta);

                if ($resultado) {
                    echo 'El usuario fué registrado correctamente, ya puede iniciar sesión.';
                } else {
                    echo 'Error al registrar, intentelo de nuevo.';
                }
            }
        }
    } else {
        echo 'La contraseña no coincide.';
    }
}

$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cPass = $_POST['cpassword'];
insertaUsuario($login, $pass, $email, $cPass);
