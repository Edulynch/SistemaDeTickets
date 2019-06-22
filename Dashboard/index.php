<?php

if (
	!isset($_COOKIE['user_id'])
	|| !isset($_COOKIE['user_nombre'])
	|| count($_COOKIE) == 0
	|| !isset($_COOKIE['priv_id'])
	|| $_COOKIE['priv_id'] != 1 //Administrador
) {
	header("Location: http://softicket.cl");
}

include_once 'menu/header.php'

?>

<div class="page-header">
	<h1>
		Dashboard
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<h4> Bienvenido Administrador(a)</h4>
	<br />
	<h6> Los modulos de administración se encuentran al lado izquierdo.</h6>
	<br />
	<h6> Elija el modulo que desea manejar.</h6>
	<br />
	<h6> Saludos.</h5>
		<br />
		<h6> Atte. Developers</h6>
</div>

</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<?php

include_once 'menu/footer.php'

?>