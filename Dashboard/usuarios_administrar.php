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

// echo $_SERVER['REQUEST_METHOD'];
// echo "<br />";
// var_dump(isset($_SERVER['REQUEST_METHOD']) == 'POST');
// echo "<br />";
// var_dump(isset($_POST['fechaFinal']));
// echo "<br />";
// var_dump(isset($_POST['fechaInicial']));
// echo "<br />";

$filtro_exitoso = false;
$mostrar_mensaje = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mostrar_mensaje = true;

    if (
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        isset($_POST['fechaFinal']) && !empty($_POST['fechaFinal'])
    ) {
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $usuarios = "SELECT *
                    FROM 
                        TICKETS.USUARIOS U
                    INNER JOIN 
                        TICKETS.PRIVILEGIOS P
                    ON 
                        U.PRIV_ID = P.PRIV_ID
                    WHERE
                        U.USER_FECHA_CREACION BETWEEN '$fechaInicial'
                        AND '$fechaFinal'
                    ORDER BY 
                        U.PRIV_ID ASC, USER_ID ASC;";

        $filtro_exitoso = true;
    } else {
        $filtro_exitoso = false;
    }
}

if (!$filtro_exitoso) {

    $usuarios = "SELECT * 
                    FROM 
                        TICKETS.USUARIOS U
                    INNER JOIN 
                        TICKETS.PRIVILEGIOS P
                    ON 
                        U.PRIV_ID = P.PRIV_ID
                    ORDER BY 
                        U.PRIV_ID ASC, USER_ID ASC;";
}

$lista_usuarios = mysqli_query($link, $usuarios);

include_once 'menu/header.php';

?>

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Listado de Usuario
        </small>
    </h1>
</div><!-- /.page-header -->

<!-- Boton Superior Tabla -->
<form action="usuarios_administrar.php" method="POST">
    <div class="row" style="text-align:right">
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
                                    <th class="text-center">Nombre Completo</th>
                                    <th class="text-center">Empresa</th>
                                    <th class="text-center">Web Empresa</th>
                                    <th class="text-center">Dirección</th>
                                    <th class="text-center">Telefono</th>
                                    <th class="text-center">Cargo</th>
                                    <th class="text-center">Correo Electronico</th>
                                    <th class="text-center">Fecha Creación</th>
                                    <th class="text-center">Tipo de Privilegio</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($lista_usuarios) {
                                    while ($row = $lista_usuarios->fetch_assoc()) {

                                        ?>
                                        <tr>
                                            <td class="pt-3-half">
                                                <?php echo $row['user_nombre']; ?>
                                            </td>
                                            <td class="pt-3-half">
                                                <?php echo $row['user_empresa']; ?>
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
                                                <?php echo $row['user_fecha_creacion']; ?>
                                            </td>
                                            <td class="pt-3-half">
                                                <?php echo $row['priv_titulo']; ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="usuarios_editar.php?id=<?php echo $row['user_id']; ?>">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e"> </i>
                                                </a>
                                                <a href="usuarios_eliminar.php?id=<?php echo $row['user_id']; ?>">
                                                    <i class="ace-icon fa fa-trash-o bigger-230" style="color:#d9534f"> </i>
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


        <?php

        if ($mostrar_mensaje) {
            if ($filtro_exitoso) {
                ?>
                <Label>
                    <b>Filtros:</b>
                    <br />
                    - Fecha Inicio: <?php echo $fechaInicial ?>
                    <br />
                    - Fecha Inicio: <?php echo $fechaFinal ?>
                </Label>

            <?php } else {
                if (!$filtro_exitoso) { ?>
                    <Label class="bg-danger">
                        <b>** Debe seleccionar una fecha Inicial y Final.</b><br />
                        <b>** No Deber Quedar Ninguna Fecha Vacía.</b>
                    </Label>
                <?php }
            }
        } ?>

        <div class="hr hr32 hr-dotted"></div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

<?php
include_once 'menu/footer.php';
?>