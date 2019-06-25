<?php

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
    || empty($_GET['id'])
    || !isset($_GET['id'])
    || empty($_GET['user'])
    || !isset($_GET['user'])
    || $_COOKIE['priv_id'] != 1 //Administrador
) {
    header("Location: http://softicket.cl");
}

include_once '../config.php';
include_once '../conexion.php';

$link = Conectarse('usuarios');

$id = limpiar($_GET['id']);
$user = limpiar($_GET['user']);

$query = "SELECT 
                gsoporte_id, user_id
            FROM 
                tickets.gruposoporte_usuarios
            WHERE 
            gsoporte_id = " . $id . "
            LIMIT 1;";

$gsoporte = mysqli_query($link, $query);

// echo $query;

$row = $gsoporte->fetch_assoc();

if (
    limpiar($row['gsoporte_id']) == $id &&
    isset($row['gsoporte_id']) && 
    !empty($row['gsoporte_id']) ||
    limpiar($row['user_id']) == $user && 
    isset($row['user_id']) && 
    !empty($row['user_id']) &&
    $gsoporte->num_rows > 0
) {
    $query_borrar = "DELETE FROM 
                        tickets.gruposoporte_usuarios
                    WHERE 
                        gsoporte_id = " . $id . "
                    AND 
                        user_id = " . $user . ";";

    $gsoporte_borrar = mysqli_query($link, $query_borrar);
    header("Location: http://softicket.cl/Dashboard/gruposoporte_editar.php?id=" . $id);
}

?>