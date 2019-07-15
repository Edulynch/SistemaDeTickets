<?php

include_once '../config.php';

//?archivo=""
$file = $_POST['archivo'];

// output headers so that the file is downloaded rather than displayed
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=' . $file);
echo "\xEF\xBB\xBF"; // UTF-8 BOM

include '../conexion.php';

$link = Conectarse();

//?tipo_reporteria=""
$tipo_reporteria = $_POST['tipo_reporteria'];

$querySelect = $_POST['querySelect'];

if ($tipo_reporteria == "usuario") {
    $cabecera = array(
        'ID_USUARIO',
        'NOMBRE_USUARIO',
        'CORREO_USUARIO',
        'EMPRESA_USUARIO',
        'DIRECCION_USUARIO',
        'TELEFONO_USUARIO',
        'CARGO_USUARIO',
        'CREACION_USUARIO',
        'PRIVILEGIO',
        'DESC_PRIVILEGIO'
    );
}

if ($tipo_reporteria == "tickets") {
    $cabecera = array(
        'ID_TICKET',
        'NOMBRE_TICKET',
        'DESC_TICKET',
        'GRUPO_SOPORTE',
        'TECNICO_ASIGNADO',
        'TITULO_ESTADO',
        'NOMBRE_USUARIO',
        'CREACION_TICKET',
        'ACTUALIZACION_TICKET'
    );
}

if ($tipo_reporteria == "auditoria_usuarios") {
    $cabecera = array(
        'MODIFICADOR',
        'NOMBRE_USUARIO',
        'EMPRESA_USUARIO',
        'WEB_EMPRESA_USUARIO',
        'DIRECCION_USUARIO',
        'TELEFONO_USUARIO',
        'CARGO_USUARIO',
        'CORREO_USUARIO',
        'MODIFICACION_USUARIO',
        'DESC_PRIVILEGIO'
    );
}

$salida = fopen('php://output', 'w');

// output the column headings
fputcsv($salida, $cabecera);

// fetch the data
$link = Conectarse();

$query = mysqli_query($link, $querySelect);

//output each row of the data, format line as csv and write to file pointer
while ($row = mysqli_fetch_assoc($query)) {
    // echo $lineData = $row['NOMBRE_USUARIO'], $row['CORREO_USUARIO'];
    fputcsv($salida, $row);
}
