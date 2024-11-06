-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 21:00:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemainventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Lácteos', '2024-10-21 07:33:09', '2024-10-21 07:33:09'),
(2, 'Frutas', '2024-10-21 04:15:09', '2024-10-21 08:56:53'),
(3, 'Mascotas', '2024-10-21 08:57:06', '0000-00-00 00:00:00'),
(4, 'Galletas', '2024-10-27 02:07:38', '0000-00-00 00:00:00'),
(5, 'Papelería', '2024-10-28 12:39:56', '0000-00-00 00:00:00'),
(6, 'Snacks', '2024-11-04 00:58:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio_venta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `ubicacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo`, `nombre`, `marca`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `fecha_vencimiento`, `ubicacion`, `imagen`, `id_usuario`, `id_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(8, 'P-000001', 'Triton Lemon', 'Mckay', 'galleta lemon-white 136 gr', 50, 30, 100, '500', '700', '2024-10-28', '2025-01-31', 'Estante B fila 2', '2024-10-28-15-07-13__triton_lemon.jpg', 8, 4, '2024-10-28 15:07:13', '0000-00-00 00:00:00'),
(9, 'P-000002', 'Triton choco', 'Mckay', 'Triton choco-white 136 gr', 30, 20, 60, '500', '750', '2024-10-28', '2025-04-20', 'Estante B fila 3', '2024-10-28-15-08-32__triton.jpg', 8, 4, '2024-10-28 15:08:32', '0000-00-00 00:00:00'),
(11, 'P-000004', 'leche entera soprole', 'soprole', 'leche entera 1 litro', 20, 10, 30, '500', '850', '2024-11-03', '2025-01-17', 'refrigerador 1', '2024-11-03-23-04-25__leche entero soprole.jpg', 9, 1, '2024-11-03 23:04:25', '2024-11-04 00:54:37'),
(12, 'P-000004', 'Cheetos', 'evercrips', 'palos de queso', 20, 30, 50, '100', '200', '2024-11-04', '2025-02-28', 'estante b', '2024-11-04-00-59-45__cheetos.jpg', 9, 6, '2024-11-04 00:59:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Administrador', '2024-10-18 08:30:51', '2024-10-18 08:30:51'),
(2, 'Bodeguero', '2024-10-18 12:49:50', '2024-10-28 12:37:14'),
(3, 'Vendedor', '2024-10-18 13:59:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `p_nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `s_nombre` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `p_apellido` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `s_apellido` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `run` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nacionalidad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comuna` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `numero_telefonico` int(9) NOT NULL,
  `password_usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `p_nombre`, `s_nombre`, `p_apellido`, `s_apellido`, `run`, `nacionalidad`, `direccion`, `comuna`, `sexo`, `fecha_nacimiento`, `email`, `numero_telefonico`, `password_usuario`, `token`, `id_rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(8, 'Geannelee', 'Diana', 'Araya', 'Millacan', '1234567-k', 'chilena', 'casa 1234', 'maipu', 'M', '2024-10-28', 'nelly@gmail.com', 123456789, '$2y$10$ZjADnKHZkKk2kNGcGUd90Ojv.x5WKvkwUza0B1CGCLGQJb7uFESiO', '', 1, '2024-10-28 12:39:07', '0000-00-00 00:00:00'),
(9, 'Victor', 'Camilo', 'Fuenzalida', 'Ramirez', '17942848-2', 'chilena', 'casa 12345', 'maipu', 'M', '1991-10-02', 'victor@gmail.com', 123456789, '$2y$10$JX6DvNwmj5NDJnWbYQyd3OsBLBgcvBGVLH34pkWMH0GMBhJWiz2cS', '', 1, '2024-10-28 15:04:36', '2024-11-03 21:06:47'),
(20, 'Marta', NULL, 'Millacán', 'Pichún', '14035486-4', 'Chilena', 'Rene Olivares Becerra 1990', 'Maipu', 'F', '1972-05-03', 'marta.1972@gmail.com', 830246509, '$2y$10$ZjADnKHZkKk2kNGcGUd90Ojv.x5WKvkwUza0B1CGCLGQJb7uFESiO', '', 1, '2024-11-04 12:28:38', '2024-11-04 12:28:38'),
(21, 'Matias', NULL, 'Ferreira', 'Millacan', '20221528-9', 'Chilena', 'Rene Olivares Becerra 1990', 'Maipu', 'M', '2002-06-25', 'matifm@gmail.com', 940955232, '$2y$10$ZjADnKHZkKk2kNGcGUd90Ojv.x5WKvkwUza0B1CGCLGQJb7uFESiO', '', 2, '2024-11-04 12:28:38', '2024-11-04 12:28:38'),
(22, 'Maricruz', NULL, 'Ferreira', 'Millacán', '18739106-7', 'Chilena', 'Rene Olivares Becerra 1990', 'Maipu', 'F', '1998-05-03', 'mari.ferreira@gmail.com', 932210574, '$2y$10$ZjADnKHZkKk2kNGcGUd90Ojv.x5WKvkwUza0B1CGCLGQJb7uFESiO', '', 3, '2024-11-04 12:28:38', '2024-11-04 12:28:38'),
(23, 'Lidia', NULL, 'Millacán', 'Pichún', '11968971-6', 'Chilena', 'Camino a Lonquen Norte Parcela 20', 'Calera de Tango', 'F', '1972-08-03', 'l.o.millacan@gmail.com', 855289755, '$2y$10$ZjADnKHZkKk2kNGcGUd90Ojv.x5WKvkwUza0B1CGCLGQJb7uFESiO', '', 3, '2024-11-04 12:28:38', '2024-11-04 12:28:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
