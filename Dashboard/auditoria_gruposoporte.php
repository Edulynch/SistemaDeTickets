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

// Dropdown tecnicos
$gruposoporte = "SELECT 
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
gh.gsoportehist_id IN (SELECT 
        MAX(gsoportehist_id)
    FROM
        gruposoporte_historico z
    GROUP BY gsoporte_id
    ORDER BY fecha_mod DESC)
ORDER BY fecha_mod DESC;";

$lista_gruposoporte = mysqli_query($link, $gruposoporte);

include_once 'menu/header.php'

?>


<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Listado de Grupos de Soporte
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
                                    <th class="text-center">Modificador</th>
                                    <th class="text-center">Nombre Grupo Soporte</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Fecha Modificación</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($lista_gruposoporte) {
                                    while ($row = $lista_gruposoporte->fetch_assoc()) {
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
                                            <td>
                                                <a href="auditoria_gsoporte_detalle.php?id=<?php echo $row['gsoporte_id']; ?>" style="text-decoration: none">
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
        </div>

        <div class="hr hr32 hr-dotted"></div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

<?php

include_once 'menu/footer.php'

?>