-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2020 a las 08:02:14
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
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_proveedor` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Direccion` text NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Ejecutivo` varchar(70) NOT NULL,
  `Correo` varchar(70) NOT NULL,
  `Cuenta_bancaria` int(40) NOT NULL,
  `Categoria` varchar(70) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`Id_proveedor`, `Nombre`, `Direccion`, `RFC`, `Telefono`, `Ejecutivo`, `Correo`, `Cuenta_bancaria`, `Categoria`, `Estado`) VALUES
(1, 'Mublezone', 'Calle 14, agua prieta', 'RFASLDO231231', '544333222', 'Jorge Martinez', 'jorge@jorge.com', 23333, 'Muebles', 0),
(2, 'Zone Providers', 'Calle 22, agua prieta', 'RFASLDO231234', '44444433', 'Marcos Morales', 'marcos@mora.com', 5555, 'Roperos', 1),
(3, 'MagaMuebles', 'Calle 43, agua prieta', 'RFASLDO231232', '433455', 'Jorge Luis', 'luis@jo.com', 3434, 'Blancos', 0),
(4, 'Kabum kasa', 'Calle 24, agua prieta', 'RFASLDO233133', '64665665', 'Miguel De la Madrid', 'miguel@m.com', 43443, 'Linea blanca', 1),
(5, 'Casa WOW!', 'Calle 14 avenida 1, agua prieta', 'RFASLDO231276', '455666777', 'Adilene Valencia', 'adi@a.com', 4545, 'Roperos', 1),
(6, 'ZoneProviders 2', 'Calle 45', 'RFASLDO231244', '445556', 'Miguel Mal', 'miguel@m.com', 3445356, 'Ropero', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`Id_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
