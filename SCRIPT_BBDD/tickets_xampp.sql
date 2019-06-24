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

--
-- Volcado de datos para la tabla `gruposoporte`
--

INSERT INTO `gruposoporte` (`gsoporte_id`, `gsoporte_titulo`, `gsoporte_descripcion`, `user_id`) VALUES
(1, 'Soporte TI', 'Soporte TI', NULL),
(2, 'BIG DATA', 'BIG DATA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposoporte_usuarios`
--

CREATE TABLE `gruposoporte_usuarios` (
  `gsoporte_usuarios_id` int(11) NOT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gruposoporte_usuarios`
--

INSERT INTO `gruposoporte_usuarios` (`gsoporte_usuarios_id`, `gsoporte_id`, `user_id`) VALUES
(38, 1, 2),
(42, 2, 2),
(43, 2, 4),
(1, 3, 2),
(3, 3, 4),
(10, 11, 2),
(24, 11, 4);

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

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `ticket_titulo`, `user_id`, `tecnico_id`, `gsoporte_id`, `ticket_descripcion`, `ticket_estado_id`, `ticket_fecha_creacion`, `ticket_fecha_actualizado`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 00:30:13', '2019-06-24 00:30:13'),
(2, 'SOPORTE DWH', 4, 2, 1, 'SOPORTE DWH', 1, '2019-06-24 00:30:19', '2019-06-24 03:08:36'),
(3, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 00:30:19', '2019-06-24 00:30:19'),
(4, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 01:27:38', '2019-06-24 01:27:38'),
(5, 'SOPORTE DWH', 4, 4, 1, 'SOPORTE DWH', 2, '2019-06-24 01:27:46', '2019-06-24 02:02:56'),
(6, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 01:27:46', '2019-06-24 01:27:46'),
(7, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 01:29:30', '2019-06-24 01:29:30'),
(8, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:32:47', '2019-06-24 03:32:47'),
(9, 'SOPORTE DWH BIG DATA', 1, NULL, 2, 'SOPORTE DWH BIG DATA', 1, '2019-06-24 03:33:07', '2019-06-24 03:33:07'),
(10, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:33:07', '2019-06-24 03:33:07'),
(11, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:33:30', '2019-06-24 03:33:30'),
(12, 'SOPORTE DWH BIG DATA', 1, NULL, 2, 'SOPORTE DWH BIG DATA', 1, '2019-06-24 03:33:34', '2019-06-24 03:33:34'),
(13, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:33:34', '2019-06-24 03:33:34'),
(14, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:47:53', '2019-06-24 03:47:53'),
(15, 'SOPORTE TI - BIG DATA', 4, NULL, 2, 'SOPORTE TI - BIG DATA', 1, '2019-06-24 03:48:05', '2019-06-24 03:48:05'),
(16, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:48:05', '2019-06-24 03:48:05'),
(17, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 03:48:07', '2019-06-24 03:48:07'),
(18, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 04:04:24', '2019-06-24 04:04:24'),
(19, 'SOPORTE DWH - Probando Usuario', 7, NULL, 1, 'SOPORTE DWH - Probando Usuario', 1, '2019-06-24 04:04:36', '2019-06-24 04:04:36'),
(20, NULL, NULL, NULL, NULL, NULL, 1, '2019-06-24 04:04:36', '2019-06-24 04:04:36');

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
(1, 'Eduardo Lynch Araya', 'eduardolynch94@gmail.com', '123456', 'Eware Consulting', 'Amunategui 20, Santiago', '+56996630457', 'www.eware.com', 'Consultor Informático', 1),
(2, 'Alvaro Cardoza', 'acardoza@carcom.com', '123456', 'Carcom', 'Quilicura 1234, Santiago', '+56912345678', 'www.carcom.com', 'Soporte Informático', 2),
(4, 'pier miqueles', 'pier@inacap.cl', '123456', 'inacap', 'apoquindo 123', '996630474', 'http://www.inacap.cl', 'Profesor', 2),
(7, 'sdasdazzzzxxxaaaa', 'hola@hola.cl', '123456', 'everis', 'apoquindo 123', '912345672', 'http://www.youtube.com', 'analista', 3);

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
-- AUTO_INCREMENT de la tabla `gruposoporte`
--
ALTER TABLE `gruposoporte`
  MODIFY `gsoporte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gruposoporte_usuarios`
--
ALTER TABLE `gruposoporte_usuarios`
  MODIFY `gsoporte_usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ticket_estado`
--
ALTER TABLE `ticket_estado`
  MODIFY `ticket_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
