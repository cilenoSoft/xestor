<?php

include 'funcions.php';
include 'mailer.php';

function generaPassAleatorio()
{
    $logitud = 8;
    $psswd = substr(md5(microtime()), 1, $logitud);

    return $psswd;
}

function cambiaContraseña($email, $login)
{
    $conexion = conexion();

    $consulta = "SELECT LOGIN FROM usuarios WHERE EMAIL LIKE '$email'";
    $resultado = $conexion->query($consulta);
    if ($resultado->rowCount() == 0) {
        echo 'Nos se atopou ningun usuario co correo indicado.';
    } else {
        $resultado = $conexion->query($consulta);

        $loginUsuario = $resultado->fetch()[0];

        if ($loginUsuario == $login) {
            $pass = generaPassAleatorio();

            $passEnc = password_hash(
                    base64_encode(
                            hash('sha256', $pass, true)
                    ), PASSWORD_DEFAULT
            );

            $consulta = "UPDATE usuarios SET pass = '$passEnc' WHERE email = '$email'";

            $resultado = $conexion->query($consulta);

            if (enviaCorreoReseteoPassword($email, $pass)) {
                echo '<script type="text/javascript">
                    alert("Enviouse un correo co novo contrasinal.");
                    </script>';
                header('Location: ../index.html');
            } else {
                echo 'Non se puido enviar o correo, intenteo de novo.';
            }
        } else {
            echo 'Login incorrecto.';
        }
    }
}

$login = $_POST['login'];
$email = $_POST['email'];

cambiaContraseña($email, $login);
