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

    $id = "SELECT *
    FROM 
        TICKETS.USUARIOS U
    INNER JOIN 
        TICKETS.PRIVILEGIOS P
    ON 
        U.PRIV_ID = P.PRIV_ID
    ORDER BY 
        U.PRIV_ID ASC, USER_ID ASC;";

    // echo $id;

    $soporte_id = mysqli_query($link, $id);

    $row = $soporte_id->fetch_assoc();

    if (isset($_GET['id']) && !empty($_GET['id']) && !empty($row['user_id'])) {

        $usuario_id = limpiar($_GET['id']);

        // // Dropdown tecnicos
        $query_detalle = "SELECT 
                                u.user_nombre user_mod,
                                uh.user_nombre,
                                uh.user_web_empresa,
                                uh.user_direccion,
                                uh.user_telefono,
                                uh.user_cargo,
                                uh.user_correo,
                                a.auditoria_fecha_creacion fecha_mod,
                                p.priv_titulo
                            FROM
                                auditoria a
                            INNER JOIN
                                usuarios_historico uh 
                            ON 
                                a.user_id = uh.priv_id
                            INNER JOIN
                                usuarios u 
                            ON 
                                u.user_id = a.modificador_id
                            INNER JOIN
                                privilegios p 
                            ON 
                                uh.priv_id = p.priv_id
                            WHERE
                                auditoria_id IN (
                                                SELECT 
                                                    MAX(auditoria_id)
                                                FROM
                                                    auditoria
                                                GROUP BY
                                                    user_id
                                                ORDER BY
                                                    user_id DESC
                                                )
                                AND 
                                    uh.user_id = '$usuario_id'
                                ORDER BY 
                                    userhist_id DESC;";

        $row_detalle = mysqli_query($link, $query_detalle);

        //Editar Grupo de Soporte
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['gsoporte_form'])) {
                $gsoporte_titulo = limpiar($_POST['gsoporte_titulo']);
                $gsoporte_descripcion = limpiar($_POST['gsoporte_descripcion']);
                if (!empty($row['gsoporte_titulo']) && !empty($row['gsoporte_descripcion'])) {

                    $query = "UPDATE tickets.gruposoporte
                                SET gsoporte_titulo = '" . limpiar($gsoporte_titulo) . "',
                                    gsoporte_descripcion = '" . limpiar($gsoporte_descripcion) . "'
                                WHERE gsoporte_id = '" . $usuario_id . "';";

                    $ticket = mysqli_query($link, $query);

                    $grupo_editado = true;
                }
            } else {
                if (isset($_POST['gsoporte_form2'])) {

                    $user_tenico = limpiar($_POST['user_tenico']);

                    if (!empty($row['gsoporte_titulo']) && !empty($row['gsoporte_descripcion'])) {

                        $query_tecnico = "INSERT INTO tickets.gruposoporte_usuarios (
                                        gsoporte_usuarios_id,
                                        gsoporte_id,
                                        user_id
                                        ) 
                                        VALUES 
                                        (
                                        NULL, 
                                        '" . $row['gsoporte_id'] . "',
                                        " . $user_tenico . "
                                        );";

                        $ticket_agregar_tecnico = mysqli_query($link, $query_tecnico);

                        $grupo_agregar_usuario = true;
                    }
                }
            }
        }

        $gruposoporte = "SELECT 
                            gu.gsoporte_id,
                            gsoporte_titulo,
                            gsoporte_descripcion,
                            gu.user_id,
                            user_nombre
                        FROM
                            tickets.gruposoporte_usuarios gu
                        INNER JOIN
                            tickets.gruposoporte g ON gu.gsoporte_id = g.gsoporte_id
                        INNER JOIN
                            tickets.usuarios u ON gu.user_id = u.user_id
                        WHERE
                            gu.gsoporte_id = '$id_existe';";

        $lista_gruposoporte_choosed = mysqli_query($link, $gruposoporte);
    } else {
        header("Location: " . SITIO_WEB_DASHBOARD . "/gruposoporte_administrar.php");
    }
} else {
    header("Location: " . SITIO_WEB_DASHBOARD . "/gruposoporte_administrar.php");
}

// // Dropdown tecnicos
$query_editar = "SELECT *
                            FROM
                                tickets.gruposoporte
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