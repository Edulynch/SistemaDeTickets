<?php

include_once '../config.php';
include_once '../conexion.php';

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
    || $_COOKIE['priv_id'] != 1 //Administrador
) {
    header("Location: http://softicket.cl");
}

$link = Conectarse('ticket');

$filtro_exitoso = false;
$mostrar_mensaje = false;

// echo "METHOD - " . $_SERVER['REQUEST_METHOD'] . "<br />";

// echo "GRUPO SOPORTE - " . $_POST['ticket_gsoporte_id'] . "<br /> gp: ";

// var_dump(
//     isset($_POST['ticket_gsoporte_id']) && !empty($_POST['ticket_gsoporte_id'])
// );

// echo "<br /> inicial ";
// var_dump(
//     empty($_POST['fechaInicial'])
// );

// echo "<br /> final ";
// var_dump(
//     empty($_POST['fechaFinal'])
// );

// echo "<br />";
// echo "<br />";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        //TICKET SELECCIONADO
        isset($_POST['ticket_gsoporte_id']) && !empty($_POST['ticket_gsoporte_id']) &&
        empty($_POST['fechaInicial']) &&
        empty($_POST['fechaFinal'])
    ) {
        $ticket_gsoporte_id = limpiar($_POST['ticket_gsoporte_id']);

        //QUERY - TICKET SELECCIONAD
        $ticket = "SELECT 
        ticket_id,
        ticket_titulo,
        ticket_descripcion,
        gsoporte_titulo,
        IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
        te.ticket_estado_titulo,
        u.user_nombre,
        t.ticket_fecha_creacion,
        t.ticket_fecha_actualizado
    FROM
        tickets.ticket t
            INNER JOIN
        tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
            RIGHT JOIN
        tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
            RIGHT JOIN
        tickets.usuarios u ON u.user_id = t.user_id
            LEFT JOIN
        tickets.usuarios tec ON tec.user_id = t.tecnico_id
    WHERE
        ticket_titulo IS NOT NULL
    AND
        g.gsoporte_id =  $ticket_gsoporte_id
    ORDER BY t.ticket_id DESC;
    ";

        // echo "FORM" . $ticket;

        $filtro_exitoso = true;
        //FECHA SELECCIONADA
    } else if (
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        !empty($_POST['fechaFinal']) &&
        empty($_POST['ticket_gsoporte_id'])
    ) {
        //QUERY - FECHA SELECCIONADA
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $ticket = "SELECT 
        ticket_id,
        ticket_titulo,
        ticket_descripcion,
        gsoporte_titulo,
        IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
        te.ticket_estado_titulo,
        u.user_nombre,
        t.ticket_fecha_creacion,
        t.ticket_fecha_actualizado
    FROM
        tickets.ticket t
            INNER JOIN
        tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
            RIGHT JOIN
        tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
            RIGHT JOIN
        tickets.usuarios u ON u.user_id = t.user_id
            LEFT JOIN
        tickets.usuarios tec ON tec.user_id = t.tecnico_id
    WHERE
        ticket_titulo IS NOT NULL
    AND
        date(t.ticket_fecha_creacion) BETWEEN '$fechaInicial' AND '$fechaFinal'
    ORDER BY t.ticket_id DESC;
    ";
        // echo "FORM2" . $ticket;

        $filtro_exitoso = true;

        //TICKET SELECCIONADO - FECHA SELECCINONADA
    } else if (
        isset($_POST['ticket_gsoporte_id']) && !empty($_POST['ticket_gsoporte_id']) &&
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        isset($_POST['fechaFinal']) && !empty($_POST['fechaFinal'])
    ) {
        $ticket_gsoporte_id = limpiar($_POST['ticket_gsoporte_id']);
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $ticket = "SELECT 
        ticket_id,
        ticket_titulo,
        ticket_descripcion,
        gsoporte_titulo,
        IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
        te.ticket_estado_titulo,
        u.user_nombre,
        t.ticket_fecha_creacion,
        t.ticket_fecha_actualizado
    FROM
        tickets.ticket t
            INNER JOIN
        tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
            RIGHT JOIN
        tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
            RIGHT JOIN
        tickets.usuarios u ON u.user_id = t.user_id
            LEFT JOIN
        tickets.usuarios tec ON tec.user_id = t.tecnico_id
    WHERE
        ticket_titulo IS NOT NULL
    AND
        date(t.ticket_fecha_creacion) BETWEEN '$fechaInicial' AND '$fechaFinal'
    AND
        g.gsoporte_id =  $ticket_gsoporte_id
    ORDER BY t.ticket_id DESC;
    ";

        // echo "FORM3" . $ticket;

        $filtro_exitoso = true;
    } else {
        $filtro_exitoso = false;
    }
}

