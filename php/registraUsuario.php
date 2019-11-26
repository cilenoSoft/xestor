<?php

include 'conexion.php';

function insertaUsuario($login, $pass, $email, $cPass) {
    if ($pass == $cPass) {
        $conexion = conexion();

        $consulta = "SELECT * FROM usuarios where email like '$email'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() > 0) {
            echo 'O correo xa existe.';
        } else {
            $consulta = "SELECT * FROM usuarios where login like '$login'";

            $resultado = $conexion->query($consulta);

            if ($resultado->rowCount() > 0) {
                echo 'O login xa existe.';
            } else {
                $passEnc = password_hash(
                        base64_encode(
                                hash('sha256', $pass, true)
                        ), PASSWORD_DEFAULT
                );

                $consulta = "INSERT INTO usuarios (`login`, `pass`,`email`) VALUES ('$login', '$passEnc','$email')";

                $resultado = $conexion->query($consulta);

                if ($resultado) {
                    echo 'O usuario foi rexistrado correctamente, xa pode iniciar sesión.';
                } else {
                    echo 'Erro ó rexistrar, intenteo de novo.';
                }
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
insertaUsuario($login, $pass, $email, $cPass);
