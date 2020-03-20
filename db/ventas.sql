-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2020 a las 23:22:40
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
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Id_venta` int(11) NOT NULL,
  `Folio` int(11) NOT NULL,
  `Id_usuario` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `Id_almacen` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `ListaProductos` text NOT NULL,
  `Descuento` varchar(20) NOT NULL,
  `TotalVenta` varchar(30) NOT NULL,
  `TotalPago` varchar(30) NOT NULL,
  `Pendiente` varchar(20) NOT NULL,
  `CalendarioAbonos` text NOT NULL,
  `TipoAbono` varchar(40) NOT NULL,
  `TipoVenta` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Id_venta`, `Folio`, `Id_usuario`, `Id_cliente`, `Id_almacen`, `Fecha`, `Hora`, `ListaProductos`, `Descuento`, `TotalVenta`, `TotalPago`, `Pendiente`, `CalendarioAbonos`, `TipoAbono`, `TipoVenta`) VALUES
(13, 100013, 25, 1, 3, '2020-03-11', '22:40:34', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonials\",\"cantidad\":\"1\",\"existencia\":\"16\",\"precio\":\"899\",\"total\":\"899\"}]', '0', '899', '900', '0', 'N', 'N', 0),
(20, 100017, 25, 6, 3, '2020-03-11', '23:07:19', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonials\",\"cantidad\":\"1\",\"existencia\":\"12\",\"precio\":\"899\",\"total\":\"899\"}]', '44.95', '854.05', '60', '794.05', '[{\"Fecha\":\"2020-03-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-04-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-04-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-05-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-06-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-06-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-07-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-07-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-08-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-08-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-09-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-09-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-10-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-11-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-11-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-12-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2020-12-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-01-30\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-02-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-02-28\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-03-15\",\"Abono\":31.76,\"Estado\":0},{\"Fecha\":\"2021-03-30\",\"Abono\":31.76,\"Estado\":0}]', 'Quincenal', 0),
(21, 100018, 25, 9, 3, '2020-03-12', '22:14:04', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"26\",\"precio\":\"5899\",\"total\":\"5899\"}]', '3539.4', '2359.6', '635', '1724.6', '[{\"Fecha\":\"2020-03-20\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-03-27\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":34.49,\"Estado\":0},{\"Fecha\":\"2021-02-26\",\"Abono\":34.49,\"Estado\":0}]', 'Semanal', 0),
(22, 100019, 25, 10, 3, '2020-03-20', '15:20:47', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"25\",\"precio\":\"5899\",\"total\":\"5899\"}]', '294.95', '5604.05', '23', '5581.05', '[{\"Fecha\":\"2020-03-27\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-26\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-03-05\",\"Abono\":111.62,\"Estado\":0}]', 'Semanal', 0),
(23, 100020, 25, 10, 3, '2020-03-20', '15:22:09', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"24\",\"precio\":\"5899\",\"total\":\"5899\"}]', '294.95', '5604.05', '9000', '0', 'N', 'N', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
