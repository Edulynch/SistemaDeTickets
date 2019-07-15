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

$registrado = false;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

	$user_cargo = limpiar($_POST['user_cargo']);
	$user_correo = limpiar($_POST['user_correo']);
	$user_direccion = limpiar($_POST['user_direccion']);
	$user_empresa = limpiar($_POST['user_empresa']);
	$user_nombre = limpiar($_POST['user_nombre']);
	$user_password = limpiar($_POST['user_password']);
	$user_telefono = limpiar($_POST['user_telefono']);
	$user_web_empresa = limpiar($_POST['user_web_empresa']);
	$user_priv_id = limpiar($_POST['user_priv_id']);

	$query_correo = "SELECT user_correo
	FROM tickets.usuarios
	WHERE user_correo = '$user_correo';";

	$ticketcorreo = mysqli_query($link, $query_correo);

	$row = $ticketcorreo->fetch_assoc();

	if (empty($row['user_correo']) || $row['user_correo'] == "") {

		$query = "INSERT INTO tickets.usuarios 
		(
		user_id,
		user_cargo,
		user_correo,
		user_direccion,
		user_empresa,
		user_nombre,
		user_password,
		user_telefono,
		user_web_empresa,
		priv_id
		) 
		VALUES
		(
		NULL, 
		'$user_cargo', 
		'$user_correo',
		'$user_direccion',
		'$user_empresa',
		'$user_nombre',
		PASSWORD('$user_password'),
		'$user_telefono',
		'$user_web_empresa',
		'$user_priv_id'
		);";

		$ticket = mysqli_query($link, $query);

		$registrado = true;
	} else {
		echo '<script language="javascript">';
		echo 'alert("El correo ya existe, no se realizará el registro.")';
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
			Registrar Usuarios
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
					<i class="ace-icon fa fa-user-plus blue"></i>
					Registrar Usuario
				</h4>
			</div>

			<div class="container">

				<form method="post" id="user_form" action="usuarios_registrar.php">

					<div class="form-group">
						<label for="user_nombre" class="control-label col-md-3"> Nombre Completo<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="50" id="user_nombre" name="user_nombre" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_empresa" class="control-label col-md-3 "> Empresa<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="50" id="user_empresa" name="user_empresa" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_web_empresa" class="control-label col-md-3 "> Web Empresa<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="50" id="user_web_empresa" name="user_web_empresa" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_direccion" class="control-label col-md-3 "> Dirección<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="50" id="user_direccion" name="user_direccion" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_telefono" class="control-label col-md-3 "> Telefono<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="15" id="user_telefono" name="user_telefono" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_cargo" class="control-label col-md-3 "> Cargo<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="15" id="user_cargo" name="user_cargo" style="margin-bottom: 10px" type="text" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_correo" class="control-label col-md-3  "> Correo Electronico<span>*</span> </label>
						<div class="controls col-md-9">
							<input class="input-md form-control" maxlength="255" id="user_correo" name="user_correo" style="margin-bottom: 10px" type="email" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_password" class="control-label col-md-3  ">Contraseña<span>*</span> </label>
						<div class="controls col-md-9 ">
							<input class="input-md form-control" maxlength="255" id="user_password" name="user_password" style="margin-bottom: 10px" type="password" />
						</div>
					</div>

					<div class="form-group">
						<label for="user_priv_id" class="control-label col-md-3 "> Tipo de Privilegio<span>*</span> </label>
						<div class="controls col-md-9 " style="margin-bottom: 10px">
							<label class="radio-inline"> <input type="radio" name="user_priv_id" id="user_priv_id" value="1" style="margin-bottom: 10px">Administrador</label>
							<br />
							<label class="radio-inline"> <input type="radio" name="user_priv_id" id="user_priv_id" value="2" style="margin-bottom: 10px">Tecnico </label>
							<br />
							<label class="radio-inline"> <input type="radio" name="user_priv_id" id="user_priv_id" value="3" style="margin-bottom: 10px">Usuario </label>
						</div>
					</div>

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