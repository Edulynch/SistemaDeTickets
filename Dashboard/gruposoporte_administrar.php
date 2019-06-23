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

// Dropdown tecnicos
$gruposoporte = "SELECT * 
FROM tickets.gruposoporte
WHERE length(gsoporte_titulo) > 0;";

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
                                    <th class="text-center">Nombre Grupo Soporte</th>
                                    <th class="text-center">Descripcion</th>
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
                                                <?php echo $row['gsoporte_titulo']; ?>
                                            </td>
                                            <td class="pt-3-half">
                                                <?php echo $row['gsoporte_descripcion']; ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="./gruposoporte_editar.php?id=<?php
                                                                                        echo $row['gsoporte_id'];
                                                                                        ?>" style="text-decoration:none">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e"> </i>
                                                </a>
                                                <a href="./gruposoporte_eliminar.php?id=<?php
                                                                                        echo $row['gsoporte_id'];
                                                                                        ?>" style="text-decoration:none">
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

        <div class="hr hr32 hr-dotted"></div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

<?php

include_once 'menu/footer.php'

?>