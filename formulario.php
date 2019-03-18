<?php

include_once 'config.php';
include_once 'conexion.php';

#PREFIJO_ORDEN_TRABAJO
#=> OT-
#000

$link = Conectarse('ticket');

//Recorrer valores obtenidos por el select
//while ($row = $result2->fetch_assoc()) {
//    echo $row['id_ticket'] . "<br>";
//}

$query = "INSERT INTO `ticket` (`id_ticket`, `fecha_creado`, `fecha_actualizado`) VALUES (NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

//Crea un Numero de Ticket Distinto cada vez que se actualiza
$result = mysqli_query($link, $query);

//MAXIMO TICKET Y LPAD
$squery = "SELECT MAX(id_ticket) id_ticket FROM `ticket` LIMIT 1;";

$ticket = mysqli_query($link, $squery);

$row = mysqli_fetch_array($ticket, MYSQLI_NUM);
//$row = $ticket->fetch_assoc();

//echo $row[0];

//sin lpad
$lpad_query = "SELECT LPAD($row[0], 10, '0') id_ticket;";

$lpad_ticket = mysqli_query($link, $lpad_query);

$lpad_row = mysqli_fetch_array($lpad_ticket, MYSQLI_NUM);

//Con LPAD
//echo $lpad_row[0];
$lpad_ticket_result = $lpad_row[0];

//while ($row = $lpad_ticket->fetch_assoc()) {
//    echo $row['id_ticket'];
//}

$ID_ORDEN_TRABAJO = PREFIJO_ORDEN_TRABAJO . $lpad_ticket_result;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Crear Orden de Trabajo</title>

<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">

    <!-- Main CSS-->
    <link href="estilos/formulario.css" rel="stylesheet" media="all">
    <link href="estilos/bootstrap_custom.css" rel="stylesheet">

</head>

<body class="bg-dark">
<div class="p-t-15">
    <div class="wrapper wrapper--w900">
        <div class="card card-6">
            <div class="card-heading">
                <h2 class="title">Formulario de Orden de Trabajo</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="name">Orden de Trabajo</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-6" type="email" name="email"
                                   placeholder="<?php echo $ID_ORDEN_TRABAJO; ?>" disabled>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <div class="form-row">
                        <div class="name">Nombre</div>
                        <div class="value">
                            <input class="input--style-6" type="text" name="full_name" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Correo Electronico</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="email" name="email" placeholder="example@email.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Grupo Resolutor</div>
                        <div class="input-group">
                            <div class="col-auto my-1">
                                <select name="cars" class="custom-select">
                                    <option selected>Seleccionar un Grupo</option>
                                    <option value="1">Grupo 1</option>
                                    <option value="2">Grupo 2</option>
                                    <option value="3">Grupo 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Descripción de Tarea</div>
                        <div class="value">
                            <div class="input-group">
                                <textarea class="textarea--style-6" name="message"
                                          placeholder="Message..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Upload CV</div>
                        <div class="value">
                            <div class="input-group js-input-file">
                                <input class="input-file" type="file" name="file_cv" id="file">
                                <label class="label--file" for="file">Choose file</label>
                                <span class="input-file__info">No file chosen</span>
                            </div>
                            <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 50 MB</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn--radius-2 btn--blue-2" type="submit">Crear Orden de Trabajo</button>
            </div>
        </div>
    </div>
</div>
<!-- Jquery JS-->
    <script src="js/jquery/jquery.min.js"></script>


<!-- Main JS-->
<script src="js/formulario.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
