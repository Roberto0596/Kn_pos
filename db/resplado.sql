-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2020 a las 20:26:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

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
-- Estructura de tabla para la tabla `almacen`
--

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

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `telefono_casa` varchar(11) NOT NULL,
  `telefono_celular` varchar(15) NOT NULL,
  `ciudad` varchar(75) NOT NULL,
  `edad` int(11) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `direccion`, `codigo_postal`, `telefono_casa`, `telefono_celular`, `ciudad`, `edad`, `tipo`) VALUES
(1, 'CONTADO', 'CONTADO', 'NA', 'NA', 'NA', 'AGUA PRIETA', 0, 0),
(2, 'Maria Esmeralda Sosa Aguilar', 'Calle 11 Avenida 42  NO. 360', '84230', '(633) 125-5', '(633) 125-5315', 'Agua prieta', 30, 0),
(3, 'BONIFACIO ESTRADA SIMUEZ', 'CALLE 8 AVENIDA 23 Y 25 # 2380 ', '84260', '(633) 338-3', '(633) 331-0928', 'Agua prieta', 64, 0),
(4, 'OLIVIA AIDEE ROMERO OCAÑO', 'CALLE 2 AVENIDA 46 Y 47 #170', '84230', '(633) 333-0', '(633) 333-0670', 'Agua prieta', 46, 0),
(5, 'NANCY MARISOL MARTINEZ PEREZ', 'CALLE 22 AVENIDA 2', '84259', '(633) 409-3', '(633) 409-3951', 'Agua prieta', 38, 0),
(6, 'NORA GUZMAN SANCHEZ', 'CALLE 14 AVENIDA 19 #1406', '84269', '(633) 338-3', '(633) 338-3702', 'Agua prieta', 64, 0),
(7, 'KARINA FRANCISCA VAZQUEZ ARRELLANO', 'CALLE 14 AVENIDA 23 #2300', '84260', '(633) 113-6', '(633) 113-6429', 'Agua prieta', 47, 0),
(8, 'JOSE ERNESTO ARMENTA MORALES', 'CALLE BOSQUE NEVADO #269 FRACCIONAMIENTO CORONADO', '84240', '(633) 334-7', '(633) 334-7292', 'Agua prieta', 38, 0),
(9, 'CECILIA GRIJALVA FIGUEROA', 'CALLE 8 Y 9 AVENIDA 11 #841', '84200', '(633) 123-8', '(633) 123-8196', 'Agua prieta', 42, 0),
(10, 'MARIA JESUS VALENZUELA ABRIL', 'CALLE 20 AVENIDA 11 # 1098', '84269', '(633) 104-6', '(633) 104-6342', 'Agua prieta', 53, 0),
(11, 'FRANCISCO  ANTONIO CASTILLO AMAYA', 'CALLE 35 AVENIDA INDUSTRIAL  1 Y 2 DEPARTAMENTO 4', '84259', '(633) 123-5', '(633) 123-5492', 'Agua prieta', 31, 0),
(12, 'NORMA CELINA BACASEGUA VALENZUELA', 'CALLE RAMA BLANCA  FRACCIONAMIENTO VALLEZ DUARTE', '84279', '(633) 102-3', '(633) 120-3033', 'Agua prieta', 27, 0),
(13, 'HONORIO MARTINEZ MATUZ', 'CALLE 32 Y 33 AVENIDA 37 #3288', '84279', '(633) 102-4', '(633) 102-4112', 'Agua prieta', 54, 0),
(14, 'ERIC SAUL SALAS DE LA CRUZ', 'CALLE 23 Y 24 AVENIDA 20', '84269', '(633) 409-0', '(520) 895-8759', 'Agua prieta', 35, 0),
(15, 'LUZ DEL CARMEN NAVARRO MIRANDA', 'CALLE 1 AVENIDA JESUS GARCIA  Y HERNAN CORTEZ', '84210', '(633) 338-1', '(633) 338-1753', 'Agua prieta', 60, 0),
(16, 'CARLOS ALBERTO CORONA', 'CALLE VALLE LEMMON #264', '84213', '(633) 115-5', '(633) 115-5011', 'Agua prieta', 40, 0),
(17, 'JOSE ANTONIO LEON ENRIQUEZ', 'PRIVADA CORONADO CALLE CHIRICAHUA #383', '84213', '(633) 112-8', '(633) 112-8100', 'Agua prieta', 46, 0),
(18, 'OSCAR ALEJANDRO ORTIZ PEREZ', 'CALLE 28 Y 29 AVENIDA 19 # 2889', '84269', '(633) 109-1', '(633) 109-1292', 'Agua prieta', 43, 0),
(19, 'RAMON ANTIOCO VALDEZ BARO', 'CALLE 8 AVENIDA 18 Y 19 #1827', '84200', '(633) 113-4', '(633) 113-4437', 'Agua prieta', 47, 0),
(20, 'NANCY MARISOL MARTINEZ PEREZ', 'CALLE 22 AVENIDA 2 ', '84259', '(633) 409-3', '(633) 409-3951', 'Agua prieta', 37, 0),
(21, 'MARIA GUADALUPE ANDRADE SANTACRUZ', 'RETORNO DE LOS HACENDADOS # 9', '84240', '(633) 119-2', '(633) 119-2126', 'Agua prieta', 36, 0),
(22, 'LAURA MORENO', 'CALLE 30 Y 31 AVENIDA 30 #296', '84267', '(633) 102-8', '(633) 102-8611', 'Agua prieta', 46, 0),
(23, 'ALEJANDRO CARLOS FERNANDEZ', 'CALLE 27 Y 28 AVENIDA 35 Y 36 #3538', '84279', '(633) 101-0', '(633) 101-0570', 'Agua prieta', 39, 0),
(24, 'ANA KAREN TAUTIMER LOYA', 'CALLE 16 AVENIDA 1 #99', '84210', '(633) 335-6', '(633) 335-6310', 'Agua prieta', 27, 0),
(25, 'MARITZA MONTOYA BERNAL', 'CALLE 9 AVENIDA 28 #896', '84270', '(633) 334-5', '(633) 334-5694', 'Agua prieta', 43, 0),
(26, 'GABRIELA MARIA PARRA DURAN', 'CALLE 10 AVENIDA 9 Y 10 # 964', '84200', '(633) 109-5', '(633) 109-5853', 'Agua prieta', 53, 0),
(27, 'DORA ELDA PERALTA DE JIMENEZ', '2311 E 10TH ST DOUGLAS ARIZONA ', '84200', '(520) 678-2', '(520) 678-2950', 'DOUGLAS ARIZONA ', 50, 0),
(28, 'PATRICIA ORTIZ', 'CALLE 1 Y 2 AVENIDA 20 ', '84269', '(633) 409-5', '(633) 409-5169', 'Agua prieta', 60, 0),
(29, 'JASMIN ORNELAS MONTAÑO ', 'CALLE 13 Y 14 AVENIDA 31 Y 32 #3142', '84270', '(633) 130-1', '(633) 130-1806', 'Agua prieta', 30, 0),
(30, 'OLGA CECILIA QUINTANA PEREZ', 'CALLE 8 AVENIDA 16 Y 17 #1601', '84200', '(121) 208-6', '(121) 208-6___', 'Agua prieta', 75, 0),
(31, 'FRANCISCO AGUSTIN PEREZ PRO', 'CALLE 29 AVENIDA 31 # 3100', '84200', '(690) 160-8', '(633) 130-0743', 'Agua prieta', 52, 0),
(32, 'HERMELINDA FIGUEROA LOPEZ', 'CALLE 17 AVENIDA 24 # 2424', '84260', '(338) 001-6', '(338) 001-6___', 'Agua prieta', 77, 0),
(33, 'GREGORIA GONZALEZ CASTRO', 'CALLE 25 AVENIDA 7 # 2549', '84259', '(633) 102-3', '(633) 102-3004', 'Agua prieta', 55, 0),
(34, 'ARACELI SERNA CORTES', 'CALLE 8 AVENIDA 48 Y 49 #4850', '84230', '(633) 350-1', '(633) 350-1123', 'Agua prieta', 46, 0),
(35, 'CARLOS ROCHIN AVILA ', 'CALLE 21 AVENIDA 44 #4495', '84279', '(633) 101-0', '(633) 101-0056', 'Agua prieta', 56, 0),
(36, 'LEONARDO QUIJADA CORONADO ', 'CALLE PASEO PALO FIERRO #4', '84240', '(633) 123-2', '(633) 123-2200', 'Agua prieta', 34, 0),
(37, 'PASCUAL ARMANDO LAMADRID ROJAS ', 'CALLE 4 AVENIDA 12 # 1201', '84259', '(633) 112-4', '(633) 112-4292', 'Agua prieta', 45, 0),
(38, 'SALVADOR INOCENCIO RIVERA JIMENEZ ', 'CALLE 6 AVENIDA 47 #614', '84230', '(633) 112-6', '(633) 112-6088', 'Agua prieta', 50, 0),
(39, 'MAIRA ZAMUDIO', 'CALLE 21 AVENIDA 9 Y 10 #955', '84259', '(633) 336-2', '(633) 336-2314', 'Agua prieta', 39, 0),
(40, 'EDNA VALENZUELA RIVERA ', 'CALLE 11 AVENIDA 28 ', '84270', '(633) 124-4', '(633) 124-4272', 'Agua prieta', 44, 0),
(41, 'ANGELICA GARCIA MONTAÑO', 'CALLE 39 AVENIDA 34 #3402', '84279', '(633) 334-9', '(633) 334-9323', 'Agua prieta', 40, 0),
(42, 'CUTBERTO GARCIA ARREDONDO ', 'CALZADA SANTA FE #23', '84200', '(633) 350-7', '(633) 350-7455', 'Agua prieta', 60, 0),
(43, 'ANGELA VALENZUELA TRUJILLO', 'CALLE 14 AVENIDA 31 Y 32 #3147', '84270', '(331) 223-3', '(331) 223-3___', 'Agua prieta', 71, 0),
(44, 'LIDIA GUADALUPE RAMIREZ OCHOA', 'CALLE INTERNACIONAL Y 1 AVENIDA 33', '84230', '(633) 409-6', '(633) 409-6052', 'Agua prieta', 38, 0),
(45, 'CARMEN PATRICIA GOMEZ ORTIZ', 'CALLE 1 Y 2 AVENIDA 20', '84200', '(121) 900-5', '(662) 268-8708', 'Agua prieta', 34, 0),
(46, 'SANDRA VILLEGAS', 'CALLE 12 AVENIDA 44 A #4475 A ', '84230', '(633) 409-0', '(633) 132-2405', 'Agua prieta', 49, 0),
(47, 'RAQUEL SALAZAR YAÑEZ', 'CALLE 10 Y 11 AVENIDA 37 #3771', '84230', '(633) 336-4', '(633) 336-4664', 'Agua prieta', 61, 0),
(48, 'LUZ GUADALUPE NORIEGA GONZALES ', 'CALLE 16 Y 17 AVENIDA 25', '84270', '(338) 459-2', '(633) 112-0228', 'Agua prieta', 65, 0),
(49, 'EDNA PATRICIA VERDUGO ', 'CALLE 13 AVENIDA 20 Y 21 # 1336', '84260', '(633) 334-7', '(633) 334-7387', 'Agua prieta', 56, 0),
(50, 'JOSE LUIS RAMIREZ IBARRA ', 'CALLE 2 AVENIDA 38 #3824', '84230', '(557) 632-9', '(633) 338-0296', 'Agua prieta', 50, 0),
(51, 'MARIA GRISELDA AVILES ENCINAS ', 'CALLE 13 AVENIDA 35', '84270', '(633) 409-4', '(633) 409-4656', 'Agua prieta', 49, 0),
(52, 'JOSE ANGEL GARCIA DORADO', 'CALLE 7 AVENIDA 48 # 4809', '84230', '(633) 337-2', '(633) 337-2892', 'Agua prieta', 54, 0),
(53, 'GEORGINA GARCIA BARAJAS ', 'CALLE 22 AVENIDA 22 Y 23 # 2266', '84267', '(633) 112-8', '(633) 112-8924', 'Agua prieta', 59, 0),
(54, 'SILVIA PERALTA BALLESTEROS', 'CALLE 28 Y 29 AVENIDA 35 #3847', '84279', '(633) 335-7', '(633) 335-7674', 'Agua prieta', 54, 0),
(55, 'OSCAR FRANCISCO CAMACHO  NAVARRO ', 'CALLE 2 AVENIDA 39 #3900', '84230', '(633) 333-0', '(633) 333-0779', 'Agua prieta', 68, 0),
(56, 'RUBEN SILVEIRA ESCOBEDO', 'CALLE 33 Y 34 AVENIDA 9 Y 10 #1143', '84269', '(633) 102-8', '(633) 102-8461', 'Agua prieta', 61, 0),
(58, 'RUBEN PERALTA ENCINAS', 'CALLE 9 Y 10 AVENIDA 28 Y 29', '84270', '(633) 132-1', '(633) 132-1020', 'Agua prieta', 56, 0),
(59, 'CARMEN LETICIA SANTILLANEZ ENCINAS ', 'CALLE 18 AVENIDA 26 #2600', '84270', '(633) 333-1', '(633) 333-1512', 'Agua prieta', 55, 0),
(60, 'ANA VERONICA CHAVEZ CORDOVA ', 'CALLE 6 Y 7 AVENIDA 20 # 698', '84269', '(633) 335-5', '(633) 335-5236', 'Agua prieta', 47, 0),
(61, 'MARGARITA DELGADO', 'CALLE 39 AVENIDA 1 #64', '84259', '(633) 129-6', '(633) 129-6191', 'Agua prieta', 47, 0),
(62, 'FAUSTO GERARDO LUZANIA ', 'CALLE 31 Y 32 AVENIDA 4 IND # 10', '84259', '(633) 109-8', '(633) 109-8515', 'Agua prieta', 51, 0),
(63, 'FIDEL AMAVIZCA ', 'CALLE 37 Y 38 AVENIDA 33', '84270', '(520) 227-6', '(520) 227-6962', 'Agua prieta', 27, 0),
(64, 'ERICK ALEJANDRO ALARCON MENDEZ ', 'CALLE FLOR DE PASION AVENIDA FLORES # 56', '84304', '(633) 113-6', '(633) 113-6602', 'Agua prieta', 29, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

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
(4, '345357898678', 'Cama matrimonial', '799', '899', 5, 7, 0, 0),
(7, '12345', 'Mesa De Centro', '400', '500', 2, 14, 0, 1),
(8, 'EAWHIWK5915', 'Enfriador de agua whirpol MOD. wk5915bd', '400', '500', 2, 5, 0, 1);

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
(5, 'Casa WOW!', 'Calle 14 avenida 1, agua prieta', 'RFASLDO231276', '455666777', 'Adilene Valencia', 'adi@a.com', 4545, 'Roperos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `id_referencia` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `tel_empresa` int(20) NOT NULL,
  `tiempo_casa` int(11) NOT NULL,
  `puesto` varchar(200) NOT NULL,
  `sueldo` int(11) NOT NULL,
  `antiguedad` int(11) NOT NULL,
  `gastos_mensuales` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_almacen` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

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
(36, 'Demo', 'demo', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Gerente General', 'vistas/img/usuarios/default/anonymous.png', 3, 1, '2020-03-16 12:25:52', '2020-03-16 19:25:52');

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
  `TotalVenta` varchar(30) NOT NULL,
  `TotalPago` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Id_venta`, `Folio`, `Id_usuario`, `Id_cliente`, `Id_almacen`, `Fecha`, `Hora`, `ListaProductos`, `TotalVenta`, `TotalPago`) VALUES
(1, 100001, 25, 1, 3, '2020-02-23', '13:06:00', '[{\"id\":\"4\",\"descripcion\":\"Camastros\",\"cantidad\":\"1\",\"existencia\":\"5\",\"precio\":\"899\",\"total\":\"899\"},{\"id\":\"5\",\"descripcion\":\"Sillon\",\"cantidad\":\"1\",\"existencia\":\"49\",\"precio\":\"599\",\"total\":\"599\"}]', '1498', '1499'),
(2, 100002, 25, 1, 3, '2020-02-24', '19:52:51', '[{\"id\":\"4\",\"descripcion\":\"Camastros\",\"cantidad\":\"1\",\"existencia\":\"7\",\"precio\":\"899\",\"total\":\"899\"}]', '899', '1000'),
(4, 100004, 25, 1, 3, '2020-02-24', '23:34:48', '[{\"id\":\"6\",\"descripcion\":\"Sofa\",\"cantidad\":\"1\",\"existencia\":\"11\",\"precio\":\"899\",\"total\":\"899\"},{\"id\":\"5\",\"descripcion\":\"Sillon\",\"cantidad\":\"2\",\"existencia\":\"45\",\"precio\":\"599\",\"total\":\"1198\"}]', '2097', '2300'),
(5, 100005, 36, 2, 3, '2020-03-07', '18:52:29', '[{\"id\":\"7\",\"descripcion\":\"Mesa De Centro\",\"cantidad\":\"1\",\"existencia\":\"14\",\"precio\":\"500\",\"total\":\"500\"}]', '500', '500');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id_referencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `solicitud_credito`
--
ALTER TABLE `solicitud_credito`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `rproducto` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `referencias_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud_credito` (`id_solicitud`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
