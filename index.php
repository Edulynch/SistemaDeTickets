<?php

if (isset($_COOKIE['user_id']) && count($_COOKIE) != 0) {
    if ($_COOKIE['priv_id'] == 1) {
        header("Location: http://softicket.cl/Dashboard");
    } else {
        header("Location: http://softicket.cl/perfil");
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="estilos/index.css">
    <title>Softicket</title>
</head>

<body>
    <div id="logreg-forms">
        <form action="index.php" method="post" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"><strong>Inicicar Sesión</strong></h1>
            <!--<div class="social-login">-->
            <!--<button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>-->
            <!--<button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>-->
            <!--</div>-->
            <!--<p style="text-align:center"> OR  </p>-->
            <input type="email" id="inputEmail" name="login_correo" class="form-control" placeholder="Correo Electronico" required="" autofocus="">
            <input type="password" id="inputPassword" name="login_password" class="form-control" placeholder="Contraseña" required="">

            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Entrar</button>
            <!--<a href="#" id="forgot_pswd">Registrate ¡Click Aquí!</a>-->
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <!-- <button onclick="location.href='registro.php';" class="btn btn-primary btn-block" type="button"><i
                    class="fas fa-user-plus"></i> Registrate
        </button> -->
        </form>

        <!-- <br> -->

    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>
<?php

include_once 'config.php';
include_once 'conexion.php';

$link = Conectarse('usuarios');

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['login_correo']) &&
    isset($_POST['login_password'])
) {
    $login_correo = limpiar($_POST['login_correo']);
    $login_password = limpiar($_POST['login_password']);

    $query = "SELECT * FROM tickets.usuarios WHERE user_correo = " . "'" .  $login_correo . "'" . " AND user_password = " .  $login_password . " LIMIT 1;";

    mysqli_set_charset($link, "utf8");

    $ticket = mysqli_query($link, $query);

    $row = $ticket->fetch_assoc();

    if (!empty($row["user_id"])) {
        setcookie("user_id", $row["user_id"], time() + 30 * 24 * 60 * 60);
        setcookie("priv_id", $row["priv_id"], time() + 30 * 24 * 60 * 60);
        setcookie("user_nombre", $row["user_nombre"], time() + 30 * 24 * 60 * 60);
        if ($row["priv_id"] == 1) {
            header("Location: http://softicket.cl/dashboard");
        } else {
            header("Location: http://softicket.cl/perfil");
        }
    } else {
        setcookie("user_id", "", time() - 3600);
        setcookie("priv_id", "", time() - 3600);
        setcookie("user_nombre", "", time() - 3600);
    }
}

?>