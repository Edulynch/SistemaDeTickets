<?php

function Conectarse()
{
    $host = DB_HOST;
    $puerto = DB_PORT;
    $usuario = DB_USER;
    $contrasena = DB_PASSWORD;
    $baseDeDatos = DB_NAME;
    $debug = DB_DEBUG;

    if (!($link = mysqli_connect($host . ":" . $puerto, $usuario, $contrasena))) {
        if ($debug == 1) {
            echo "Error conectando a la base de datos.<br>";
        }
        exit();
    } else {
        if ($debug == 1) {
            echo "Listo, estamos conectados.<br>";
        }
    }
    if (!mysqli_select_db($link, $baseDeDatos)) {
        if ($debug == 1) {
            echo "Error seleccionando la base de datos.<br>";
        }
        exit();
    } else {
        if ($debug == 1) {
            echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
        }
    }

    //añadir tildes y ñ
    mysqli_set_charset($link, "utf8");

    return $link;
}
