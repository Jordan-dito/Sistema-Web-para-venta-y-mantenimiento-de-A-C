-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-hermanosfrios2024.alwaysdata.net
-- Generation Time: May 28, 2025 at 06:51 PM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hermanosfrios2024_sistemadeventas`
--
CREATE DATABASE IF NOT EXISTS `hermanosfrios2024_sistemadeventas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hermanosfrios2024_sistemadeventas`;

-- --------------------------------------------------------

--
-- Table structure for table `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id_cotizacion` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `orden_trabajo` varchar(50) DEFAULT NULL,
  `solicitud` text DEFAULT NULL,
  `estado_cotizacion` varchar(20) NOT NULL,
  `observacion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `cotizacion`
--

INSERT INTO `cotizacion` (`id_cotizacion`, `nombres`, `apellidos`, `correo`, `telefono`, `orden_trabajo`, `solicitud`, `estado_cotizacion`, `observacion`, `fecha`, `id_rol`) VALUES
(26, 'Denisse ', 'Alvarado', 'denisse-alvarado@hot', '0981004805', 'Compra A/C', NULL, 'En proceso', 'Listo', '2025-02-03 18:35:04', 6),
(27, 'Gabriela ', 'Arias', 'g_arias@hotmail.com', '0994502281', 'Instalacion A/C', NULL, 'En proceso', 'Listo', '2025-02-03 18:38:53', 6),
(31, 'Bryan ', 'Caicedo', 'bryan_caicedo@hotmail.com', '0987654321', 'Compra A/C', NULL, 'En proceso', 'Cliente satisfecho', '2025-02-22 14:54:07', 6);

-- --------------------------------------------------------

--
-- Table structure for table `distribuidora`
--

