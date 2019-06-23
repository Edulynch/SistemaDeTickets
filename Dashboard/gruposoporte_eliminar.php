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

$link = Conectarse('usuarios');

$id = limpiar($_GET['id']);

$query = "SELECT 
                gsoporte_id
            FROM 
                tickets.gruposoporte
            WHERE 
                gsoporte_id = " . $id . "
            LIMIT 1;";

$gsoporte = mysqli_query($link, $query);

$row = $gsoporte->fetch_assoc();

// echo $gsoporte->num_rows;

if (limpiar($row['gsoporte_id']) == $id && isset($row['gsoporte_id']) && !empty($row['gsoporte_id']) && $gsoporte->num_rows > 0) {
    $query_borrar = "DELETE FROM 
                        tickets.gruposoporte
                    WHERE 
                        gsoporte_id = " . $id . ";";

    $gsoporte_borrar = mysqli_query($link, $query_borrar);
    header("Location: http://softicket.cl/Dashboard/gruposoporte_administrar.php");
}
