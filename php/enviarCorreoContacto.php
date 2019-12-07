<?php

include 'funcions.php';
include 'mailer.php';
session_start();

function enviaCorreo($email, $login, $asunto, $contido)
{
    if (enviaCorreoContacto($email, $login, $asunto, $contido)) {
        echo 'Enviouse o correo correctamente.';
        sleep(2);
        header('Location: paxinaContacto.php');
    } else {
        echo 'Non se puido enviar o correo, intenteo de novo.';
    }
}

$login = $_SESSION['login'];
$email = obtenerEmail($login);
$asunto = $_POST['asunto'];
$contido = $_POST['contido'];
enviaCorreo($email, $login, $asunto, $contido);
