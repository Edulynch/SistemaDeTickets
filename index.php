<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="estilos/index.css">
    <title>Bootstrap 4 Login/Register Form</title>
</head>
<body>
<div id="logreg-forms">
    <form action="formulario.php" method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"><strong>Inicicar Sesión</strong></h1>
        <!--<div class="social-login">-->
        <!--<button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>-->
        <!--<button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>-->
        <!--</div>-->
        <!--<p style="text-align:center"> OR  </p>-->
        <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electronico" required=""
               autofocus="">
        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="">

        <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Entrar</button>
        <!--<a href="#" id="forgot_pswd">Registrate ¡Click Aquí!</a>-->
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <button onclick="location.href='registro.php';" class="btn btn-primary btn-block" type="button"><i
                    class="fas fa-user-plus"></i> Registrate
        </button>
    </form>

    <br>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>