if (!$filtro_exitoso) {

    // Dropdown tecnicos
    $ticket = "SELECT 
                ticket_id,
                ticket_titulo,
                ticket_descripcion,
                gsoporte_titulo,
                IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
                te.ticket_estado_titulo,
                u.user_nombre,
                t.ticket_fecha_creacion,
                t.ticket_fecha_actualizado
            FROM
                tickets.ticket t
                    INNER JOIN
                tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
                    RIGHT JOIN
                tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
                    RIGHT JOIN
                tickets.usuarios u ON u.user_id = t.user_id
                    LEFT JOIN
                tickets.usuarios tec ON tec.user_id = t.tecnico_id
            WHERE
                ticket_titulo IS NOT NULL
            ORDER BY t.ticket_id DESC;
            ";
}

$lista_ticket = mysqli_query($link, $ticket);

// Dropdown tecnicos
$gsoporte = "SELECT gsoporte_id, gsoporte_titulo FROM tickets.gruposoporte;";

$lista_gsoporte = mysqli_query($link, $gsoporte);

include_once 'menu/header.php'

?>

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Listado de Tickets de Soporte
        </small>
    </h1>
</div><!-- /.page-header -->
<div>
    <!-- Boton Superior Tabla -->
    <form action="tickets_administrar.php" method="POST" id="form1" name="form1">
        <!-- Grupo de Soporte -->
        <div class="row">
            <div class="col-sm-1">
                <b>Grupo de Soporte:</b>
            </div>
            <div class="col-sm-2">
                <!-- <div class="col-auto my-1"> -->
                <select name="ticket_gsoporte_id" class="form-control" onchange="submitForm();">
                    <option value="">Seleccionar un Grupo</option>
                    <?php
                    while ($gruposoporte = mysqli_fetch_assoc($lista_gsoporte)) {
                        echo "<option value=" . $gruposoporte['gsoporte_id'] . ">" . $gruposoporte['gsoporte_titulo'] . "</option>";
                    }
                    ?>
                </select>
                <!-- </div> -->
            </div>
            <!-- </form>
        <form action="tickets_administrar.php" method="POST" id="form2" name="form2"> -->
            <div class='col-sm-offset-3 col-sm-2'>
                <div class="form-group">
                    <div id="filterDate2">
                        <!-- Datepicker as text field -->

                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" placeholder="Ingresar Fecha Inicio" style="text-align:center;letter-spacing: 1px" readonly="readonly" name="fechaInicial">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-sm-2'>
                <div class="form-group">
                    <div id="filterDate2">
                        <!-- Datepicker as text field -->

                        <div class="input-group date" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" placeholder="Ingresar Fecha Final" style="text-align:center;letter-spacing: 1px" readonly="readonly" name="fechaFinal">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success col-sm-2">
                <i class="glyphicon glyphicon-search"></i>
                Filtrar
            </button>
        </div>
    </form>

    <br />

    <!-- Boton Superior Tabla -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div id="table" class="table-editable">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Número Ticket</th>
                                        <th class="text-center">Nombre Ticket</th>
                                        <th class="text-center">Descripcion</th>
                                        <th class="text-center">Grupo Resolutor</th>
                                        <th class="text-center">Estado Ticket</th>
                                        <th class="text-center">Dueño Ticket</th>
                                        <th class="text-center">Resolutor Asignado</th>
                                        <th class="text-center">Fecha Creación</th>
                                        <th class="text-center">Fecha Última Acción</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($lista_ticket) {
                                        while ($row = $lista_ticket->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <?php

                                                $lpad_query = "SELECT LPAD(" . $row['ticket_id'] . ", 10, '0') ticket_id;";

                                                $lpad_ticket = mysqli_query($link, $lpad_query);

                                                $lpad_row = mysqli_fetch_array($lpad_ticket, MYSQLI_ASSOC);

                                                ?>

                                                <td class="pt-3-half">
                                                    <?php echo PREFIJO_ORDEN_TRABAJO . $lpad_row['ticket_id']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['ticket_titulo']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['ticket_descripcion']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['gsoporte_titulo']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['ticket_estado_titulo']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['user_nombre']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['tecnico_nombre']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['ticket_fecha_creacion']; ?>
                                                </td>
                                                <td class="pt-3-half">
                                                    <?php echo $row['ticket_fecha_actualizado']; ?>
                                                </td>
                                                </td>
                                                <td>
                                                    <a href="../formulario_editar.php?id=<?php echo $row['ticket_id']; ?>" style="text-decoration: none">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e;text-decoration:none"> </i>
                                                    </a>

                                                    <a href="../formulario_eliminar.php?id=<?php echo $row['ticket_id']; ?>" class="icon_opcion" style="color:#d9534f;text-decoration:none">
                                                        <i class="ace-icon fa fa-trash-o bigger-230"> </i>
                                                    </a>

                                                <?php
                                                }
                                            }
                                            ?>
                                    </tr>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Editable table -->
            </div>

            <div class="hr hr32 hr-dotted"></div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <?php

    include_once 'menu/footer.php'

    ?>