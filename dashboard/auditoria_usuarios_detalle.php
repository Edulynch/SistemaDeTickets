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
                            mu.user_nombre user_mod,
                            uh.user_nombre,
                            uh.user_correo,
                            uh.user_password,
                            uh.user_empresa,
                            uh.user_direccion,
                            uh.user_telefono,
                            uh.user_web_empresa,
                            uh.user_cargo,
                            uh.user_fecha_creacion,
                            p.priv_titulo,
                            uh.fecha_mod
                        FROM
                            usuarios_historico uh
                        INNER JOIN
                            usuarios u ON u.user_id = uh.user_id_mod
                        INNER JOIN
                            usuarios mu ON mu.user_id = uh.user_id_mod
                        INNER JOIN
                            privilegios p ON p.priv_id = uh.priv_id
                        WHERE
                            uh.user_id = '$usuario_id'
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
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Web Empresa</th>
                                            <th class="text-center">Direccion</th>
                                            <th class="text-center">Telefono</th>
                                            <th class="text-center">Cargo</th>
                                            <th class="text-center">Correo Electronico</th>
                                            <th class="text-center">Fecha Modificación</th>
                                            <th class="text-center">Tipo de Privilegio</th>

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
                                                        <?php echo $row['user_nombre']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_web_empresa']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_direccion']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_telefono']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_cargo']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_correo']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['fecha_mod']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['priv_titulo']; ?>
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