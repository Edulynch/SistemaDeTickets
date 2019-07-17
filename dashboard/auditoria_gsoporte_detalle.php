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
        mu.user_nombre user_nombre_mod,
        gh.gsoporte_id,
        gh.gsoporte_titulo,
        gh.gsoporte_descripcion,
        gh.fecha_mod
        FROM
        gruposoporte_historico gh
            INNER JOIN
        usuarios mu ON mu.user_id = gh.user_id_mod
        WHERE
            gh.gsoporte_id = '$usuario_id'
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
                                        <tr>
                                            <th class="text-center">Modificador</th>
                                            <th class="text-center">Nombre Grupo Soporte</th>
                                            <th class="text-center">Descripción</th>
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
                                                        <?php echo $row['user_nombre_mod']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['gsoporte_titulo']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['gsoporte_descripcion']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['fecha_mod']; ?>
                                                    </td>


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