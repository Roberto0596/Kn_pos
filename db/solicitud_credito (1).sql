-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2020 a las 07:54:09
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kn_pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_credito`
--

CREATE TABLE `solicitud_credito` (
  `id_solicitud` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `num_placas` varchar(50) NOT NULL,
  `estado_civil` varchar(100) NOT NULL,
  `casa` varchar(150) NOT NULL,
  `profesion` varchar(200) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `dom_empresa` varchar(200) NOT NULL,
  `tel_empresa` varchar(20) NOT NULL,
  `tiempo_casa` varchar(50) NOT NULL,
  `puesto` varchar(200) NOT NULL,
  `sueldo` int(11) NOT NULL,
  `antiguedad` varchar(50) NOT NULL,
  `gastos_mensuales` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_almacen` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_credito`
--

INSERT INTO `solicitud_credito` (`id_solicitud`, `id_cliente`, `num_placas`, `estado_civil`, `casa`, `profesion`, `empresa`, `dom_empresa`, `tel_empresa`, `tiempo_casa`, `puesto`, `sueldo`, `antiguedad`, `gastos_mensuales`, `fecha`, `id_almacen`, `foto`, `tipo`) VALUES
(37, 10, '', 'Soltero', 'Propietario', 'E', 'Blazarsoft', 'E', '(234) 234-2342', '4343', 'E', 899, '1 año', 988, '2020-03-20 05:28:49', 3, 'vistas/img/solicitudes/default/anonymous.png', 0),
(38, 11, 'YUIO', 'Casado', 'Pagandola', 'E', 'E', 'E', '(878) 978-9789', '8 meses', 'E', 8989, '1 año', 8789, '2020-03-20 06:44:21', 3, 'vistas/img/solicitudes/default/anonymous.png', 0),
(39, 32, '234234', 'Casado', 'Pagandola', 'Ninguna', 'E', 'E', '(879) 788-9789', '8 meses', 'E', 8798, 'Menos de un año', 897897, '2020-03-20 06:44:21', 3, 'vistas/img/solicitudes/default/anonymous.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `solicitud_credito`
--
ALTER TABLE `solicitud_credito`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `solicitud_credito`
--
ALTER TABLE `solicitud_credito`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
