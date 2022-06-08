-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2022 a las 06:04:07
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL,
  `categoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_ubicacion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(1, 'bebidas', ''),
(2, 'no pedecedero', ''),
(5, 'frutas', ''),
(6, 'vegetales', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_td` varchar(10) NOT NULL,
  `cliente_documento` varchar(30) NOT NULL,
  `cliente_nombre` varchar(50) NOT NULL,
  `cliente_apellido` varchar(50) NOT NULL,
  `cliente_telefono` varchar(10) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `cliente_direccion` varchar(70) NOT NULL,
  `cliente_ciudad` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_td`, `cliente_documento`, `cliente_nombre`, `cliente_apellido`, `cliente_telefono`, `cliente_email`, `cliente_direccion`, `cliente_ciudad`) VALUES
(4, 'CC', '123456789', 'cliente', 'de prueba', '4543634634', 'afaf@fsd.com', 'asserr cll 23 #d43-45', 'Barranquilla'),
(5, 'CC', '1007973563', 'Cristian David', 'Palacio Morelos', '3105437197', 'palaciomorelos12@gmail.com', 'zaragocilla calle 27 #53-55', 'cartagena'),
(6, 'CC', '325423523', 'Gustavo', 'Petro  Urrego', '4567859680', 'petro@gmail.com', 'Calle 42 # 15-34', 'Bogota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_peso` decimal(30,2) NOT NULL,
  `producto_pmedida` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_volumen` decimal(30,2) NOT NULL,
  `producto_vmedida` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_fecha` date DEFAULT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `proveedor_id` int(10) NOT NULL,
  `producto_ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_peso`, `producto_pmedida`, `producto_volumen`, `producto_vmedida`, `producto_fecha`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`, `proveedor_id`, `producto_ingreso`) VALUES
(22, '214234', 'Arroz Diana', '500.00', 'g', '0.00', 'Lt', '0000-00-00', '2000.00', 35, 'Arroz_Diana_14.jpg', 2, 1, 1, '2022-06-07 22:23:21'),
(23, '124243', 'Leche colanta', '0.00', 'Kg', '950.00', 'ml', '2022-06-24', '3700.00', 45, 'Leche_colanta_12.jpg', 1, 1, 1, '2022-06-07 22:40:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_vendido`
--

CREATE TABLE `producto_vendido` (
  `pv_id` int(11) NOT NULL,
  `venta_codigo` varchar(10) NOT NULL,
  `producto_id` int(20) NOT NULL,
  `pv_stock` int(25) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `pv_total` int(50) NOT NULL,
  `pv_utilidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_vendido`
--

INSERT INTO `producto_vendido` (`pv_id`, `venta_codigo`, `producto_id`, `pv_stock`, `precio_unitario`, `pv_total`, `pv_utilidad`) VALUES
(326, '1000000001', 22, 15, '2272.00', 34080, '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proveedor_id` int(10) NOT NULL,
  `proveedor_td` varchar(10) NOT NULL,
  `proveedor_documento` varchar(20) NOT NULL,
  `proveedor_nombre` varchar(70) NOT NULL,
  `proveedor_telefono` varchar(20) NOT NULL,
  `proveedor_email` varchar(30) NOT NULL,
  `proveedor_direccion` varchar(50) NOT NULL,
  `proveedor_ciudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedor_id`, `proveedor_td`, `proveedor_documento`, `proveedor_nombre`, `proveedor_telefono`, `proveedor_email`, `proveedor_direccion`, `proveedor_ciudad`) VALUES
(1, 'CC', '342141244123', 'Proveedor de prueba', '1234567890', 'safdasfd@erewr.com', 'fasffdfads adfafasfas', 'sdggsdagadsg'),
(2, 'DE', '464664565', 'fulanito de tal', '6754575034', 'empresa@alazar.com', 'afasfsaffa', 'medellin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `fecha_ingreso` datetime NOT NULL,
  `fecha _salida` datetime NOT NULL,
  `cantidad_ingresada` int(11) NOT NULL,
  `cantidad_retirada` int(11) NOT NULL,
  `producto_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`fecha_ingreso`, `fecha _salida`, `cantidad_ingresada`, `cantidad_retirada`, `producto_id`) VALUES
('2022-06-07 22:23:21', '0000-00-00 00:00:00', 50, 0, 22),
('2022-06-07 22:40:49', '0000-00-00 00:00:00', 45, 0, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rol` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `rol`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', '', 'admin'),
(2, 'Cristian', 'palacio', 'Cristian', 'Cristian123', 'palaciomorelos12@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_codigo` varchar(10) NOT NULL DEFAULT '0',
  `venta_fecha` date DEFAULT NULL,
  `venta_stock` longtext NOT NULL,
  `venta_total` int(20) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `venta_factura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_id`, `venta_codigo`, `venta_fecha`, `venta_stock`, `venta_total`, `cliente_id`, `usuario_id`, `venta_factura`) VALUES
(1, '1000000001', '2022-06-07', '15', 34080, 4, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  ADD PRIMARY KEY (`pv_id`),
  ADD KEY `venta_id` (`venta_codigo`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD UNIQUE KEY `venta_factura_2` (`venta_factura`),
  ADD KEY `venta_codigo` (`venta_codigo`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `venta_factura` (`venta_factura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proveedor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`);

--
-- Filtros para la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  ADD CONSTRAINT `producto_vendido_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`venta_codigo`) REFERENCES `producto_vendido` (`venta_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
