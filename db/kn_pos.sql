-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2020 a las 07:37:34
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
(6, 'Roberto Manuel Cordero Balderas', 'ninguna', '43453', '6341055849', '6341055849', 'Agua Prieta', 24, 0),
(7, 'federico daniel villa leyva', 'nacozari', '94944', '6341055849', '6341055849', 'nacozari', 34, 1),
(8, 'daniel villa leyva', 'nacozari', '45434', '6341055849', '6341055849', 'nacozari', 24, 1),
(9, 'Martin Perez', 'Calle 10', '84200', '(666) 666-6', '(334) 444-4444', 'Agua Prieta', 24, 0);

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
(4, '345357898678', 'Cama matrimonial', '799', '899', 5, 7, 0, 1),
(5, '345357893453', 'Sala', '455', '599', 5, 45, 0, 1),
(6, '343534545443', 'Ropero', '755', '899', 6, 11, 0, 1);

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

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`id_referencia`, `nombre`, `direccion`, `telefono`, `tipo`, `id_solicitud`) VALUES
(76, 'e', 'e', '0', '2', 12),
(77, 'e', 'e', '0', '3', 12),
(78, 'e', 'e', '0', '0', 12),
(79, 'e', 'e', '0', '0', 12),
(80, 'e', 'e', '0', '0', 12),
(81, 'e', 'e', '0', '1', 12),
(82, 'e', 'e', '0', '1', 12),
(83, 'e', 'e', '0', '1', 12),
(84, 'e', 'e', '0', '2', 13),
(85, 'e', 'e', '0', '3', 13),
(86, 'e', 'e', '0', '0', 13),
(87, 'e', 'e', '0', '0', 13),
(88, 'e', 'e', '0', '0', 13),
(89, 'e', 'e', '0', '1', 13),
(90, 'e', 'e', '0', '1', 13),
(91, 'e', 'e', '0', '1', 13);

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

--
-- Volcado de datos para la tabla `solicitud_credito`
--

INSERT INTO `solicitud_credito` (`id_solicitud`, `id_cliente`, `num_placas`, `estado_civil`, `casa`, `profesion`, `empresa`, `dom_empresa`, `tel_empresa`, `tiempo_casa`, `puesto`, `sueldo`, `antiguedad`, `gastos_mensuales`, `fecha`, `id_almacen`, `status`, `foto`, `tipo`) VALUES
(12, 6, 'uudud', 'Casado', 'Si', 'ingeniero en sistemas computacionales', 'dev creative', 'agua prieta', 2147483647, 8, 'programador', 4000, 2, 4000, '2020-02-12 02:18:23', 3, 0, 'vistas/img/solicitudes/6/236.jpg', 0),
(13, 6, 'uudud', 'Casado', 'Si', 'ingeniero en sistemas computacionales', 'dev creative', 'agua prieta', 2147483647, 8, 'programador', 4000, 2, 4000, '2020-02-12 02:18:24', 3, 0, 'vistas/img/solicitudes/6/236.jpg', 0);

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
(25, 'Roberto Manuel Cordero Balderas', 'robert', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Gerente General', 'vistas/img/usuarios/robert/566.jpg', 3, 1, '2020-02-12 10:05:03', '2020-02-12 17:05:03'),
(35, 'federico daniel villa leyva', 'dani', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Administrador', 'vistas/img/usuarios//701.jpg', 3, 0, '0000-00-00 00:00:00', '2020-02-11 07:35:34');

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
(4, 100004, 25, 1, 3, '2020-02-24', '23:34:48', '[{\"id\":\"6\",\"descripcion\":\"Sofa\",\"cantidad\":\"1\",\"existencia\":\"11\",\"precio\":\"899\",\"total\":\"899\"},{\"id\":\"5\",\"descripcion\":\"Sillon\",\"cantidad\":\"2\",\"existencia\":\"45\",\"precio\":\"599\",\"total\":\"1198\"}]', '2097', '2300');

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
