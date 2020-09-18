-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2020 a las 00:14:00
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
CREATE DATABASE IF NOT EXISTS `kn_pos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kn_pos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

DROP TABLE IF EXISTS `abonos`;
CREATE TABLE `abonos` (
  `id_abono` int(11) NOT NULL,
  `folio_venta` int(11) NOT NULL,
  `folio_pago` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_pago` date NOT NULL,
  `numero_abono` int(3) NOT NULL,
  `cantidad` float NOT NULL,
  `saldo` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id_abono`, `folio_venta`, `folio_pago`, `fecha_vencimiento`, `fecha_pago`, `numero_abono`, `cantidad`, `saldo`, `estado`) VALUES
(1, 100019, 100001, '2020-03-27', '2020-03-27', 1, 111.62, 5469.43, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `nombre`, `ubicacion`, `estado`) VALUES
(3, 'Matriz', 'Agua Prieta, Sonora', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `telefono_casa` varchar(15) NOT NULL,
  `telefono_celular` varchar(15) NOT NULL,
  `ciudad` varchar(75) NOT NULL,
  `edad` int(11) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT 0,
  `asentamiento` varchar(100) NOT NULL,
  `historial` varchar(50) NOT NULL,
  `Credito` int(1) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `codigo_postal`, `telefono_casa`, `telefono_celular`, `ciudad`, `edad`, `tipo`, `asentamiento`, `historial`, `Credito`, `activo`) VALUES
(1, 'CONTADO', 'CONTADO', 'NA', 'NA', 'NA', 'AGUA PRIETA', 0, 0, 'CONTADO', '', 0, 1),
(10, 'Roberto Manuel Cordero Balderas', 'Calle siempre viva #34', '83917', '(234) 234-2342', '(423) 423-4234', 'Benjamín Hill', 48, 0, 'El Picacho', 'Nuevo', 1, 1),
(11, 'Federico daniel villa leyva', 'Calle emiliano zapata', '83364', '', '(634) 015-9555', 'San Miguel de Horcasitas', 19, 0, 'El Tren', 'Medio', 1, 1),
(12, 'Wilber Lopez cliente mejor', 'Calle 12', '84200', '(999) 999-9999', '(444) 444-4444', 'Agua Prieta', 34, 0, 'Centro', 'Nuevo', 1, 1),
(13, 'Lorenzo pedregal', 'Ninguna', '85774', '(234) 234-2342', '(423) 423-4234', 'Alamos', 23, 0, 'Los Amoles', 'Nuevo', 1, 1),
(32, 'Elizabeth zamorano', 'Cantera #1', 'ningu', '(234) 342-3423', '(234) 234-2342', 'Ninguna', 23, 1, 'ninguno', 'ninguno', 0, 1),
(33, 'IjfijTTT', 'AsjdajsduFF', 'ningu', '(958) 585-8585', '(777) 777-7777', 'Agua prieta', 23, 1, 'ninguno', 'ninguno', 0, 1),
(34, 'Cliente Prueba', 'Calle 10', '84200', '(655) 555-5949', '(949) 595-9599', 'Agua Prieta', 27, 0, 'Centro', 'Medio', 1, 1),
(35, 'Client pruena ', 'Calle 10', '84200', '(777) 777-7777', '(777) 777-7777', 'Agua Prieta', 77, 0, 'Centro', 'Medio', 1, 1),
(36, 'Adilene Valencia', 'Calle 49 avenida 10', '84316', '(455) 555-5555', '', 'Agua Prieta', 25, 0, 'El Potrero de la Sierra', 'Bueno', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_conyuge`
--

