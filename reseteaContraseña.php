<?php

include 'conexion.php';
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
    //obtenemos el login del usuario para verificar que coincide
    $consulta = "SELECT login FROM usuarios where email like '$email'";
    $resultado = $conexion->query($consulta);
    if ($resultado->rowCount() == 0) {
        echo 'No se ha encontrado ningun usuario con el email indicado.';
    } else {
        $resultado = $conexion->query($consulta);

        $loginUsuario = $resultado->fetch()[0];
        // si el login del usuario coincide se genera una contraseña aleatoria
        if ($loginUsuario == $login) {
            $pass = generaPassAleatorio();

            $passEnc = password_hash(
                base64_encode(
                        hash('sha256', $pass, true)
                ), PASSWORD_DEFAULT
        );
            //actualizamos la contraseña con la generada automaticamente
            $consulta = "UPDATE usuarios SET pass = '$passEnc' WHERE email = '$email'";

            $resultado = $conexion->query($consulta);
            //enviamos por correo la contraseña al usuario
            if (enviaCorreoReseteoPassword($email, $pass)) {
                echo 'Se ha enviado un correo electronico con la nueva contraseña.';
                sleep(2);
                header('Location: logueo.php');
            } else {
                echo 'No se ha podido enviar el correo.';
            }
        } else {
            echo 'Login incorrecto.';
        }
    }
}

$login = $_POST['login'];
$email = $_POST['email'];

cambiaContraseña($email, $login);
