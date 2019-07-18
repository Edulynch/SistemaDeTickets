<?php

include_once '../config.php';
include_once '../conexion.php';

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
) {
    header("Location: " . SITIO_WEB);
}

$link = Conectarse();

$id = limpiar($_COOKIE['user_id']);

// Dropdown tecnicos
$ticket = "SELECT 
                ticket_id,
                ticket_titulo,
                ticket_descripcion,
                gsoporte_titulo,
                t.ticket_estado_id,
                te.ticket_estado_titulo,
                IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
                u.user_nombre,
                t.ticket_fecha_creacion,
                t.ticket_fecha_actualizado
            FROM
                ticket t
            INNER JOIN
                ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
            INNER JOIN
                gruposoporte g ON g.gsoporte_id = t.gsoporte_id
            INNER JOIN
                usuarios u ON u.user_id = t.user_id
            LEFT OUTER JOIN
                usuarios tec ON t.tecnico_id = tec.user_id
            WHERE
                t.user_id = '$id'
            AND 
                ticket_titulo IS NOT NULL
            AND
                t.ticket_estado_id = 1
            ORDER BY 
                t.ticket_id DESC;
            ";

$lista_ticket = mysqli_query($link, $ticket);

include_once 'menu/header.php'

?>

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Tickets Abiertos Enviados Por Mi
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
                                                <?php
                                                if ($row['ticket_estado_id'] == 1) { ?>
                                                    <a href="../formulario_editar.php?id=<?php echo $row['ticket_id']; ?>" style="text-decoration: none">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e;text-decoration:none"> </i>
                                                    </a>
                                                <?php
                                                } else {
                                                    ?>
                                                    <a href="#" onClick="alert('Estimado,\n\nLos Tickets Cerrados, solo pueden ser editados por un Administrador.\n\nAtte. Developers')" style="text-decoration: none">
                                                        <i class="ace-icon fa fa-info-circle bigger-230 text-primary" style="text-decoration:none"> </i>
                                                    </a>
                                                <?php
                                                }
                                                ?>

                                                <!-- <a href="../formulario_eliminar.php?id=<?php echo $row['ticket_id']; ?>" class="icon_opcion" style="color:#d9534f;text-decoration:none">
                                                                                    <i class="ace-icon fa fa-trash-o bigger-230"> </i>
                                                                                </a> -->

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