CREATE TABLE `distribuidora` (
  `id_distribuidora` int(11) NOT NULL,
  `compania` varchar(100) NOT NULL,
  `ruc` varchar(13) NOT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `estado` varchar(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distribuidora`
--

INSERT INTO `distribuidora` (`id_distribuidora`, `compania`, `ruc`, `ciudad`, `provincia`, `direccion`, `telefono`, `correo`, `estado`) VALUES
(28, 'DITODEVS', '0952491157001', 'GUAYAQUIL', 'GUAYAS', 'gfgfg', '0987654321', '1363@gmail.com', 'Activo'),
(29, 'michi', '0952491157001', 'MONTÚFAR', 'CARCHI', 'gfgfg', '985754703', '12@gmail.com', 'Activo'),
(30, 'MC-AIRES SAS', '0993341495001', 'GUAYAQUIL', 'GUAYAS', 'Coop. Aguirre Abad Mz. 119 Solar 55', '(593)3901466', 'mcimportaciones@live.com', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `horariostecnicos`
--

CREATE TABLE `horariostecnicos` (
  `ID_HorarioTecnico` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Dia_Inicio_Semana` varchar(10) NOT NULL,
  `Dia_Fin_Semana` varchar(10) NOT NULL,
  `Horario_Inicio` time NOT NULL,
  `Horario_Fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `horariostecnicos`
--

INSERT INTO `horariostecnicos` (`ID_HorarioTecnico`, `ID_Usuario`, `Dia_Inicio_Semana`, `Dia_Fin_Semana`, `Horario_Inicio`, `Horario_Fin`) VALUES
(32, 4, 'Lunes', 'Sábado', '08:00:00', '17:00:00'),
(38, 16, 'Lunes', 'Viernes', '08:00:00', '17:00:00'),
(39, 21, 'Lunes', 'Viernes', '08:00:00', '17:00:00'),
(41, 28, 'Lunes', 'Miércoles', '08:00:00', '17:00:00'),
(42, 34, 'Lunes', 'Viernes', '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_instalacion`
--

CREATE TABLE `ordenes_instalacion` (
  `id_instalacion` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `numero_factura` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `id_horario_tecnico` int(11) DEFAULT NULL,
  `fecha_instalacion` datetime NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `iva_porcentaje` decimal(5,2) DEFAULT 0.00,
  `precio_venta` decimal(10,2) DEFAULT 0.00,
  `valor_iva` decimal(10,2) DEFAULT 0.00,
  `total_con_iva` decimal(10,2) DEFAULT 0.00,
  `datos_extras` text DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes_instalacion`
--

INSERT INTO `ordenes_instalacion` (`id_instalacion`, `fecha_orden`, `numero_factura`, `cedula`, `nombre_cliente`, `correo_cliente`, `id_horario_tecnico`, `fecha_instalacion`, `id_producto`, `iva_porcentaje`, `precio_venta`, `valor_iva`, `total_con_iva`, `datos_extras`, `fyh_creacion`) VALUES
(8, '0000-00-00', '001', '0952491157', 'Jordan', 'jordanmalave18@gmail.com', 42, '2025-05-27 01:47:00', 5, 15.00, 82.50, 12.38, 94.88, '\nNombre: compresores\nDescripción: potencia y calidad\nPrecio Venta: $82.50\nIVA (15%): $12.38\nTotal con IVA: $94.88\n    ', '2025-05-27 01:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_mantenimiento`
--

CREATE TABLE `ordenes_mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `numero_factura` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `id_horario_tecnico` int(11) DEFAULT NULL,
  `fecha_mantenimiento` datetime NOT NULL,
  `fecha_proximo_mantenimiento` datetime DEFAULT NULL,
  `tipo_servicio` enum('Mantenimiento','Reparación') NOT NULL DEFAULT 'Mantenimiento',
  `datos_extras` text DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `costo_servicio` decimal(10,2) DEFAULT 0.00,
  `iva_porcentaje` decimal(5,2) DEFAULT 0.00,
  `valor_iva` decimal(10,2) DEFAULT 0.00,
  `total_con_iva` decimal(10,2) DEFAULT 0.00,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes_mantenimiento`
--

INSERT INTO `ordenes_mantenimiento` (`id_mantenimiento`, `fecha_orden`, `numero_factura`, `cedula`, `nombre_cliente`, `correo_cliente`, `id_horario_tecnico`, `fecha_mantenimiento`, `fecha_proximo_mantenimiento`, `tipo_servicio`, `datos_extras`, `id_producto`, `costo_servicio`, `iva_porcentaje`, `valor_iva`, `total_con_iva`, `cantidad`) VALUES
(11, '2025-05-13', '006', '0952491157', 'Jordan Malavé', 'jordanmalave18@gmail.com', 41, '2025-05-13 19:08:00', NULL, 'Mantenimiento', 'Mantenimiento semestral', 27, 30.00, 15.00, 4.50, 34.50, 2),
(18, '2025-05-12', '004', '0952491157', 'Jordan', 'jordanmalave18@gmail.com', 41, '2025-05-13 19:08:00', NULL, 'Mantenimiento', NULL, 27, 30.00, 15.00, 4.50, 34.50, 2),
(19, '2025-05-13', '006', '0952491157', 'Jordan Malavé', 'jordanmalave18@gmail.com', 41, '2025-05-13 19:08:00', NULL, 'Mantenimiento', 'Mantenimiento semestral', 27, 30.00, 15.00, 4.50, 34.50, 2),
(23, '0000-00-00', '002', '0952491157', 'Jordan', 'jordanmalave18@gmail.com', 41, '2025-05-28 17:16:00', '2025-11-28 17:16:00', 'Mantenimiento', '\nNombre: Aire Acondicionado Split Indurama \nDescripción: Aire Acondicionado  ASI-185A | 18000 BTU\nCantidad seleccionada: 2\nCosto Servicio: $0.00\nIVA (15%): $0.00\nTotal Servicio + IVA: $0.00\n    ', 27, 0.00, 15.00, 0.00, 0.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_almacen`
--

CREATE TABLE `tb_almacen` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` varchar(255) NOT NULL,
  `precio_venta` varchar(255) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_almacen`
--

INSERT INTO `tb_almacen` (`id_producto`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `imagen`, `id_usuario`, `id_categoria`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(5, 'P-00002', 'compresores', 'potencia y calidad', 0, 20, 50, '60', '82.5', '2024-05-16', '2024-05-16-09-43-28__compresores.jpg', 2, 4, '2024-05-16 21:43:28', '2024-12-16 21:55:22', 'activo'),
(7, 'P-00003', 'Alicate', 'Alicate', 0, 100, 201, '5', '8', '2024-07-03', '2024-07-03-10-57-10__alicate.png', 2, 5, '2024-07-03 22:57:10', '2024-12-31 19:21:34', 'activo'),
(14, 'P-00004', 'Tornillo', 'Tornillo', 0, 10, 100, '10', '20', '2024-10-26', '2024-10-26-01-23-56__images.jpg', 3, 5, '2024-10-26 13:23:56', '2024-10-26 13:24:58', 'inactivo'),
(17, 'P-00005', 'dssssfds', 'hyugvhmghhkmj', 9, 24, 45, '45', '69', '2025-01-30', '2025-01-04-03-08-43__Captura de pantalla 2024-06-18 180946.png', 3, 1, '2025-01-04 15:08:43', '2025-05-01 00:49:31', 'activo'),
(20, 'P-00006', 'A/C Indurama', '12.000 btu', 20, 1, 100, '50', '100', '2025-02-03', '2025-02-03-09-57-14__images.jpg', 3, 13, '2025-02-03 21:57:14', '2025-05-01 01:12:11', 'activo'),
(21, 'P-00007', 'A/C CHIGO', '12000 BTU', -3, 5, 100, '200', '400', '2025-02-24', '2025-02-24-09-24-03__images.jpg', 3, 1, '2025-02-24 21:24:03', '2025-02-24 21:24:38', 'activo'),
(22, 'P-00008', 'Soporte para A/C Split ', '120kG', 51, 5, 100, '10', '20', '2025-02-24', '2025-02-24-09-27-25__17029310940.jpg', 3, 5, '2025-02-24 21:27:25', '0000-00-00 00:00:00', 'activo'),
(23, 'P-00009', 'dfa', 'asdfgh', 0, 5, 100, '20', '30', '2025-02-24', '', 3, 1, '2025-02-24 21:27:57', '2025-02-24 21:28:16', 'inactivo'),
(24, 'P-00010', 'BOMBA DE CONDENSACIÓN', 'Bomba de drenaje', 0, 5, 100, '40', '80', '2025-03-29', '2025-03-29-10-56-59__Bomba_condesacion.jpg', 3, 4, '2025-03-29 10:56:59', '2025-03-30 11:46:26', 'activo'),
(25, 'P-00011', 'A/C Panasonic', '12.000 BTU Ecologico', 3, 5, 100, '100', '200', '2025-04-19', '2025-04-19-12-57-34__panasonic.jpg', 3, 1, '2025-04-19 12:57:34', '2025-04-19 12:59:07', 'activo'),
(26, 'P-00011', 'Filtros de aire', 'Filtros para A/C', 0, 5, 100, '10', '20', '2025-04-29', '2025-04-29-10-04-01__filtros de aire.jpg', 3, 4, '2025-04-29 22:04:01', '2025-04-29 22:05:12', 'activo'),
(27, 'P-00012', 'Aire Acondicionado Split Indurama ', 'Aire Acondicionado  ASI-185A | 18000 BTU', 8, 5, 10, '300', '348', '2025-05-01', '2025-05-01-01-11-35__INDURAMA.jpg', 3, 13, '2025-05-01 01:11:35', '0000-00-00 00:00:00', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_carrito`
--

CREATE TABLE `tb_carrito` (
  `id_carrito` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tb_carrito`
--

INSERT INTO `tb_carrito` (`id_carrito`, `nro_venta`, `id_producto`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(3, 0, 5, 4, '2024-05-26 17:33:34', '0000-00-00 00:00:00'),
(5, 0, 5, 2, '2024-05-26 19:18:55', '0000-00-00 00:00:00'),
(88, 8, 14, 5, '2024-12-30 01:15:05', '0000-00-00 00:00:00'),
(90, 9, 7, 9, '2024-12-31 19:54:57', '0000-00-00 00:00:00'),
(103, 9, 20, 50, '2025-02-03 22:04:14', '0000-00-00 00:00:00'),
(104, 10, 17, 21, '2025-02-03 22:25:50', '0000-00-00 00:00:00'),
(105, 10, 20, 10, '2025-02-03 22:26:04', '0000-00-00 00:00:00'),
(106, 11, 21, 10, '2025-02-24 21:37:07', '0000-00-00 00:00:00'),
(111, 12, 22, 10, '2025-02-24 21:51:55', '0000-00-00 00:00:00'),
(112, 12, 21, 1, '2025-02-24 21:52:17', '0000-00-00 00:00:00'),
(115, 13, 5, 1, '2025-03-26 12:29:20', '0000-00-00 00:00:00'),
(119, 15, 24, 2, '2025-03-30 11:29:28', '0000-00-00 00:00:00'),
(127, 19, 20, 8, '2025-04-19 14:19:36', '0000-00-00 00:00:00'),
(128, 20, 21, 5, '2025-04-19 14:20:57', '0000-00-00 00:00:00'),
(129, 21, 24, 5, '2025-04-19 14:21:58', '0000-00-00 00:00:00'),
(144, 1, 26, 2, '2025-04-30 22:23:10', '0000-00-00 00:00:00'),
(145, 2, 17, 1, '2025-05-01 00:59:52', '0000-00-00 00:00:00'),
(146, 3, 27, 2, '2025-05-04 12:24:00', '0000-00-00 00:00:00'),
(147, 4, 17, 1, '2025-05-26 10:38:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `nombre_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'SERVICIOS', '2023-01-24 22:25:10', '2024-08-15 23:56:22'),
(4, 'REPUESTOS', '2023-01-25 14:41:14', '2024-05-16 21:34:54'),
(5, 'ACCESORIOS', '2023-01-25 14:43:06', '2024-05-16 21:35:07'),
(13, 'A/C', '2025-05-01 00:52:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `nit_ci_cliente` varchar(255) NOT NULL,
  `celular_cliente` varchar(50) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `estado` varchar(20) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nombre_cliente`, `nit_ci_cliente`, `celular_cliente`, `email_cliente`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(55, 'Jordan', '0952491157', '0990122698', 'jordanmalave18@gmail.com', '2025-04-23 16:43:55', '0000-00-00 00:00:00', 'activo'),
(56, 'Carlos Perez', '0930366802', '0985975993 ', 'cperezsolorzano@hotmail.com', '2025-04-29 21:18:18', '0000-00-00 00:00:00', 'inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nro_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio_compra` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `iva` decimal(5,2) DEFAULT 0.00,
  `precio_total` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_compras`
--

INSERT INTO `tb_compras` (`id_compra`, `id_producto`, `nro_compra`, `fecha_compra`, `id_proveedor`, `comprobante`, `id_usuario`, `precio_compra`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`, `iva`, `precio_total`) VALUES
(106, 26, 1, '2025-04-30', 27, '12', 3, '23.00', 2, '2025-04-30 23:38:51', '2025-05-01 00:47:20', 14.00, 52.44);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modulos`
--

CREATE TABLE `tb_modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_modulos`
--

INSERT INTO `tb_modulos` (`id_modulo`, `nombre`, `estado`) VALUES
(1, 'Administracion', 'activo'),
(2, 'Ordenes de Trabajo', 'activo'),
(3, 'Categorías', 'activo'),
(4, 'Compras', 'activo'),
(5, 'Ventas', 'activo'),
(6, 'Seguridad', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permisos`
--

CREATE TABLE `tb_permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_permisos`
--

INSERT INTO `tb_permisos` (`id_permiso`, `id_rol`, `id_modulo`, `estado`) VALUES
(1, 1, 1, 'activo'),
(2, 1, 2, 'activo'),
(3, 1, 3, 'activo'),
(4, 1, 4, 'activo'),
(5, 1, 5, 'activo'),
(6, 3, 1, 'activo'),
(7, 3, 2, 'inactivo'),
(8, 3, 3, 'activo'),
(9, 3, 4, 'activo'),
(10, 3, 5, 'activo'),
(11, 4, 1, 'activo'),
(12, 4, 2, 'activo'),
(13, 4, 3, 'activo'),
(14, 4, 4, 'activo'),
(15, 4, 5, 'activo'),
(16, 5, 1, 'activo'),
(17, 5, 2, 'activo'),
(18, 5, 3, 'activo'),
(19, 5, 4, 'activo'),
(20, 5, 5, 'activo'),
(21, 1, 6, 'activo'),
(25, 4, 6, 'activo'),
(26, 5, 6, 'activo'),
(27, 3, 6, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proveedores`
--

CREATE TABLE `tb_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `estado` varchar(20) DEFAULT 'Activo',
  `id_distribuidora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_proveedores`
--

INSERT INTO `tb_proveedores` (`id_proveedor`, `nombre_proveedor`, `celular`, `telefono`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`, `estado`, `id_distribuidora`) VALUES
(26, 'CNE', '43344343', '0987654321', 'admin@gmail.com', 'DSSDSDSDDS', '2025-04-27 22:53:47', '2025-04-28 02:12:38', 'Activo', 29),
(27, 'babdud', '4654554', '985754703', 'jordanmalave18@gmail.com', 'gfgfg', '2025-04-27 23:35:20', '2025-04-28 02:08:01', 'Activo', 29),
(28, 'barcelona', '445454545', '0987654321', 'admin@gmail.com', 'gfgfg', '2025-04-28 02:13:11', '2025-04-28 02:13:18', 'Inactivo', 29),
(29, 'Kevin Diaz', '0990354573', '0926285917', 'kevinandresdiaspolo@gmail.com', 'Norte', '2025-04-29 21:25:41', '2025-04-29 21:41:12', 'Activo', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'ADMINISTRADOR', '2023-01-23 23:15:19', '2025-02-02 15:51:59'),
(3, 'TECNICO', '2023-01-23 19:11:28', '2024-08-16 19:52:58'),
(4, 'GERENTE', '2023-01-23 21:09:54', '2024-09-30 20:24:49'),
(5, 'SECRETARIA', '2023-01-24 08:28:24', '2024-09-30 20:25:10'),
(6, 'USUARIO COTIZADOR', '2024-08-03 21:43:08', '2024-08-03 21:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `telefono_empl` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion_emple` varchar(255) NOT NULL,
  `password_user` text NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'activo',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Dumping data for table `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `cedula`, `nombres`, `apellidos`, `telefono_empl`, `email`, `direccion_emple`, `password_user`, `estado_civil`, `id_rol`, `estado`, `fecha_creacion`) VALUES
(1, 0, 'admin', 'hgddsgndsds', 2147483647, 'admin@gmail.com', 'aerytcjfch', '$2y$10$VIDXuo4wKCt/x5BHkwHZAOw9lJNirjyLbBHPa9AA4/xgOW.91y/DG', 'Soltero', 1, 'activo', '2024-12-16 17:34:33'),
(2, 0, 'KENNY', 'marcillo', 999639651, 'marcillokenny@gmail.com', 'ddad', '$2y$10$epJ.ciWA2vvhKDtHlPUa6uU6LgDepwWFKqCzyQv9F/rSl/4Z.uG1G', 'Casado', 1, 'inactivo', '2024-12-16 17:34:33'),
(3, 9999999, 'prueba', 'prueba2', 99999999, 'jordanmalave18@gmail.com', 'guayas', '123456', 'Casado', 1, 'inactivo', '2024-12-16 17:34:33'),
(4, 943778027, 'Damian', 'Diaz', 999889, 'prueba2@gmail.com', 'guayas y quil', '$2y$10$bSrEsW10dh6txjRw4P14teWL0gTwR.lHQx0dD3al1Q22iZgFzQNBy', 'Casado', 3, 'inactivo', '2024-12-16 17:34:33'),
(13, 921815676, 'Alexander ', 'Ronquillo', 985754703, 'alex@hotmail.com', 'Norte', '1234567', 'divorciado', 1, 'inactivo', '2024-12-17 03:36:30'),
(14, 942652132, 'Haylis ', 'Lavayen', 990857815, 'haylis-lavayen@hotmail.com', 'Guayaquil', '12345', 'divorciado', 6, '1', '2025-02-03 18:56:42'),
(15, 916509706, 'Alexander ', 'Ronquillo', 985754703, 'garealex20@outlook.com', 'Norte', '12345', 'divorciado', 1, 'inactivo', '2025-02-03 19:03:13'),
(16, 955576848, 'José ', 'Macias', 980988472, 'jose-maciasr@hotmail.com', 'Sur', '12345', 'divorciado', 3, 'activo', '2025-02-04 02:35:05'),
(18, 952491157, 'dsdssdd', 'dsdsds', 52544222, 'jordanmalave18@gmail.com', 'jordanmalave18@gmail.com', '123456', 'divorciado', 1, 'inactivo', '2025-02-16 06:50:58'),
(19, 952491157, 'dsdssdd', 'dsdsds', 52544222, 'jordanmalave18@gmail.com', 'jordanmalave18@gmail.com', '123456', 'divorciado', 1, 'inactivo', '2025-02-16 07:02:53'),
(20, 952491157, 'dsdssdd', 'dsdsds', 6556767, 'jordanmalave18@gmail.com', 'medarrdo', '123456', 'divorciado', 4, 'inactivo', '2025-02-16 07:03:27'),
(21, 921815676, 'Alexander ', 'Caicedo', 987654321, 'alex-caicedo@gmail.com', 'Norte', '123456', 'divorciado', 3, '1', '2025-02-16 07:07:30'),
(22, 952491157, 'Darlyn', 'Macias', 54878787, 'jordanmalave18@gmail.com', 'Daule', '123456', 'divorciado', 6, '1', '2025-02-16 07:14:21'),
(23, 916509706, 'Alexander', 'Ronquillo', 985754703, 'alex@hotmail.com', 'NOrte', '12345', 'divorciado', 1, 'activo', '2025-02-22 03:42:25'),
(24, 916509707, 'Alexander ', 'Ronquillo', 985754703, 'alex@hotmail.com', 'Norte', '12345', 'divorciado', 1, 'inactivo', '2025-02-22 03:44:04'),
(25, 2147483647, 'JAVIER ', 'GARCIA', 987654321, 'jgarcia@hotmail.com', 'Centro', '12345', 'divorciado', 1, 'inactivo', '2025-02-22 03:47:01'),
(26, 934658767, 'Geovanny ', 'Echeverría', 987654321, 'gecheverria@hotmail.com', 'Centro', '123456', 'divorciado', 4, 'activo', '2025-03-29 03:11:54'),
(27, 978563412, 'Samantha ', 'Rojas', 987654321, 'srojas@hotmail.com', 'Sur', '123456', 'divorciado', 5, 'activo', '2025-03-29 03:12:47'),
(28, 987654321, 'Robert ', 'Alvarado', 965544332, 'ralvarado@hotmail.com', 'Gye', '12345', 'divorciado', 3, 'activo', '2025-03-30 16:33:26'),
(29, 912345678, 'Samantha', 'Rojas', 912345678, 'srojas@hotmail.com', 'Sur', '12345', 'divorciado', 5, '1', '2025-03-30 17:03:40'),
(30, 987654321, 'Cristian ', 'Ramirez', 999999999, 'cramirez@hotmail.com', 'Centro', '12345', 'divorciado', 4, 'activo', '2025-03-30 17:10:42'),
(31, 952491157, 'prueba', 'dshjff', 4434334, 'jordanmalave18@gmail.com', 'fdfddffdfdfd', '123456', 'divorciado', 1, 'activo', '2025-03-31 01:05:26'),
(32, 921815676, 'KATHIA', 'AMOROS', 554545454, 'jordanmalave18@gmail.com', 'EEWEWEW', '123456', 'divorciado', 1, 'activo', '2025-03-31 16:18:57'),
(33, 918190067, 'LUIS', 'ABAD', 978726740, 'lar7728@hotmail.com', 'Centro', '12345', '', 6, '0', '2025-04-19 16:35:45'),
(34, 966182339, 'Rogelio', 'Acosta', 978995818, 'rogelioeap@gmail.com', 'Centro', '123456', '', 3, 'inactivo', '2025-04-19 18:05:27'),
(35, 906352323, 'Luis', 'Bonilla', 963344493, 'Luboj2011@hotmail.com', 'Centro', '12345', '', 1, '1', '2025-04-20 03:34:20'),
(36, 913024279, 'Elena', 'Mero', 995443599, 'elenitamero@gmail.com', 'Norte', '12345', '', 1, '0', '2025-04-30 02:10:34'),
(37, 920552668, 'Rosa ', 'Litardo', 997610765, 'rosalitardo6@gmail.com', 'Centro', '12345', '', 5, '0', '2025-04-30 03:32:17'),
(38, 1245758457, 'valentina', 'ggfgfgf', 985754703, 'gfgdgggf', 'gffggfgf', 'gfgfgf', 'divorciado', 1, 'activo', '2025-05-09 02:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ventas`
--

CREATE TABLE `tb_ventas` (
  `id_venta` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_pagado` float NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL,
  `estado` varchar(10) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Dumping data for table `tb_ventas`
--

INSERT INTO `tb_ventas` (`id_venta`, `nro_venta`, `id_cliente`, `total_pagado`, `fyh_creacion`, `fyh_actualizacion`, `estado`) VALUES
(89, 1, 56, 46, '2025-04-30 22:23:24', '0000-00-00 00:00:00', 'Activo'),
(90, 2, 55, 79.35, '2025-05-01 01:00:04', '0000-00-00 00:00:00', 'Activo'),
(91, 3, 55, 800.4, '2025-05-04 12:25:36', '0000-00-00 00:00:00', 'Activo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_cotizacion`),
  ADD KEY `cotizacion_ibfk_1` (`id_rol`);

--
-- Indexes for table `distribuidora`
--
ALTER TABLE `distribuidora`
  ADD PRIMARY KEY (`id_distribuidora`);

--
-- Indexes for table `horariostecnicos`
--
ALTER TABLE `horariostecnicos`
  ADD PRIMARY KEY (`ID_HorarioTecnico`) USING BTREE,
  ADD KEY `usuario_id` (`ID_Usuario`) USING BTREE;

--
-- Indexes for table `ordenes_instalacion`
--
ALTER TABLE `ordenes_instalacion`
  ADD PRIMARY KEY (`id_instalacion`),
  ADD KEY `id_horario_tecnico` (`id_horario_tecnico`),
  ADD KEY `fk_producto` (`id_producto`);

--
-- Indexes for table `ordenes_mantenimiento`
--
ALTER TABLE `ordenes_mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `id_horario_tecnico` (`id_horario_tecnico`),
  ADD KEY `fk_producto_mantenimiento` (`id_producto`);

--
-- Indexes for table `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `nro_venta` (`nro_venta`);

--
-- Indexes for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tb_modulos`
--
ALTER TABLE `tb_modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indexes for table `tb_permisos`
--
ALTER TABLE `tb_permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indexes for table `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fk_distribuidora_proveedor` (`id_distribuidora`);

--
-- Indexes for table `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indexes for table `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `nro_venta` (`nro_venta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `distribuidora`
--
ALTER TABLE `distribuidora`
  MODIFY `id_distribuidora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `horariostecnicos`
--
ALTER TABLE `horariostecnicos`
  MODIFY `ID_HorarioTecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ordenes_instalacion`
--
ALTER TABLE `ordenes_instalacion`
  MODIFY `id_instalacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ordenes_mantenimiento`
--
ALTER TABLE `ordenes_mantenimiento`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_carrito`
--
ALTER TABLE `tb_carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tb_modulos`
--
ALTER TABLE `tb_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_permisos`
--
ALTER TABLE `tb_permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_ventas`
--
ALTER TABLE `tb_ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `horariostecnicos`
--
ALTER TABLE `horariostecnicos`
  ADD CONSTRAINT `HorariosTecnicos_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_instalacion`
--
ALTER TABLE `ordenes_instalacion`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`),
  ADD CONSTRAINT `ordenes_instalacion_ibfk_1` FOREIGN KEY (`id_horario_tecnico`) REFERENCES `horariostecnicos` (`ID_HorarioTecnico`);

--
-- Constraints for table `ordenes_mantenimiento`
--
ALTER TABLE `ordenes_mantenimiento`
  ADD CONSTRAINT `fk_producto_mantenimiento` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`),
  ADD CONSTRAINT `ordenes_mantenimiento_ibfk_1` FOREIGN KEY (`id_horario_tecnico`) REFERENCES `horariostecnicos` (`ID_HorarioTecnico`);

--
-- Constraints for table `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD CONSTRAINT `tb_carrito_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD CONSTRAINT `tb_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_4` FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_permisos`
--
ALTER TABLE `tb_permisos`
  ADD CONSTRAINT `tb_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_permisos_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulos` (`id_modulo`) ON DELETE CASCADE;

--
-- Constraints for table `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD CONSTRAINT `fk_distribuidora_proveedor` FOREIGN KEY (`id_distribuidora`) REFERENCES `distribuidora` (`id_distribuidora`);

--
-- Constraints for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD CONSTRAINT `tb_ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_ventas_ibfk_2` FOREIGN KEY (`nro_venta`) REFERENCES `tb_carrito` (`nro_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
