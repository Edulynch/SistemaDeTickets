<?php

include_once 'config.php';
include_once 'conexion.php';

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
) {
    header("Location: " . SITIO_WEB);
}

$link = Conectarse();

$id = limpiar($_GET['id']);

$registrado = false;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $ticket_titulo = limpiar($_POST['ticket_titulo']);
    $ticket_user_id = limpiar($_POST['ticket_user_id']);
    $ticket_estado_id = limpiar($_POST['ticket_estado_id']);
    $user_id = $_COOKIE['user_id'];
    $ticket_gsoporte_id = limpiar($_POST['ticket_gsoporte_id']);
    $ticket_descripcion = limpiar($_POST['ticket_descripcion']);

    $query = "UPDATE ticket
                SET ticket_titulo = '$ticket_titulo',
                ticket_descripcion = '$ticket_descripcion',
                gsoporte_id = '$ticket_gsoporte_id',
                tecnico_id = '$ticket_user_id',
                ticket_estado_id = '$ticket_estado_id'
                WHERE ticket_id = '$id';";

    $ticket = mysqli_query($link, $query);

    $registrado = true;
}

$squery = "SELECT 
                ticket_id,
                ticket_titulo,
                gsoporte_id,
                ticket_descripcion,
                tecnico_id,
                ticket_estado_id
            FROM 
                ticket
            WHERE 
                ticket_id = " . $id . "
            LIMIT 1;";

$ticket = mysqli_query($link, $squery);

$row = mysqli_fetch_array($ticket, MYSQLI_NUM);

$lpad_query = "SELECT LPAD($row[0], 10, '0') ticket_id;";

$lpad_ticket = mysqli_query($link, $lpad_query);

$lpad_row = mysqli_fetch_array($lpad_ticket, MYSQLI_NUM);

$lpad_ticket_result = $lpad_row[0];

$ID_ORDEN_TRABAJO = PREFIJO_ORDEN_TRABAJO . $lpad_ticket_result;

// Dropdown Grupo Resolutor
$gsoporte = "SELECT gsoporte_id, gsoporte_titulo FROM gruposoporte;";

$lista_gsoporte = mysqli_query($link, $gsoporte);

// Dropdown tecnicos

$tecnico = "SELECT 
                u.user_id, u.user_nombre
            FROM
                usuarios u
            INNER JOIN
                gruposoporte_usuarios g 
            ON 
                u.user_id = g.user_id
            WHERE
                g.gsoporte_id = '$row[2]'
            AND
                priv_id = 2
            ;";

$lista_tecnico = mysqli_query($link, $tecnico);

// Dropdown ticket_estados

$ticket_estado = "SELECT 
                ticket_estado_id, ticket_estado_titulo
            FROM 
                ticket_estado 
            ;";

$lista_ticket_estado = mysqli_query($link, $ticket_estado);

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

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
                                <input class="input--style-6" type="text" name="ticket_id" value="<?php echo $ID_ORDEN_TRABAJO; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <form method="POST" id="formulario_form" action="formulario_editar.php?id=<?php echo $row[0]; ?>">
                        <div class="form-row">
                            <div class="name">Titulo</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="ticket_titulo" value="<?php echo $row[1]; ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Grupo Resolutor</div>
                            <div class="input-group">
                                <div class="col-auto my-1">
                                    <select name="ticket_gsoporte_id" class="custom-select" <?php
                                                                                            if ($_COOKIE['priv_id'] != 1) {
                                                                                                echo "disabled";
                                                                                            }
                                                                                            ?> onchange="myFunction()" id="dropdown">
                                        <option value="">Seleccionar un Grupo</option>
                                        <?php
                                        while ($gruposoporte = mysqli_fetch_assoc($lista_gsoporte)) {
                                            if ($row[2] == $gruposoporte['gsoporte_id']) {
                                                echo "<option value=" . $gruposoporte['gsoporte_id'] . " selected>" . $gruposoporte['gsoporte_titulo'] . "</option>";
                                            } else {
                                                echo "<option value=" . $gruposoporte['gsoporte_id'] . ">" . $gruposoporte['gsoporte_titulo'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Seleccionar Tecnico</div>
                            <div class="input-group">
                                <div class="col-auto my-1">
                                    <select name="ticket_user_id" class="custom-select" id="dropdown2">
                                        <option value="" id="tecnico">Seleccionar un Tecnico</option>
                                        <?php
                                        while ($row_tecnico = mysqli_fetch_assoc($lista_tecnico)) {
                                            if ($row[4] == $row_tecnico['user_id']) {
                                                echo "<option value=" . $row_tecnico['user_id'] . " selected>" . $row_tecnico['user_nombre'] . "</option>";
                                            } else {
                                                echo "<option value=" . $row_tecnico['user_id'] . ">" . $row_tecnico['user_nombre'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Descripción de Tarea</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="ticket_descripcion"><?php echo $row[3]; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Estado del Ticket</div>
                            <div class="input-group">
                                <div class="col-auto my-1">
                                    <select name="ticket_estado_id" class="custom-select">
                                        <option value="">Seleccionar un Estado</option>
                                        <?php
                                        while ($row_ticket_estado = mysqli_fetch_assoc($lista_ticket_estado)) {
                                            if ($row[5] == $row_ticket_estado['ticket_estado_id']) {
                                                echo "<option value=" . $row_ticket_estado['ticket_estado_id'] . " selected>" . $row_ticket_estado['ticket_estado_titulo'] . "</option>";
                                            } else {
                                                echo "<option value=" . $row_ticket_estado['ticket_estado_id'] . ">" . $row_ticket_estado['ticket_estado_titulo'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php

                        if ($registrado == true) {

                            echo '<div class="form-row">';
                            echo '<label for="gsoporte_descripcion" class="control-label label--style-6 "></label>';
                            echo '<div class="input-group">';
                            echo '<label class="label--style-6" style="color:green"> Se actualizo correctamente el ticket. !</label>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                        <!-- <div class="form-row">
                                <div class="name">Upload CV</div>
                                <div class="value">
                                    <div class="input-group js-input-file">
                                        <input class="input-file" type="file" name="file_cv" id="file">
                                        <label class="label--file" for="file">Choose file</label>
                                        <span class="input-file__info">No file chosen</span>
                                    </div>
                                    <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 50 MB</div>
                                </div>
                            </div> -->
                </div>
                <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" type="submit">Actualizar Orden de Trabajo</button>
                    <?php
                    if ($_COOKIE['priv_id'] == 1) {
                        ?>
                        <a href="./dashboard/tickets_administrar.php" class="btn btn--radius-2" style="color:white;background-color:green;text-decoration:none" type="submit">Volver</button>
                        <?php
                        } else {
                            ?>
                            <a href="./bandeja/tickets_asignado_grupo.php" class="btn btn--radius-2" style="color:white;background-color:green;text-decoration:none" type="submit">Volver</button>
                            <?php
                            }
                            ?>
                </div>
                </form>
                <script>
                    function myFunction() {
                        if (document.getElementById("dropdown2").value) {
                            document.getElementById("dropdown2").disabled = true;
                            document.getElementById("dropdown2").selectedIndex = "0";
                            alert("Estimado,\n\nAl cambiar el Grupo Resolutor, no es posible asignar un tenico.\n - Primero se debe guardar los cambios.\n\nAtte. Developers");
                        }
                    }
                </script>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="js/jquery/jquery.min.js"></script>


    <!-- Main JS-->
    <script src="js/formulario.js"></script>

    <script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

    <script src="js/formulario_editar.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->