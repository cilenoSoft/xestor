<?php

session_start();

//Tamaño e Formatos permitidos
if ((($_FILES['file']['type'] == 'image/gif') || ($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/jpg') || ($_FILES['file']['type'] == 'image/JPG') || ($_FILES['file']['type'] == 'image/png') || ($_FILES['file']['type'] == 'image/pjpeg'))
) { //Manexo do erro en caso de arquivo non valido
    if ($_FILES['file']['error'] > 0) {
        echo 'Return Code: '.$_FILES['file']['error'].'';
    } else {
        //Mostra a información do arquivo subido
        echo 'Upload: '.$_FILES['file']['name'].'';

        //Verifica se o arquivo existe
        $ruta = '../../imgUsuarios/'; //ruta carpeta donde queremos copiar a imaxe

        $login = $_SESSION['login'];
        $extension = '.'.str_replace('image/', '', $_FILES['file']['type']);

        //copiamos a imaxe sobreescribindo no caso de que xa exista unha imaxe co mesmo nome de usuario
        move_uploaded_file($_FILES['file']['tmp_name'], $ruta.$login.$extension);

        echo '<p>Almacenado en: '.$ruta.$login.$extension.'</p>';

        $nombreArchivo = $ruta.$login;

        // mostra a imaxe subida
        echo "<img src='$nombreArchivo'  width='200' />";

        //volve a páxina anterior
        header('Refresh: 2; URL=conta.php');
    }
} else {
    echo '<br>';
    echo '<p>Arquivo inválido, so se permiten arquivos en formato GIF, JPG e PNG.';
    echo '<p>Volvendo á páxina anterior...</p>';
    header('Refresh: 3; URL=conta.php');
}
