<?php

include 'funcions.php';

function insertaUsuario($login, $pass, $email, $cPass, $rol)
{
    if ($pass == $cPass) {
        $conexion = conexion();

        $consulta = "SELECT * FROM usuarios where EMAIL like '$email'";

        $resultado = $conexion->query($consulta);

        if ($resultado->rowCount() > 0) {
            echo 'O correo xa existe.';
        } else {
            $consulta = "SELECT * FROM usuarios where LOGIN like '$login'";

            $resultado = $conexion->query($consulta);

            if ($resultado->rowCount() > 0) {
                echo 'O login xa existe.';
            } else {
                $passEnc = password_hash(
                        base64_encode(
                                hash('sha256', $pass, true)
                        ), PASSWORD_DEFAULT
                );
                try {
                    echo '</br>';
                    echo $login;
                    echo '</br>';
                    echo $passEnc;
                    echo '</br>';
                    echo $email;
                    echo '</br>';
                    echo $rol;
                    echo '</br>';

                    $consulta = "INSERT INTO `usuarios` (`LOGIN`, `PASS`,`EMAIL`,`ID_EQUIPO`,`ROL`) VALUES ('$login', '$passEnc','$email',0,'$rol')";

                    $resultado = $conexion->query($consulta);
                } catch (PDOException $Exception) {
                    // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
                    // String.
                    echo $Exception->getMessage();
                }
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
$rol = $_POST['rol'];
echo $rol;
insertaUsuario($login, $pass, $email, $cPass, $rol);
