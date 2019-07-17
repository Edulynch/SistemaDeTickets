<?php

if (
    !isset($_COOKIE['user_id'])
    || !isset($_COOKIE['user_nombre'])
    || count($_COOKIE) == 0
    || !isset($_COOKIE['priv_id'])
    || $_COOKIE['priv_id'] != 1 //Administrador
) {
    header("Location: " . SITIO_WEB);
}

include_once '../config.php';
include_once '../conexion.php';

$link = Conectarse();

$id_existe = limpiar($_GET['id']);
$grupo_editado = false;
$grupo_agregar_usuario = false;
if ($id_existe > 0) {

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $usuario_id = limpiar($_GET['id']);

        // // Dropdown tecnicos
        $query_detalle = "SELECT 
                            LPAD(th.ticket_id, 10, '0') ticket_id,
                            mu.user_nombre user_mod,
                            th.ticket_titulo,
                            th.ticket_descripcion,
                            gs.gsoporte_titulo,
                            te.ticket_estado_titulo,
                            u.user_nombre,
                            th.ticket_fecha_creacion,
                            th.ticket_fecha_actualizado,
                            IFNULL(tec.user_nombre, 'NO ASIGNADO') tecnico_nombre,
                            fecha_mod
                        FROM
                            ticket t
                                INNER JOIN
                            ticket_historico th ON t.ticket_id = th.ticket_id
                                INNER JOIN
                            gruposoporte gs ON th.gsoporte_id = gs.gsoporte_id
                                INNER JOIN
                            usuarios mu ON mu.user_id = th.user_id_mod
                                INNER JOIN
                            ticket_estado te ON te.ticket_estado_id = th.ticket_estado_id
                                INNER JOIN
                            gruposoporte_usuarios gsu ON gsu.gsoporte_id = th.gsoporte_id
                                INNER JOIN
                            usuarios u ON u.user_id = gsu.user_id
                                LEFT OUTER JOIN
                            usuarios tec ON tec.user_id = t.tecnico_id
                        WHERE
                            th.ticket_id = '$usuario_id'
                        ORDER BY fecha_mod DESC;";

        $row_detalle = mysqli_query($link, $query_detalle);
    } else {
        header("Location: " . SITIO_WEB_DASHBOARD . "/auditoria_usuarios.php");
    }
} else {
    header("Location: " . SITIO_WEB_DASHBOARD . "/auditoria_usuarios.php");
}

// // Dropdown tecnicos
$query_editar = "SELECT *
                            FROM
                                gruposoporte
                            WHERE
                                gsoporte_id = " . $usuario_id . "
                            AND
                                LENGTH(gsoporte_titulo) > 0
                            LIMIT
                                1
                            ;";

$ticket_editar = mysqli_query($link, $query_editar);

$ticket_row_editar = $ticket_editar->fetch_assoc();

include_once 'menu/header.php'

?>

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Historial de Modificaciones del Usuario
        </small>
    </h1>
</div>
<!-- /.page-header -->

<div class="hr hr10 hr-dotted"></div>

<div class="row">

    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
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
                                            <th class="text-center">Modificador</th>
                                            <th class="text-center">Número Ticket</th>
                                            <th class="text-center">Nombre Ticket</th>
                                            <th class="text-center">Descripcion</th>
                                            <th class="text-center">Grupo Resolutor</th>
                                            <th class="text-center">Estado Ticket</th>
                                            <th class="text-center">Dueño Ticket</th>
                                            <th class="text-center">Resolutor Asignado</th>
                                            <th class="text-center">Fecha Creación</th>
                                            <th class="text-center">Fecha Última Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if ($row_detalle) {
                                            while ($row = $row_detalle->fetch_assoc()) {

                                                ?>
                                                <tr>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_mod']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo PREFIJO_ORDEN_TRABAJO . $row['ticket_id']; ?>
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
                                                    <td>
                                                        <!-- <a href="auditoria_usuarios_detalle.php?id=<?php echo $row['user_id']; ?>" style="text-decoration: none">
                                                                                                                                    <i class="ace-icon fa fa-file-text-o bigger-230 text-pimary"> </i>
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
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>

<?php

include_once 'menu/footer.php'

?>