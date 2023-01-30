-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2023 a las 19:25:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wintershop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `modProducts` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `disabled`) VALUES
(1, 'Ropa invierno', 'Artículos relacionados con la ropa de invierno.', 0),
(2, 'Esquí', 'Artículos relacionados con el esquí', 0),
(3, 'Accesorios', 'Accesorios para tus actividades de invierno.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `poblacion` varchar(50) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `pais` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido1`, `apellido2`, `email`, `password`, `direccion`, `poblacion`, `cp`, `pais`) VALUES
(11, 'Garcilasco', 'de la', 'Vega', 'dsfjndk@fjdifj.com', 'NOT_REAL', 'no direction', '', '', ''),
(12, 'Jorge', 'de', 'Montemayor', 'sakmfkds@dfd.com', 'NOT_REAL', 'no direction', '', '', ''),
(13, 'Benito Antonio', 'Martínez', 'Ocasio', 'conejomalo@badbunny.com', 'ce78991c463291e45a153579dec087e907eb4d3313d74079dd4ba7185f6e98e0', 'no direction', 'Almirante Sur', '', 'Puerto Rico'),
(14, 'Jorge', 'Javier', 'Jiménez', 'jorge@javier.com', '56e2d65715c249dd59bb44effe17c70e7f3f06ce3a7e57124ce6966389dffa8c', 'C/ de la Maruja', 'Abudalán', '45646DC', 'Marruecos'),
(16, 'Franciso', 'Quevedo', 'Guiterrez', 'fran@gg.com', '56e2d65715c249dd59bb44effe17c70e7f3f06ce3a7e57124ce6966389dffa8c', 'C/ de los pirineos 32', 'Les pyrenees', '11222FR', 'Francia'),
(17, 'gxfg', 'dsv', 'vdsv', 'dfdsv@hfgh.com', 'cf3c2fe64c17199f8762177a2c1805f37814f9bc4e7365d8f75dd979f9846db3', 'dvsv', 'vdcsv', '3545', 'vdsfv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `comentario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_producto`, `id_cliente`, `fecha`, `comentario`) VALUES
(2, 1, 9, '2022-11-23 22:12:45', 'Son las mejores botas que he probado. ¡100% recomendadas!'),
(4, 2, 9, '2022-11-23 22:39:34', '¡Conseguí deslizarme hacia el aprobado!'),
(5, 2, 11, '2022-11-23 22:39:34', 'La vida es corta: viviendo todo falta, muriendo todo sobra y el sistema de frenado de este trineo no funciona.'),
(7, 2, 12, '2022-11-23 22:43:44', '¿Qué pudo ser sin trineo el alma mía, o qué sería de mí si así no fuese?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(10) NOT NULL DEFAULT 'No enviado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `precio` float NOT NULL,
  `marca` varchar(30) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT current_timestamp(),
  `idCategoria` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `marca`, `fechaAlta`, `idCategoria`, `oferta`, `disabled`) VALUES
(1, 'Botas de nieve', '¡Tienen una temperatura confort de hasta -15 °C en actividad! Su suela te proporcionará un gran agarre y adherencia en terrenos nevados.', 59.99, 'Quechua', '2022-11-18 16:58:51', 1, 0, 0),
(2, 'Trineo con frenos', '¡Por fin un trineo para los adultos! Dirígelo con las asas laterales. Adecuado para 1 adulto y 1 niño o 2 niños.Compatible con la sillita de bebé Tril', 34.99, 'Wedze', '2022-11-18 17:59:51', 3, 0, 0),
(3, 'Cinturón masajeador', 'El cinturón de masaje perfecto para descontracturar tu espalda, cervicales y/o extremidades. Puedes usarlo como cojín o darte un automasaje relajante.', 39.99, 'Aptonia', '2022-11-18 19:11:37', 3, 10, 0),
(5, 'ATOMIC REDSTER Q4', 'Esquí alpino de pista para esquiadores en perfeccionamiento, muy seguro y fácil de manejar con todos los tipos de nieve.', 299.99, 'Atomic', '2022-11-23 22:08:13', 2, 100, 0),
(6, 'Mujer Salomon X Access', 'Concebidas para esquiadores en perfeccionamiento que buscan unas botas cómodas para acompañar su progreso gracias a su horma ancha.', 139.99, 'Salomon', '2022-11-23 22:18:59', 2, 0, 0),
(7, 'Bastones de Esquí', 'Nuestros diseñadores esquiadores fuera de pista han desarrollado estos bastones de esquí para quienes no se limitan a las bajadas accesibles.', 29.99, 'Wedze', '2022-11-23 22:24:22', 2, 10, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_fk1` (`id_cliente`);

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_rel` (`id_cliente`),
  ADD KEY `productos_rel` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorias_FK_1` (`idCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carro`
--
ALTER TABLE `carro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `admins_fk1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `carro_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `carro_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
