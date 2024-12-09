-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2024 a las 14:53:30
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
-- Base de datos: `market-pos-3`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_eliminar_venta` (IN `p_nro_boleta` VARCHAR(8))   BEGIN

DECLARE v_codigo VARCHAR(20);
DECLARE v_cantidad FLOAT;
DECLARE done INT DEFAULT FALSE;
DECLARE cursor_i CURSOR FOR 
SELECT codigo_producto,cantidad 
FROM venta_detalle 
where CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN cursor_i;
read_loop: LOOP
FETCH cursor_i INTO v_codigo, v_cantidad;

	IF done THEN
	  LEAVE read_loop;
	END IF;
    
    UPDATE PRODUCTOS 
       SET stock_producto = stock_producto + v_cantidad
    WHERE CAST(codigo_producto AS CHAR CHARACTER SET utf8) = CAST(v_codigo AS CHAR CHARACTER SET utf8);

END LOOP;
CLOSE cursor_i;

DELETE FROM VENTA_DETALLE WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8) = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;
DELETE FROM VENTA_CABECERA WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;

SELECT 'Se eliminó correctamente la venta';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductos` ()  NO SQL BEGIN
SELECT '' as detalles,
p.id, 
p.codigo_producto,
c.id_categoria,
c.nombre_categoria,
p.descripcion_producto,
round(p.precio_compra_producto,2) as precio_compra,
round(p.precio_venta_producto,2) as precio_venta,
round(p.utilidad,2) as utilidad,

case when c.aplica_peso = 1 then concat(p.stock_producto, 'Kg(s)') else concat(p.stock_producto, 'Und(s)') end as stock,
case when c.aplica_peso = 1 then concat(p.minimo_stock_producto, 'Kg(s)') else concat(p.minimo_stock_producto, 'Und(s)') end as minimo_stock,
case when c.aplica_peso = 1 then concat(p.ventas_producto, 'Kg(s)') else concat(p.ventas_producto, 'Und(s)') end as ventas,
p.fecha_vencimiento,
p.ubicacion,
p.fecha_creacion_producto,
p.fecha_actualizacion_producto,
'' as opciones

from productos p INNER JOIN categorias c on p.id_categoria_producto = c.id_categoria order by p.id desc;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosMasVendidos` ()  NO SQL BEGIN

select  p.codigo_producto,
		p.descripcion_producto,
        sum(vd.cantidad) as cantidad,
        sum(Round(vd.total_venta,2)) as total_venta
from venta_detalle vd inner join productos p on
vd.codigo_producto = p.codigo_producto
group by p.codigo_producto,
         p.descripcion_producto
order by sum(Round(vd.total_venta,2)) desc            
limit 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosPocoStock` ()   BEGIN
select p.codigo_producto,
	p.descripcion_producto,
    p.stock_producto,
    p.minimo_stock_producto
from productos p
where p.stock_producto <= p.minimo_stock_producto
order by p.stock_producto asc;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosSinVentaMes` ()  NO SQL BEGIN

SELECT p.codigo_producto,
       p.descripcion_producto,
       p.stock_producto,
       p.minimo_stock_producto
FROM productos p
LEFT JOIN venta_detalle vd 
    ON p.codigo_producto = vd.codigo_producto
    AND MONTH(vd.fecha_venta) = MONTH(CURRENT_DATE()) 
    AND YEAR(vd.fecha_venta) = YEAR(CURRENT_DATE())
WHERE vd.codigo_producto IS NULL
ORDER BY p.descripcion_producto;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarUsuarios` ()  NO SQL SELECT 
    '' AS detalles,
    u.id_usuario,
    u.nombre_usuario,
    u.apellido_usuario,
    u.usuario,
    u.clave,
    p.id_perfil,
    p.descripcion,
    CASE 
        WHEN u.estado = 1 THEN 'Activo'
        ELSE 'Inactivo'
    END AS estado,
    '' AS opciones
FROM 
    usuarios u 
