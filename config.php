<?php

/**************************************
 *** CONFIGURACION DE LA PAGINA WEB ***
 **************************************/

// Enlace de la Pagina Web
const SITIO_WEB = "http://softicket.cl";

// PERFIL
const SITIO_WEB_PERFIL = "http://softicket.cl/perfil";

// Dashboard
const SITIO_WEB_DASHBOARD = "http://softicket.cl/dashboard";

// Bandeja
const SITIO_WEB_BANDEJA = "http://softicket.cl/bandeja";

// Prefijo de los tickets
const PREFIJO_ORDEN_TRABAJO = "OT-";

/*****************************************
 *** CONFIGURACION DE LA BASE DE DATOS ***
 *****************************************/

// Dirección o IP del servidor MySQL
const DB_HOST = "localhost";

// Puerto del servidor MySQL
const DB_PORT = "3306";

// Nombre de usuario del servidor MySQL
const DB_USER = "root";

// Contraseña de usuario del servidor MySQL
const DB_PASSWORD = "";

// Nombre de la base de datos del servidor MySQL
const DB_NAME = "tickets";

// Activar para mostrar mensajes (1:Activado / 0:Desactivado)
const DB_DEBUG = 0;

/******************************
 *** FUNCIONES DEL SITIO WEB ***
 ******************************/

// Funcion para Limpiar Datos (evitar inyecciones web)
function limpiar($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
