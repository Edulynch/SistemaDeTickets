<?php

const PREFIJO_ORDEN_TRABAJO = "OT-";


function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
