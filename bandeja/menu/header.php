<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Softicket</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
        <![endif]-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body class="no-skin">

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {}
            </script>


            <ul class="nav nav-list">
                <li class="active">
                    <a href="index.php">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text"> Dashboard </span>
                    </a>

                    <b class="arrow"></b>
                </li>


                <li class="">
                    <a href="index.php">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <span class="menu-text"> Bandeja de Tickets </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <b class="arrow"></b>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-file-text "></i>
                        <span class="menu-text"> Ticket de Soporte </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="/formulario.php">
                                <i class="menu-icon fa fa-plus"></i>
                                Registrar
                            </a>
                        </li>
                    </ul>

                    <?php

                    //3 ==> Usuario
                    if ($_COOKIE['priv_id'] != 3) {

                        ?>

                        <ul class="submenu">
                            <li class="">
                                <a href="tickets_asignado_grupo.php">
                                    <i class="menu-icon fa fa-cog"></i>
                                    Tickets Asignados En Mis Grupos
                                </a>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="">
                                <a href="tickets_asginado_a_mi.php">
                                    <i class="menu-icon fa fa-cog"></i>
                                    Tickets Asignados a mi
                                </a>
                            </li>
                        </ul>

                    <?php
                }
                ?>

                    <ul class="submenu">
                        <li class="">
                            <a href="tickets_abiertos_enviados.php">
                                <i class="menu-icon fa fa-cog"></i>
                                Tickets Abiertos Enviados
                            </a>
                        </li>
                    </ul>

                    <ul class="submenu">
                        <li class="">
                            <a href="tickets_cerrados_enviados.php">
                                <i class="menu-icon fa fa-cog"></i>
                                Tickets Cerrados Enviados
                            </a>
                        </li>
                    </ul>

                    <b class="arrow"></b>
                </li>
            </ul>
            </li>


            </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="../perfil/" style="none;color:black">
                                <?php
                                echo $_COOKIE['user_nombre'];
                                ?>
                            </a>
                            <a href="/salir.php" class="RED">
                                [Cerrar sesion]
                                <!-- <i class="ace-icon fa fa-trash-o"></i> -->
                            </a>
                        </li>
                    </ul><!-- /.breadcrumb -->


                </div>

                <div class="page-content">