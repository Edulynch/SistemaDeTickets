<?php

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
    || empty($_GET['id'])
    || !isset($_GET['id'])
    || $_COOKIE['priv_id'] != 1 //Administrador
) {
    header("Location: http://softicket.cl");
}

include_once '../config.php';
include_once '../conexion.php';

$link = Conectarse();

$id = limpiar($_GET['id']);

$query = "SELECT 
                user_id
            FROM 
                tickets.usuarios
            WHERE 
                user_id = " . $id . "
            LIMIT 1;";

$gsoporte = mysqli_query($link, $query);

$row = $gsoporte->fetch_assoc();

// echo $gsoporte->num_rows;

if (limpiar($row['user_id']) == $id && isset($row['user_id']) && !empty($row['user_id']) && $gsoporte->num_rows > 0) {
    $query_borrar = "DELETE FROM 
                        tickets.usuarios
                    WHERE 
                        user_id = " . $id . ";";

    $gsoporte_borrar = mysqli_query($link, $query_borrar);
    header("Location: http://softicket.cl/dashboard/usuarios_administrar.php");
}
