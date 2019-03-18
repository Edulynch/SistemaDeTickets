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

    <form action="/signup/" class="form-signin">
        <!--        <div class="social-login">-->
        <!--            <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>-->
        <!--        </div>-->
        <!--        <div class="social-login">-->
        <!--            <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>-->
        <!--        </div>-->
        <!---->
        <p style="text-align:center">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"><strong>Registrarse</strong></h1></p>

        <input type="text" id="user-name" class="form-control" placeholder="Nombre" required="" autofocus="">
        <input type="text" id="user-lastname" class="form-control" placeholder="Apellido" required="" autofocus="">
        <input type="email" id="user-email" class="form-control" placeholder="Correo Electronico" required autofocus="">

        <input type="password" id="user-pass" class="form-control" placeholder="Contraseña" required autofocus="">
        <input type="password" id="user-repeatpass" class="form-control" placeholder="Repetir Contraseña" required
               autofocus="">

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Crear Cuenta</button>

    </form>
    <br>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>