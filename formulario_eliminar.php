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

include_once './config.php';
include_once './conexion.php';

$link = Conectarse();

$id = limpiar($_GET['id']);

$query = "SELECT 
                ticket_id
            FROM 
                tickets.ticket
            WHERE 
                ticket_id = " . $id . "
            LIMIT 1;";

$gsoporte = mysqli_query($link, $query);

$row = $gsoporte->fetch_assoc();

// echo $gsoporte->num_rows;

if (limpiar($row['ticket_id']) == $id && isset($row['ticket_id']) && !empty($row['ticket_id']) && $gsoporte->num_rows > 0) {
    $query_borrar = "DELETE FROM 
                        tickets.ticket
                    WHERE 
                        ticket_id = " . $id . ";";

    $gsoporte_borrar = mysqli_query($link, $query_borrar);
    header("Location: http://softicket.cl/dashboard/tickets_administrar.php");
}
