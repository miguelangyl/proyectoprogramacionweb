-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2024 a las 07:47:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `correo`, `direccion`) VALUES
(1, 'Sonni ', 'sonnij123@gmail.com', 'holaholahola'),
(2, 'Sonni ', 'sonnij123@gmail.com', 'holaholahola'),
(3, 'Sonni ', 'sonnij123@gmail.com', 'holaholahola'),
(4, 'diego abel ', 'abel@gmail.com', 'chaman'),
(5, 'ernesto', 'ernesto@gmail.com', 'holaholahola'),
(6, 'ernesto', 'ernesto@gmail.com', 'holaholahola'),
(7, 'ernesto', 'ernesto@gmail.com', 'holaholahola'),
(8, 'abelito', 'abelito@gmail.com', 'construccion'),
(9, 'gabriel', 'abelito@gmail.com', 'san juan'),
(10, 'diego', 'diego@gmail.com', 'upíicsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pago`
--

CREATE TABLE `detalles_pago` (
  `id_pago` int(11) NOT NULL,
  `id_proceso` int(11) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `numero_tarjeta` varchar(20) DEFAULT NULL,
  `fecha_vencimiento` varchar(5) DEFAULT NULL,
  `cvv` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pago`
--

INSERT INTO `detalles_pago` (`id_pago`, `id_proceso`, `metodo_pago`, `numero_tarjeta`, `fecha_vencimiento`, `cvv`) VALUES
(4, 4, 'tarjeta', '11112222333344444', '12/12', '345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `numero_recibo` varchar(255) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `archivo_factura` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `numero_recibo`, `cliente`, `direccion`, `fecha`, `subtotal`, `impuestos`, `total`, `archivo_factura`, `fecha_creacion`) VALUES
(2, 'RC-20241208072753', 'juan', 'delegacion iztacalco', '2024-12-08', 168.00, 33.60, 201.60, '', '2024-12-08 06:27:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_compra`
--

CREATE TABLE `procesos_compra` (
  `id_proceso` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_proceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_compra`
--

INSERT INTO `procesos_compra` (`id_proceso`, `id_cliente`, `fecha_proceso`) VALUES
(1, 1, '2024-12-07 14:25:27'),
(2, 2, '2024-12-07 14:31:25'),
(3, 3, '2024-12-07 14:31:30'),
(4, 4, '2024-12-07 14:40:56'),
(5, 5, '2024-12-07 14:49:31'),
(6, 6, '2024-12-07 14:50:18'),
(7, 7, '2024-12-07 14:52:32'),
(8, 8, '2024-12-07 15:39:49'),
(9, 9, '2024-12-07 16:04:52'),
(10, 10, '2024-12-08 00:07:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `precio`, `imagen`) VALUES
(1, 'Jabón Líquido', 'Jabones', 10.00, 'jabon_liquido.jpg'),
(2, 'Jabón en Barra', 'Jabones', 8.00, 'jabon_barra.jpg'),
(3, 'Jabón Orgánico', 'Jabones', 12.00, 'jabon_organico.jpg'),
(4, 'Detergente Líquido', 'Detergentes', 15.00, 'detergente_liquido.jpg'),
(5, 'Detergente en Polvo', 'Detergentes', 12.00, 'detergente_polvo.jpg'),
(6, 'Detergente Bio', 'Detergentes', 14.00, 'detergente_bio.jpg'),
(7, 'Limpiador Multi-Superficie', 'Limpiadores', 11.00, 'limpiador_multisuperficie.jpg'),
(8, 'Limpiador de Vidrio', 'Limpiadores', 9.00, 'limpiador_vidrio.jpg'),
(9, 'Limpiador Ambiental', 'Limpiadores', 13.00, 'limpiador_ambiental.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`) VALUES
(1, 'Sonni ', '1234'),
(2, 'abel', 'chaman69'),
(4, 'diego abel ', 'chamanpizza'),
(5, 'abelito', 'pentagrama'),
(6, 'ernesto', 'rancho'),
(7, 'jesus', '3456'),
(8, 'sebas', 'hola');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalles_pago`
--
ALTER TABLE `detalles_pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_proceso` (`id_proceso`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `procesos_compra`
--
ALTER TABLE `procesos_compra`
  ADD PRIMARY KEY (`id_proceso`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalles_pago`
--
ALTER TABLE `detalles_pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `procesos_compra`
--
ALTER TABLE `procesos_compra`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pago`
--
ALTER TABLE `detalles_pago`
  ADD CONSTRAINT `detalles_pago_ibfk_1` FOREIGN KEY (`id_proceso`) REFERENCES `procesos_compra` (`id_proceso`);

--
-- Filtros para la tabla `procesos_compra`
--
ALTER TABLE `procesos_compra`
  ADD CONSTRAINT `procesos_compra_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
