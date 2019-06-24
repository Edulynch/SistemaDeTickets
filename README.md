# SistemaDeTickets

## Index/Login
### Login Por Defecto: 
### Usuario: admin@softicket.cl
### Contraseña: 123456

![1](https://user-images.githubusercontent.com/7959627/54503654-f75dcc00-490e-11e9-8d9b-f9d012aabb5e.PNG)
## Registro
![2](https://user-images.githubusercontent.com/7959627/54503661-f9278f80-490e-11e9-8cda-26b7a616a5c1.PNG)
## Formulario
![3](https://user-images.githubusercontent.com/7959627/54503667-f9c02600-490e-11e9-9ee9-14208efd6ec5.PNG)


## Instrucciones:
### Para que el Proyecto funcione, debemos crear la Base de Datos: "tickets".
### Luego debemos restaurar el siguiente script.
## Base de Datos MYSQL 

```sql
-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2019 a las 10:07:23
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposoporte`
--

CREATE TABLE `gruposoporte` (
  `gsoporte_id` int(11) NOT NULL,
  `gsoporte_titulo` varchar(50) DEFAULT NULL,
  `gsoporte_descripcion` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposoporte_usuarios`
--

CREATE TABLE `gruposoporte_usuarios` (
  `gsoporte_usuarios_id` int(11) NOT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `priv_id` int(11) NOT NULL,
  `priv_titulo` varchar(50) DEFAULT NULL,
  `priv_descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`priv_id`, `priv_titulo`, `priv_descripcion`) VALUES
(1, 'Administrador', 'Dios de la web'),
(2, 'Tecnico', 'Soporte TI'),
(3, 'Usuario', 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_titulo` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tecnico_id` int(11) DEFAULT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `ticket_descripcion` varchar(255) DEFAULT NULL,
  `ticket_estado_id` int(1) NOT NULL DEFAULT 1,
  `ticket_fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `ticket_fecha_actualizado` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_estado`
--

CREATE TABLE `ticket_estado` (
  `ticket_estado_id` int(11) NOT NULL,
  `ticket_estado_titulo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ticket_estado`
--

INSERT INTO `ticket_estado` (`ticket_estado_id`, `ticket_estado_titulo`) VALUES
(1, 'Abierto'),
(2, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_nombre` varchar(50) DEFAULT NULL,
  `user_correo` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_empresa` varchar(50) DEFAULT NULL,
  `user_direccion` varchar(50) DEFAULT NULL,
  `user_telefono` varchar(15) DEFAULT NULL,
  `user_web_empresa` varchar(50) DEFAULT NULL,
  `user_cargo` varchar(50) DEFAULT NULL,
  `priv_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_nombre`, `user_correo`, `user_password`, `user_empresa`, `user_direccion`, `user_telefono`, `user_web_empresa`, `user_cargo`, `priv_id`) VALUES
(1, 'Administrador', 'admin@softicket.cl', '123456', 'Softicket Consulting', 'Inacap Apoquindo', '912345678', 'http://www.softicket.cl', 'Administrador Global', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gruposoporte`
--
ALTER TABLE `gruposoporte`
  ADD PRIMARY KEY (`gsoporte_id`);

--
-- Indices de la tabla `gruposoporte_usuarios`
--
ALTER TABLE `gruposoporte_usuarios`
  ADD PRIMARY KEY (`gsoporte_usuarios_id`),
  ADD UNIQUE KEY `idx_gruposoporte_usuarios` (`gsoporte_id`,`user_id`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`priv_id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indices de la tabla `ticket_estado`
--
ALTER TABLE `ticket_estado`
  ADD PRIMARY KEY (`ticket_estado_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

### Modulos Funcionales
##### - Generador de Codigos para Ticket (OT-0000000XXX)
##### - Login de Usuarios
##### - Registro de Usuarios
##### - Registro de Tickets
##### - Perfil de Usuario
##### - Bandeja de Tickets por Grupo
##### - Bandeja de Tickets por Usuario

### Modulos NO Funcionales
##### - Agregar Comentarios en Tickets
##### - Seguridad de Permisos por Usuario
##### - Confirmar Validaciones de Todos los Formularios (Ingreso/Editar)

### Eres libre de usar el Código en Tus Proyectos
### Proposito del Repositorio: Inacap Apoquindo