DROP TABLE IF EXISTS `cliente_conyuge`;
CREATE TABLE `cliente_conyuge` (
  `id` int(11) NOT NULL,
  `id_solicitud_cliente` int(11) NOT NULL,
  `id_solicitud_conyuge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente_conyuge`
--

INSERT INTO `cliente_conyuge` (`id`, `id_solicitud_cliente`, `id_solicitud_conyuge`) VALUES
(3, 38, 39),
(4, 41, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `Id_compra` int(11) NOT NULL,
  `Folio` int(11) NOT NULL,
  `Id_usuario` int(11) NOT NULL,
  `Id_proveedor` int(11) NOT NULL,
  `Id_almacen` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `ListaProductos` text NOT NULL,
  `TotalVenta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`Id_compra`, `Folio`, `Id_usuario`, `Id_proveedor`, `Id_almacen`, `Fecha`, `Hora`, `ListaProductos`, `TotalVenta`) VALUES
(1, 10001, 25, 2, 3, '2020-03-14', '23:45:08', '[{\"id\":\"10\",\"descripcion\":\"Cama\",\"cantidad\":\"3\",\"existencia\":\"-3\",\"precio\":\"400\",\"total\":\"1200\"}]', '1200'),
(2, 10002, 25, 2, 3, '2020-03-15', '00:13:55', '[{\"id\":\"10\",\"descripcion\":\"Cama\",\"cantidad\":\"4\",\"existencia\":\"4\",\"precio\":\"400\",\"total\":\"1600\"}]', '1600'),
(3, 10003, 25, 2, 3, '2020-03-15', '00:14:12', '[{\"id\":\"10\",\"descripcion\":\"Cama\",\"cantidad\":\"3\",\"existencia\":\"7\",\"precio\":\"400\",\"total\":\"1200\"}]', '1200'),
(4, 10004, 25, 2, 3, '2020-03-16', '00:50:12', '[{\"id\":\"15\",\"descripcion\":\"productonuevo\",\"cantidad\":\"3\",\"existencia\":\"3\",\"precio\":\"500\",\"total\":\"1500\"},{\"id\":\"14\",\"descripcion\":\"Mueble loco\",\"cantidad\":\"3\",\"existencia\":\"3\",\"precio\":\"400\",\"total\":\"1200\"}]', '2700'),
(5, 10005, 25, 2, 3, '2020-06-22', '13:36:39', '[{\"id\":\"10\",\"descripcion\":\"Cama\",\"cantidad\":\"31\",\"existencia\":\"38\",\"precio\":\"402\",\"total\":\"12462\"}]', '12462');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `Id_producto` int(11) NOT NULL,
  `Codigo` varchar(70) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Precio_compra` varchar(50) NOT NULL,
  `Precio_venta` varchar(50) NOT NULL,
  `Id_proveedor` int(11) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Ventas` int(11) NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_producto`, `Codigo`, `Nombre`, `Precio_compra`, `Precio_venta`, `Id_proveedor`, `Stock`, `Ventas`, `Estado`) VALUES
(4, '345357898678', 'Cama matrimonial', '4799', '5899', 5, 15, 0, 1),
(5, '345357893453', 'Sala', '9455', '10599', 5, 14, 0, 1),
(6, '343534545443', 'Ropero', '4755', '6899', 6, 17, 0, 1),
(7, '343534545129', 'Ropero grande', '5399', '6499', 4, 26, 0, 1),
(8, '343534545123', 'Sala gris', '7499', '8999', 4, 30, 0, 1),
(9, '343534545312', 'Ropero chico', '3000', '3599', 6, 33, 0, 1),
(10, '23434', 'Cama', '402', '570.84', 2, 38, 42, 1),
(11, '23434', 'Cama', '400', '400', 4, 0, 0, 1),
(12, '3249235', 'mueble nuevo', '400', '500', 5, 0, 0, 1),
(13, '32473', 'Esquinero', '300', '420', 4, 0, 0, 1),
(14, '4345345', 'Mueble loco', '400', '568', 2, 3, 3, 1),
(15, '23492393', 'productonuevo', '500', '700', 2, 3, 3, 1),
(16, '74733847737', 'otro nuevo', '400', '560', 2, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
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
(5, 'Casa WOW!', 'Calle 14 avenida 1, agua prieta', 'RFASLDO231276', '455666777', 'Adilene Valencias', 'adi@a.com', 4545, 'Roperos', 1),
(6, 'ZoneProviders 2', 'Calle 45', 'RFASLDO231244', '445556', 'Miguel Mal', 'miguel@m.com', 3445356, 'Ropero', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

DROP TABLE IF EXISTS `referencias`;
CREATE TABLE `referencias` (
  `id_referencia` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`id_referencia`, `nombre`, `direccion`, `telefono`, `tipo`, `id_solicitud`) VALUES
(280, 'E', 'E', '(889) 798-7897', '2', 37),
(281, 'Mama', 'E', '(897) 897-8978', '3', 37),
(282, 'E', 'E', '(897) 987-9878', '0', 37),
(283, 'R', 'R', '(897) 897-8978', '0', 37),
(284, 'Tres', 'Tres', '(098) 098-0980', '0', 37),
(285, 'E', 'E', '(798) 789-7897', '1', 37),
(286, 'E', 'E', '(878) 978-9789', '1', 37),
(287, 'E', 'E98789', '(897) 897-8978', '1', 37),
(288, 'Concubina', 'Ninda', '(324) 234-2342', '2', 39),
(289, 'Eleazar', 'Asdjasdj', '(324) 234-2342', '3', 39),
(290, 'E', 'E', '(789) 789-7897', '0', 39),
(291, 'E', 'E', '(987) 897-8978', '0', 39),
(292, 'E', 'E', '(987) 897-8978', '0', 39),
(293, 'E', 'E', '(879) 897-8978', '1', 39),
(294, 'E', 'E98', '(987) 897-8978', '1', 39),
(295, 'E', 'E', '(987) 897-8979', '1', 39),
(296, 'Avel', 'Ninguna', '(234) 234-2342', '4', 38),
(297, 'E', 'E', '(678) 789-7897', '2', 38),
(298, 'E', 'E', '(897) 897-8979', '3', 38),
(299, 'E', 'E', '(879) 878-9798', '0', 38),
(300, 'E', 'E', '(897) 897-9878', '0', 38),
(301, 'E', 'E', '(987) 897-8978', '0', 38),
(302, 'E', 'E', '(798) 789-7897', '1', 38),
(303, 'E', 'E', '(987) 897-8978', '1', 38),
(304, 'E', 'E', '(878) 978-9789', '1', 38),
(305, 'Ghuhu', 'Jnj', '(999) 999-9999', '2', 40),
(306, 'Njnj', 'Jnjn', '(888) 888-8888', '3', 40),
(307, 'Gyg', 'Kkk', '(777) 777-7777', '0', 40),
(308, 'Lmllk', 'Ji', '(333) 333-3333', '0', 40),
(309, 'Kmkmkm', 'Nk', '(333) 333-3333', '0', 40),
(310, 'Hhgj', 'Jkhkj3', '(454) 445-3434', '1', 40),
(311, 'Kkbkj', 'Bmnm', '(776) 877-8768', '1', 40),
(312, 'Jnjnj', 'Nbmnmn', '(435) 553-3533', '1', 40),
(313, 'DksdFF', 'KerkFF', '(343) 434-3443', '2', 42),
(314, 'SdsdFF', 'KmfdkmFF', '(343) 343-4343', '3', 42),
(315, 'AsdadasdDD', 'AsdasdDD', '(344) 534-5345', '0', 42),
(316, 'Sdffsd', 'SdfsdfDD', '(455) 454-3565', '0', 42),
(317, 'DsdfsdDD', 'SdfsdfDD', '(987) 655-6789', '0', 42),
(318, 'AsdadasdDD', 'AsdasdDD', '(344) 534-5345', '1', 42),
(319, 'SdffsdDD', 'SdfsdfDD', '(455) 454-3565', '1', 42),
(320, 'DsdfsdDD', 'Sdfsdf', '(987) 655-6789', '1', 42),
(321, 'JorgeFF', 'Calle jorge', '(232) 323-2332', '4', 41),
(322, 'PAPA JorgeDD', 'Calle papaDD', '(599) 686-8686', '2', 41),
(323, 'MAMA JorgeDD', 'Calle mama', '(459) 595-9595', '3', 41),
(324, 'Asdadasd', 'Asdasd', '(344) 534-5345', '0', 41),
(325, 'Sdffsd', 'Sdfsdf', '(455) 454-3565', '0', 41),
(326, 'Dsdfsd', 'Sdfsdf', '(987) 655-6789', '0', 41),
(327, 'Ami 1DD', 'Amis1DD', '(984) 389-4389', '1', 41),
(328, 'Ami 2DD', 'Amis2DD', '(838) 839-8489', '1', 41),
(329, 'Ami 3DD', 'Amis3DD', '(934) 838-3843', '1', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_credito`
--

DROP TABLE IF EXISTS `solicitud_credito`;
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
(39, 32, 'HMO', 'Unión libre', 'Rentandola', 'Programadora', 'Blazarsoft', 'E', '(879) 788-9789', '9 meses', 'E', 8798, 'Menos de un año', 897897, '2020-03-20 06:44:21', 3, 'vistas/img/solicitudes/default/anonymous.png', 1),
(40, 12, 'DF55RDF', 'Soltero', 'Propietario', 'Hh', 'Uu', 'Jijij', '(888) 888-8888', '3', 'Hhg', 6765, '2 años', 665, '2020-03-20 07:11:09', 3, 'vistas/img/solicitudes/default/anonymous.png', 0),
(41, 13, 'JOR66U', 'Casado', 'Pagandola', 'Don JORGE', 'JORGENDDDDD', 'CALLE LA GERGI', '(343) 434-3434', '6', 'PRESIDENTE', 4455, '4 años', 44, '2020-03-20 07:38:17', 3, 'vistas/img/solicitudes/13/662.png', 0),
(42, 33, 'IJDIJSFF', 'Casado', 'Rentandola', 'AsdFF', 'AsdasdaFF', 'DfpdfdfiFF', '(566) 666-6666', '3ij', 'KkmasdFF', 455434, '2 años', 23, '2020-03-20 07:38:18', 3, 'vistas/img/solicitudes/13/662.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `almacen` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `almacen`, `estado`, `ultimo_login`, `fecha`) VALUES
(25, 'Roberto Manuel Cordero Balderas', 'robert', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Gerente General', 'vistas/img/usuarios/robert/566.jpg', 3, 1, '2020-09-18 11:48:04', '2020-09-18 18:48:04'),
(35, 'federico daniel villa leyva', 'dani', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Administrador', 'vistas/img/usuarios//701.jpg', 3, 0, '0000-00-00 00:00:00', '2020-02-11 07:35:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
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
  `TipoVenta` int(1) NOT NULL,
  `FolioFact` varchar(60) NOT NULL DEFAULT 'NO_PRESENTADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Id_venta`, `Folio`, `Id_usuario`, `Id_cliente`, `Id_almacen`, `Fecha`, `Hora`, `ListaProductos`, `Descuento`, `TotalVenta`, `TotalPago`, `Pendiente`, `CalendarioAbonos`, `TipoAbono`, `TipoVenta`, `FolioFact`) VALUES
(22, 100019, 25, 10, 3, '2020-03-20', '15:20:47', '[{\"id\":\"4\",\"descripcion\":\"Cama matrimonial\",\"cantidad\":\"1\",\"existencia\":\"25\",\"precio\":\"5899\",\"total\":\"5899\"}]', '294.95', '5604.05', '23', '0', '[{\"Fecha\":\"2020-03-27\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-03\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-10\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-17\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-04-24\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-01\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-08\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-15\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-22\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-05-29\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-05\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-12\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-19\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-06-26\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-03\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-10\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-17\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-24\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-07-31\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-07\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-14\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-21\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-08-28\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-04\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-11\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-18\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-09-25\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-02\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-09\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-16\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-23\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-10-30\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-06\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-13\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-20\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-11-27\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-04\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-11\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-18\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2020-12-25\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-01\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-08\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-15\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-22\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-01-29\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-05\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-12\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-19\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-02-26\",\"Abono\":111.62,\"Estado\":0},{\"Fecha\":\"2021-03-05\",\"Abono\":111.62,\"Estado\":0}]', 'Semanal', 0, 'NO_PRESENTADO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id_abono`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_conyuge`
--
ALTER TABLE `cliente_conyuge`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`Id_compra`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_producto`),
  ADD KEY `Id_proveedor` (`Id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`Id_proveedor`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id_referencia`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `solicitud_credito`
--
ALTER TABLE `solicitud_credito`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `cliente_conyuge`
--
ALTER TABLE `cliente_conyuge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `Id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id_referencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT de la tabla `solicitud_credito`
--
ALTER TABLE `solicitud_credito`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `referencias_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud_credito` (`id_solicitud`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
