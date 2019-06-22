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

// Dropdown Tickets
$ticket = "SELECT 
ticket_titulo,
ticket_descripcion,
gsoporte_titulo,
te.ticket_estado_titulo,
t.ticket_fecha_creacion,
t.ticket_fecha_actualizado
FROM
tickets.ticket t
    INNER JOIN
tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
    INNER JOIN
tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
WHERE
ticket_titulo IS NOT NULL
AND t.ticket_estado_id = 1;";

$lista_ticket = mysqli_query($link, $ticket);
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
                                    <th class="text-center">Nombre Ticket</th>
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Grupo Resolutor</th>
                                    <th class="text-center">Estado Ticket</th>
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
                                                <?php echo $row['ticket_fecha_creacion']; ?>
                                            </td>
                                            <td class="pt-3-half">
                                                <?php echo $row['ticket_fecha_actualizado']; ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="#" style="text-decoration: none">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e;text-decoration:none"> </i>
                                                </a>

                                                <a href="#" class="icon_opcion" style="color:#d9534f;text-decoration:none">
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