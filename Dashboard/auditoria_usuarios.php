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
    if (
        //TICKET SELECCIONADO
        isset($_POST['buscar_usuario']) && !empty($_POST['buscar_usuario']) &&
        empty($_POST['fechaInicial']) &&
        empty($_POST['fechaFinal'])
    ) {
        $buscar_usuario = limpiar($_POST['buscar_usuario']);

        //QUERY - TICKET SELECCIONAD
        $usuarios = "SELECT 
                        mu.user_nombre user_nombre_mod, 
                        u.user_nombre, 
                        u.user_empresa,
                        u.user_web_empresa,
                        u.user_direccion,
                        u.user_telefono,
                        u.user_cargo,
                        u.user_correo,
                        a.auditoria_fecha_creacion, 
                        priv_titulo
                    FROM
                        auditoria a
                    INNER JOIN
                        usuarios u 
                    ON 
                        a.user_id = u.user_id
                    INNER JOIN 
                        privilegios p
                    ON 
                        p.priv_id = u.priv_id
                    INNER JOIN 
                        usuarios mu
                    ON 
                        mu.user_id = a.modificador_id
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
                        a.user_id = '$buscar_usuario'
                    ORDER BY 
                        auditoria_id DESC;";

        $filtro_exitoso = true;
        //FECHA SELECCIONADA
    } else if (
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        !empty($_POST['fechaFinal']) &&
        empty($_POST['buscar_usuario'])
    ) {
        //QUERY - FECHA SELECCIONADA
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $usuarios = "SELECT 
                        mu.user_nombre user_nombre_mod, a.*, u.*, priv_titulo
                    FROM
                        auditoria a
                    INNER JOIN
                        usuarios u 
                    ON 
                        a.user_id = u.user_id
                    INNER JOIN 
                        privilegios p
                    ON 
                        p.priv_id = u.priv_id
                    INNER JOIN 
                        usuarios mu
                    ON 
                        mu.user_id = a.modificador_id
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
                        date(a.auditoria_fecha_creacion) BETWEEN '$fechaInicial'
                        AND '$fechaFinal'
                    ORDER BY 
                        auditoria_id DESC;";

        $filtro_exitoso = true;

        //TICKET SELECCIONADO - FECHA SELECCINONADA
    } else if (
        isset($_POST['buscar_usuario']) && !empty($_POST['buscar_usuario']) &&
        isset($_POST['fechaInicial']) && !empty($_POST['fechaInicial']) &&
        isset($_POST['fechaFinal']) && !empty($_POST['fechaFinal'])
    ) {
        $buscar_usuario = limpiar($_POST['buscar_usuario']);
        $fechaInicial = limpiar($_POST['fechaInicial']);
        $fechaFinal = limpiar($_POST['fechaFinal']);

        $usuarios = "SELECT 
        mu.user_nombre user_nombre_mod, a.*, u.*, priv_titulo
    FROM
        auditoria a
    INNER JOIN
        usuarios u 
    ON 
        a.user_id = u.user_id
    INNER JOIN 
        privilegios p
    ON 
        p.priv_id = u.priv_id
    INNER JOIN 
        usuarios mu
    ON 
        mu.user_id = a.modificador_id
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
        a.user_id = '$buscar_usuario'
    AND
        date(a.auditoria_fecha_creacion) BETWEEN '$fechaInicial'
        AND '$fechaFinal'
    ORDER BY 
        auditoria_id DESC;";

        $filtro_exitoso = true;
    } else {
        $filtro_exitoso = false;
    }
}

if (!$filtro_exitoso) {

    // Dropdown tecnicos
    $usuarios = "SELECT 
                    mu.user_nombre user_nombre_mod, a.*, u.*, priv_titulo
                FROM
                    auditoria a
                INNER JOIN
                    usuarios u 
                ON 
                    a.user_id = u.user_id
                INNER JOIN 
                    privilegios p
                ON 
                    p.priv_id = u.priv_id
                INNER JOIN 
                    usuarios mu
                ON 
                    mu.user_id = a.modificador_id
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
                ORDER BY 
                    auditoria_id DESC;";
}


$lista_usuarios = mysqli_query($link, $usuarios);

// Dropdown Perfiles
$usuarios_id = "SELECT user_id, user_nombre FROM usuarios;";

$lista_usuarios_id = mysqli_query($link, $usuarios_id);

include_once 'menu/header.php';

?>

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Últimos Usuarios Modificados
        </small>
    </h1>
</div><!-- /.page-header -->

<!-- Boton Superior Tabla -->
<form action="auditoria_usuarios.php" method="POST" id="form1" name="form1">
    <!-- Grupo de Soporte -->
    <div class="row">
        <div class="col-sm-1">
            <b>Buscar Usuario:</b>
        </div>
        <div class="col-sm-2">
            <!-- <div class="col-auto my-1"> -->
            <select name="buscar_usuario" class="form-control" onchange="submitForm();">
                <option value="">Seleccionar un Usuario</option>
                <?php
                while ($row_usuarios = mysqli_fetch_assoc($lista_usuarios_id)) {
                    echo "<option value=" . $row_usuarios['user_id'] . ">" . $row_usuarios['user_nombre'] . "</option>";
                }
                ?>
            </select>
            <!-- </div> -->
        </div>
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
                                    <th class="text-center">Modificador</th>
                                    <th class="text-center">Nombre Completo</th>
                                    <th class="text-center">Empresa</th>
                                    <th class="text-center">Web Empresa</th>
                                    <th class="text-center">Dirección</th>
                                    <th class="text-center">Telefono</th>
                                    <th class="text-center">Cargo</th>
                                    <th class="text-center">Correo Electronico</th>
                                    <th class="text-center">Fecha Modificación</th>
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
                                                <?php echo $row['user_nombre_mod']; ?>
                                            </td>
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
                                                <?php echo $row['auditoria_fecha_creacion']; ?>
                                            </td>
                                            <td class="pt-3-half">
                                                <?php echo $row['priv_titulo']; ?>
                                            </td>
                                            <td>
                                                <a href="auditoria_usuarios_detalle.php?id=<?php echo $row['user_id']; ?>" style="text-decoration: none">
                                                    <i class="ace-icon fa fa-file-text-o bigger-230 text-pimary"> </i>
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
                <input type="text" name="archivo" value="auditoria_usuarios.csv" hidden>
                <input type="text" name="tipo_reporteria" value="auditoria_usuarios" hidden>
                <input type="text" name="querySelect" value="<?php echo $usuarios; ?>" hidden>
                <button type="submit" class="btn btn-success col-sm-1" id="submit-form3" name="submit-form3">
                    <i class="fa fa-download"></i>
                    Exportar
                </button>
            </form>
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