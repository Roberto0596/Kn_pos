-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2020 a las 06:22:49
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
(21, 100018, 25, 6, 3, '2020-03-12', '21:59:44', '[{\"id\":\"5\",\"descripcion\":\"Sala\",\"cantidad\":\"1\",\"existencia\":\"34\",\"precio\":\"10599\",\"total\":\"10599\"}]', '529.95', '10069.05', '500', '9569.05', '[{\"Fecha\":\"2020-03-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-04-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-04-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-05-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-06-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-06-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-07-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-07-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-08-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-08-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-09-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-09-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-10-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-11-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-11-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-12-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2020-12-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-01-30\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-02-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-02-28\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-03-15\",\"Abono\":382.76,\"Estado\":0},{\"Fecha\":\"2021-03-30\",\"Abono\":382.76,\"Estado\":0}]', 'Quincenal', 0),
(22, 100019, 25, 6, 3, '2020-03-14', '21:29:18', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"2\",\"existencia\":\"25\",\"precio\":\"5899\",\"total\":\"11798\"}]', '0', '11798', '60', '11738', '[{\"Fecha\":\"2020-03-20\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-03-27\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":234.76,\"Estado\":0},{\"Fecha\":\"2021-02-26\",\"Abono\":234.76,\"Estado\":0}]', 'Semanal', 0),
(23, 100020, 25, 1, 3, '2020-03-14', '21:29:50', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"2\",\"existencia\":\"23\",\"precio\":\"5899\",\"total\":\"11798\"}]', '0', '11798', '12000', '0', 'N', 'N', 0),
(24, 100021, 25, 1, 3, '2020-03-15', '22:19:51', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"22\",\"precio\":\"5899\",\"total\":\"5899\"}]', '294.95', '5604.05', '6000', '0', 'N', 'N', 0),
(25, 100022, 25, 1, 3, '2020-03-15', '22:20:21', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"21\",\"precio\":\"5899\",\"total\":\"5899\"}]', '294.95', '5604.05', '6000', '0', 'N', 'N', 0),
(26, 100023, 25, 10, 3, '2020-03-15', '22:23:25', '[{\"id\":\"5\",\"descripcion\":\"Sala\",\"cantidad\":\"1\",\"existencia\":\"33\",\"precio\":\"10599\",\"total\":\"10599\"}]', '529.95', '10069.05', '-3', '10072.05', '[{\"Fecha\":\"2020-03-13\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-03-20\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-03-27\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":201.44,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":201.44,\"Estado\":0}]', 'Semanal', 0),
(27, 100024, 25, 10, 3, '2020-03-15', '22:33:32', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"20\",\"precio\":\"5899\",\"total\":\"5899\"}]', '235.96', '5663.04', '89', '5574.04', '[{\"Fecha\":\"2020-03-20\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-03-27\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":111.48,\"Estado\":0},{\"Fecha\":\"2021-02-26\",\"Abono\":111.48,\"Estado\":0}]', 'Semanal', 0),
(28, 100025, 25, 10, 3, '2020-03-17', '19:33:48', '[{\"id\":\"6\",\"descripcion\":\"Ropero\",\"cantidad\":\"1\",\"existencia\":\"29\",\"precio\":\"6899\",\"total\":\"6899\"}]', '344.95', '6554.05', '80', '6474.05', '[{\"Fecha\":\"2020-03-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-03-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-04-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-04-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-05-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-06-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-06-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-07-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-07-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-08-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-08-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-09-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-09-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-10-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-11-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-11-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-12-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2020-12-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2021-01-30\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2021-02-15\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2021-02-28\",\"Abono\":258.96,\"Estado\":0},{\"Fecha\":\"2021-03-15\",\"Abono\":258.96,\"Estado\":0}]', 'Quincenal', 0),
(29, 100026, 25, 10, 3, '2020-03-17', '19:35:23', '[{\"id\":\"6\",\"descripcion\":\"Ropero\",\"cantidad\":\"1\",\"existencia\":\"28\",\"precio\":\"6899\",\"total\":\"6899\"}]', '344.95', '6554.05', '7000', '0', 'N', 'N', 1);

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
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
