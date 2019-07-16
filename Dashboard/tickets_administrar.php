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
    header("Location: " . SITIO_WEB);
}

$link = Conectarse();

$filtro_exitoso = false;
$mostrar_mensaje = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
        ticket t
            INNER JOIN
        ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
            RIGHT JOIN
        gruposoporte g ON g.gsoporte_id = t.gsoporte_id
            RIGHT JOIN
        usuarios u ON u.user_id = t.user_id
            LEFT JOIN
        usuarios tec ON tec.user_id = t.tecnico_id
    WHERE
        ticket_titulo IS NOT NULL";

    if (
        isset($_POST['ticket_gsoporte_id']) && !empty($_POST['ticket_gsoporte_id'])
    ) {
        $ticket_gsoporte_id = limpiar($_POST['ticket_gsoporte_id']);

        //QUERY - TICKET SELECCIONAD
        $ticket .= " AND g.gsoporte_id =  $ticket_gsoporte_id";

        $filtro_exitoso = true;
    }

    if (
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        isset($_POST['fechaFinal']) && !empty($_POST['fechaFinal'])
    ) {
        //QUERY - FECHA SELECCIONADA
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $ticket .= " AND date(t.ticket_fecha_creacion) BETWEEN '$fechaInicial' AND '$fechaFinal'";

        $filtro_exitoso = true;

        //TICKET SELECCIONADO - FECHA SELECCINONADA
    }

    if (
        isset($_POST['ticket_estado']) && !empty($_POST['ticket_estado'])
    ) {
        //QUERY - FECHA SELECCIONADA
        $ticket_estado = limpiar($_POST['ticket_estado']);

        $ticket .= " AND t.ticket_estado_id = $ticket_estado";

        $filtro_exitoso = true;
    }
}

if (!$filtro_exitoso) {

    // Dropdown tecnicos
    $ticket = "SELECT
					ticket_id,
					ticket_titulo,
					ticket_descripcion,
					IFNULL(gsoporte_titulo, 'NO ASIGNADO') gsoporte_titulo,
					IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
					IFNULL(te.ticket_estado_titulo, 'NO ASIGNADO') ticket_estado_titulo,
					u.user_nombre,
					t.ticket_fecha_creacion,
					t.ticket_fecha_actualizado
				FROM
					ticket t
				LEFT OUTER JOIN ticket_estado te ON
					t.ticket_estado_id = te.ticket_estado_id
				LEFT JOIN usuarios tec ON
					tec.user_id = t.tecnico_id
				LEFT OUTER JOIN gruposoporte g ON
					g.gsoporte_id = t.gsoporte_id
				RIGHT JOIN usuarios u ON
					u.user_id = t.user_id
				WHERE
					ticket_titulo IS NOT NULL
				ORDER BY
					t.ticket_id
				DESC;
            ";
}

if ($filtro_exitoso == true) {
    $ticket .= " ORDER BY t.ticket_id DESC;";
}

$lista_ticket = mysqli_query($link, $ticket);

// Dropdown tecnicos
$gsoporte = "SELECT gsoporte_id, gsoporte_titulo FROM gruposoporte;";

$lista_gsoporte = mysqli_query($link, $gsoporte);

$estado_ticket = "SELECT ticket_estado_id, ticket_estado_titulo FROM ticket_estado;";

$lista_estado_ticket = mysqli_query($link, $estado_ticket);

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
                <select name="ticket_gsoporte_id" class="form-control">
                    <option value="">Seleccionar un Grupo</option>
                    <?php
                    while ($gruposoporte = mysqli_fetch_assoc($lista_gsoporte)) {
                        echo "<option value=" . $gruposoporte['gsoporte_id'] . ">" . $gruposoporte['gsoporte_titulo'] . "</option>";
                    }
                    ?>
                </select>
                <!-- </div> -->
            </div>

            <div class="col-sm-1">
                <b>Estado del Ticket:</b>
            </div>
            <div class="col-sm-2">
                <!-- <div class="col-auto my-1"> -->
                <select name="ticket_estado" class="form-control">
                    <option value="">Seleccionar un Estado</option>
                    <?php
                    while ($estado_ticket = mysqli_fetch_assoc($lista_estado_ticket)) {
                        echo "<option value=" . $estado_ticket['ticket_estado_id'] . ">" . $estado_ticket['ticket_estado_titulo'] . "</option>";
                    }
                    ?>
                </select>
                <!-- </div> -->
            </div>

            <!-- </form>
        <form action="tickets_administrar.php" method="POST" id="form2" name="form2"> -->
            <div class='col-sm-2'>
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
                <form action="exportar_to_csv.php" method="post" id="form3" name="form3">
                    <input type="text" name="archivo" value="tickets_por_grupo.csv" hidden>
                    <input type="text" name="tipo_reporteria" value="tickets" hidden>
                    <input type="text" name="querySelect" value="<?php echo $ticket; ?>" hidden>
                    <button type="submit" class="btn btn-success col-sm-1" id="submit-form3" name="submit-form3">
                        <i class="fa fa-download"></i>
                        Exportar
                    </button>
                </form>
            </div>

            <div class="hr hr32 hr-dotted"></div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <?php

    include_once 'menu/footer.php'

    ?>