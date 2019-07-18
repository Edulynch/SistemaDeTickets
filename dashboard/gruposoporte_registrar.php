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

// // Dropdown tecnicos
$query_tecnicos = "SELECT user_id,user_nombre
FROM usuarios
where priv_id = 2;";

$ticket_tenicos = mysqli_query($link, $query_tecnicos);

$registrado = false;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

	$gsoporte_titulo = limpiar($_POST['gsoporte_titulo']);
	$gsoporte_descripcion = limpiar($_POST['gsoporte_descripcion']);
	// $gsoporte_user_id = limpiar($_POST['gsoporte_user_id']);

	// $query_correo = "SELECT gsoporte_titulo
	// FROM usuarios
	// WHERE gsoporte_titulo = '$gsoporte_titulo';";

	// $ticketcorreo = mysqli_query($link, $query_correo);

	// $row = $ticketcorreo->fetch_assoc();

	if (empty($row['gsoporte_titulo']) || $row['gsoporte_titulo'] == "") {

		$query = "INSERT INTO gruposoporte 
		(
		gsoporte_id,
		gsoporte_titulo,
		gsoporte_descripcion
		) 
		VALUES
		(
		NULL, 
		'$gsoporte_titulo',
		'$gsoporte_descripcion'
		);";

		$ticket = mysqli_query($link, $query);

		$registrado = true;
	} else {
		echo '<script language="javascript">';
		echo 'alert("El Grupo de Soporte ya existe, no se realizará el registro.")';
		echo '</script>';
	}
}

include_once 'menu/header.php'


?>

<div class="page-header">
	<h1>
		Dashboard
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Registrar Grupo de Soporte
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

	</div>

	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title lighter smaller">
					<i class="ace-icon fa fa-plus blue"></i>
					Registrar Grupo de Soporte
				</h4>
			</div>

			<div class="container">

				<form method="post" id="gsoporte_form" action="gruposoporte_registrar.php">

					<div class="form-group">
						<label for="gsoporte_titulo" class="control-label col-md-3"> Titulo del Grupo<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="50" id="gsoporte_titulo" name="gsoporte_titulo" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="gsoporte_descripcion" class="control-label col-md-3 "> Descripción del Grupo<span>*</span> </label>
						<div class="controls col-md-9">
							<textarea class="input-md form-control" id="gsoporte_descripcion" name="gsoporte_descripcion" style="margin-bottom: 10px" type="text" cols="30" rows="3"></textarea>
						</div>
					</div>

					<!-- <div class="form-group">
						<label for="gsoporte_user_id" class="control-label col-md-3 "> Usuario del Grupo<span>*</span> </label>
						<div class="controls col-md-9">
							<select class="form-control input-md dropdown-toggle" id="user_tenico" style="margin-bottom: 10px">

								// <?php
									// while ($lista_tecnicos = mysqli_fetch_assoc($ticket_tenicos)) {
									// 	echo "<option value=" . $lista_tecnicos['user_id'] . ">" . $lista_tecnicos['user_nombre'] . "</option>";
									// }

									?>
							</select>

						</div>

					</div> -->

					<?php
					if ($registrado == true) {

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
						<div class="controls col-md-9 ">
							<input type="reset" value="Limpiar" class="btn btn-success" id="submit-id-signup" style="margin-bottom: 10px;margin-top: 10px" />
							<input type="submit" value="Enviar" class="btn btn-primary" id="button-id-signup" style="margin-bottom: 10px;margin-top: 10px" />
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
</div><!-- /.widget-box -->
</div><!-- /.col -->
</div><!-- /.row -->

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->

<?php

include_once 'menu/footer.php'

?>