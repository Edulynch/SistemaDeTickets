<?php

include_once '../config.php';

if (
	!isset($_COOKIE['user_id'])
	|| !isset($_COOKIE['user_nombre'])
	|| count($_COOKIE) == 0
	|| !isset($_COOKIE['priv_id'])
) {
	header("Location: " . SITIO_WEB);
}

include_once 'menu/header.php'

?>

<div class="page-header">
	<h1>
		Dashboard
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<h4> Bienvenidos(as)</h4>
	<br />
	<h6> Los modulos de ticket se encuentran al lado izquierdo.</h6>
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