INNER JOIN 
    perfiles p 
    ON u.id_perfil_usuario = p.id_perfil$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerDatosDashboard` ()  NO SQL BEGIN
DECLARE totalProductos int;
DECLARE totalCompras float;
DECLARE totalVentas float;
DECLARE ganancias float;
DECLARE productosPocoStock int;
DECLARE ventasHoy float;

SET totalProductos = (SELECT count(*) FROM productos p);

SET totalCompras = (select sum(p.precio_compra_producto*p.stock_producto) from productos p);

set totalVentas = (select sum(vc.total_venta) from venta_cabecera vc where EXTRACT(MONTH FROM vc.fecha_venta) = EXTRACT(MONTH FROM curdate()) and EXTRACT(YEAR FROM vc.fecha_venta) = EXTRACT(YEAR FROM curdate()));

set ganancias = (select sum(vd.total_venta - (p.precio_compra_producto * vd.cantidad)) from venta_detalle vd inner join productos p on vd.codigo_producto = p.codigo_producto where EXTRACT(MONTH FROM vd.fecha_venta) = EXTRACT(MONTH FROM curdate()) and EXTRACT(YEAR FROM vd.fecha_venta) = EXTRACT(YEAR FROM curdate()));

set productosPocoStock = (select count(1) from productos p where p.stock_producto <= p.minimo_stock_producto);
SET ventasHoy = (SELECT SUM(vc.total_venta) FROM venta_cabecera vc WHERE DATE(vc.fecha_venta) = CURDATE());

SELECT IFNULL(totalProductos,0) AS totalProductos,
	   IFNULL(ROUND(totalCompras,2),0) AS totalCompras,
       IFNULL(ROUND(totalVentas,2),0) AS totalVentas,
       IFNULL(ROUND(ganancias,2),0) AS ganancias,
       IFNULL(productosPocoStock,0) AS productosPocoStock,
       IFNULL(ROUND(ventasHoy,2),0) AS ventasHoy;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_obtenerNroBoleta` ()  NO SQL select serie_boleta,
		ifnull(LPAD(max(c.nro_correlativo_venta)+1,8,'0'),'00000001') nro_venta
from empresa c$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerVentasMesActual` ()  NO SQL BEGIN

SELECT date(vc.fecha_venta) as fecha_venta,
	   sum(round(vc.total_venta)) as total_venta
FROM venta_cabecera vc
where date(vc.fecha_venta) >=date(last_day(now() - INTERVAL 1 month) + INTERVAL 1 day)
and date(vc.fecha_venta) <= last_day(date(current_date))
GROUP BY date(vc.fecha_venta);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_PorVencer` ()  NO SQL BEGIN

SELECT p.codigo_producto,
       p.descripcion_producto,
       p.stock_producto,
       p.minimo_stock_producto,
       p.fecha_vencimiento
FROM productos p
WHERE p.fecha_vencimiento IS NOT NULL
  AND p.fecha_vencimiento <= DATE_ADD(CURRENT_DATE(), INTERVAL 10 DAY)
  AND p.fecha_vencimiento >= CURRENT_DATE()
ORDER BY p.fecha_vencimiento;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `aplica_peso` int(11) NOT NULL,
  `fecha_creacion_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_categoria` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `aplica_peso`, `fecha_creacion_categoria`, `fecha_actualizacion_categoria`) VALUES
