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
$usuarios = "SELECT * FROM tickets.usuarios u
inner join tickets.privilegios p
on u.priv_id = p.priv_id;";

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
                                                <?php echo $row['priv_titulo']; ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-230" style="color:#f0ad4e"> </i>
                                                </a>
                                                <a href="#">
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
include_once 'menu/footer.php';
?>