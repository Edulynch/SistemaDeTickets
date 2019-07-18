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

    $id = "SELECT 
                *
            FROM
                gruposoporte
            WHERE
                gsoporte_id = " . $id_existe . "
            AND LENGTH(gsoporte_titulo) > 0
                LIMIT 1;";

    // echo $id;

    $soporte_id = mysqli_query($link, $id);

    $row = $soporte_id->fetch_assoc();

    if (isset($_GET['id']) && !empty($_GET['id']) && !empty($row['gsoporte_id'])) {

        $gruposoporte_id = limpiar($_GET['id']);
        $user_id_mod = limpiar($_COOKIE['user_id']);

        // Insertar en HISTORICO

        $query_historico = "INSERT INTO gruposoporte_historico (
                            gsoporte_id, 
                            gsoporte_titulo, 
                            gsoporte_descripcion, 
                            user_id_mod
                            )
                            SELECT 	
                                gsoporte_id,
                                gsoporte_titulo,
                                gsoporte_descripcion,
                                (SELECT '$user_id_mod') user_id_mod
                            FROM
                                gruposoporte
                            WHERE
                                gsoporte_id = '$id_existe';";

        mysqli_query($link, $query_historico);

        // // Dropdown tecnicos
        $query_tecnicos = "SELECT 
                            user_id, 
                            user_nombre
                            FROM usuarios
                            WHERE priv_id = 2
                            AND length(user_nombre) > 0;";

        $ticket_tenicos = mysqli_query($link, $query_tecnicos);

        //Editar Grupo de Soporte
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['gsoporte_form'])) {
                $gsoporte_titulo = limpiar($_POST['gsoporte_titulo']);
                $gsoporte_descripcion = limpiar($_POST['gsoporte_descripcion']);
                if (!empty($row['gsoporte_titulo']) && !empty($row['gsoporte_descripcion'])) {

                    $query = "UPDATE gruposoporte
                                SET gsoporte_titulo = " . "'" . limpiar($gsoporte_titulo) . "'" . " ,
                                    gsoporte_descripcion = " . "'" . limpiar($gsoporte_descripcion) . "'" . " 
                                WHERE gsoporte_id = " . "'" . $gruposoporte_id . "'" . " 
                ;";

                    $ticket = mysqli_query($link, $query);

                    $grupo_editado = true;
                }
            } else {
                if (isset($_POST['gsoporte_form2'])) {

                    $user_tenico = limpiar($_POST['user_tenico']);

                    if (!empty($row['gsoporte_titulo']) && !empty($row['gsoporte_descripcion'])) {

                        $query_tecnico = "INSERT INTO gruposoporte_usuarios (
                        gsoporte_usuarios_id,
                        gsoporte_id,
                        user_id
                        ) VALUES (
                        NULL, 
                        " . "'" . $row['gsoporte_id'] . "'" . ",
                        " . $user_tenico . ");";

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
                            gruposoporte_usuarios gu
                        INNER JOIN
                            gruposoporte g ON gu.gsoporte_id = g.gsoporte_id
                        INNER JOIN
                            usuarios u ON gu.user_id = u.user_id
                        WHERE
                            gu.gsoporte_id = " . $id_existe . ";";

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
                                gruposoporte
                            WHERE
                                gsoporte_id = " . $gruposoporte_id . "
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
            Editar Grupo de Soporte
        </small>
    </h1>
</div>
<!-- /.page-header -->

<div class="row">
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">
                    <i class="ace-icon fa fa-plus blue"></i> Editar Grupo de Soporte
                </h4>
            </div>

            <div class="container">

                <form method="post" id="gsoporte_form" action="./gruposoporte_editar.php?id=<?php echo $row['gsoporte_id']; ?>">

                    <div class="form-group">
                        <label for="gsoporte_titulo" class="control-label col-md-3"> Titulo del Grupo<span>*</span>
                        </label>
                        <div class="controls col-md-9">
                            <input class="input-md form-control" maxlength="50" value="<?php echo $ticket_row_editar['gsoporte_titulo']; ?>" id="gsoporte_titulo" name="gsoporte_titulo" style="margin-bottom: 10px" type="text" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gsoporte_descripcion" class="control-label col-md-3 "> Descripción del
                            Grupo<span>*</span> </label>
                        <div class="controls col-md-9">
                            <textarea class="input-md form-control" id="gsoporte_descripcion" name="gsoporte_descripcion" style="margin-bottom: 10px" type="text" cols="30" rows="5" contenteditable="true" onchange="this.value=(this.value.replace('/[\n\r](?!\w)/gi','')).trim();" type="text" data-bind="value: myValue, hasFocus: cleared"><?php echo limpiar($ticket_row_editar['gsoporte_descripcion']); ?></textarea>
                        </div>
                    </div>

                    <?php
                    if ($grupo_editado) {

                        echo '<div class="form-group">';
                        echo '<label for="gsoporte_descripcion" class="control-label col-md-3 "></label>';
                        echo '<div class="controls col-md-9">';
                        echo '<label class="text-success"> Se registro correctamente. !</label>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <div class="aab controls col-md-3 "></div>
                        <div class="controls col-md-9">
                            <input type="submit" value="Actualizar Información" name="gsoporte_form" class="btn btn-primary" id="button-id-signup" style="margin-bottom: 10px;margin-top: 10px" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">
                    <i class="ace-icon fa fa-user-plus blue"></i> Agregar Tecnico al Grupo de Soporte
                </h4>
            </div>

            <div class="container">

                <form method="post" id="gsoporte_form2" action="./gruposoporte_editar.php?id=<?php echo $row['gsoporte_id']; ?>">
                    <div class="form-group">
                        <label for="gsoporte_user_id" class="control-label col-md-3 "> Usuario del Grupo<span>*</span>
                        </label>
                        <div class="controls col-md-9">
                            <select class="form-control input-md dropdown-toggle" name="user_tenico" id="user_tenico" style="margin-bottom: 10px">

                                <?php
                                while ($lista_tecnicos = mysqli_fetch_assoc($ticket_tenicos)) {
                                    echo "<option value=" . $lista_tecnicos['user_id'] . ">" . $lista_tecnicos['user_nombre'] . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <?php
                    if ($grupo_agregar_usuario) {

                        echo '<div class="form-group">';
                        echo '<label for="gsoporte_descripcion" class="control-label col-md-3 "></label>';
                        echo '<div class="controls col-md-9">';
                        echo '<label class="text-success"> Se asocio Tenico a Grupo de Soporte.!</label>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <div class="aab controls col-md-3 "></div>
                        <div class="controls col-md-9 ">
                            <input type="submit" value="Agregar Tenico" name="gsoporte_form2" class="btn btn-primary" id="button-id-signup" style="margin-bottom: 10px;margin-top: 10px" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

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
                                            <th class="text-center">Nombre Grupo Soporte</th>
                                            <th class="text-center">Descripcion</th>
                                            <th class="text-center">Tecnico</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        if (($lista_gruposoporte_choosed) && $lista_gruposoporte_choosed->num_rows > 0) {
                                            while ($row = $lista_gruposoporte_choosed->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['gsoporte_titulo']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['gsoporte_descripcion']; ?>
                                                    </td>
                                                    <td class="pt-3-half">
                                                        <?php echo $row['user_nombre']; ?>
                                                    </td>
                                                    </td>
                                                    <td>
                                                        <!-- <a href="#" style="text-decoration:none">
                                                                                                                                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e"> </i>
                                                                                                                                                                                                </a> -->
                                                        <a href="./gruposoporte_editar_eliminar.php?id=<?php
                                                                                                        echo $row['gsoporte_id'] . "&user=" . $row['user_id'];
                                                                                                        ?>" style="text-decoration:none">
                                                            <i class="ace-icon fa fa-trash-o bigger-230" style="color:#d9534f"> </i>
                                                        </a>

                                                    <?php
                                                    }
                                                } else {
                                                    echo "<tr>";
                                                    echo "<b>No hay Tecnicos asociados al Ticket</b>";
                                                    echo "</tr>";
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