(96, 'Frutas', 1, '2024-12-09 00:01:23', '2024-12-09'),
(97, 'Verduras', 1, '2024-12-09 00:01:23', '2024-12-09'),
(98, 'Snack', 0, '2024-12-09 00:01:23', '2024-12-09'),
(99, 'Avena', 0, '2024-12-09 00:01:23', '2024-12-09'),
(100, 'Energizante', 0, '2024-12-09 00:01:23', '2024-12-09'),
(101, 'Jugo', 0, '2024-12-09 00:01:23', '2024-12-09'),
(102, 'Refresco', 0, '2024-12-09 00:01:23', '2024-12-09'),
(103, 'Mantequilla', 0, '2024-12-09 00:01:23', '2024-12-09'),
(104, 'Gaseosa', 0, '2024-12-09 00:01:23', '2024-12-09'),
(105, 'Aceite', 0, '2024-12-09 00:01:23', '2024-12-09'),
(106, 'Yogurt', 0, '2024-12-09 00:01:23', '2024-12-09'),
(107, 'Arroz', 0, '2024-12-09 00:01:23', '2024-12-09'),
(108, 'Leche', 0, '2024-12-09 00:01:23', '2024-12-09'),
(109, 'Atún', 0, '2024-12-09 00:01:23', '2024-12-09'),
(110, 'Chocolate', 0, '2024-12-09 00:01:23', '2024-12-09'),
(111, 'Wafer', 0, '2024-12-09 00:01:23', '2024-12-09'),
(112, 'Golosina', 0, '2024-12-09 00:01:23', '2024-12-09'),
(113, 'Galletas', 0, '2024-12-09 00:01:23', '2024-12-09'),
(114, 'Mascotas', 0, '2024-12-09 01:15:22', '2024-12-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razon_social` text NOT NULL,
  `rut` text NOT NULL,
  `direccion` text NOT NULL,
  `marca` text NOT NULL,
  `serie_boleta` varchar(4) NOT NULL,
  `nro_correlativo_venta` varchar(8) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon_social`, `rut`, `direccion`, `marca`, `serie_boleta`, `nro_correlativo_venta`, `email`) VALUES
(1, 'La Martita', '14.744.404-4', 'René Olivares Becerra 1990, Villa Los Héroes Maipú, Chile', 'La Martita', '0002', '00000053', 'almacen_la_martita@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `vista` varchar(45) DEFAULT NULL,
  `icon_menu` varchar(45) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `padre_id`, `vista`, `icon_menu`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Tablero Principal', NULL, 'dashboard.php', 'fas fa-tachometer-alt', NULL, NULL),
(2, 'Ventas', NULL, '', 'fas fa-store-alt', NULL, NULL),
(3, 'Punto de Venta', 2, 'ventas.php', 'far fa-circle', NULL, NULL),
(4, 'Administrar Ventas', 2, 'administrar_ventas.php', 'far fa-circle', NULL, NULL),
(5, 'Productos', NULL, NULL, 'fas fa-cart-plus', NULL, NULL),
(6, 'Inventario', 5, 'productos.php', 'far fa-circle', NULL, NULL),
(7, 'Carga Masiva', 5, 'carga_masiva_productos.php', 'far fa-circle', NULL, NULL),
(8, 'Categorías', 5, 'categorias.php', 'far fa-circle', NULL, NULL),
(9, 'Compras', NULL, 'compras.php', 'fas fa-dolly', NULL, NULL),
(10, 'Reportes', NULL, 'reportes.php', 'fas fa-chart-line', NULL, NULL),
(11, 'Configuración', NULL, 'configuracion.php', 'fas fa-cogs', NULL, NULL),
(12, 'Usuarios', NULL, 'usuarios.php', 'fas fa-users', NULL, NULL),
(13, 'Módulos y Perfiles', NULL, 'modulos_perfiles.php', 'fas fa-tablet-alt', NULL, NULL),
(15, 'Caja', NULL, 'caja.php', 'fas fa-shopping-bag', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Administrador', 1, NULL, NULL),
(2, 'Vendedor', 1, NULL, NULL),
(3, 'Bodeguero', 1, '2024-12-06 09:18:43', '2024-12-06 12:18:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_modulo`
--

CREATE TABLE `perfil_modulo` (
  `idperfil_modulo` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `vista_inicio` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil_modulo`
--

INSERT INTO `perfil_modulo` (`idperfil_modulo`, `id_perfil`, `id_modulo`, `vista_inicio`, `estado`) VALUES
(13, 1, 13, NULL, 1),
(74, 3, 7, 1, 1),
(75, 3, 5, 0, 1),
(76, 3, 6, 0, 1),
(77, 3, 8, 0, 1),
(82, 2, 3, 1, 1),
(83, 2, 2, 0, 1),
(84, 2, 4, 0, 1),
(91, 1, 1, 1, 1),
(92, 1, 3, 0, 1),
(93, 1, 2, 0, 1),
(94, 1, 4, 0, 1),
(95, 1, 10, 0, 1),
(96, 1, 12, 0, 1),
(97, 1, 5, 0, 1),
(98, 1, 6, 0, 1),
(99, 1, 7, 0, 1),
(100, 1, 8, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` bigint(13) NOT NULL,
  `id_categoria_producto` int(11) DEFAULT NULL,
  `descripcion_producto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_compra_producto` float NOT NULL,
  `precio_venta_producto` float NOT NULL,
  `precio_mayor_producto` float DEFAULT NULL,
  `precio_oferta_producto` float DEFAULT NULL,
  `utilidad` float NOT NULL,
  `stock_producto` float DEFAULT NULL,
  `minimo_stock_producto` float DEFAULT NULL,
  `ventas_producto` float DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `ubicacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_creacion_producto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_producto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `id_categoria_producto`, `descripcion_producto`, `precio_compra_producto`, `precio_venta_producto`, `precio_mayor_producto`, `precio_oferta_producto`, `utilidad`, `stock_producto`, `minimo_stock_producto`, `ventas_producto`, `fecha_vencimiento`, `ubicacion`, `fecha_creacion_producto`, `fecha_actualizacion_producto`) VALUES
(17, 7755139002809, 103, 'Mantequilla Colun 250', 1200, 1800, 1440, 1080, 600, 3, 10, 0, '2024-05-01', 'Estante A', '2024-12-09 01:40:43', '2024-12-09'),
(18, 7755139002810, 98, 'Chocolate trencito 100 gr', 700, 1000, 800, 600, 300, 30, 5, 0, '2024-12-12', 'Estante B', '2024-12-09 01:24:07', '2024-12-09'),
(21, 7755139002812, 114, 'Collar de perro azul', 2000, 2500, 2000, 1500, 500, 10, 5, 1, '0000-00-00', 'Estante Mascotas', '2024-12-09 05:38:35', '2024-12-09'),
(22, 7755139002813, 96, 'Manzana Roja', 1100, 1400, 1120, 840, 300, 9.5, 5, 0.5, '2024-12-14', 'Estante Frutas', '2024-12-09 01:19:28', '2024-12-09'),
(25, 123456785, 113, 'Galletas Triton 125 gr chocolate', 400, 650, 520, 390, 250, 25, 15, 0, '2025-03-31', 'Estante C', '2024-12-09 05:55:37', '2024-12-09');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `before_insert_productos` BEFORE INSERT ON `productos` FOR EACH ROW BEGIN
    SET NEW.precio_mayor_producto = ROUND(NEW.precio_venta_producto * (1 - 0.20), 2);
    SET NEW.precio_oferta_producto = ROUND(NEW.precio_venta_producto * (1 - 0.40), 2);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_productos` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN
    SET NEW.precio_mayor_producto = ROUND(NEW.precio_venta_producto * (1 - 0.20), 2);
    SET NEW.precio_oferta_producto = ROUND(NEW.precio_venta_producto * (1 - 0.40), 2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `id_perfil_usuario` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `usuario`, `clave`, `id_perfil_usuario`, `estado`) VALUES
(2, 'Geannelee', 'Araya', 'vendedor1', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 2, 1),
(9, 'Victor', 'Fuenzalida', 'admin', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 1, 1),
(15, 'Matias', 'Ferreira', 'bodeguero1', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id_boleta` int(11) NOT NULL,
  `nro_boleta` varchar(8) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `total_venta` float DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_cabecera`
--

INSERT INTO `venta_cabecera` (`id_boleta`, `nro_boleta`, `descripcion`, `total_venta`, `fecha_venta`) VALUES
(88, '00000053', 'Venta realizada con Nro Boleta: 00000053', 3200, '2024-12-09 01:19:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `nro_boleta` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `cantidad` float NOT NULL,
  `total_venta` float NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id`, `nro_boleta`, `codigo_producto`, `cantidad`, `total_venta`, `fecha_venta`) VALUES
(679, '00000053', 7755139002813, 0.5, 700, '2024-12-09 01:19:28'),
(680, '00000053', 7755139002812, 1, 2500, '2024-12-09 01:19:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`) USING HASH;

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD PRIMARY KEY (`idperfil_modulo`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`,`codigo_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_perfil_usuario` (`id_perfil_usuario`);

--
-- Indices de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD PRIMARY KEY (`id_boleta`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  MODIFY `idperfil_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD CONSTRAINT `id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil_usuario`) REFERENCES `perfiles` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
