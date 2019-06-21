<?php

// Dirección o IP del servidor MySQL
$host = "localhost";

// Puerto del servidor MySQL
$puerto = "3306";

// Nombre de usuario del servidor MySQL
$usuario = "root";

// Contraseña del usuario
$contrasena = "";

// Nombre de la base de datos
$baseDeDatos = "tickets";

// Nombre de la tabla a trabajar
// $tabla = "personas";

//Activar para mostrar mensajes
$debug = 0;

function Conectarse($tabla)
{
    global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla, $debug;

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
