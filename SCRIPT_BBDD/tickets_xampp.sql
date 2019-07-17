-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2019 a las 07:27:39
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

DROP TABLE IF EXISTS `gruposoporte`;
CREATE TABLE `gruposoporte` (
  `gsoporte_id` int(11) NOT NULL,
  `gsoporte_titulo` varchar(50) DEFAULT NULL,
  `gsoporte_descripcion` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposoporte_historico`
--

DROP TABLE IF EXISTS `gruposoporte_historico`;
CREATE TABLE `gruposoporte_historico` (
  `gsoportehist_id` int(11) NOT NULL,
  `gsoporte_id` int(11) NOT NULL,
  `gsoporte_titulo` varchar(50) DEFAULT NULL,
  `gsoporte_descripcion` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_id_mod` int(11) DEFAULT NULL,
  `fecha_mod` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposoporte_usuarios`
--

DROP TABLE IF EXISTS `gruposoporte_usuarios`;
CREATE TABLE `gruposoporte_usuarios` (
  `gsoporte_usuarios_id` int(11) NOT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE `privilegios` (
  `priv_id` int(11) NOT NULL,
  `priv_titulo` varchar(50) DEFAULT NULL,
  `priv_descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `privilegios`
--

TRUNCATE TABLE `privilegios`;
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

DROP TABLE IF EXISTS `ticket`;
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

DROP TABLE IF EXISTS `ticket_estado`;
CREATE TABLE `ticket_estado` (
  `ticket_estado_id` int(11) NOT NULL,
  `ticket_estado_titulo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `ticket_estado`
--

TRUNCATE TABLE `ticket_estado`;
--
-- Volcado de datos para la tabla `ticket_estado`
--

INSERT INTO `ticket_estado` (`ticket_estado_id`, `ticket_estado_titulo`) VALUES
(1, 'Abierto'),
(2, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_historico`
--

DROP TABLE IF EXISTS `ticket_historico`;
CREATE TABLE `ticket_historico` (
  `tickethist_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_titulo` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tecnico_id` int(11) DEFAULT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `ticket_descripcion` varchar(255) DEFAULT NULL,
  `ticket_estado_id` int(1) NOT NULL,
  `ticket_fecha_creacion` datetime NOT NULL,
  `ticket_fecha_actualizado` datetime NOT NULL,
  `user_id_mod` int(11) DEFAULT NULL,
  `fecha_mod` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_nombre` varchar(50) NOT NULL,
  `user_correo` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_empresa` varchar(50) NOT NULL,
  `user_direccion` varchar(50) NOT NULL,
  `user_telefono` varchar(15) NOT NULL,
  `user_web_empresa` varchar(50) NOT NULL,
  `user_cargo` varchar(50) NOT NULL,
  `user_fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `priv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_nombre`, `user_correo`, `user_password`, `user_empresa`, `user_direccion`, `user_telefono`, `user_web_empresa`, `user_cargo`, `user_fecha_creacion`, `priv_id`) VALUES
(1, 'Administrador', 'admin@admin.com', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Eware Consulting', 'Amunategui 20, Santiago', '+56996630457', 'www.eware.com', 'Consultor Informático', '2019-07-07 00:00:00', 1),
(2, 'TecnicoABCD', 'tecnico@tecnico.com', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Carcom', 'Quilicura 1234, Santiago', '+56912345678', 'www.carcom.com', 'Soporte Informático', '2019-07-07 00:00:00', 2),
(3, 'UsuarioABCDE', 'usuario@usuario.com', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Junaeb Consulting', 'Bandera 2331, Santiago', '+56996612547', 'www.junaeb.com', 'Administrador DBA', '2019-07-01 00:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_historico`
--

DROP TABLE IF EXISTS `usuarios_historico`;
CREATE TABLE `usuarios_historico` (
  `userhist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_nombre` varchar(50) NOT NULL,
  `user_correo` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_empresa` varchar(50) NOT NULL,
  `user_direccion` varchar(50) NOT NULL,
  `user_telefono` varchar(15) NOT NULL,
  `user_web_empresa` varchar(50) NOT NULL,
  `user_cargo` varchar(50) NOT NULL,
  `user_fecha_creacion` date NOT NULL,
  `priv_id` int(11) NOT NULL,
  `user_id_mod` int(11) DEFAULT NULL,
  `fecha_mod` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gruposoporte`
--
ALTER TABLE `gruposoporte`
  ADD PRIMARY KEY (`gsoporte_id`);

--
-- Indices de la tabla `gruposoporte_historico`
--
ALTER TABLE `gruposoporte_historico`
  ADD PRIMARY KEY (`gsoportehist_id`);

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
-- Indices de la tabla `ticket_historico`
--
ALTER TABLE `ticket_historico`
  ADD PRIMARY KEY (`tickethist_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `usuarios_historico`
--
ALTER TABLE `usuarios_historico`
  ADD PRIMARY KEY (`userhist_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gruposoporte`
--
ALTER TABLE `gruposoporte`
  MODIFY `gsoporte_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gruposoporte_historico`
--
ALTER TABLE `gruposoporte_historico`
  MODIFY `gsoportehist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gruposoporte_usuarios`
--
ALTER TABLE `gruposoporte_usuarios`
  MODIFY `gsoporte_usuarios_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_estado`
--
ALTER TABLE `ticket_estado`
  MODIFY `ticket_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ticket_historico`
--
ALTER TABLE `ticket_historico`
  MODIFY `tickethist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios_historico`
--
ALTER TABLE `usuarios_historico`
  MODIFY `userhist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
