<?php

function comprobaSesion()
{
    if (!isset($_SESSION['login'])) {
        header('Location: sesionNonIniciada.php');
    }
}
