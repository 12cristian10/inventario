-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2022 a las 21:53:22
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
-- Base de datos: `pdo`
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
(2, 'no pedecedero', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_peso` decimal(30,2) NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_peso`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`) VALUES
(4, '474574574', 'Arroz diana', '5.40', '1800.00', 5, '', 1, 1),
(6, '8686679', 'sal refisal', '250.00', '3200.00', 43, '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_vendido`
--

CREATE TABLE `producto_vendido` (
  `pv_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(20) NOT NULL,
  `pv_stock` int(25) NOT NULL,
  `pv_total` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `usuario_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', ''),
(2, 'Cristian', 'palacio', 'Cristian', 'Cristian123', 'palaciomorelos12@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_codigo` varchar(70) NOT NULL,
  `venta_fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  ADD PRIMARY KEY (`pv_id`),
  ADD KEY `venta_id` (`venta_id`,`producto_id`),
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
  ADD PRIMARY KEY (`venta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `producto_vendido`
--
ALTER TABLE `producto_vendido`
  ADD CONSTRAINT `producto_vendido_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`),
  ADD CONSTRAINT `producto_vendido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
