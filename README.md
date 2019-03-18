# SistemaDeTickets

## Index/Login
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
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2019 a las 03:35:11
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

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
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(10) UNSIGNED ZEROFILL NOT NULL,
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

## Modulos Funcionales
### Generador de Codigos para Ticket (OT-0000000XXX)

## Modulos NO Funcionales
### - Login de Usuarios
### - Registro de Usuarios
### - Registro de Tickets
### - Perfil de Usuario
### - Bandeja de Tickets por Grupo
### - Bandeja de Tickets por Usuario

### Eres libre de usar el Código en Tus Proyectos
### Proposito del Repositorio: Inacap Apoquindo
