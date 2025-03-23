-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-12-2023 a las 14:30:46
-- Versión del servidor: 8.0.34
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sichas_sichasoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `codigo_almacen` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`codigo_almacen`, `nombre`, `descripcion`, `estado`) VALUES
(18, 'ALMACEN GENERAL', 'ALMACEN DE TIENDA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int NOT NULL,
  `codigo_sunat` varchar(50) DEFAULT NULL,
  `codigo_producto` varchar(50) DEFAULT NULL,
  `nombre_producto` varchar(250) NOT NULL,
  `idcategoria` int NOT NULL,
  `idmarca` int NOT NULL,
  `idpresentacion` int NOT NULL,
  `idunidad_medida` int NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `precio_base_venta` decimal(10,0) NOT NULL,
  `precio_costo` decimal(10,0) NOT NULL,
  `codigo_almacen` int NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `codigo_sunat`, `codigo_producto`, `nombre_producto`, `idcategoria`, `idmarca`, `idpresentacion`, `idunidad_medida`, `stock`, `imagen`, `precio_base_venta`, `precio_costo`, `codigo_almacen`, `condicion`) VALUES
(1, NULL, 'PER-ROP', 'PERCHERO PARA ROPA', 7, 15, 11, 8, 7, NULL, 25, 20, 18, 1),
(2, NULL, 'SCHBERT', 'ESPUMA LIMPIA TODO', 7, 15, 11, 8, 6, NULL, 10, 6, 18, 1),
(3, NULL, 'UR-SAPITO', 'URINARIO SAPITO', 7, 15, 11, 8, 11, NULL, 15, 9, 18, 1),
(4, NULL, 'PICADOR', 'PICADOR MULTIUSO', 7, 15, 11, 8, 8, NULL, 30, 25, 18, 1),
(5, NULL, 'ALUMINIO', 'ALUMINIO COCINA', 7, 15, 11, 8, 6, NULL, 3, 2, 18, 1),
(6, NULL, 'FOR-MOTO', 'FORRO PROTECTOR DE MOTO', 7, 15, 11, 8, 5, NULL, 12, 8, 18, 1),
(7, NULL, 'STARBUCKS', 'VASOS  STARBUCKS', 7, 15, 11, 8, 9, NULL, 5, 2, 18, 1),
(8, NULL, 'WATHER-GUN', 'CHISGUETE PARA NIÑOS RECARGABLE', 7, 15, 11, 8, 4, NULL, 15, 10, 18, 1),
(9, NULL, 'FOC-CAM', 'FOCO CON CAMARA', 7, 15, 11, 8, 5, NULL, 45, 38, 18, 1),
(10, NULL, 'SET-KEKE', 'SET DE MOLDE DE KEKES', 7, 15, 11, 8, 8, NULL, 25, 20, 18, 1),
(11, NULL, 'AFIL-CUCHI', 'AFILADOR DE CUCHILLOS', 7, 15, 11, 8, 6, NULL, 10, 6, 18, 1),
(12, NULL, 'PIC-MANUAL', 'PICADOR MANUAL', 7, 15, 11, 8, 5, NULL, 8, 5, 18, 1),
(13, NULL, 'EXP-NARAN', 'EXPRIMIDOR DE NARANJA', 7, 15, 11, 8, 4, NULL, 4, 3, 18, 1),
(14, NULL, 'PER-BAILA', 'PERROS BAILARINES', 7, 15, 11, 8, 7, NULL, 10, 9, 18, 1),
(15, NULL, 'ACUA', 'ACUARELAS PARA PINTAR', 7, 15, 11, 8, 20, NULL, 8, 5, 18, 1),
(16, NULL, 'ROD-BEBE', 'RODILLERA DE BEBE', 7, 15, 11, 8, 9, NULL, 7, 5, 18, 1),
(17, NULL, 'JERINGA', 'JERINGA PARA PAVOS', 7, 15, 11, 8, 10, NULL, 9, 7, 18, 1),
(18, NULL, 'ORG-REFRI', 'ORGANIZADOR REFRIGERADORA', 7, 15, 11, 8, 10, NULL, 3, 2, 18, 1),
(19, NULL, 'CEP-MULTIUSO', 'CEPILLOS MULTIUSO', 7, 15, 11, 8, 8, NULL, 3, 2, 18, 1),
(20, NULL, 'DADOS', 'LLAVE DE DADOS', 7, 15, 11, 8, 26, NULL, 20, 18, 18, 1),
(21, NULL, 'PATINES', 'PATINES NIÑOS', 7, 15, 11, 8, 3, NULL, 15, 10, 18, 1),
(22, NULL, 'LIM-BEBE', 'LIMA ELECTRICA', 7, 15, 11, 8, 11, NULL, 13, 11, 18, 1),
(23, NULL, 'DEPILADORA', 'CREMA DEPILADORA', 7, 15, 11, 8, 2, NULL, 2, 1, 18, 1),
(24, NULL, 'LLAV-NAVIDAD', 'LLAVEROS DE NAVIDAD', 7, 15, 11, 8, 11, NULL, 2, 1, 18, 1),
(25, NULL, 'AFEITADORA', 'MAQUINA AFEITADORA', 7, 15, 11, 8, 3, NULL, 12, 9, 18, 1),
(26, NULL, 'PARCHE', 'PARCHE DE PIES ', 7, 15, 11, 8, 7, NULL, 5, 2, 18, 1),
(27, NULL, 'PROYECTOR', 'PROYECTOR DE NIÑOS', 7, 15, 11, 8, 2, NULL, 20, 16, 18, 1),
(28, NULL, 'PACK-LONCHERA', 'PACK DE LONCHERA PEQUEÑA', 7, 15, 11, 8, 10, NULL, 5, 3, 18, 1),
(29, NULL, 'LUZ-CHICA', 'LUZ NAVIDAD CHICA', 7, 15, 11, 8, 9, NULL, 10, 6, 18, 1),
(30, NULL, 'VELA-NAVIDAD', 'VELAS DE NAVIDAD', 7, 15, 11, 8, 22, NULL, 2, 1, 18, 1),
(31, NULL, 'LUZ-NAVIDAD', 'LUZ DE NAVIDAD MEDIANA', 7, 15, 11, 8, 0, NULL, 15, 10, 18, 1),
(32, NULL, 'ZAZA-S-L', 'DINOSAURIO ZA ZA SIN LUZ', 7, 15, 11, 8, 12, NULL, 15, 12, 18, 1),
(33, NULL, 'REPISA', 'REPISA HUMANOIDE', 7, 15, 11, 8, 17, NULL, 8, 6, 18, 1),
(34, NULL, 'ESFERA', 'ESFERA NAVIDAD LUZ', 7, 15, 11, 8, 4, NULL, 40, 35, 18, 1),
(35, NULL, 'AROS', 'CORTINA AROS LUZ', 7, 15, 11, 8, 2, NULL, 40, 32, 18, 1),
(36, NULL, 'BOLAS-LED', 'BOMBITAS LED ', 7, 15, 11, 8, 0, NULL, 35, 30, 18, 1),
(37, NULL, 'FOCO-LED', 'FOCO LED NAVIDAD', 7, 15, 11, 8, 6, NULL, 30, 25, 18, 1),
(38, NULL, 'LUZ-LED', 'LUZ LED NAVIDAD', 7, 15, 11, 8, 9, NULL, 15, 10, 18, 1),
(39, NULL, 'BINCHAS', 'BINCHAS NAVIDAD', 7, 15, 11, 8, 36, NULL, 2, 1, 18, 1),
(40, '-', 'CAMBIO-MESA', 'CAMINO DE MESA', 7, 15, 4, 1, 1, '', 10, 8, 18, 1),
(41, '-', 'FORRO-SILLA', 'FORROS DE SILLA  NAVIDAD', 7, 15, 11, 8, 16, '', 6, 5, 18, 1),
(42, NULL, 'SET-BAÑO', 'SET DE BAÑO NAVIDAD', 7, 15, 11, 8, 8, NULL, 20, 15, 18, 1),
(43, NULL, 'VINO', 'FUNDA DE VINO', 7, 15, 11, 8, 24, NULL, 4, 2, 18, 1),
(44, NULL, 'INDIVIDUALES', 'INDIVIDUALES PARA MESA', 7, 15, 11, 8, 17, NULL, 10, 7, 18, 1),
(45, NULL, 'BURBUJA', 'DINOSAURIO BRUBUJA', 7, 15, 11, 8, 9, NULL, 22, 17, 18, 1),
(46, NULL, 'ZAZA-C-L', 'DINOSAURIO ZAZA CON LUCES', 7, 15, 11, 8, 10, NULL, 17, 13, 18, 1),
(47, NULL, 'HEROES', 'ROBOTH HEROES', 7, 15, 11, 8, 5, NULL, 10, 4, 18, 1),
(48, NULL, 'HUE-DINO', 'HUEVOS DINO', 7, 15, 11, 8, 20, NULL, 10, 6, 18, 1),
(49, NULL, 'BOLAS-SET', 'SET DE BOLAS NAVIDEÑAS', 7, 15, 11, 8, 13, NULL, 5, 4, 18, 1),
(50, NULL, 'SET-VASOS', 'SET DE VASOS NAVIDEÑOS', 7, 15, 11, 8, 11, NULL, 10, 8, 18, 1),
(51, NULL, 'PATILARGAS', 'PATILARGAS  DIVERSAS', 7, 15, 11, 8, -2, NULL, 15, 14, 18, 1),
(52, '-', 'PATILARGA-MUSI', 'PATILARGA MUSICAL', 7, 15, 11, 8, 4, '', 27, 15, 18, 1),
(53, '-', 'ADORNO', 'ADORNO DE ARBOL', 7, 15, 4, 1, 3, '', 5, 1, 18, 1),
(54, NULL, 'BABY-HORUEST', 'BABY-HORUEST', 7, 15, 11, 8, 4, NULL, 50, 35, 18, 1),
(55, NULL, 'PAÑITOS', 'PAÑITOS HUMEDOS ', 7, 15, 11, 8, 16, NULL, 5, 3, 18, 1),
(56, NULL, 'PIANO', 'PIANO MUSICAL', 7, 15, 11, 8, 8, NULL, 15, 11, 18, 1),
(57, NULL, 'POPIT-WHACK', 'POP IT MUSICAL', 7, 15, 11, 8, 3, NULL, 13, 9, 18, 1),
(58, NULL, 'POPIT-YIQU', 'POP IT MUSICAL', 7, 15, 11, 8, 15, NULL, 13, 9, 18, 1),
(59, NULL, 'PEGARATA', 'PEGA RATA ', 7, 15, 11, 8, 95, NULL, 3, 1, 18, 1),
(60, NULL, 'SELFIE', 'BASE PARA SELFIE', 7, 15, 11, 8, 30, NULL, 10, 7, 18, 1),
(61, NULL, 'DEPILADOR', 'DELINIADOR DE CEJAS', 7, 15, 11, 8, 14, NULL, 10, 6, 18, 1),
(62, NULL, 'CONDIMENTO', 'CONDIMENTERO', 7, 15, 11, 8, 8, NULL, 3, 2, 18, 1),
(63, NULL, 'FRESH-BOX', 'SET 5 PCS FRESH BOX', 7, 15, 11, 8, 2, NULL, 15, 10, 18, 1),
(64, NULL, 'MANGUERA', 'MANGUERA 30M ', 7, 15, 11, 8, 2, NULL, 20, 15, 18, 1),
(65, NULL, 'VASO-DISNEY', 'VASOS DE DISNEY', 7, 15, 11, 8, 11, NULL, 3, 1, 18, 1),
(66, NULL, 'LAPICEROS', 'LAPICEROS PARA NIÑOS', 7, 15, 11, 8, 33, NULL, 2, 1, 18, 1),
(67, NULL, 'LONCHERA', 'LONCHERA NIÑOS ', 7, 15, 11, 8, 49, NULL, 8, 4, 18, 1),
(68, NULL, 'LEGO', 'TAPER MODELO LEGO', 7, 15, 11, 8, 10, NULL, 15, 10, 18, 1),
(69, NULL, 'TOMATODO-1L', 'TOMATODO DE UN LITRO', 7, 15, 11, 8, 3, NULL, 15, 10, 18, 1),
(70, NULL, 'MOCHILA-DINO', 'MOCHILA DINOSAURIO', 7, 15, 11, 8, 3, NULL, 15, 10, 18, 1),
(71, NULL, 'MORRAl', 'MORRAL ', 7, 15, 11, 8, 2, NULL, 15, 10, 18, 1),
(72, NULL, 'CORT-CUMPLE', 'CORTINA DFE CUMPLEAÑOS', 7, 15, 11, 8, 1, NULL, 5, 1, 18, 1),
(73, NULL, 'PRO-MICROONDAS', 'PROTECTOR DE MOCROONDAS', 7, 15, 11, 8, 10, NULL, 8, 4, 18, 1),
(74, NULL, 'PRO-REFRI', 'PROTECTOR DE REFRIGERADORA', 7, 15, 11, 8, 5, NULL, 10, 5, 18, 1),
(75, NULL, 'CORT-BAÑO', 'CORTINA DE BAÑO', 7, 15, 11, 8, 2, NULL, 5, 3, 18, 1),
(76, NULL, 'LLAVERO-KAWAI', 'LLAVEROS DE DISTINTOSD MODELOS', 7, 15, 11, 8, 106, NULL, 2, 1, 18, 1),
(77, NULL, 'CHOCOLATERO', 'DERRETIDOR DE CHOCOLATE', 7, 15, 11, 8, 2, NULL, 35, 20, 18, 1),
(78, NULL, 'SOKET', 'SOKET PARA ENCHUFE', 7, 15, 11, 8, 17, NULL, 2, 1, 18, 1),
(79, NULL, 'LONCHERA-ELECT', 'LONCHERA ELECETREICA', 7, 15, 11, 8, 4, NULL, 25, 20, 18, 1),
(80, NULL, 'SET-LOVELY', 'ACCESORIOS JUGUETES NIÑAS', 7, 15, 11, 8, 3, NULL, 10, 8, 18, 1),
(81, NULL, 'SHOPING', 'CARRITOS NIÑAS SHOPING', 7, 15, 11, 8, 3, NULL, 10, 8, 18, 1),
(82, NULL, 'ZAPATILLAS', 'ZAPATILLAS MODELOS', 7, 15, 11, 8, 15, NULL, 50, 35, 18, 1),
(83, NULL, 'ENCENDEDOR', 'ENCENDEDOR  ELECTRICO', 7, 15, 11, 8, 5, NULL, 15, 10, 18, 1),
(84, NULL, 'PELUSA', 'QUITA PELUSA', 7, 15, 11, 8, 4, NULL, 12, 8, 18, 1),
(85, '-', 'AK47', 'PISTYOLA HIDROGEL', 7, 15, 4, 1, 4, '', 35, 26, 18, 1),
(86, NULL, 'FROZEN', 'MUÑECAS FROZEN', 7, 15, 11, 8, 4, NULL, 12, 8, 18, 1),
(87, NULL, 'NANCY-1.5', 'SABANA NANCY  PLAZA  Y MEDIA', 7, 15, 11, 8, 6, NULL, 27, 23, 18, 1),
(88, NULL, 'NANCY-2P', 'SABANA NANCY 2 PLAZAS', 7, 15, 11, 8, 10, NULL, 30, 24, 18, 1),
(89, NULL, 'FORRO', 'FORRO DE COLCHON', 7, 15, 11, 8, 11, NULL, 20, 15, 18, 1),
(90, NULL, 'SAB-C-E-QUEEN', 'SABANA QUEEN COLOR ENTERO', 7, 15, 11, 8, 3, NULL, 50, 40, 18, 1),
(91, NULL, 'COB-NIÑA', 'COBERTOER DE NIÑA ', 7, 15, 11, 8, 1, NULL, 75, 65, 18, 1),
(92, NULL, 'REMOVEDOR', 'REMOVEDOR DE ESMALTE', 7, 15, 11, 8, 10, NULL, 5, 3, 18, 1),
(93, NULL, 'SET-TAPER-GRANDE', 'SET DE TAPER GRANDE', 7, 15, 11, 8, 3, NULL, 15, 10, 18, 1),
(94, NULL, 'SET-TAPER-MEDIANO', 'SET DE TAPER MEDIANO', 7, 15, 11, 8, 1, NULL, 10, 8, 18, 1),
(95, NULL, 'PALTA', 'PORTA PALTA', 7, 15, 11, 8, 2, NULL, 6, 3, 18, 1),
(96, NULL, 'LICUADORA', 'LICUADORA PORTATIL', 7, 15, 11, 8, 2, NULL, 25, 15, 18, 1),
(97, NULL, 'IMAN', 'IMAN PARA FREGIDERADORA', 7, 15, 11, 8, 43, NULL, 1, 1, 18, 1),
(98, NULL, 'CANASTAS', 'CANASTAS DE COMPRA', 7, 15, 11, 8, 2, NULL, 25, 20, 18, 1),
(99, NULL, 'BALDE', 'BALDE SENTRIFUGA', 7, 15, 11, 8, 6, NULL, 35, 20, 18, 1),
(100, NULL, 'CREMA-MANOS', 'CREMA PARA MANOS', 7, 15, 11, 8, 17, NULL, 3, 1, 18, 1),
(101, NULL, 'CARTUCHERA', 'CARTUCHERA DE TELA', 7, 15, 11, 8, 12, NULL, 3, 1, 18, 1),
(102, NULL, 'FRUITS', 'ADORNOS DE FRUTAS', 7, 15, 11, 8, 7, NULL, 7, 5, 18, 1),
(103, NULL, 'CANGURO', 'CANGUROS', 7, 15, 11, 8, 3, NULL, 15, 10, 18, 1),
(104, NULL, 'AMARRADOR', 'AMARRADOR DE CORTINA', 7, 15, 11, 8, 21, NULL, 5, 3, 18, 1),
(105, NULL, 'ARBOL', 'ARBOL DE NAVIDAD', 7, 15, 11, 8, 2, NULL, 70, 48, 18, 1),
(106, NULL, 'WOK', 'SARTEN DE CHAUFA', 7, 15, 11, 8, 8, NULL, 20, 11, 18, 1),
(107, NULL, 'PATINES', 'PATINES CON HUMO', 7, 15, 11, 8, 2, NULL, 80, 50, 18, 1),
(108, NULL, 'PLUMONES-TOUCH', 'PLUMONES DE COLORES', 7, 15, 11, 8, 0, NULL, 70, 54, 18, 1),
(109, NULL, 'CARTERA', 'CARTERAS MODELOS', 7, 15, 11, 8, 9, NULL, 20, 14, 18, 1),
(110, NULL, 'ESPONJA', 'ESPONJA EFOLIANTE', 7, 15, 11, 8, 27, NULL, 3, 1, 18, 1),
(111, NULL, 'ALUMINIO-CAJA', 'CAJA DE PAPEL ALUMINIO', 7, 15, 11, 8, 27, NULL, 5, 2, 18, 1),
(112, NULL, 'INDIVIDUAL-MINI', 'INDIVIDUAL DISEÑOS', 7, 15, 11, 8, 50, NULL, 2, 1, 18, 1),
(113, NULL, 'FUNDAS-COJIN', 'FUNDA DE COJIN', 7, 15, 11, 8, 26, NULL, 5, 2, 18, 1),
(114, NULL, 'LONCHERA-FROZEN', 'LONCHERA DE FROZEN', 7, 15, 11, 8, 4, NULL, 30, 20, 18, 1),
(115, NULL, 'COCINA', 'JUGUETE COCINA', 7, 15, 11, 8, 6, NULL, 20, 16, 18, 1),
(116, NULL, 'BATIDOR', 'BAQTIDOR MANUAL', 7, 15, 11, 8, 29, NULL, 5, 3, 18, 1),
(117, NULL, 'SEPA-MENESTRA', 'SEPARADOR DE MENESTRAS', 7, 15, 11, 8, 2, NULL, 15, 10, 18, 1),
(118, NULL, 'BASE-COLINOS', 'BASE PARA COLINOS', 7, 15, 11, 8, 8, NULL, 2, 1, 18, 1),
(119, NULL, 'CERRADOR', 'CERRADOR DE BOLSAS', 7, 15, 11, 8, 10, NULL, 3, 2, 18, 1),
(120, NULL, 'SEPARTDOR', 'SEPARADOR DE REFRI', 7, 15, 11, 8, 16, NULL, 2, 2, 18, 1),
(121, NULL, 'GIMNASIO', 'GYM BABY', 7, 15, 11, 8, 3, NULL, 50, 33, 18, 1),
(122, NULL, 'RELOJ-MU', 'RELOJ DE MUJER', 7, 15, 11, 8, 23, NULL, 15, 9, 18, 1),
(123, NULL, 'TASAS', 'TASAS NAVIDAD', 7, 15, 11, 8, 13, NULL, 4, 2, 18, 1),
(124, NULL, 'TOMATODO-RENO', 'TOMATODO RENO', 7, 15, 11, 8, 12, NULL, 8, 5, 18, 1),
(125, NULL, 'TOMATODO-TRIO', 'TOMATODO 3', 7, 15, 11, 8, 5, NULL, 20, 11, 18, 1),
(126, NULL, 'ASPIRADORA', 'ASPIRADORA MANUAL', 7, 15, 11, 8, 8, NULL, 15, 10, 18, 1),
(127, '-', 'botella', 'botella economica', 7, 15, 4, 8, 3, '', 2, 1, 18, 1),
(128, '-', 'vaso-niña', 'vaso modelo para niña', 7, 15, 4, 8, 4, '', 6, 3, 18, 1),
(129, '-', 'audfiono', 'audifono bluetoh', 7, 15, 4, 8, 0, '', 15, 10, 18, 1),
(130, '-', 'CART-NIÑA', 'CARTERITAS NIÑA', 7, 15, 11, 1, 2, '', 10, 5, 18, 1),
(131, '-', 'ZAP-DAMA', 'ZAPATILLAS PARA DAMA', 7, 15, 11, 8, 3, '', 35, 30, 18, 1),
(132, '-', 'BINCHAS-NIÑA', 'BINCHAS PARA NIÑAS', 7, 15, 11, 8, 9, '', 1, 1, 18, 1),
(133, '-', 'PARRILLA', 'PARRILAS', 7, 15, 11, 8, 2, '', 35, 30, 18, 1),
(134, '-', 'BRALETT', 'BRALET', 7, 15, 11, 8, 2, '', 10, 5, 18, 1),
(135, '-', 'SECADO-CABELLO', 'SECADOR DE CABELLO', 7, 15, 11, 8, 2, '', 25, 20, 18, 1),
(136, '-', 'CORT-NAVIDAD', 'CORTINA NAVIDAD', 7, 15, 11, 8, 0, '', 7, 6, 18, 1),
(137, '-', 'FAJAS-SHAPER', 'FAJAS SHAPER', 7, 15, 11, 8, 2, '', 10, 5, 18, 1),
(138, '-', 'PARCHE', 'PARCHE FEMENINO', 7, 15, 4, 1, 5, '', 6, 3, 18, 1),
(139, '-', 'LUZ-ESTRRELLA', 'LUZ ESTRELLA', 7, 15, 11, 8, 1, '', 15, 10, 18, 1),
(140, '-', 'MANDIL-NAV', 'MANDIL NAVIDEÑO', 7, 15, 11, 8, 3, '', 5, 2, 18, 1),
(141, '-', 'SOPRTE-CEL', 'SOPORTE PARA CELULAR', 8, 15, 4, 1, 13, '', 3, 1, 18, 1),
(142, '-', 'TERMO-LED', 'TERMO LED', 7, 15, 11, 8, 5, '', 10, 5, 18, 1),
(143, '-', 'VELA -LED', 'VELA  LED NAVIDEÑO', 7, 15, 11, 8, 3, '', 10, 5, 18, 1),
(144, '-', 'LIC-PORT', 'LICUADORA PORTATIL', 7, 15, 11, 8, 1, '', 25, 20, 18, 1),
(145, '-', 'ORG-JOY', 'ORGANIZADOR DE JOYAS', 7, 15, 11, 8, 2, '', 12, 12, 18, 1),
(146, '-', 'LIMPIA -DUCHA', 'LIMPIA BAÑOS', 7, 15, 11, 1, 7, '', 5, 5, 18, 1),
(147, '-', 'TETERA', 'TETERA', 7, 15, 11, 1, 0, '', 15, 15, 18, 1),
(148, '-', 'FOCO-NAVIDAD', 'FOCO NAVIDAD', 7, 15, 4, 1, 5, '', 3, 1, 18, 1),
(149, '-', 'PILAS', 'PILAS AA Y AAA', 7, 15, 11, 1, 15, '', 2, 1, 18, 1),
(150, '-', 'taper-cuchara', 'set de taper con juegos de cuchara', 7, 15, 4, 8, 3, '', 12, 10, 18, 1),
(151, '-', 'afeitador', 'afeitador', 7, 15, 4, 8, 3, '', 15, 12, 18, 1),
(152, '-', 'balanza-g', 'balanza granera', 7, 15, 4, 8, 3, '', 15, 12, 18, 1),
(153, '-', 'peni-copas', 'penicopas', 7, 15, 4, 8, 5, '', 5, 3, 18, 1),
(154, '-', 'herbidora-h', 'hervidora de huevo', 7, 15, 4, 8, 1, '', 20, 15, 18, 1),
(155, '-', 'plancha-port', 'plancha portatil', 7, 15, 4, 8, 2, '', 15, 10, 18, 1),
(156, '-', 'disp-ayu', 'dispensador de ayudin', 7, 15, 4, 8, 4, '', 7, 5, 18, 1),
(157, '-', 'apl-pap', 'aplasta papas', 7, 15, 4, 1, 4, '', 3, 1, 18, 1),
(158, '-', 'pijama', 'pijama 3 pcs', 7, 15, 4, 8, 1, '', 20, 10, 18, 1),
(159, '-', 'aud-dep', 'audifono deportivo', 7, 15, 11, 8, 4, '', 20, 12, 18, 1),
(160, '-', 'joy', 'joyeros', 7, 15, 11, 8, 2, '', 10, 9, 18, 1),
(161, '-', 'lamp-par', 'lampara parlante', 7, 15, 11, 8, 0, '', 15, 13, 18, 1),
(162, '-', 'set-art', 'set arte de 150 pcs', 7, 15, 11, 8, 2, '', 20, 19, 18, 1),
(163, '-', 'set-art-80', 'set arte de 80 pcs', 7, 15, 11, 8, 1, '', 15, 10, 18, 1),
(164, '-', 'org-zap', 'organizador de zapatos', 7, 15, 11, 8, 1, '', 35, 30, 18, 1),
(165, '-', 'org-rop', 'organizador de ropas', 7, 15, 11, 8, 1, '', 20, 18, 18, 1),
(166, '-', 'vas-nav', 'vasos navidad', 7, 15, 11, 8, 3, '', 3, 2, 18, 1),
(167, '-', 'cart-laz', 'cartera lazo', 7, 15, 11, 8, 4, '', 15, 12, 18, 1),
(168, '-', 'pl-puer', 'puled de puerta', 7, 15, 11, 8, 12, '', 5, 4, 18, 1),
(169, '-', 'org', 'organizador generico', 7, 15, 11, 8, 1, '', 2, 1, 18, 1),
(170, '-', 'rej-dig-ni', 'reloj digital para niños', 7, 15, 11, 8, 7, '', 5, 4, 18, 1),
(171, '-', 'org-cond', 'organizador de de condimentos giratorio', 7, 15, 11, 8, 1, '', 30, 28, 18, 1),
(172, '-', 'bol-nav-g', 'bola de navidad grande de diferentes colores', 7, 15, 11, 8, 8, '', 10, 8, 18, 1),
(173, '-', 'rk-coc', 'rack de cocina', 7, 15, 11, 8, 1, '', 75, 70, 18, 1),
(174, '-', 'pis-nav', 'pisos navideños', 7, 15, 11, 8, 4, '', 10, 8, 18, 1),
(175, '-', 'cafetera', 'cafetera', 7, 15, 4, 1, 1, '', 20, 15, 18, 1),
(176, '-', 'carg-port', 'cargador portatil de celular', 7, 15, 4, 8, 4, '', 10, 8, 18, 1),
(177, '-', 'JUG-MAR', 'JUGUETES MARVEL', 9, 15, 4, 8, 12, '', 12, 9, 18, 1),
(178, '-', 'parc-var', 'parche varices', 10, 15, 11, 8, 50, '', 3, 2, 18, 1),
(179, '-', 'pot-cel', 'porta celular', 10, 15, 4, 1, 20, '', 9, 5, 18, 1),
(180, '-', 'DET-BILL', 'DETECTOR DE BILLETES', 10, 15, 4, 8, 19, '', 5, 2, 18, 1),
(181, '-', 'AUD-BL', 'AUDIFONO BLUETOH ECONOMICA', 10, 15, 11, 8, 10, '', 18, 11, 18, 1),
(182, '-', 'BANN-NAV', 'BANNER NAVIDAD', 10, 15, 4, 1, 10, '', 10, 6, 18, 1),
(183, '-', 'PULVERIZADOR', 'PULVERIZADOR CON SPRITE', 11, 15, 11, 8, 3, '', 17, 10, 18, 1),
(184, '-', 'EST-ARM', 'ESTANTE ARMABLE', 11, 15, 11, 8, 2, '', 55, 45, 18, 1),
(185, '-', 'gorro-nav', 'gorro navidad', 11, 15, 4, 1, 9, '', 2, 2, 18, 1),
(186, '-', 'MANTE-MESA-6', 'MANTEL DE MESA NAVIDEÑO PARA 6 SILLAs', 11, 15, 11, 3, 3, '', 12, 9, 18, 1),
(187, '-', 'MANTE-MESA-8', 'MANTEL DE MESA NAVIDEÑO PARA 8 SILLAs', 11, 15, 11, 8, 3, '', 15, 10, 18, 1),
(188, '-', 'rompe-chorro', 'rompe chorro para caños', 7, 15, 4, 8, 30, '', 5, 1, 18, 1),
(189, '-', 'correc-juanete', 'corrector de juanete', 7, 15, 11, 8, 9, '', 7, 5, 18, 1),
(190, '-', 'cub-kwai', 'cubierto kaway para niños', 7, 15, 11, 8, 6, '', 5, 2, 18, 1),
(191, '-', 'm4-16', 'pistola m4-16', 9, 15, 11, 8, 1, '', 25, 18, 18, 1),
(192, '-', 'disp-perfu', 'dispensador de perfume', 10, 15, 11, 8, 7, '', 2, 1, 18, 1),
(193, '-', 'rimel', 'rimel neon de colores', 10, 15, 11, 8, 6, '', 3, 2, 18, 1),
(194, '-', 'secadores', 'secadores', 10, 15, 4, 1, 10, '', 2, 1, 18, 1),
(195, '-', 'port-per', 'porta perfume', 10, 15, 4, 1, 6, '', 3, 1, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `condicion`) VALUES
(7, 'GENERAL', 'GENERAL', 1),
(8, 'COMPUTO', 'CATEGORIA DE ACCESORIOS DE COMPU de masTO y', 1),
(9, 'JUGUETES', 'JUGUETES', 1),
(10, 'ACCESSORIOS', 'DIFERENTES TIPOS DE ACCESORIOS', 1),
(11, 'HOGAR', 'PRODUCTOS DE HOGAR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int NOT NULL,
  `cod_tipo_doc` int NOT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `razon_social` varchar(100) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado_sunat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `cod_tipo_doc`, `num_documento`, `razon_social`, `direccion`, `telefono`, `estado_sunat`) VALUES
(25, 1, '47661166', 'SICHA ROMANI HERNAN', '', '', ''),
(26, 6, '20600454472', 'CORPORACION K BRIGITTE S.A.C.', 'PRO. ANDAHUAYLAS NRO 264 A.F. MIGUEL GRAU', '124', 'ACTIVO'),
(27, 6, '10476611666', 'SICHA ROMANI HERNAN', '- av los robles', '1245', 'ACTIVO'),
(28, 1, '73218746', 'CANALES MEDINA GINO ANDERSON', 'LIMA', '444', ''),
(29, 1, '48148230', 'MEDINA GARCIA HECTOR ANTONIO', 'LIMA', '123456', ''),
(30, 1, '12345678', 'VARIOS', '-', '-', '-'),
(31, 6, '10094695509', 'MINAS JULCA VILMA MERCEDES', '-', '111', 'ACTIVO'),
(32, 1, '40014807', 'MEDINA GARCIA MILAGROS FAVIANA', '', '', ''),
(33, 1, '46289360', 'RAMIREZ VEGA JUANA LILI', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int NOT NULL,
  `idingreso` int NOT NULL,
  `idarticulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`iddetalle_ingreso`, `idingreso`, `idarticulo`, `cantidad`, `precio_compra`, `precio_venta`) VALUES
(1, 6, 104, 13, 2.00, 5.00),
(2, 7, 41, 17, 6.00, 7.00),
(3, 7, 85, 2, 25.00, 35.00);

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
 UPDATE articulo SET stock = stock + NEW.cantidad 
 WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int NOT NULL,
  `idventa` int NOT NULL,
  `idarticulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `id_tipo_igv` int DEFAULT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `total` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`iddetalle_venta`, `idventa`, `idarticulo`, `cantidad`, `id_tipo_igv`, `precio_venta`, `total`) VALUES
(17, 29, 51, 4, 1, 15.00, 60.00),
(18, 29, 125, 1, 1, 20.00, 20.00),
(19, 29, 36, 1, 1, 35.00, 35.00),
(20, 29, 85, 1, 1, 35.00, 35.00),
(21, 29, 29, 2, 1, 10.00, 20.00),
(22, 29, 19, 1, 1, 3.00, 3.00),
(23, 30, 27, 1, 1, 20.00, 20.00),
(24, 30, 47, 1, 1, 10.00, 10.00),
(25, 31, 4, 1, 1, 30.00, 30.00),
(26, 32, 13, 1, 1, 4.00, 4.00),
(27, 32, 5, 1, 1, 3.00, 3.00),
(28, 32, 83, 1, 1, 15.00, 15.00),
(29, 32, 43, 1, 1, 4.00, 4.00),
(30, 32, 123, 6, 1, 4.00, 24.00),
(31, 32, 99, 1, 1, 35.00, 35.00),
(41, 34, 33, 1, 1, 8.00, 8.00),
(42, 34, 125, 1, 1, 20.00, 20.00),
(43, 34, 63, 1, 1, 15.00, 15.00),
(44, 34, 115, 1, 1, 20.00, 20.00),
(45, 34, 113, 1, 1, 5.00, 5.00),
(46, 34, 88, 1, 1, 30.00, 30.00),
(47, 34, 75, 1, 1, 5.00, 5.00),
(48, 34, 85, 1, 1, 35.00, 35.00),
(50, 36, 41, 8, 1, 5.00, 40.00),
(51, 37, 100, 1, 1, 3.00, 3.00),
(52, 37, 61, 1, 1, 10.00, 10.00),
(53, 37, 85, 1, 1, 35.00, 35.00),
(54, 37, 53, 1, 1, 5.00, 5.00),
(55, 37, 41, 5, 1, 5.00, 25.00),
(56, 37, 83, 1, 1, 15.00, 15.00),
(57, 37, 55, 1, 1, 4.00, 4.00),
(58, 37, 51, 2, 1, 15.00, 30.00),
(59, 37, 125, 1, 1, 20.00, 20.00),
(60, 37, 87, 1, 1, 27.00, 27.00),
(61, 37, 19, 1, 1, 3.00, 3.00),
(62, 37, 106, 1, 1, 20.00, 20.00),
(63, 37, 64, 1, 1, 20.00, 20.00),
(64, 37, 108, 1, 1, 70.00, 70.00),
(65, 38, 42, 1, 1, 20.00, 20.00),
(66, 38, 6, 1, 1, 12.00, 12.00),
(67, 39, 46, 1, 1, 17.00, 17.00),
(68, 40, 31, 1, 1, 15.00, 15.00),
(69, 40, 76, 1, 1, 2.00, 2.00),
(70, 40, 43, 3, 1, 4.00, 12.00),
(71, 41, 31, 1, 1, 15.00, 15.00),
(72, 41, 78, 2, 1, 2.00, 4.00),
(73, 42, 88, 2, 1, 30.00, 60.00),
(74, 42, 6, 1, 1, 12.00, 12.00),
(75, 42, 89, 1, 1, 20.00, 20.00),
(76, 42, 53, 1, 1, 5.00, 5.00),
(77, 42, 97, 5, 1, 1.00, 5.00),
(78, 43, 2, 1, 1, 10.00, 10.00),
(79, 44, 57, 1, 1, 13.00, 13.00),
(83, 46, 14, 1, 1, 10.00, 10.00),
(84, 46, 41, 4, 1, 5.00, 20.00),
(85, 46, 26, 1, 1, 3.00, 3.00),
(86, 46, 39, 1, 1, 3.00, 3.00),
(87, 46, 49, 1, 1, 5.00, 5.00),
(88, 47, 14, 1, 1, 10.00, 10.00),
(89, 47, 67, 1, 1, 8.00, 8.00),
(90, 47, 65, 1, 1, 3.00, 3.00),
(91, 48, 123, 3, 1, 3.00, 9.00),
(92, 49, 123, 2, 1, 4.00, 8.00),
(93, 50, 75, 1, 1, 5.00, 5.00),
(95, 52, 45, 1, 1, 22.00, 22.00),
(96, 53, 75, 1, 1, 5.00, 5.00),
(97, 54, 56, 1, 1, 15.00, 15.00),
(98, 55, 146, 1, 1, 5.00, 5.00),
(99, 55, 147, 1, 1, 15.00, 15.00),
(100, 55, 137, 1, 1, 10.00, 10.00),
(101, 56, 130, 1, 1, 10.00, 10.00),
(102, 57, 88, 1, 1, 30.00, 30.00),
(103, 57, 87, 2, 1, 28.00, 56.00),
(104, 57, 75, 2, 1, 5.00, 10.00),
(105, 58, 148, 1, 1, 3.00, 3.00),
(106, 58, 30, 1, 1, 2.00, 2.00),
(107, 58, 113, 1, 1, 5.00, 5.00),
(108, 59, 58, 1, 1, 13.00, 13.00),
(109, 60, 141, 1, 1, 3.00, 3.00),
(111, 62, 148, 1, 1, 3.00, 3.00),
(112, 63, 89, 1, 1, 20.00, 20.00),
(113, 64, 57, 2, 1, 13.00, 26.00),
(114, 65, 88, 1, 1, 30.00, 30.00),
(115, 66, 149, 1, 1, 2.00, 2.00),
(116, 66, 55, 1, 1, 5.00, 4.50),
(117, 67, 75, 1, 1, 5.00, 5.00),
(118, 67, 149, 1, 1, 2.00, 2.00),
(119, 67, 95, 1, 1, 3.00, 3.00),
(120, 68, 149, 1, 1, 2.00, 2.00),
(121, 68, 55, 1, 1, 4.50, 4.50),
(122, 69, 76, 1, 1, 2.00, 2.00),
(123, 70, 76, 1, 1, 2.00, 2.00),
(124, 71, 85, 1, 1, 35.00, 35.00),
(125, 72, 101, 1, 1, 3.00, 3.00),
(126, 73, 75, 1, 1, 5.00, 5.00),
(127, 74, 53, 1, 1, 5.00, 5.00),
(128, 75, 46, 1, 1, 17.00, 17.00),
(129, 76, 115, 1, 1, 20.00, 20.00),
(130, 77, 136, 2, 1, 7.00, 14.00),
(131, 77, 89, 2, 1, 20.00, 40.00),
(132, 77, 88, 1, 1, 30.00, 30.00),
(133, 78, 40, 1, 1, 10.00, 10.00),
(134, 79, 89, 2, 1, 20.00, 40.00),
(135, 79, 162, 1, 1, 20.00, 20.00),
(136, 79, 108, 1, 1, 70.00, 70.00),
(137, 79, 148, 3, 1, 3.00, 9.00),
(138, 80, 8, 1, 1, 15.00, 15.00),
(139, 81, 89, 1, 1, 20.00, 20.00),
(140, 81, 88, 1, 1, 30.00, 30.00),
(141, 81, 8, 1, 1, 15.00, 15.00),
(142, 82, 6, 1, 1, 12.00, 12.00),
(143, 82, 104, 1, 1, 5.00, 5.00),
(144, 82, 144, 1, 1, 25.00, 25.00),
(145, 83, 174, 1, 1, 10.00, 10.00),
(146, 84, 30, 1, 1, 2.00, 2.00),
(147, 85, 39, 1, 1, 1.50, 1.50),
(148, 86, 41, 8, 1, 5.00, 40.00),
(149, 87, 122, 1, 1, 15.00, 15.00),
(150, 87, 143, 1, 1, 10.00, 10.00),
(151, 88, 66, 2, 1, 2.00, 4.00),
(152, 89, 143, 1, 1, 10.00, 10.00),
(153, 89, 172, 1, 1, 10.00, 10.00),
(154, 90, 41, 8, 1, 5.50, 44.00),
(155, 91, 100, 1, 1, 3.00, 3.00),
(156, 92, 76, 1, 1, 2.00, 2.00),
(157, 93, 161, 1, 1, 15.00, 15.00),
(158, 94, 120, 1, 1, 1.50, 1.50),
(159, 95, 26, 1, 1, 5.00, 5.00),
(160, 95, 53, 1, 1, 5.00, 5.00),
(162, 97, 23, 1, 1, 1.50, 1.50),
(163, 98, 137, 1, 1, 10.00, 10.00),
(164, 99, 39, 3, 1, 1.50, 4.50),
(165, 100, 101, 2, 1, 3.00, 6.00),
(166, 100, 55, 1, 1, 4.50, 4.50),
(167, 100, 59, 2, 1, 3.00, 6.00),
(168, 101, 185, 1, 1, 2.00, 2.00),
(169, 102, 120, 2, 1, 2.00, 4.00),
(171, 104, 100, 1, 1, 3.00, 3.00),
(172, 105, 180, 1, 1, 5.00, 5.00),
(173, 105, 59, 1, 1, 2.00, 2.00),
(174, 105, 176, 1, 1, 10.00, 10.00),
(175, 106, 57, 1, 1, 13.00, 13.00),
(176, 107, 24, 2, 1, 2.00, 4.00),
(177, 108, 57, 1, 1, 13.00, 13.00),
(178, 108, 149, 1, 1, 2.00, 2.00),
(179, 109, 39, 4, 1, 1.50, 6.00),
(180, 110, 55, 1, 1, 4.50, 4.50),
(181, 111, 76, 2, 1, 2.00, 4.00),
(182, 111, 125, 1, 1, 20.00, 20.00),
(183, 112, 89, 3, 1, 20.00, 60.00),
(184, 112, 12, 1, 1, 8.00, 8.00),
(185, 112, 113, 1, 1, 5.00, 5.00),
(186, 112, 113, 3, 1, 5.00, 15.00),
(187, 112, 162, 1, 1, 20.00, 20.00),
(188, 112, 89, 1, 1, 20.00, 20.00),
(189, 112, 113, 1, 1, 5.00, 5.00),
(190, 112, 89, 1, 1, 20.00, 20.00),
(191, 112, 88, 1, 1, 30.00, 30.00),
(192, 112, 87, 1, 1, 27.00, 27.00),
(193, 112, 41, 8, 1, 5.00, 40.00),
(194, 112, 11, 1, 1, 10.00, 10.00),
(195, 112, 6, 1, 1, 12.00, 12.00),
(196, 112, 89, 2, 1, 20.00, 40.00),
(197, 112, 113, 2, 1, 5.00, 10.00),
(198, 112, 132, 3, 1, 1.50, 4.50),
(199, 112, 41, 6, 1, 5.00, 30.00),
(200, 113, 143, 2, 1, 9.00, 18.00),
(201, 113, 50, 1, 1, 10.00, 10.00),
(202, 114, 88, 1, 1, 30.00, 30.00),
(203, 114, 41, 7, 1, 6.00, 42.00),
(204, 114, 113, 3, 1, 5.00, 15.00),
(205, 115, 76, 1, 1, 2.00, 2.00),
(206, 116, 111, 1, 1, 5.00, 5.00),
(207, 117, 176, 2, 1, 10.00, 20.00),
(208, 118, 53, 1, 1, 5.00, 5.00),
(209, 118, 44, 1, 1, 10.00, 10.00),
(210, 118, 76, 1, 1, 2.00, 2.00),
(211, 119, 66, 1, 1, 2.00, 2.00),
(212, 120, 44, 2, 1, 10.00, 20.00),
(213, 120, 40, 1, 1, 10.00, 10.00),
(214, 121, 158, 1, 1, 20.00, 20.00),
(215, 121, 116, 1, 1, 5.00, 5.00),
(216, 121, 137, 2, 1, 10.00, 20.00),
(217, 122, 149, 1, 1, 2.00, 2.00),
(218, 123, 149, 1, 1, 2.00, 2.00),
(219, 124, 2, 1, 1, 10.00, 10.00),
(220, 125, 55, 2, 1, 4.50, 9.00),
(221, 125, 111, 1, 1, 5.00, 5.00),
(222, 125, 26, 1, 1, 5.00, 5.00),
(223, 125, 56, 1, 1, 15.00, 15.00),
(224, 125, 5, 1, 1, 3.00, 3.00),
(225, 125, 138, 1, 1, 6.00, 6.00),
(226, 126, 76, 1, 1, 2.00, 2.00),
(227, 127, 55, 1, 1, 4.50, 4.50),
(228, 127, 76, 1, 1, 2.00, 2.00),
(229, 128, 111, 1, 1, 5.00, 5.00),
(230, 129, 185, 2, 1, 2.00, 4.00),
(231, 130, 191, 1, 1, 25.00, 25.00),
(232, 131, 174, 1, 1, 8.00, 8.00),
(233, 131, 40, 1, 1, 10.00, 10.00),
(234, 131, 39, 1, 1, 5.00, 5.00),
(235, 131, 52, 1, 1, 15.00, 15.00),
(236, 131, 148, 2, 1, 3.00, 6.00),
(237, 132, 78, 1, 1, 2.00, 2.00),
(238, 133, 109, 1, 1, 20.00, 20.00),
(239, 134, 76, 2, 1, 2.00, 4.00),
(240, 134, 24, 2, 1, 2.00, 4.00),
(241, 135, 148, 2, 1, 3.00, 6.00),
(243, 137, 76, 1, 1, 2.00, 2.00),
(245, 139, 115, 1, 1, 20.00, 20.00),
(246, 140, 129, 1, 1, 15.00, 20.00);

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
 UPDATE articulo SET stock = stock - NEW.cantidad 
 WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int NOT NULL,
  `nom_empresa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_comercial` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ruc` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `domicilio_fiscal` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono_fijo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono_movil` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint NOT NULL,
  `modo` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nom_empresa`, `nombre_comercial`, `ruc`, `domicilio_fiscal`, `telefono_fijo`, `telefono_movil`, `correo`, `logo`, `estado`, `modo`) VALUES
(4, 'GRACE ANGELICA LUYO PRIETO', 'TODOENUNO', '10775474888', 'AV. TUPAC AMARU 5044', '', '', '', '1698870695.png', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pagos`
--

CREATE TABLE `forma_pagos` (
  `id_forma_pago` int NOT NULL,
  `forma_pago` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forma_pagos`
--

INSERT INTO `forma_pagos` (`id_forma_pago`, `forma_pago`) VALUES
(1, 'Crédito'),
(2, 'Contado'),
(3, 'Depósito'),
(4, 'Transferencia'),
(5, 'Yape'),
(6, 'Plin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int NOT NULL,
  `idproveedor` int NOT NULL,
  `idusuario` int NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) DEFAULT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_compra` decimal(11,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `idproveedor`, `idusuario`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `total_compra`, `estado`) VALUES
(6, 24, 1, 'Ticket', 'BE01', '00000002', '2023-12-03 00:00:00', 0.00, 26.00, 'Aceptado'),
(7, 24, 1, 'Ticket', 'BE01', '00000001', '2023-12-08 00:00:00', 0.00, 94.50, 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idMarca`, `nombre`, `descripcion`, `estado`) VALUES
(15, 'S/M', 'MARCA CHINA', 1),
(16, 'SAMSUNG', 'MARCA UNIVERSAL', 1),
(17, 'TOSHIBA', 'MARCA DE LAPTOPS', 1),
(18, 'DELL', 'MARCA DE COMPUTADORAS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id_moneda` int NOT NULL,
  `moneda` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `abreviado` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `abrstandar` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `simbolo` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `activo` char(1) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `moneda`, `abreviado`, `abrstandar`, `simbolo`, `activo`) VALUES
(1, 'soles', 'sol', 'PEN', 'S/', '1'),
(2, 'dólares', 'dol', 'USD', '$', '1'),
(3, 'euros', 'eur', 'EUR', 'E', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Almacen'),
(3, 'Compras'),
(4, 'Ventas'),
(5, 'Acceso'),
(6, 'Consulta Compras'),
(7, 'Consulta Ventas'),
(9, 'Tipo Documento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `idpresentacion` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`idpresentacion`, `nombre`, `descripcion`, `estado`) VALUES
(4, '20', 'FARDO DE 18UNIDADES', 1),
(5, '60', 'FARDOS DE 60 UNIDADES', 1),
(6, '12', 'FARDO DE 120 UNIDADES', 1),
(7, '120', 'FARDO DE 120 UNIDADES', 1),
(8, '180', 'FARDO DE 180 UNIDADES', 1),
(9, '20', 'fardo de 20 unidades', 1),
(10, '24', 'fardo de 24 unidades', 1),
(11, '1', 'UNUDADES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int NOT NULL,
  `cod_tipo_doc` int NOT NULL,
  `nro_documento` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `razon_social` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` int NOT NULL,
  `estado_sunat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `cod_tipo_doc`, `nro_documento`, `razon_social`, `direccion`, `telefono`, `estado_sunat`) VALUES
(24, 1, '47661166', 'SICHA ROMANI HERNAN', 'av los lirios', 910467736, ''),
(33, 6, '20600454472', 'CORPORACION K BRIGITTE S.A.C.', 'PRO. ANDAHUAYLAS NRO 264 A.F. MIGUEL GRAU', 2552, 'ACTIVO'),
(36, 1, '', 'MEDINA GARCIA HECTOR ANTONIO', 'KIKL', 988, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `pueba` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`pueba`) VALUES
('hola'),
('hola'),
('HOLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `ID_SEDE` int NOT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `id_ubigeo` int DEFAULT NULL,
  `UBIGEO` varchar(50) DEFAULT NULL,
  `NOMBRE_SEDE` varchar(30) DEFAULT NULL,
  `TEL_CELULAR` varchar(20) DEFAULT NULL,
  `IDUSUARIO` int DEFAULT NULL,
  `CODIGO_ALMACEN` int NOT NULL,
  `RUTA` varchar(150) DEFAULT NULL,
  `TOKEN` varchar(150) DEFAULT NULL,
  `ANEXO` varchar(20) DEFAULT NULL,
  `ESTADO` enum('ACTIVO','INACTIVO') DEFAULT NULL COMMENT 'ACTIVO,INACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`ID_SEDE`, `DIRECCION`, `id_ubigeo`, `UBIGEO`, `NOMBRE_SEDE`, `TEL_CELULAR`, `IDUSUARIO`, `CODIGO_ALMACEN`, `RUTA`, `TOKEN`, `ANEXO`, `ESTADO`) VALUES
(9, 'AV. FREDY VALLADARES', 2308, '50401', 'LOCAL PRINCIPAL', '', 1, 18, '', '', '', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contribuyente`
--

CREATE TABLE `tipo_contribuyente` (
  `codigo_tipo_cont` int NOT NULL,
  `nombre_contribuyente` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_contribuyente`
--

INSERT INTO `tipo_contribuyente` (`codigo_tipo_cont`, `nombre_contribuyente`) VALUES
(1, 'PERSONA NATURAL'),
(2, 'PERSONA JURIDICA'),
(3, 'INTERNACIONAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idtipo_documento` int NOT NULL,
  `idtipo_doc` int NOT NULL,
  `num_serie` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nro_inicial` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nro_final` int NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `idusuario` int NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idtipo_documento`, `idtipo_doc`, `num_serie`, `nro_inicial`, `nro_final`, `fecha_registro`, `idusuario`, `estado`) VALUES
(19, 1, 'FE01', '1', 999999, '2023-09-24 23:41:29', 1, 'ACTIVO'),
(20, 3, 'BE01', '1', 999999, '2023-09-24 23:44:58', 1, 'ACTIVO'),
(21, 7, 'BC01', '1', 999999, '2023-10-12 22:35:45', 1, 'ACTIVO'),
(24, 2, 'PR001', '1', 999999, '2023-11-28 12:02:29', 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_doc_contribuyente`
--

CREATE TABLE `tipo_doc_contribuyente` (
  `cod_tipo_doc` int NOT NULL,
  `descripcion_documento` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_doc_contribuyente`
--

INSERT INTO `tipo_doc_contribuyente` (`cod_tipo_doc`, `descripcion_documento`) VALUES
(1, 'DNI'),
(4, 'CARNET DE EXTRANJERIA'),
(6, 'RUC'),
(7, 'PASAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_igvs`
--

CREATE TABLE `tipo_igvs` (
  `id_tipo_igv` int UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_igv` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codigo_de_tributo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_igvs`
--

INSERT INTO `tipo_igvs` (`id_tipo_igv`, `codigo`, `tipo_igv`, `codigo_de_tributo`) VALUES
(1, '10', 'Gravado - Operación Onerosa', 1000),
(2, '11', 'Gravado - Retiro por premio', 9996),
(3, '12', 'Gravado - Retiro por donación', 9996),
(4, '13', 'Gravado - Retiro', 9996),
(5, '14', 'Gravado - Retiro por publicidad', 9996),
(6, '15', 'Gravado - Bonificaciones', 9996),
(7, '16', 'Gravado - Retiro por entrega a trabajadores', 9996),
(8, '17', 'Gravado - IVAP', 9996),
(9, '20', 'Exonerado - Operación Onerosa', 9997),
(10, '21', 'Exonerado - Transferencia gratuita', 9996),
(11, '30', 'Inafecto - Operación Onerosa', 9998),
(12, '31', 'Inafecto - Retiro por Bonificación', 9996),
(13, '32', 'Inafecto - Retiro', 9996),
(14, '33', 'Inafecto - Retiro por Muestras Médicas', 9996),
(15, '34', 'Inafecto - Retiro por Convenio Colectivo', 9996),
(16, '35', 'Inafecto - Retiro por premio', 9996),
(17, '36', 'Inafecto - Retiro por publicidad', 9996),
(18, '37', 'Inafecto - Transferencia gratuita', 9996),
(19, '40', 'Exportación de Bienes o Servicios', 9995);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_operaciones`
--

CREATE TABLE `tipo_operaciones` (
  `id_operacion` int NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_compro_asoc` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_operaciones`
--

INSERT INTO `tipo_operaciones` (`id_operacion`, `codigo`, `descripcion`, `tipo_compro_asoc`) VALUES
(1, '0101', 'Venta interna', 'Factura, Boletas'),
(2, '0200', 'Exportacion', 'Factura, Boletas'),
(3, '0502', 'Ventas con anticipo', 'Liquidacion de compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_doc`
--

CREATE TABLE `type_doc` (
  `idtipo_doc` int NOT NULL,
  `nombre_tipo_doc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `type_doc`
--

INSERT INTO `type_doc` (`idtipo_doc`, `nombre_tipo_doc`) VALUES
(1, 'FACTURA'),
(2, 'PROFORMA'),
(3, 'BOLETA'),
(7, 'NOTA DE CREDITO'),
(8, 'NOTA DE DEBITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE `ubigeo` (
  `id_ubigeo` int NOT NULL,
  `codigo_ubigeo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `distrito` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `provincia` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `departamento` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubigeo`
--

INSERT INTO `ubigeo` (`id_ubigeo`, `codigo_ubigeo`, `distrito`, `provincia`, `departamento`) VALUES
(1839, '10101', 'Chachapoyas', 'Chachapoyas', 'Amazonas'),
(1840, '10102', 'Asuncion', 'Chachapoyas', 'Amazonas'),
(1841, '10103', 'Balsas', 'Chachapoyas', 'Amazonas'),
(1842, '10104', 'Cheto', 'Chachapoyas', 'Amazonas'),
(1843, '10105', 'Chiliquin', 'Chachapoyas', 'Amazonas'),
(1844, '10106', 'Chuquibamba', 'Chachapoyas', 'Amazonas'),
(1845, '10107', 'Granada', 'Chachapoyas', 'Amazonas'),
(1846, '10108', 'Huancas', 'Chachapoyas', 'Amazonas'),
(1847, '10109', 'La Jalca', 'Chachapoyas', 'Amazonas'),
(1848, '10110', 'Leimebamba', 'Chachapoyas', 'Amazonas'),
(1849, '10111', 'Levanto', 'Chachapoyas', 'Amazonas'),
(1850, '10112', 'Magdalena', 'Chachapoyas', 'Amazonas'),
(1851, '10113', 'Mariscal Castilla', 'Chachapoyas', 'Amazonas'),
(1852, '10114', 'Molinopampa', 'Chachapoyas', 'Amazonas'),
(1853, '10115', 'Montevideo', 'Chachapoyas', 'Amazonas'),
(1854, '10116', 'Olleros', 'Chachapoyas', 'Amazonas'),
(1855, '10117', 'Quinjalca', 'Chachapoyas', 'Amazonas'),
(1856, '10118', 'San Francisco de Daguas', 'Chachapoyas', 'Amazonas'),
(1857, '10119', 'San Isidro de Maino', 'Chachapoyas', 'Amazonas'),
(1858, '10120', 'Soloco', 'Chachapoyas', 'Amazonas'),
(1859, '10121', 'Sonche', 'Chachapoyas', 'Amazonas'),
(1860, '10201', 'Bagua', 'Bagua', 'Amazonas'),
(1861, '10202', 'Aramango', 'Bagua', 'Amazonas'),
(1862, '10203', 'Copallin', 'Bagua', 'Amazonas'),
(1863, '10204', 'El Parco', 'Bagua', 'Amazonas'),
(1864, '10205', 'Imaza', 'Bagua', 'Amazonas'),
(1865, '10206', 'La Peca', 'Bagua', 'Amazonas'),
(1866, '10301', 'Jumbilla', 'Bongara', 'Amazonas'),
(1867, '10302', 'Chisquilla', 'Bongara', 'Amazonas'),
(1868, '10303', 'Churuja', 'Bongara', 'Amazonas'),
(1869, '10304', 'Corosha', 'Bongara', 'Amazonas'),
(1870, '10305', 'Cuispes', 'Bongara', 'Amazonas'),
(1871, '10306', 'Florida', 'Bongara', 'Amazonas'),
(1872, '10307', 'Jazan', 'Bongara', 'Amazonas'),
(1873, '10308', 'Recta', 'Bongara', 'Amazonas'),
(1874, '10309', 'San Carlos', 'Bongara', 'Amazonas'),
(1875, '10310', 'Shipasbamba', 'Bongara', 'Amazonas'),
(1876, '10311', 'Valera', 'Bongara', 'Amazonas'),
(1877, '10312', 'Yambrasbamba', 'Bongara', 'Amazonas'),
(1878, '10401', 'Nieva', 'Condorcanqui', 'Amazonas'),
(1879, '10402', 'El Cenepa', 'Condorcanqui', 'Amazonas'),
(1880, '10403', 'Rio Santiago', 'Condorcanqui', 'Amazonas'),
(1881, '10501', 'Lamud', 'Luya', 'Amazonas'),
(1882, '10502', 'Camporredondo', 'Luya', 'Amazonas'),
(1883, '10503', 'Cocabamba', 'Luya', 'Amazonas'),
(1884, '10504', 'Colcamar', 'Luya', 'Amazonas'),
(1885, '10505', 'Conila', 'Luya', 'Amazonas'),
(1886, '10506', 'Inguilpata', 'Luya', 'Amazonas'),
(1887, '10507', 'Longuita', 'Luya', 'Amazonas'),
(1888, '10508', 'Lonya Chico', 'Luya', 'Amazonas'),
(1889, '10509', 'Luya', 'Luya', 'Amazonas'),
(1890, '10510', 'Luya Viejo', 'Luya', 'Amazonas'),
(1891, '10511', 'Maria', 'Luya', 'Amazonas'),
(1892, '10512', 'Ocalli', 'Luya', 'Amazonas'),
(1893, '10513', 'Ocumal', 'Luya', 'Amazonas'),
(1894, '10514', 'Pisuquia', 'Luya', 'Amazonas'),
(1895, '10515', 'Providencia', 'Luya', 'Amazonas'),
(1896, '10516', 'San Cristobal', 'Luya', 'Amazonas'),
(1897, '10517', 'San Francisco del Yeso', 'Luya', 'Amazonas'),
(1898, '10518', 'San Jeronimo', 'Luya', 'Amazonas'),
(1899, '10519', 'San Juan de Lopecancha', 'Luya', 'Amazonas'),
(1900, '10520', 'Santa Catalina', 'Luya', 'Amazonas'),
(1901, '10521', 'Santo Tomas', 'Luya', 'Amazonas'),
(1902, '10522', 'Tingo', 'Luya', 'Amazonas'),
(1903, '10523', 'Trita', 'Luya', 'Amazonas'),
(1904, '10601', 'San Nicolas', 'Rodriguez de Mendoza', 'Amazonas'),
(1905, '10602', 'Chirimoto', 'Rodriguez de Mendoza', 'Amazonas'),
(1906, '10603', 'Cochamal', 'Rodriguez de Mendoza', 'Amazonas'),
(1907, '10604', 'Huambo', 'Rodriguez de Mendoza', 'Amazonas'),
(1908, '10605', 'Limabamba', 'Rodriguez de Mendoza', 'Amazonas'),
(1909, '10606', 'Longar', 'Rodriguez de Mendoza', 'Amazonas'),
(1910, '10607', 'Mariscal Benavides', 'Rodriguez de Mendoza', 'Amazonas'),
(1911, '10608', 'Milpuc', 'Rodriguez de Mendoza', 'Amazonas'),
(1912, '10609', 'Omia', 'Rodriguez de Mendoza', 'Amazonas'),
(1913, '10610', 'Santa Rosa', 'Rodriguez de Mendoza', 'Amazonas'),
(1914, '10611', 'Totora', 'Rodriguez de Mendoza', 'Amazonas'),
(1915, '10612', 'Vista Alegre', 'Rodriguez de Mendoza', 'Amazonas'),
(1916, '10701', 'Bagua Grande', 'Utcubamba', 'Amazonas'),
(1917, '10702', 'Cajaruro', 'Utcubamba', 'Amazonas'),
(1918, '10703', 'Cumba', 'Utcubamba', 'Amazonas'),
(1919, '10704', 'El Milagro', 'Utcubamba', 'Amazonas'),
(1920, '10705', 'Jamalca', 'Utcubamba', 'Amazonas'),
(1921, '10706', 'Lonya Grande', 'Utcubamba', 'Amazonas'),
(1922, '10707', 'Yamon', 'Utcubamba', 'Amazonas'),
(1923, '20101', 'Huaraz', 'Huaraz', 'Ancash'),
(1924, '20102', 'Cochabamba', 'Huaraz', 'Ancash'),
(1925, '20103', 'Colcabamba', 'Huaraz', 'Ancash'),
(1926, '20104', 'Huanchay', 'Huaraz', 'Ancash'),
(1927, '20105', 'Independencia', 'Huaraz', 'Ancash'),
(1928, '20106', 'Jangas', 'Huaraz', 'Ancash'),
(1929, '20107', 'La Libertad', 'Huaraz', 'Ancash'),
(1930, '20108', 'Olleros', 'Huaraz', 'Ancash'),
(1931, '20109', 'Pampas', 'Huaraz', 'Ancash'),
(1932, '20110', 'Pariacoto', 'Huaraz', 'Ancash'),
(1933, '20111', 'Pira', 'Huaraz', 'Ancash'),
(1934, '20112', 'Tarica', 'Huaraz', 'Ancash'),
(1935, '20201', 'Aija', 'Aija', 'Ancash'),
(1936, '20202', 'Coris', 'Aija', 'Ancash'),
(1937, '20203', 'Huacllan', 'Aija', 'Ancash'),
(1938, '20204', 'La Merced', 'Aija', 'Ancash'),
(1939, '20205', 'Succha', 'Aija', 'Ancash'),
(1940, '20301', 'Llamellin', 'Antonio Raymondi', 'Ancash'),
(1941, '20302', 'Aczo', 'Antonio Raymondi', 'Ancash'),
(1942, '20303', 'Chaccho', 'Antonio Raymondi', 'Ancash'),
(1943, '20304', 'Chingas', 'Antonio Raymondi', 'Ancash'),
(1944, '20305', 'Mirgas', 'Antonio Raymondi', 'Ancash'),
(1945, '20306', 'San Juan de Rontoy', 'Antonio Raymondi', 'Ancash'),
(1946, '20401', 'Chacas', 'Asuncion', 'Ancash'),
(1947, '20402', 'Acochaca', 'Asuncion', 'Ancash'),
(1948, '20501', 'Chiquian', 'Bolognesi', 'Ancash'),
(1949, '20502', 'Abelardo Pardo Lezameta', 'Bolognesi', 'Ancash'),
(1950, '20503', 'Antonio Raymondi', 'Bolognesi', 'Ancash'),
(1951, '20504', 'Aquia', 'Bolognesi', 'Ancash'),
(1952, '20505', 'Cajacay', 'Bolognesi', 'Ancash'),
(1953, '20506', 'Canis', 'Bolognesi', 'Ancash'),
(1954, '20507', 'Colquioc', 'Bolognesi', 'Ancash'),
(1955, '20508', 'Huallanca', 'Bolognesi', 'Ancash'),
(1956, '20509', 'Huasta', 'Bolognesi', 'Ancash'),
(1957, '20510', 'Huayllacayan', 'Bolognesi', 'Ancash'),
(1958, '20511', 'La Primavera', 'Bolognesi', 'Ancash'),
(1959, '20512', 'Mangas', 'Bolognesi', 'Ancash'),
(1960, '20513', 'Pacllon', 'Bolognesi', 'Ancash'),
(1961, '20514', 'San Miguel de Corpanqui', 'Bolognesi', 'Ancash'),
(1962, '20515', 'Ticllos', 'Bolognesi', 'Ancash'),
(1963, '20601', 'Carhuaz', 'Carhuaz', 'Ancash'),
(1964, '20602', 'Acopampa', 'Carhuaz', 'Ancash'),
(1965, '20603', 'Amashca', 'Carhuaz', 'Ancash'),
(1966, '20604', 'Anta', 'Carhuaz', 'Ancash'),
(1967, '20605', 'Ataquero', 'Carhuaz', 'Ancash'),
(1968, '20606', 'Marcara', 'Carhuaz', 'Ancash'),
(1969, '20607', 'Pariahuanca', 'Carhuaz', 'Ancash'),
(1970, '20608', 'San Miguel de Aco', 'Carhuaz', 'Ancash'),
(1971, '20609', 'Shilla', 'Carhuaz', 'Ancash'),
(1972, '20610', 'Tinco', 'Carhuaz', 'Ancash'),
(1973, '20611', 'Yungar', 'Carhuaz', 'Ancash'),
(1974, '20701', 'San Luis', 'Carlos Fermin Fitzca', 'Ancash'),
(1975, '20702', 'San Nicolas', 'Carlos Fermin Fitzca', 'Ancash'),
(1976, '20703', 'Yauya', 'Carlos Fermin Fitzca', 'Ancash'),
(1977, '20801', 'Casma', 'Casma', 'Ancash'),
(1978, '20802', 'Buena Vista Alta', 'Casma', 'Ancash'),
(1979, '20803', 'Comandante Noel', 'Casma', 'Ancash'),
(1980, '20804', 'Yautan', 'Casma', 'Ancash'),
(1981, '20901', 'Corongo', 'Corongo', 'Ancash'),
(1982, '20902', 'Aco', 'Corongo', 'Ancash'),
(1983, '20903', 'Bambas', 'Corongo', 'Ancash'),
(1984, '20904', 'Cusca', 'Corongo', 'Ancash'),
(1985, '20905', 'La Pampa', 'Corongo', 'Ancash'),
(1986, '20906', 'Yanac', 'Corongo', 'Ancash'),
(1987, '20907', 'Yupan', 'Corongo', 'Ancash'),
(1988, '21001', 'Huari', 'Huari', 'Ancash'),
(1989, '21002', 'Anra', 'Huari', 'Ancash'),
(1990, '21003', 'Cajay', 'Huari', 'Ancash'),
(1991, '21004', 'Chavin de Huantar', 'Huari', 'Ancash'),
(1992, '21005', 'Huacachi', 'Huari', 'Ancash'),
(1993, '21006', 'Huacchis', 'Huari', 'Ancash'),
(1994, '21007', 'Huachis', 'Huari', 'Ancash'),
(1995, '21008', 'Huantar', 'Huari', 'Ancash'),
(1996, '21009', 'Masin', 'Huari', 'Ancash'),
(1997, '21010', 'Paucas', 'Huari', 'Ancash'),
(1998, '21011', 'Ponto', 'Huari', 'Ancash'),
(1999, '21012', 'Rahuapampa', 'Huari', 'Ancash'),
(2000, '21013', 'Rapayan', 'Huari', 'Ancash'),
(2001, '21014', 'San Marcos', 'Huari', 'Ancash'),
(2002, '21015', 'San Pedro de Chana', 'Huari', 'Ancash'),
(2003, '21016', 'Uco', 'Huari', 'Ancash'),
(2004, '21101', 'Huarmey', 'Huarmey', 'Ancash'),
(2005, '21102', 'Cochapeti', 'Huarmey', 'Ancash'),
(2006, '21103', 'Culebras', 'Huarmey', 'Ancash'),
(2007, '21104', 'Huayan', 'Huarmey', 'Ancash'),
(2008, '21105', 'Malvas', 'Huarmey', 'Ancash'),
(2009, '21201', 'Caraz', 'Huaylas', 'Ancash'),
(2010, '21202', 'Huallanca', 'Huaylas', 'Ancash'),
(2011, '21203', 'Huata', 'Huaylas', 'Ancash'),
(2012, '21204', 'Huaylas', 'Huaylas', 'Ancash'),
(2013, '21205', 'Mato', 'Huaylas', 'Ancash'),
(2014, '21206', 'Pamparomas', 'Huaylas', 'Ancash'),
(2015, '21207', 'Pueblo Libre', 'Huaylas', 'Ancash'),
(2016, '21208', 'Santa Cruz', 'Huaylas', 'Ancash'),
(2017, '21209', 'Santo Toribio', 'Huaylas', 'Ancash'),
(2018, '21210', 'Yuracmarca', 'Huaylas', 'Ancash'),
(2019, '21301', 'Piscobamba', 'Mariscal Luzuriaga', 'Ancash'),
(2020, '21302', 'Casca', 'Mariscal Luzuriaga', 'Ancash'),
(2021, '21303', 'Eleazar Guzman Barron', 'Mariscal Luzuriaga', 'Ancash'),
(2022, '21304', 'Fidel Olivas Escudero', 'Mariscal Luzuriaga', 'Ancash'),
(2023, '21305', 'Llama', 'Mariscal Luzuriaga', 'Ancash'),
(2024, '21306', 'Llumpa', 'Mariscal Luzuriaga', 'Ancash'),
(2025, '21307', 'Lucma', 'Mariscal Luzuriaga', 'Ancash'),
(2026, '21308', 'Musga', 'Mariscal Luzuriaga', 'Ancash'),
(2027, '21401', 'Ocros', 'Ocros', 'Ancash'),
(2028, '21402', 'Acas', 'Ocros', 'Ancash'),
(2029, '21403', 'Cajamarquilla', 'Ocros', 'Ancash'),
(2030, '21404', 'Carhuapampa', 'Ocros', 'Ancash'),
(2031, '21405', 'Cochas', 'Ocros', 'Ancash'),
(2032, '21406', 'Congas', 'Ocros', 'Ancash'),
(2033, '21407', 'Llipa', 'Ocros', 'Ancash'),
(2034, '21408', 'San Cristobal de Rajan', 'Ocros', 'Ancash'),
(2035, '21409', 'San Pedro', 'Ocros', 'Ancash'),
(2036, '21410', 'Santiago de Chilcas', 'Ocros', 'Ancash'),
(2037, '21501', 'Cabana', 'Pallasca', 'Ancash'),
(2038, '21502', 'Bolognesi', 'Pallasca', 'Ancash'),
(2039, '21503', 'Conchucos', 'Pallasca', 'Ancash'),
(2040, '21504', 'Huacaschuque', 'Pallasca', 'Ancash'),
(2041, '21505', 'Huandoval', 'Pallasca', 'Ancash'),
(2042, '21506', 'Lacabamba', 'Pallasca', 'Ancash'),
(2043, '21507', 'Llapo', 'Pallasca', 'Ancash'),
(2044, '21508', 'Pallasca', 'Pallasca', 'Ancash'),
(2045, '21509', 'Pampas', 'Pallasca', 'Ancash'),
(2046, '21510', 'Santa Rosa', 'Pallasca', 'Ancash'),
(2047, '21511', 'Tauca', 'Pallasca', 'Ancash'),
(2048, '21601', 'Pomabamba', 'Pomabamba', 'Ancash'),
(2049, '21602', 'Huayllan', 'Pomabamba', 'Ancash'),
(2050, '21603', 'Parobamba', 'Pomabamba', 'Ancash'),
(2051, '21604', 'Quinuabamba', 'Pomabamba', 'Ancash'),
(2052, '21701', 'Recuay', 'Recuay', 'Ancash'),
(2053, '21702', 'Catac', 'Recuay', 'Ancash'),
(2054, '21703', 'Cotaparaco', 'Recuay', 'Ancash'),
(2055, '21704', 'Huayllapampa', 'Recuay', 'Ancash'),
(2056, '21705', 'Llacllin', 'Recuay', 'Ancash'),
(2057, '21706', 'Marca', 'Recuay', 'Ancash'),
(2058, '21707', 'Pampas Chico', 'Recuay', 'Ancash'),
(2059, '21708', 'Pararin', 'Recuay', 'Ancash'),
(2060, '21709', 'Tapacocha', 'Recuay', 'Ancash'),
(2061, '21710', 'Ticapampa', 'Recuay', 'Ancash'),
(2062, '21801', 'Chimbote', 'Santa', 'Ancash'),
(2063, '21802', 'Caceres del Peru', 'Santa', 'Ancash'),
(2064, '21803', 'Coishco', 'Santa', 'Ancash'),
(2065, '21804', 'Macate', 'Santa', 'Ancash'),
(2066, '21805', 'Moro', 'Santa', 'Ancash'),
(2067, '21806', 'Nepe?a', 'Santa', 'Ancash'),
(2068, '21807', 'Samanco', 'Santa', 'Ancash'),
(2069, '21808', 'Santa', 'Santa', 'Ancash'),
(2070, '21809', 'Nuevo Chimbote', 'Santa', 'Ancash'),
(2071, '21901', 'Sihuas', 'Sihuas', 'Ancash'),
(2072, '21902', 'Acobamba', 'Sihuas', 'Ancash'),
(2073, '21903', 'Alfonso Ugarte', 'Sihuas', 'Ancash'),
(2074, '21904', 'Cashapampa', 'Sihuas', 'Ancash'),
(2075, '21905', 'Chingalpo', 'Sihuas', 'Ancash'),
(2076, '21906', 'Huayllabamba', 'Sihuas', 'Ancash'),
(2077, '21907', 'Quiches', 'Sihuas', 'Ancash'),
(2078, '21908', 'Ragash', 'Sihuas', 'Ancash'),
(2079, '21909', 'San Juan', 'Sihuas', 'Ancash'),
(2080, '21910', 'Sicsibamba', 'Sihuas', 'Ancash'),
(2081, '22001', 'Yungay', 'Yungay', 'Ancash'),
(2082, '22002', 'Cascapara', 'Yungay', 'Ancash'),
(2083, '22003', 'Mancos', 'Yungay', 'Ancash'),
(2084, '22004', 'Matacoto', 'Yungay', 'Ancash'),
(2085, '22005', 'Quillo', 'Yungay', 'Ancash'),
(2086, '22006', 'Ranrahirca', 'Yungay', 'Ancash'),
(2087, '22007', 'Shupluy', 'Yungay', 'Ancash'),
(2088, '22008', 'Yanama', 'Yungay', 'Ancash'),
(2089, '30101', 'Abancay', 'Abancay', 'Apurimac'),
(2090, '30102', 'Chacoche', 'Abancay', 'Apurimac'),
(2091, '30103', 'Circa', 'Abancay', 'Apurimac'),
(2092, '30104', 'Curahuasi', 'Abancay', 'Apurimac'),
(2093, '30105', 'Huanipaca', 'Abancay', 'Apurimac'),
(2094, '30106', 'Lambrama', 'Abancay', 'Apurimac'),
(2095, '30107', 'Pichirhua', 'Abancay', 'Apurimac'),
(2096, '30108', 'San Pedro de Cachora', 'Abancay', 'Apurimac'),
(2097, '30109', 'Tamburco', 'Abancay', 'Apurimac'),
(2098, '30201', 'Andahuaylas', 'Andahuaylas', 'Apurimac'),
(2099, '30202', 'Andarapa', 'Andahuaylas', 'Apurimac'),
(2100, '30203', 'Chiara', 'Andahuaylas', 'Apurimac'),
(2101, '30204', 'Huancarama', 'Andahuaylas', 'Apurimac'),
(2102, '30205', 'Huancaray', 'Andahuaylas', 'Apurimac'),
(2103, '30206', 'Huayana', 'Andahuaylas', 'Apurimac'),
(2104, '30207', 'Kishuara', 'Andahuaylas', 'Apurimac'),
(2105, '30208', 'Pacobamba', 'Andahuaylas', 'Apurimac'),
(2106, '30209', 'Pacucha', 'Andahuaylas', 'Apurimac'),
(2107, '30210', 'Pampachiri', 'Andahuaylas', 'Apurimac'),
(2108, '30211', 'Pomacocha', 'Andahuaylas', 'Apurimac'),
(2109, '30212', 'San Antonio de Cachi', 'Andahuaylas', 'Apurimac'),
(2110, '30213', 'San Jeronimo', 'Andahuaylas', 'Apurimac'),
(2111, '30214', 'San Miguel de Chaccrampa', 'Andahuaylas', 'Apurimac'),
(2112, '30215', 'Santa Maria de Chicmo', 'Andahuaylas', 'Apurimac'),
(2113, '30216', 'Talavera', 'Andahuaylas', 'Apurimac'),
(2114, '30217', 'Tumay Huaraca', 'Andahuaylas', 'Apurimac'),
(2115, '30218', 'Turpo', 'Andahuaylas', 'Apurimac'),
(2116, '30219', 'Kaquiabamba', 'Andahuaylas', 'Apurimac'),
(2117, '30220', 'Jos? Mar?a Arguedas', 'Andahuaylas', 'Apurimac'),
(2118, '30301', 'Antabamba', 'Antabamba', 'Apurimac'),
(2119, '30302', 'El Oro', 'Antabamba', 'Apurimac'),
(2120, '30303', 'Huaquirca', 'Antabamba', 'Apurimac'),
(2121, '30304', 'Juan Espinoza Medrano', 'Antabamba', 'Apurimac'),
(2122, '30305', 'Oropesa', 'Antabamba', 'Apurimac'),
(2123, '30306', 'Pachaconas', 'Antabamba', 'Apurimac'),
(2124, '30307', 'Sabaino', 'Antabamba', 'Apurimac'),
(2125, '30401', 'Chalhuanca', 'Aymaraes', 'Apurimac'),
(2126, '30402', 'Capaya', 'Aymaraes', 'Apurimac'),
(2127, '30403', 'Caraybamba', 'Aymaraes', 'Apurimac'),
(2128, '30404', 'Chapimarca', 'Aymaraes', 'Apurimac'),
(2129, '30405', 'Colcabamba', 'Aymaraes', 'Apurimac'),
(2130, '30406', 'Cotaruse', 'Aymaraes', 'Apurimac'),
(2131, '30407', 'Huayllo', 'Aymaraes', 'Apurimac'),
(2132, '30408', 'Justo Apu Sahuaraura', 'Aymaraes', 'Apurimac'),
(2133, '30409', 'Lucre', 'Aymaraes', 'Apurimac'),
(2134, '30410', 'Pocohuanca', 'Aymaraes', 'Apurimac'),
(2135, '30411', 'San Juan de Chac?a', 'Aymaraes', 'Apurimac'),
(2136, '30412', 'Sa?ayca', 'Aymaraes', 'Apurimac'),
(2137, '30413', 'Soraya', 'Aymaraes', 'Apurimac'),
(2138, '30414', 'Tapairihua', 'Aymaraes', 'Apurimac'),
(2139, '30415', 'Tintay', 'Aymaraes', 'Apurimac'),
(2140, '30416', 'Toraya', 'Aymaraes', 'Apurimac'),
(2141, '30417', 'Yanaca', 'Aymaraes', 'Apurimac'),
(2142, '30501', 'Tambobamba', 'Cotabambas', 'Apurimac'),
(2143, '30502', 'Cotabambas', 'Cotabambas', 'Apurimac'),
(2144, '30503', 'Coyllurqui', 'Cotabambas', 'Apurimac'),
(2145, '30504', 'Haquira', 'Cotabambas', 'Apurimac'),
(2146, '30505', 'Mara', 'Cotabambas', 'Apurimac'),
(2147, '30506', 'Challhuahuacho', 'Cotabambas', 'Apurimac'),
(2148, '30601', 'Chincheros', 'Chincheros', 'Apurimac'),
(2149, '30602', 'Anco_Huallo', 'Chincheros', 'Apurimac'),
(2150, '30603', 'Cocharcas', 'Chincheros', 'Apurimac'),
(2151, '30604', 'Huaccana', 'Chincheros', 'Apurimac'),
(2152, '30605', 'Ocobamba', 'Chincheros', 'Apurimac'),
(2153, '30606', 'Ongoy', 'Chincheros', 'Apurimac'),
(2154, '30607', 'Uranmarca', 'Chincheros', 'Apurimac'),
(2155, '30608', 'Ranracancha', 'Chincheros', 'Apurimac'),
(2156, '30609', 'Rocchacc', 'Chincheros', 'Apurimac'),
(2157, '30610', 'El Porvenir', 'Chincheros', 'Apurimac'),
(2158, '30611', 'Los Chankas', 'Chincheros', 'Apurimac'),
(2159, '30701', 'Chuquibambilla', 'Grau', 'Apurimac'),
(2160, '30702', 'Curpahuasi', 'Grau', 'Apurimac'),
(2161, '30703', 'Gamarra', 'Grau', 'Apurimac'),
(2162, '30704', 'Huayllati', 'Grau', 'Apurimac'),
(2163, '30705', 'Mamara', 'Grau', 'Apurimac'),
(2164, '30706', 'Micaela Bastidas', 'Grau', 'Apurimac'),
(2165, '30707', 'Pataypampa', 'Grau', 'Apurimac'),
(2166, '30708', 'Progreso', 'Grau', 'Apurimac'),
(2167, '30709', 'San Antonio', 'Grau', 'Apurimac'),
(2168, '30710', 'Santa Rosa', 'Grau', 'Apurimac'),
(2169, '30711', 'Turpay', 'Grau', 'Apurimac'),
(2170, '30712', 'Vilcabamba', 'Grau', 'Apurimac'),
(2171, '30713', 'Virundo', 'Grau', 'Apurimac'),
(2172, '30714', 'Curasco', 'Grau', 'Apurimac'),
(2173, '40101', 'Arequipa', 'Arequipa', 'Arequipa'),
(2174, '40102', 'Alto Selva Alegre', 'Arequipa', 'Arequipa'),
(2175, '40103', 'Cayma', 'Arequipa', 'Arequipa'),
(2176, '40104', 'Cerro Colorado', 'Arequipa', 'Arequipa'),
(2177, '40105', 'Characato', 'Arequipa', 'Arequipa'),
(2178, '40106', 'Chiguata', 'Arequipa', 'Arequipa'),
(2179, '40107', 'Jacobo Hunter', 'Arequipa', 'Arequipa'),
(2180, '40108', 'La Joya', 'Arequipa', 'Arequipa'),
(2181, '40109', 'Mariano Melgar', 'Arequipa', 'Arequipa'),
(2182, '40110', 'Miraflores', 'Arequipa', 'Arequipa'),
(2183, '40111', 'Mollebaya', 'Arequipa', 'Arequipa'),
(2184, '40112', 'Paucarpata', 'Arequipa', 'Arequipa'),
(2185, '40113', 'Pocsi', 'Arequipa', 'Arequipa'),
(2186, '40114', 'Polobaya', 'Arequipa', 'Arequipa'),
(2187, '40115', 'Queque?a', 'Arequipa', 'Arequipa'),
(2188, '40116', 'Sabandia', 'Arequipa', 'Arequipa'),
(2189, '40117', 'Sachaca', 'Arequipa', 'Arequipa'),
(2190, '40118', 'San Juan de Siguas', 'Arequipa', 'Arequipa'),
(2191, '40119', 'San Juan de Tarucani', 'Arequipa', 'Arequipa'),
(2192, '40120', 'Santa Isabel de Siguas', 'Arequipa', 'Arequipa'),
(2193, '40121', 'Santa Rita de Siguas', 'Arequipa', 'Arequipa'),
(2194, '40122', 'Socabaya', 'Arequipa', 'Arequipa'),
(2195, '40123', 'Tiabaya', 'Arequipa', 'Arequipa'),
(2196, '40124', 'Uchumayo', 'Arequipa', 'Arequipa'),
(2197, '40125', 'Vitor', 'Arequipa', 'Arequipa'),
(2198, '40126', 'Yanahuara', 'Arequipa', 'Arequipa'),
(2199, '40127', 'Yarabamba', 'Arequipa', 'Arequipa'),
(2200, '40128', 'Yura', 'Arequipa', 'Arequipa'),
(2201, '40129', 'Jose Luis Bustamante y Rivero', 'Arequipa', 'Arequipa'),
(2202, '40201', 'Camana', 'Camana', 'Arequipa'),
(2203, '40202', 'Jose Maria Quimper', 'Camana', 'Arequipa'),
(2204, '40203', 'Mariano Nicolas Valcarcel', 'Camana', 'Arequipa'),
(2205, '40204', 'Mariscal Caceres', 'Camana', 'Arequipa'),
(2206, '40205', 'Nicolas de Pierola', 'Camana', 'Arequipa'),
(2207, '40206', 'Oco?a', 'Camana', 'Arequipa'),
(2208, '40207', 'Quilca', 'Camana', 'Arequipa'),
(2209, '40208', 'Samuel Pastor', 'Camana', 'Arequipa'),
(2210, '40301', 'Caraveli', 'Caraveli', 'Arequipa'),
(2211, '40302', 'Acari', 'Caraveli', 'Arequipa'),
(2212, '40303', 'Atico', 'Caraveli', 'Arequipa'),
(2213, '40304', 'Atiquipa', 'Caraveli', 'Arequipa'),
(2214, '40305', 'Bella Union', 'Caraveli', 'Arequipa'),
(2215, '40306', 'Cahuacho', 'Caraveli', 'Arequipa'),
(2216, '40307', 'Chala', 'Caraveli', 'Arequipa'),
(2217, '40308', 'Chaparra', 'Caraveli', 'Arequipa'),
(2218, '40309', 'Huanuhuanu', 'Caraveli', 'Arequipa'),
(2219, '40310', 'Jaqui', 'Caraveli', 'Arequipa'),
(2220, '40311', 'Lomas', 'Caraveli', 'Arequipa'),
(2221, '40312', 'Quicacha', 'Caraveli', 'Arequipa'),
(2222, '40313', 'Yauca', 'Caraveli', 'Arequipa'),
(2223, '40401', 'Aplao', 'Castilla', 'Arequipa'),
(2224, '40402', 'Andagua', 'Castilla', 'Arequipa'),
(2225, '40403', 'Ayo', 'Castilla', 'Arequipa'),
(2226, '40404', 'Chachas', 'Castilla', 'Arequipa'),
(2227, '40405', 'Chilcaymarca', 'Castilla', 'Arequipa'),
(2228, '40406', 'Choco', 'Castilla', 'Arequipa'),
(2229, '40407', 'Huancarqui', 'Castilla', 'Arequipa'),
(2230, '40408', 'Machaguay', 'Castilla', 'Arequipa'),
(2231, '40409', 'Orcopampa', 'Castilla', 'Arequipa'),
(2232, '40410', 'Pampacolca', 'Castilla', 'Arequipa'),
(2233, '40411', 'Tipan', 'Castilla', 'Arequipa'),
(2234, '40412', 'U?on', 'Castilla', 'Arequipa'),
(2235, '40413', 'Uraca', 'Castilla', 'Arequipa'),
(2236, '40414', 'Viraco', 'Castilla', 'Arequipa'),
(2237, '40501', 'Chivay', 'Caylloma', 'Arequipa'),
(2238, '40502', 'Achoma', 'Caylloma', 'Arequipa'),
(2239, '40503', 'Cabanaconde', 'Caylloma', 'Arequipa'),
(2240, '40504', 'Callalli', 'Caylloma', 'Arequipa'),
(2241, '40505', 'Caylloma', 'Caylloma', 'Arequipa'),
(2242, '40506', 'Coporaque', 'Caylloma', 'Arequipa'),
(2243, '40507', 'Huambo', 'Caylloma', 'Arequipa'),
(2244, '40508', 'Huanca', 'Caylloma', 'Arequipa'),
(2245, '40509', 'Ichupampa', 'Caylloma', 'Arequipa'),
(2246, '40510', 'Lari', 'Caylloma', 'Arequipa'),
(2247, '40511', 'Lluta', 'Caylloma', 'Arequipa'),
(2248, '40512', 'Maca', 'Caylloma', 'Arequipa'),
(2249, '40513', 'Madrigal', 'Caylloma', 'Arequipa'),
(2250, '40514', 'San Antonio de Chuca', 'Caylloma', 'Arequipa'),
(2251, '40515', 'Sibayo', 'Caylloma', 'Arequipa'),
(2252, '40516', 'Tapay', 'Caylloma', 'Arequipa'),
(2253, '40517', 'Tisco', 'Caylloma', 'Arequipa'),
(2254, '40518', 'Tuti', 'Caylloma', 'Arequipa'),
(2255, '40519', 'Yanque', 'Caylloma', 'Arequipa'),
(2256, '40520', 'Majes', 'Caylloma', 'Arequipa'),
(2257, '40601', 'Chuquibamba', 'Condesuyos', 'Arequipa'),
(2258, '40602', 'Andaray', 'Condesuyos', 'Arequipa'),
(2259, '40603', 'Cayarani', 'Condesuyos', 'Arequipa'),
(2260, '40604', 'Chichas', 'Condesuyos', 'Arequipa'),
(2261, '40605', 'Iray', 'Condesuyos', 'Arequipa'),
(2262, '40606', 'Rio Grande', 'Condesuyos', 'Arequipa'),
(2263, '40607', 'Salamanca', 'Condesuyos', 'Arequipa'),
(2264, '40608', 'Yanaquihua', 'Condesuyos', 'Arequipa'),
(2265, '40701', 'Mollendo', 'Islay', 'Arequipa'),
(2266, '40702', 'Cocachacra', 'Islay', 'Arequipa'),
(2267, '40703', 'Dean Valdivia', 'Islay', 'Arequipa'),
(2268, '40704', 'Islay', 'Islay', 'Arequipa'),
(2269, '40705', 'Mejia', 'Islay', 'Arequipa'),
(2270, '40706', 'Punta de Bombon', 'Islay', 'Arequipa'),
(2271, '40801', 'Cotahuasi', 'La Union', 'Arequipa'),
(2272, '40802', 'Alca', 'La Union', 'Arequipa'),
(2273, '40803', 'Charcana', 'La Union', 'Arequipa'),
(2274, '40804', 'Huaynacotas', 'La Union', 'Arequipa'),
(2275, '40805', 'Pampamarca', 'La Union', 'Arequipa'),
(2276, '40806', 'Puyca', 'La Union', 'Arequipa'),
(2277, '40807', 'Quechualla', 'La Union', 'Arequipa'),
(2278, '40808', 'Sayla', 'La Union', 'Arequipa'),
(2279, '40809', 'Tauria', 'La Union', 'Arequipa'),
(2280, '40810', 'Tomepampa', 'La Union', 'Arequipa'),
(2281, '40811', 'Toro', 'La Union', 'Arequipa'),
(2282, '50101', 'Ayacucho', 'Huamanga', 'Ayacucho'),
(2283, '50102', 'Acocro', 'Huamanga', 'Ayacucho'),
(2284, '50103', 'Acos Vinchos', 'Huamanga', 'Ayacucho'),
(2285, '50104', 'Carmen Alto', 'Huamanga', 'Ayacucho'),
(2286, '50105', 'Chiara', 'Huamanga', 'Ayacucho'),
(2287, '50106', 'Ocros', 'Huamanga', 'Ayacucho'),
(2288, '50107', 'Pacaycasa', 'Huamanga', 'Ayacucho'),
(2289, '50108', 'Quinua', 'Huamanga', 'Ayacucho'),
(2290, '50109', 'San Jose de Ticllas', 'Huamanga', 'Ayacucho'),
(2291, '50110', 'San Juan Bautista', 'Huamanga', 'Ayacucho'),
(2292, '50111', 'Santiago de Pischa', 'Huamanga', 'Ayacucho'),
(2293, '50112', 'Socos', 'Huamanga', 'Ayacucho'),
(2294, '50113', 'Tambillo', 'Huamanga', 'Ayacucho'),
(2295, '50114', 'Vinchos', 'Huamanga', 'Ayacucho'),
(2296, '50115', 'Jesus Nazareno', 'Huamanga', 'Ayacucho'),
(2297, '50116', 'Andr?s Avelino C?ceres Dorregaray', 'Huamanga', 'Ayacucho'),
(2298, '50201', 'Cangallo', 'Cangallo', 'Ayacucho'),
(2299, '50202', 'Chuschi', 'Cangallo', 'Ayacucho'),
(2300, '50203', 'Los Morochucos', 'Cangallo', 'Ayacucho'),
(2301, '50204', 'Maria Parado de Bellido', 'Cangallo', 'Ayacucho'),
(2302, '50205', 'Paras', 'Cangallo', 'Ayacucho'),
(2303, '50206', 'Totos', 'Cangallo', 'Ayacucho'),
(2304, '50301', 'Sancos', 'Huanca Sancos', 'Ayacucho'),
(2305, '50302', 'Carapo', 'Huanca Sancos', 'Ayacucho'),
(2306, '50303', 'Sacsamarca', 'Huanca Sancos', 'Ayacucho'),
(2307, '50304', 'Santiago de Lucanamarca', 'Huanca Sancos', 'Ayacucho'),
(2308, '50401', 'Huanta', 'Huanta', 'Ayacucho'),
(2309, '50402', 'Ayahuanco', 'Huanta', 'Ayacucho'),
(2310, '50403', 'Huamanguilla', 'Huanta', 'Ayacucho'),
(2311, '50404', 'Iguain', 'Huanta', 'Ayacucho'),
(2312, '50405', 'Luricocha', 'Huanta', 'Ayacucho'),
(2313, '50406', 'Santillana', 'Huanta', 'Ayacucho'),
(2314, '50407', 'Sivia', 'Huanta', 'Ayacucho'),
(2315, '50408', 'Llochegua', 'Huanta', 'Ayacucho'),
(2316, '50409', 'Canayre', 'Huanta', 'Ayacucho'),
(2317, '50410', 'Uchuraccay', 'Huanta', 'Ayacucho'),
(2318, '50411', 'Pucacolpa', 'Huanta', 'Ayacucho'),
(2319, '50412', 'Chaca', 'Huanta', 'Ayacucho'),
(2320, '50501', 'San Miguel', 'La Mar', 'Ayacucho'),
(2321, '50502', 'Anco', 'La Mar', 'Ayacucho'),
(2322, '50503', 'Ayna', 'La Mar', 'Ayacucho'),
(2323, '50504', 'Chilcas', 'La Mar', 'Ayacucho'),
(2324, '50505', 'Chungui', 'La Mar', 'Ayacucho'),
(2325, '50506', 'Luis Carranza', 'La Mar', 'Ayacucho'),
(2326, '50507', 'Santa Rosa', 'La Mar', 'Ayacucho'),
(2327, '50508', 'Tambo', 'La Mar', 'Ayacucho'),
(2328, '50509', 'Samugari', 'La Mar', 'Ayacucho'),
(2329, '50510', 'Anchihuay', 'La Mar', 'Ayacucho'),
(2330, '50511', 'Oronccoy', 'La Mar', 'Ayacucho'),
(2331, '50601', 'Puquio', 'Lucanas', 'Ayacucho'),
(2332, '50602', 'Aucara', 'Lucanas', 'Ayacucho'),
(2333, '50603', 'Cabana', 'Lucanas', 'Ayacucho'),
(2334, '50604', 'Carmen Salcedo', 'Lucanas', 'Ayacucho'),
(2335, '50605', 'Chavi?a', 'Lucanas', 'Ayacucho'),
(2336, '50606', 'Chipao', 'Lucanas', 'Ayacucho'),
(2337, '50607', 'Huac-Huas', 'Lucanas', 'Ayacucho'),
(2338, '50608', 'Laramate', 'Lucanas', 'Ayacucho'),
(2339, '50609', 'Leoncio Prado', 'Lucanas', 'Ayacucho'),
(2340, '50610', 'Llauta', 'Lucanas', 'Ayacucho'),
(2341, '50611', 'Lucanas', 'Lucanas', 'Ayacucho'),
(2342, '50612', 'Oca?a', 'Lucanas', 'Ayacucho'),
(2343, '50613', 'Otoca', 'Lucanas', 'Ayacucho'),
(2344, '50614', 'Saisa', 'Lucanas', 'Ayacucho'),
(2345, '50615', 'San Cristobal', 'Lucanas', 'Ayacucho'),
(2346, '50616', 'San Juan', 'Lucanas', 'Ayacucho'),
(2347, '50617', 'San Pedro', 'Lucanas', 'Ayacucho'),
(2348, '50618', 'San Pedro de Palco', 'Lucanas', 'Ayacucho'),
(2349, '50619', 'Sancos', 'Lucanas', 'Ayacucho'),
(2350, '50620', 'Santa Ana de Huaycahuacho', 'Lucanas', 'Ayacucho'),
(2351, '50621', 'Santa Lucia', 'Lucanas', 'Ayacucho'),
(2352, '50701', 'Coracora', 'Parinacochas', 'Ayacucho'),
(2353, '50702', 'Chumpi', 'Parinacochas', 'Ayacucho'),
(2354, '50703', 'Coronel Casta?eda', 'Parinacochas', 'Ayacucho'),
(2355, '50704', 'Pacapausa', 'Parinacochas', 'Ayacucho'),
(2356, '50705', 'Pullo', 'Parinacochas', 'Ayacucho'),
(2357, '50706', 'Puyusca', 'Parinacochas', 'Ayacucho'),
(2358, '50707', 'San Francisco de Ravacayco', 'Parinacochas', 'Ayacucho'),
(2359, '50708', 'Upahuacho', 'Parinacochas', 'Ayacucho'),
(2360, '50801', 'Pausa', 'Paucar del Sara Sara', 'Ayacucho'),
(2361, '50802', 'Colta', 'Paucar del Sara Sara', 'Ayacucho'),
(2362, '50803', 'Corculla', 'Paucar del Sara Sara', 'Ayacucho'),
(2363, '50804', 'Lampa', 'Paucar del Sara Sara', 'Ayacucho'),
(2364, '50805', 'Marcabamba', 'Paucar del Sara Sara', 'Ayacucho'),
(2365, '50806', 'Oyolo', 'Paucar del Sara Sara', 'Ayacucho'),
(2366, '50807', 'Pararca', 'Paucar del Sara Sara', 'Ayacucho'),
(2367, '50808', 'San Javier de Alpabamba', 'Paucar del Sara Sara', 'Ayacucho'),
(2368, '50809', 'San Jose de Ushua', 'Paucar del Sara Sara', 'Ayacucho'),
(2369, '50810', 'Sara Sara', 'Paucar del Sara Sara', 'Ayacucho'),
(2370, '50901', 'Querobamba', 'Sucre', 'Ayacucho'),
(2371, '50902', 'Belen', 'Sucre', 'Ayacucho'),
(2372, '50903', 'Chalcos', 'Sucre', 'Ayacucho'),
(2373, '50904', 'Chilcayoc', 'Sucre', 'Ayacucho'),
(2374, '50905', 'Huaca?a', 'Sucre', 'Ayacucho'),
(2375, '50906', 'Morcolla', 'Sucre', 'Ayacucho'),
(2376, '50907', 'Paico', 'Sucre', 'Ayacucho'),
(2377, '50908', 'San Pedro de Larcay', 'Sucre', 'Ayacucho'),
(2378, '50909', 'San Salvador de Quije', 'Sucre', 'Ayacucho'),
(2379, '50910', 'Santiago de Paucaray', 'Sucre', 'Ayacucho'),
(2380, '50911', 'Soras', 'Sucre', 'Ayacucho'),
(2381, '51001', 'Huancapi', 'Victor Fajardo', 'Ayacucho'),
(2382, '51002', 'Alcamenca', 'Victor Fajardo', 'Ayacucho'),
(2383, '51003', 'Apongo', 'Victor Fajardo', 'Ayacucho'),
(2384, '51004', 'Asquipata', 'Victor Fajardo', 'Ayacucho'),
(2385, '51005', 'Canaria', 'Victor Fajardo', 'Ayacucho'),
(2386, '51006', 'Cayara', 'Victor Fajardo', 'Ayacucho'),
(2387, '51007', 'Colca', 'Victor Fajardo', 'Ayacucho'),
(2388, '51008', 'Huamanquiquia', 'Victor Fajardo', 'Ayacucho'),
(2389, '51009', 'Huancaraylla', 'Victor Fajardo', 'Ayacucho'),
(2390, '51010', 'Huaya', 'Victor Fajardo', 'Ayacucho'),
(2391, '51011', 'Sarhua', 'Victor Fajardo', 'Ayacucho'),
(2392, '51012', 'Vilcanchos', 'Victor Fajardo', 'Ayacucho'),
(2393, '51101', 'Vilcas Huaman', 'Vilcas Huaman', 'Ayacucho'),
(2394, '51102', 'Accomarca', 'Vilcas Huaman', 'Ayacucho'),
(2395, '51103', 'Carhuanca', 'Vilcas Huaman', 'Ayacucho'),
(2396, '51104', 'Concepcion', 'Vilcas Huaman', 'Ayacucho'),
(2397, '51105', 'Huambalpa', 'Vilcas Huaman', 'Ayacucho'),
(2398, '51106', 'Independencia', 'Vilcas Huaman', 'Ayacucho'),
(2399, '51107', 'Saurama', 'Vilcas Huaman', 'Ayacucho'),
(2400, '51108', 'Vischongo', 'Vilcas Huaman', 'Ayacucho'),
(2401, '60101', 'Cajamarca', 'Cajamarca', 'Cajamarca'),
(2402, '60102', 'Asuncion', 'Cajamarca', 'Cajamarca'),
(2403, '60103', 'Chetilla', 'Cajamarca', 'Cajamarca'),
(2404, '60104', 'Cospan', 'Cajamarca', 'Cajamarca'),
(2405, '60105', 'Enca?ada', 'Cajamarca', 'Cajamarca'),
(2406, '60106', 'Jesus', 'Cajamarca', 'Cajamarca'),
(2407, '60107', 'Llacanora', 'Cajamarca', 'Cajamarca'),
(2408, '60108', 'Los Ba?os del Inca', 'Cajamarca', 'Cajamarca'),
(2409, '60109', 'Magdalena', 'Cajamarca', 'Cajamarca'),
(2410, '60110', 'Matara', 'Cajamarca', 'Cajamarca'),
(2411, '60111', 'Namora', 'Cajamarca', 'Cajamarca'),
(2412, '60112', 'San Juan', 'Cajamarca', 'Cajamarca'),
(2413, '60201', 'Cajabamba', 'Cajabamba', 'Cajamarca'),
(2414, '60202', 'Cachachi', 'Cajabamba', 'Cajamarca'),
(2415, '60203', 'Condebamba', 'Cajabamba', 'Cajamarca'),
(2416, '60204', 'Sitacocha', 'Cajabamba', 'Cajamarca'),
(2417, '60301', 'Celendin', 'Celendin', 'Cajamarca'),
(2418, '60302', 'Chumuch', 'Celendin', 'Cajamarca'),
(2419, '60303', 'Cortegana', 'Celendin', 'Cajamarca'),
(2420, '60304', 'Huasmin', 'Celendin', 'Cajamarca'),
(2421, '60305', 'Jorge Chavez', 'Celendin', 'Cajamarca'),
(2422, '60306', 'Jose Galvez', 'Celendin', 'Cajamarca'),
(2423, '60307', 'Miguel Iglesias', 'Celendin', 'Cajamarca'),
(2424, '60308', 'Oxamarca', 'Celendin', 'Cajamarca'),
(2425, '60309', 'Sorochuco', 'Celendin', 'Cajamarca'),
(2426, '60310', 'Sucre', 'Celendin', 'Cajamarca'),
(2427, '60311', 'Utco', 'Celendin', 'Cajamarca'),
(2428, '60312', 'La Libertad de Pallan', 'Celendin', 'Cajamarca'),
(2429, '60401', 'Chota', 'Chota', 'Cajamarca'),
(2430, '60402', 'Anguia', 'Chota', 'Cajamarca'),
(2431, '60403', 'Chadin', 'Chota', 'Cajamarca'),
(2432, '60404', 'Chiguirip', 'Chota', 'Cajamarca'),
(2433, '60405', 'Chimban', 'Chota', 'Cajamarca'),
(2434, '60406', 'Choropampa', 'Chota', 'Cajamarca'),
(2435, '60407', 'Cochabamba', 'Chota', 'Cajamarca'),
(2436, '60408', 'Conchan', 'Chota', 'Cajamarca'),
(2437, '60409', 'Huambos', 'Chota', 'Cajamarca'),
(2438, '60410', 'Lajas', 'Chota', 'Cajamarca'),
(2439, '60411', 'Llama', 'Chota', 'Cajamarca'),
(2440, '60412', 'Miracosta', 'Chota', 'Cajamarca'),
(2441, '60413', 'Paccha', 'Chota', 'Cajamarca'),
(2442, '60414', 'Pion', 'Chota', 'Cajamarca'),
(2443, '60415', 'Querocoto', 'Chota', 'Cajamarca'),
(2444, '60416', 'San Juan de Licupis', 'Chota', 'Cajamarca'),
(2445, '60417', 'Tacabamba', 'Chota', 'Cajamarca'),
(2446, '60418', 'Tocmoche', 'Chota', 'Cajamarca'),
(2447, '60419', 'Chalamarca', 'Chota', 'Cajamarca'),
(2448, '60501', 'Contumaza', 'Contumaza', 'Cajamarca'),
(2449, '60502', 'Chilete', 'Contumaza', 'Cajamarca'),
(2450, '60503', 'Cupisnique', 'Contumaza', 'Cajamarca'),
(2451, '60504', 'Guzmango', 'Contumaza', 'Cajamarca'),
(2452, '60505', 'San Benito', 'Contumaza', 'Cajamarca'),
(2453, '60506', 'Santa Cruz de Toled', 'Contumaza', 'Cajamarca'),
(2454, '60507', 'Tantarica', 'Contumaza', 'Cajamarca'),
(2455, '60508', 'Yonan', 'Contumaza', 'Cajamarca'),
(2456, '60601', 'Cutervo', 'Cutervo', 'Cajamarca'),
(2457, '60602', 'Callayuc', 'Cutervo', 'Cajamarca'),
(2458, '60603', 'Choros', 'Cutervo', 'Cajamarca'),
(2459, '60604', 'Cujillo', 'Cutervo', 'Cajamarca'),
(2460, '60605', 'La Ramada', 'Cutervo', 'Cajamarca'),
(2461, '60606', 'Pimpingos', 'Cutervo', 'Cajamarca'),
(2462, '60607', 'Querocotillo', 'Cutervo', 'Cajamarca'),
(2463, '60608', 'San Andres de Cutervo', 'Cutervo', 'Cajamarca'),
(2464, '60609', 'San Juan de Cutervo', 'Cutervo', 'Cajamarca'),
(2465, '60610', 'San Luis de Lucma', 'Cutervo', 'Cajamarca'),
(2466, '60611', 'Santa Cruz', 'Cutervo', 'Cajamarca'),
(2467, '60612', 'Santo Domingo de La Capilla', 'Cutervo', 'Cajamarca'),
(2468, '60613', 'Santo Tomas', 'Cutervo', 'Cajamarca'),
(2469, '60614', 'Socota', 'Cutervo', 'Cajamarca'),
(2470, '60615', 'Toribio Casanova', 'Cutervo', 'Cajamarca'),
(2471, '60701', 'Bambamarca', 'Hualgayoc', 'Cajamarca'),
(2472, '60702', 'Chugur', 'Hualgayoc', 'Cajamarca'),
(2473, '60703', 'Hualgayoc', 'Hualgayoc', 'Cajamarca'),
(2474, '60801', 'Jaen', 'Jaen', 'Cajamarca'),
(2475, '60802', 'Bellavista', 'Jaen', 'Cajamarca'),
(2476, '60803', 'Chontali', 'Jaen', 'Cajamarca'),
(2477, '60804', 'Colasay', 'Jaen', 'Cajamarca'),
(2478, '60805', 'Huabal', 'Jaen', 'Cajamarca'),
(2479, '60806', 'Las Pirias', 'Jaen', 'Cajamarca'),
(2480, '60807', 'Pomahuaca', 'Jaen', 'Cajamarca'),
(2481, '60808', 'Pucara', 'Jaen', 'Cajamarca'),
(2482, '60809', 'Sallique', 'Jaen', 'Cajamarca'),
(2483, '60810', 'San Felipe', 'Jaen', 'Cajamarca'),
(2484, '60811', 'San Jose del Alto', 'Jaen', 'Cajamarca'),
(2485, '60812', 'Santa Rosa', 'Jaen', 'Cajamarca'),
(2486, '60901', 'San Ignacio', 'San Ignacio', 'Cajamarca'),
(2487, '60902', 'Chirinos', 'San Ignacio', 'Cajamarca'),
(2488, '60903', 'Huarango', 'San Ignacio', 'Cajamarca'),
(2489, '60904', 'La Coipa', 'San Ignacio', 'Cajamarca'),
(2490, '60905', 'Namballe', 'San Ignacio', 'Cajamarca'),
(2491, '60906', 'San Jose de Lourdes', 'San Ignacio', 'Cajamarca'),
(2492, '60907', 'Tabaconas', 'San Ignacio', 'Cajamarca'),
(2493, '61001', 'Pedro Galvez', 'San Marcos', 'Cajamarca'),
(2494, '61002', 'Chancay', 'San Marcos', 'Cajamarca'),
(2495, '61003', 'Eduardo Villanueva', 'San Marcos', 'Cajamarca'),
(2496, '61004', 'Gregorio Pita', 'San Marcos', 'Cajamarca'),
(2497, '61005', 'Ichocan', 'San Marcos', 'Cajamarca'),
(2498, '61006', 'Jose Manuel Quiroz', 'San Marcos', 'Cajamarca'),
(2499, '61007', 'Jose Sabogal', 'San Marcos', 'Cajamarca'),
(2500, '61101', 'San Miguel', 'San Miguel', 'Cajamarca'),
(2501, '61102', 'Bolivar', 'San Miguel', 'Cajamarca'),
(2502, '61103', 'Calquis', 'San Miguel', 'Cajamarca'),
(2503, '61104', 'Catilluc', 'San Miguel', 'Cajamarca'),
(2504, '61105', 'El Prado', 'San Miguel', 'Cajamarca'),
(2505, '61106', 'La Florida', 'San Miguel', 'Cajamarca'),
(2506, '61107', 'Llapa', 'San Miguel', 'Cajamarca'),
(2507, '61108', 'Nanchoc', 'San Miguel', 'Cajamarca'),
(2508, '61109', 'Niepos', 'San Miguel', 'Cajamarca'),
(2509, '61110', 'San Gregorio', 'San Miguel', 'Cajamarca'),
(2510, '61111', 'San Silvestre de Cochan', 'San Miguel', 'Cajamarca'),
(2511, '61112', 'Tongod', 'San Miguel', 'Cajamarca'),
(2512, '61113', 'Union Agua Blanca', 'San Miguel', 'Cajamarca'),
(2513, '61201', 'San Pablo', 'San Pablo', 'Cajamarca'),
(2514, '61202', 'San Bernardino', 'San Pablo', 'Cajamarca'),
(2515, '61203', 'San Luis', 'San Pablo', 'Cajamarca'),
(2516, '61204', 'Tumbaden', 'San Pablo', 'Cajamarca'),
(2517, '61301', 'Santa Cruz', 'Santa Cruz', 'Cajamarca'),
(2518, '61302', 'Andabamba', 'Santa Cruz', 'Cajamarca'),
(2519, '61303', 'Catache', 'Santa Cruz', 'Cajamarca'),
(2520, '61304', 'Chancayba?os', 'Santa Cruz', 'Cajamarca'),
(2521, '61305', 'La Esperanza', 'Santa Cruz', 'Cajamarca'),
(2522, '61306', 'Ninabamba', 'Santa Cruz', 'Cajamarca'),
(2523, '61307', 'Pulan', 'Santa Cruz', 'Cajamarca'),
(2524, '61308', 'Saucepampa', 'Santa Cruz', 'Cajamarca'),
(2525, '61309', 'Sexi', 'Santa Cruz', 'Cajamarca'),
(2526, '61310', 'Uticyacu', 'Santa Cruz', 'Cajamarca'),
(2527, '61311', 'Yauyucan', 'Santa Cruz', 'Cajamarca'),
(2528, '70101', 'Callao', 'Callao', 'Callao'),
(2529, '70102', 'Bellavista', 'Callao', 'Callao'),
(2530, '70103', 'Carmen de La Legua', 'Callao', 'Callao'),
(2531, '70104', 'La Perla', 'Callao', 'Callao'),
(2532, '70105', 'La Punta', 'Callao', 'Callao'),
(2533, '70106', 'Ventanilla', 'Callao', 'Callao'),
(2534, '70107', 'Mi Peru', 'Callao', 'Callao'),
(2535, '80101', 'Cusco', 'Cusco', 'Cusco'),
(2536, '80102', 'Ccorca', 'Cusco', 'Cusco'),
(2537, '80103', 'Poroy', 'Cusco', 'Cusco'),
(2538, '80104', 'San Jeronimo', 'Cusco', 'Cusco'),
(2539, '80105', 'San Sebastian', 'Cusco', 'Cusco'),
(2540, '80106', 'Santiago', 'Cusco', 'Cusco'),
(2541, '80107', 'Saylla', 'Cusco', 'Cusco'),
(2542, '80108', 'Wanchaq', 'Cusco', 'Cusco'),
(2543, '80201', 'Acomayo', 'Acomayo', 'Cusco'),
(2544, '80202', 'Acopia', 'Acomayo', 'Cusco'),
(2545, '80203', 'Acos', 'Acomayo', 'Cusco'),
(2546, '80204', 'Mosoc Llacta', 'Acomayo', 'Cusco'),
(2547, '80205', 'Pomacanchi', 'Acomayo', 'Cusco'),
(2548, '80206', 'Rondocan', 'Acomayo', 'Cusco'),
(2549, '80207', 'Sangarara', 'Acomayo', 'Cusco'),
(2550, '80301', 'Anta', 'Anta', 'Cusco'),
(2551, '80302', 'Ancahuasi', 'Anta', 'Cusco'),
(2552, '80303', 'Cachimayo', 'Anta', 'Cusco'),
(2553, '80304', 'Chinchaypujio', 'Anta', 'Cusco'),
(2554, '80305', 'Huarocondo', 'Anta', 'Cusco'),
(2555, '80306', 'Limatambo', 'Anta', 'Cusco'),
(2556, '80307', 'Mollepata', 'Anta', 'Cusco'),
(2557, '80308', 'Pucyura', 'Anta', 'Cusco'),
(2558, '80309', 'Zurite', 'Anta', 'Cusco'),
(2559, '80401', 'Calca', 'Calca', 'Cusco'),
(2560, '80402', 'Coya', 'Calca', 'Cusco'),
(2561, '80403', 'Lamay', 'Calca', 'Cusco'),
(2562, '80404', 'Lares', 'Calca', 'Cusco'),
(2563, '80405', 'Pisac', 'Calca', 'Cusco'),
(2564, '80406', 'San Salvador', 'Calca', 'Cusco'),
(2565, '80407', 'Taray', 'Calca', 'Cusco'),
(2566, '80408', 'Yanatile', 'Calca', 'Cusco'),
(2567, '80501', 'Yanaoca', 'Canas', 'Cusco'),
(2568, '80502', 'Checca', 'Canas', 'Cusco'),
(2569, '80503', 'Kunturkanki', 'Canas', 'Cusco'),
(2570, '80504', 'Langui', 'Canas', 'Cusco'),
(2571, '80505', 'Layo', 'Canas', 'Cusco'),
(2572, '80506', 'Pampamarca', 'Canas', 'Cusco'),
(2573, '80507', 'Quehue', 'Canas', 'Cusco'),
(2574, '80508', 'Tupac Amaru', 'Canas', 'Cusco'),
(2575, '80601', 'Sicuani', 'Canchis', 'Cusco'),
(2576, '80602', 'Checacupe', 'Canchis', 'Cusco'),
(2577, '80603', 'Combapata', 'Canchis', 'Cusco'),
(2578, '80604', 'Marangani', 'Canchis', 'Cusco'),
(2579, '80605', 'Pitumarca', 'Canchis', 'Cusco'),
(2580, '80606', 'San Pablo', 'Canchis', 'Cusco'),
(2581, '80607', 'San Pedro', 'Canchis', 'Cusco'),
(2582, '80608', 'Tinta', 'Canchis', 'Cusco'),
(2583, '80701', 'Santo Tomas', 'Chumbivilcas', 'Cusco'),
(2584, '80702', 'Capacmarca', 'Chumbivilcas', 'Cusco'),
(2585, '80703', 'Chamaca', 'Chumbivilcas', 'Cusco'),
(2586, '80704', 'Colquemarca', 'Chumbivilcas', 'Cusco'),
(2587, '80705', 'Livitaca', 'Chumbivilcas', 'Cusco'),
(2588, '80706', 'Llusco', 'Chumbivilcas', 'Cusco'),
(2589, '80707', 'Qui?ota', 'Chumbivilcas', 'Cusco'),
(2590, '80708', 'Velille', 'Chumbivilcas', 'Cusco'),
(2591, '80801', 'Espinar', 'Espinar', 'Cusco'),
(2592, '80802', 'Condoroma', 'Espinar', 'Cusco'),
(2593, '80803', 'Coporaque', 'Espinar', 'Cusco'),
(2594, '80804', 'Ocoruro', 'Espinar', 'Cusco'),
(2595, '80805', 'Pallpata', 'Espinar', 'Cusco'),
(2596, '80806', 'Pichigua', 'Espinar', 'Cusco'),
(2597, '80807', 'Suyckutambo', 'Espinar', 'Cusco'),
(2598, '80808', 'Alto Pichigua', 'Espinar', 'Cusco'),
(2599, '80901', 'Santa Ana', 'La Convencion', 'Cusco'),
(2600, '80902', 'Echarate', 'La Convencion', 'Cusco'),
(2601, '80903', 'Huayopata', 'La Convencion', 'Cusco'),
(2602, '80904', 'Maranura', 'La Convencion', 'Cusco'),
(2603, '80905', 'Ocobamba', 'La Convencion', 'Cusco'),
(2604, '80906', 'Quellouno', 'La Convencion', 'Cusco'),
(2605, '80907', 'Kimbiri', 'La Convencion', 'Cusco'),
(2606, '80908', 'Santa Teresa', 'La Convencion', 'Cusco'),
(2607, '80909', 'Vilcabamba', 'La Convencion', 'Cusco'),
(2608, '80910', 'Pichari', 'La Convencion', 'Cusco'),
(2609, '80911', 'Inkawasi', 'La Convencion', 'Cusco'),
(2610, '80912', 'Villa Virgen', 'La Convencion', 'Cusco'),
(2611, '80913', 'Villa Kintiarina', 'La Convencion', 'Cusco'),
(2612, '80914', 'Megantoni', 'La Convencion', 'Cusco'),
(2613, '81001', 'Paruro', 'Paruro', 'Cusco'),
(2614, '81002', 'Accha', 'Paruro', 'Cusco'),
(2615, '81003', 'Ccapi', 'Paruro', 'Cusco'),
(2616, '81004', 'Colcha', 'Paruro', 'Cusco'),
(2617, '81005', 'Huanoquite', 'Paruro', 'Cusco'),
(2618, '81006', 'Omacha', 'Paruro', 'Cusco'),
(2619, '81007', 'Paccaritambo', 'Paruro', 'Cusco'),
(2620, '81008', 'Pillpinto', 'Paruro', 'Cusco'),
(2621, '81009', 'Yaurisque', 'Paruro', 'Cusco'),
(2622, '81101', 'Paucartambo', 'Paucartambo', 'Cusco'),
(2623, '81102', 'Caicay', 'Paucartambo', 'Cusco'),
(2624, '81103', 'Challabamba', 'Paucartambo', 'Cusco'),
(2625, '81104', 'Colquepata', 'Paucartambo', 'Cusco'),
(2626, '81105', 'Huancarani', 'Paucartambo', 'Cusco'),
(2627, '81106', 'Kos?ipata', 'Paucartambo', 'Cusco'),
(2628, '81201', 'Urcos', 'Quispicanchi', 'Cusco'),
(2629, '81202', 'Andahuaylillas', 'Quispicanchi', 'Cusco'),
(2630, '81203', 'Camanti', 'Quispicanchi', 'Cusco'),
(2631, '81204', 'Ccarhuayo', 'Quispicanchi', 'Cusco'),
(2632, '81205', 'Ccatca', 'Quispicanchi', 'Cusco'),
(2633, '81206', 'Cusipata', 'Quispicanchi', 'Cusco'),
(2634, '81207', 'Huaro', 'Quispicanchi', 'Cusco'),
(2635, '81208', 'Lucre', 'Quispicanchi', 'Cusco'),
(2636, '81209', 'Marcapata', 'Quispicanchi', 'Cusco'),
(2637, '81210', 'Ocongate', 'Quispicanchi', 'Cusco'),
(2638, '81211', 'Oropesa', 'Quispicanchi', 'Cusco'),
(2639, '81212', 'Quiquijana', 'Quispicanchi', 'Cusco'),
(2640, '81301', 'Urubamba', 'Urubamba', 'Cusco'),
(2641, '81302', 'Chinchero', 'Urubamba', 'Cusco'),
(2642, '81303', 'Huayllabamba', 'Urubamba', 'Cusco'),
(2643, '81304', 'Machupicchu', 'Urubamba', 'Cusco'),
(2644, '81305', 'Maras', 'Urubamba', 'Cusco'),
(2645, '81306', 'Ollantaytambo', 'Urubamba', 'Cusco'),
(2646, '81307', 'Yucay', 'Urubamba', 'Cusco'),
(2647, '90101', 'Huancavelica', 'Huancavelica', 'Huancavelica'),
(2648, '90102', 'Acobambilla', 'Huancavelica', 'Huancavelica'),
(2649, '90103', 'Acoria', 'Huancavelica', 'Huancavelica'),
(2650, '90104', 'Conayca', 'Huancavelica', 'Huancavelica'),
(2651, '90105', 'Cuenca', 'Huancavelica', 'Huancavelica'),
(2652, '90106', 'Huachocolpa', 'Huancavelica', 'Huancavelica'),
(2653, '90107', 'Huayllahuara', 'Huancavelica', 'Huancavelica'),
(2654, '90108', 'Izcuchaca', 'Huancavelica', 'Huancavelica'),
(2655, '90109', 'Laria', 'Huancavelica', 'Huancavelica'),
(2656, '90110', 'Manta', 'Huancavelica', 'Huancavelica'),
(2657, '90111', 'Mariscal Caceres', 'Huancavelica', 'Huancavelica'),
(2658, '90112', 'Moya', 'Huancavelica', 'Huancavelica'),
(2659, '90113', 'Nuevo Occoro', 'Huancavelica', 'Huancavelica'),
(2660, '90114', 'Palca', 'Huancavelica', 'Huancavelica'),
(2661, '90115', 'Pilchaca', 'Huancavelica', 'Huancavelica'),
(2662, '90116', 'Vilca', 'Huancavelica', 'Huancavelica'),
(2663, '90117', 'Yauli', 'Huancavelica', 'Huancavelica'),
(2664, '90118', 'Ascension', 'Huancavelica', 'Huancavelica'),
(2665, '90119', 'Huando', 'Huancavelica', 'Huancavelica'),
(2666, '90201', 'Acobamba', 'Acobamba', 'Huancavelica'),
(2667, '90202', 'Andabamba', 'Acobamba', 'Huancavelica'),
(2668, '90203', 'Anta', 'Acobamba', 'Huancavelica'),
(2669, '90204', 'Caja', 'Acobamba', 'Huancavelica'),
(2670, '90205', 'Marcas', 'Acobamba', 'Huancavelica'),
(2671, '90206', 'Paucara', 'Acobamba', 'Huancavelica'),
(2672, '90207', 'Pomacocha', 'Acobamba', 'Huancavelica'),
(2673, '90208', 'Rosario', 'Acobamba', 'Huancavelica'),
(2674, '90301', 'Lircay', 'Angaraes', 'Huancavelica'),
(2675, '90302', 'Anchonga', 'Angaraes', 'Huancavelica'),
(2676, '90303', 'Callanmarca', 'Angaraes', 'Huancavelica'),
(2677, '90304', 'Ccochaccasa', 'Angaraes', 'Huancavelica'),
(2678, '90305', 'Chincho', 'Angaraes', 'Huancavelica'),
(2679, '90306', 'Congalla', 'Angaraes', 'Huancavelica'),
(2680, '90307', 'Huanca-Huanca', 'Angaraes', 'Huancavelica'),
(2681, '90308', 'Huayllay Grande', 'Angaraes', 'Huancavelica'),
(2682, '90309', 'Julcamarca', 'Angaraes', 'Huancavelica'),
(2683, '90310', 'San Antonio de Antaparco', 'Angaraes', 'Huancavelica'),
(2684, '90311', 'Santo Tomas de Pata', 'Angaraes', 'Huancavelica'),
(2685, '90312', 'Secclla', 'Angaraes', 'Huancavelica'),
(2686, '90401', 'Castrovirreyna', 'Castrovirreyna', 'Huancavelica'),
(2687, '90402', 'Arma', 'Castrovirreyna', 'Huancavelica'),
(2688, '90403', 'Aurahua', 'Castrovirreyna', 'Huancavelica'),
(2689, '90404', 'Capillas', 'Castrovirreyna', 'Huancavelica'),
(2690, '90405', 'Chupamarca', 'Castrovirreyna', 'Huancavelica'),
(2691, '90406', 'Cocas', 'Castrovirreyna', 'Huancavelica'),
(2692, '90407', 'Huachos', 'Castrovirreyna', 'Huancavelica'),
(2693, '90408', 'Huamatambo', 'Castrovirreyna', 'Huancavelica'),
(2694, '90409', 'Mollepampa', 'Castrovirreyna', 'Huancavelica'),
(2695, '90410', 'San Juan', 'Castrovirreyna', 'Huancavelica'),
(2696, '90411', 'Santa Ana', 'Castrovirreyna', 'Huancavelica'),
(2697, '90412', 'Tantara', 'Castrovirreyna', 'Huancavelica'),
(2698, '90413', 'Ticrapo', 'Castrovirreyna', 'Huancavelica'),
(2699, '90501', 'Churcampa', 'Churcampa', 'Huancavelica'),
(2700, '90502', 'Anco', 'Churcampa', 'Huancavelica'),
(2701, '90503', 'Chinchihuasi', 'Churcampa', 'Huancavelica'),
(2702, '90504', 'El Carmen', 'Churcampa', 'Huancavelica'),
(2703, '90505', 'La Merced', 'Churcampa', 'Huancavelica'),
(2704, '90506', 'Locroja', 'Churcampa', 'Huancavelica'),
(2705, '90507', 'Paucarbamba', 'Churcampa', 'Huancavelica'),
(2706, '90508', 'San Miguel de Mayocc', 'Churcampa', 'Huancavelica'),
(2707, '90509', 'San Pedro de Coris', 'Churcampa', 'Huancavelica'),
(2708, '90510', 'Pachamarca', 'Churcampa', 'Huancavelica'),
(2709, '90511', 'Cosme', 'Churcampa', 'Huancavelica'),
(2710, '90601', 'Huaytara', 'Huaytara', 'Huancavelica'),
(2711, '90602', 'Ayavi', 'Huaytara', 'Huancavelica'),
(2712, '90603', 'Cordova', 'Huaytara', 'Huancavelica'),
(2713, '90604', 'Huayacundo Arma', 'Huaytara', 'Huancavelica'),
(2714, '90605', 'Laramarca', 'Huaytara', 'Huancavelica'),
(2715, '90606', 'Ocoyo', 'Huaytara', 'Huancavelica'),
(2716, '90607', 'Pilpichaca', 'Huaytara', 'Huancavelica'),
(2717, '90608', 'Querco', 'Huaytara', 'Huancavelica'),
(2718, '90609', 'Quito-Arma', 'Huaytara', 'Huancavelica'),
(2719, '90610', 'San Antonio de Cusicancha', 'Huaytara', 'Huancavelica'),
(2720, '90611', 'San Francisco de Sangayaico', 'Huaytara', 'Huancavelica'),
(2721, '90612', 'San Isidro', 'Huaytara', 'Huancavelica'),
(2722, '90613', 'Santiago de Chocorvos', 'Huaytara', 'Huancavelica'),
(2723, '90614', 'Santiago de Quirahuara', 'Huaytara', 'Huancavelica'),
(2724, '90615', 'Santo Domingo de Capillas', 'Huaytara', 'Huancavelica'),
(2725, '90616', 'Tambo', 'Huaytara', 'Huancavelica'),
(2726, '90701', 'Pampas', 'Tayacaja', 'Huancavelica'),
(2727, '90702', 'Acostambo', 'Tayacaja', 'Huancavelica'),
(2728, '90703', 'Acraquia', 'Tayacaja', 'Huancavelica'),
(2729, '90704', 'Ahuaycha', 'Tayacaja', 'Huancavelica'),
(2730, '90705', 'Colcabamba', 'Tayacaja', 'Huancavelica'),
(2731, '90706', 'Daniel Hernandez', 'Tayacaja', 'Huancavelica'),
(2732, '90707', 'Huachocolpa', 'Tayacaja', 'Huancavelica'),
(2733, '90709', 'Huaribamba', 'Tayacaja', 'Huancavelica'),
(2734, '90710', '?ahuimpuquio', 'Tayacaja', 'Huancavelica'),
(2735, '90711', 'Pazos', 'Tayacaja', 'Huancavelica'),
(2736, '90713', 'Quishuar', 'Tayacaja', 'Huancavelica'),
(2737, '90714', 'Salcabamba', 'Tayacaja', 'Huancavelica'),
(2738, '90715', 'Salcahuasi', 'Tayacaja', 'Huancavelica'),
(2739, '90716', 'San Marcos de Rocchac', 'Tayacaja', 'Huancavelica'),
(2740, '90717', 'Surcubamba', 'Tayacaja', 'Huancavelica'),
(2741, '90718', 'Tintay Puncu', 'Tayacaja', 'Huancavelica'),
(2742, '90719', 'Quichuas', 'Tayacaja', 'Huancavelica'),
(2743, '90720', 'Andaymarca', 'Tayacaja', 'Huancavelica'),
(2744, '90721', 'Roble', 'Tayacaja', 'Huancavelica'),
(2745, '90722', 'Pichos', 'Tayacaja', 'Huancavelica'),
(2746, '90723', 'Santiago de T?cuma', 'Tayacaja', 'Huancavelica'),
(2747, '100101', 'Huanuco', 'Huanuco', 'Huanuco'),
(2748, '100102', 'Amarilis', 'Huanuco', 'Huanuco'),
(2749, '100103', 'Chinchao', 'Huanuco', 'Huanuco'),
(2750, '100104', 'Churubamba', 'Huanuco', 'Huanuco'),
(2751, '100105', 'Margos', 'Huanuco', 'Huanuco'),
(2752, '100106', 'Quisqui', 'Huanuco', 'Huanuco'),
(2753, '100107', 'San Francisco de Cayran', 'Huanuco', 'Huanuco'),
(2754, '100108', 'San Pedro de Chaulan', 'Huanuco', 'Huanuco'),
(2755, '100109', 'Santa Maria del Valle', 'Huanuco', 'Huanuco'),
(2756, '100110', 'Yarumayo', 'Huanuco', 'Huanuco'),
(2757, '100111', 'Pillco Marca', 'Huanuco', 'Huanuco'),
(2758, '100112', 'Yacus', 'Huanuco', 'Huanuco'),
(2759, '100113', 'San Pablo de Pillao', 'Huanuco', 'Huanuco'),
(2760, '100201', 'Ambo', 'Ambo', 'Huanuco'),
(2761, '100202', 'Cayna', 'Ambo', 'Huanuco'),
(2762, '100203', 'Colpas', 'Ambo', 'Huanuco'),
(2763, '100204', 'Conchamarca', 'Ambo', 'Huanuco'),
(2764, '100205', 'Huacar', 'Ambo', 'Huanuco'),
(2765, '100206', 'San Francisco', 'Ambo', 'Huanuco'),
(2766, '100207', 'San Rafael', 'Ambo', 'Huanuco'),
(2767, '100208', 'Tomay Kichwa', 'Ambo', 'Huanuco'),
(2768, '100301', 'La Union', 'Dos de Mayo', 'Huanuco'),
(2769, '100307', 'Chuquis', 'Dos de Mayo', 'Huanuco'),
(2770, '100311', 'Marias', 'Dos de Mayo', 'Huanuco'),
(2771, '100313', 'Pachas', 'Dos de Mayo', 'Huanuco'),
(2772, '100316', 'Quivilla', 'Dos de Mayo', 'Huanuco'),
(2773, '100317', 'Ripan', 'Dos de Mayo', 'Huanuco'),
(2774, '100321', 'Shunqui', 'Dos de Mayo', 'Huanuco'),
(2775, '100322', 'Sillapata', 'Dos de Mayo', 'Huanuco'),
(2776, '100323', 'Yanas', 'Dos de Mayo', 'Huanuco'),
(2777, '100401', 'Huacaybamba', 'Huacaybamba', 'Huanuco'),
(2778, '100402', 'Canchabamba', 'Huacaybamba', 'Huanuco'),
(2779, '100403', 'Cochabamba', 'Huacaybamba', 'Huanuco'),
(2780, '100404', 'Pinra', 'Huacaybamba', 'Huanuco'),
(2781, '100501', 'Llata', 'Huamalies', 'Huanuco'),
(2782, '100502', 'Arancay', 'Huamalies', 'Huanuco'),
(2783, '100503', 'Chavin de Pariarca', 'Huamalies', 'Huanuco'),
(2784, '100504', 'Jacas Grande', 'Huamalies', 'Huanuco'),
(2785, '100505', 'Jircan', 'Huamalies', 'Huanuco'),
(2786, '100506', 'Miraflores', 'Huamalies', 'Huanuco'),
(2787, '100507', 'Monzon', 'Huamalies', 'Huanuco'),
(2788, '100508', 'Punchao', 'Huamalies', 'Huanuco'),
(2789, '100509', 'Pu?os', 'Huamalies', 'Huanuco'),
(2790, '100510', 'Singa', 'Huamalies', 'Huanuco'),
(2791, '100511', 'Tantamayo', 'Huamalies', 'Huanuco');
INSERT INTO `ubigeo` (`id_ubigeo`, `codigo_ubigeo`, `distrito`, `provincia`, `departamento`) VALUES
(2792, '100601', 'Rupa-Rupa', 'Leoncio Prado', 'Huanuco'),
(2793, '100602', 'Daniel Alomias Robles', 'Leoncio Prado', 'Huanuco'),
(2794, '100603', 'Hermilio Valdizan', 'Leoncio Prado', 'Huanuco'),
(2795, '100604', 'Jose Crespo y Castillo', 'Leoncio Prado', 'Huanuco'),
(2796, '100605', 'Luyando', 'Leoncio Prado', 'Huanuco'),
(2797, '100606', 'Mariano Damaso Beraun', 'Leoncio Prado', 'Huanuco'),
(2798, '100607', 'Pucayacu', 'Leoncio Prado', 'Huanuco'),
(2799, '100608', 'Castillo Grande', 'Leoncio Prado', 'Huanuco'),
(2800, '100609', 'Pueblo Nuevo', 'Leoncio Prado', 'Huanuco'),
(2801, '100610', 'Santo Domingo de Anda', 'Leoncio Prado', 'Huanuco'),
(2802, '100701', 'Huacrachuco', 'Mara?on', 'Huanuco'),
(2803, '100702', 'Cholon', 'Mara?on', 'Huanuco'),
(2804, '100703', 'San Buenaventura', 'Mara?on', 'Huanuco'),
(2805, '100704', 'La Morada', 'Mara?on', 'Huanuco'),
(2806, '100705', 'Santa Rosa de Alto Yanajanca', 'Mara?on', 'Huanuco'),
(2807, '100801', 'Panao', 'Pachitea', 'Huanuco'),
(2808, '100802', 'Chaglla', 'Pachitea', 'Huanuco'),
(2809, '100803', 'Molino', 'Pachitea', 'Huanuco'),
(2810, '100804', 'Umari', 'Pachitea', 'Huanuco'),
(2811, '100901', 'Puerto Inca', 'Puerto Inca', 'Huanuco'),
(2812, '100902', 'Codo del Pozuzo', 'Puerto Inca', 'Huanuco'),
(2813, '100903', 'Honoria', 'Puerto Inca', 'Huanuco'),
(2814, '100904', 'Tournavista', 'Puerto Inca', 'Huanuco'),
(2815, '100905', 'Yuyapichis', 'Puerto Inca', 'Huanuco'),
(2816, '101001', 'Jesus', 'Lauricocha', 'Huanuco'),
(2817, '101002', 'Ba?os', 'Lauricocha', 'Huanuco'),
(2818, '101003', 'Jivia', 'Lauricocha', 'Huanuco'),
(2819, '101004', 'Queropalca', 'Lauricocha', 'Huanuco'),
(2820, '101005', 'Rondos', 'Lauricocha', 'Huanuco'),
(2821, '101006', 'San Francisco de Asis', 'Lauricocha', 'Huanuco'),
(2822, '101007', 'San Miguel de Cauri', 'Lauricocha', 'Huanuco'),
(2823, '101101', 'Chavinillo', 'Yarowilca', 'Huanuco'),
(2824, '101102', 'Cahuac', 'Yarowilca', 'Huanuco'),
(2825, '101103', 'Chacabamba', 'Yarowilca', 'Huanuco'),
(2826, '101104', 'Aparicio Pomares', 'Yarowilca', 'Huanuco'),
(2827, '101105', 'Jacas Chico', 'Yarowilca', 'Huanuco'),
(2828, '101106', 'Obas', 'Yarowilca', 'Huanuco'),
(2829, '101107', 'Pampamarca', 'Yarowilca', 'Huanuco'),
(2830, '101108', 'Choras', 'Yarowilca', 'Huanuco'),
(2831, '110101', 'Ica', 'Ica', 'Ica'),
(2832, '110102', 'La Tingui?a', 'Ica', 'Ica'),
(2833, '110103', 'Los Aquijes', 'Ica', 'Ica'),
(2834, '110104', 'Ocucaje', 'Ica', 'Ica'),
(2835, '110105', 'Pachacutec', 'Ica', 'Ica'),
(2836, '110106', 'Parcona', 'Ica', 'Ica'),
(2837, '110107', 'Pueblo Nuevo', 'Ica', 'Ica'),
(2838, '110108', 'Salas', 'Ica', 'Ica'),
(2839, '110109', 'San Jose de los Molinos', 'Ica', 'Ica'),
(2840, '110110', 'San Juan Bautista', 'Ica', 'Ica'),
(2841, '110111', 'Santiago', 'Ica', 'Ica'),
(2842, '110112', 'Subtanjalla', 'Ica', 'Ica'),
(2843, '110113', 'Tate', 'Ica', 'Ica'),
(2844, '110114', 'Yauca del Rosario', 'Ica', 'Ica'),
(2845, '110201', 'Chincha Alta', 'Chincha', 'Ica'),
(2846, '110202', 'Alto Laran', 'Chincha', 'Ica'),
(2847, '110203', 'Chavin', 'Chincha', 'Ica'),
(2848, '110204', 'Chincha Baja', 'Chincha', 'Ica'),
(2849, '110205', 'El Carmen', 'Chincha', 'Ica'),
(2850, '110206', 'Grocio Prado', 'Chincha', 'Ica'),
(2851, '110207', 'Pueblo Nuevo', 'Chincha', 'Ica'),
(2852, '110208', 'San Juan de Yanac', 'Chincha', 'Ica'),
(2853, '110209', 'San Pedro de Huacarpana', 'Chincha', 'Ica'),
(2854, '110210', 'Sunampe', 'Chincha', 'Ica'),
(2855, '110211', 'Tambo de Mora', 'Chincha', 'Ica'),
(2856, '110301', 'Nazca', 'Nazca', 'Ica'),
(2857, '110302', 'Changuillo', 'Nazca', 'Ica'),
(2858, '110303', 'El Ingenio', 'Nazca', 'Ica'),
(2859, '110304', 'Marcona', 'Nazca', 'Ica'),
(2860, '110305', 'Vista Alegre', 'Nazca', 'Ica'),
(2861, '110401', 'Palpa', 'Palpa', 'Ica'),
(2862, '110402', 'Llipata', 'Palpa', 'Ica'),
(2863, '110403', 'Rio Grande', 'Palpa', 'Ica'),
(2864, '110404', 'Santa Cruz', 'Palpa', 'Ica'),
(2865, '110405', 'Tibillo', 'Palpa', 'Ica'),
(2866, '110501', 'Pisco', 'Pisco', 'Ica'),
(2867, '110502', 'Huancano', 'Pisco', 'Ica'),
(2868, '110503', 'Humay', 'Pisco', 'Ica'),
(2869, '110504', 'Independencia', 'Pisco', 'Ica'),
(2870, '110505', 'Paracas', 'Pisco', 'Ica'),
(2871, '110506', 'San Andres', 'Pisco', 'Ica'),
(2872, '110507', 'San Clemente', 'Pisco', 'Ica'),
(2873, '110508', 'Tupac Amaru Inca', 'Pisco', 'Ica'),
(2874, '120101', 'Huancayo', 'Huancayo', 'Junin'),
(2875, '120104', 'Carhuacallanga', 'Huancayo', 'Junin'),
(2876, '120105', 'Chacapampa', 'Huancayo', 'Junin'),
(2877, '120106', 'Chicche', 'Huancayo', 'Junin'),
(2878, '120107', 'Chilca', 'Huancayo', 'Junin'),
(2879, '120108', 'Chongos Alto', 'Huancayo', 'Junin'),
(2880, '120111', 'Chupuro', 'Huancayo', 'Junin'),
(2881, '120112', 'Colca', 'Huancayo', 'Junin'),
(2882, '120113', 'Cullhuas', 'Huancayo', 'Junin'),
(2883, '120114', 'El Tambo', 'Huancayo', 'Junin'),
(2884, '120116', 'Huacrapuquio', 'Huancayo', 'Junin'),
(2885, '120117', 'Hualhuas', 'Huancayo', 'Junin'),
(2886, '120119', 'Huancan', 'Huancayo', 'Junin'),
(2887, '120120', 'Huasicancha', 'Huancayo', 'Junin'),
(2888, '120121', 'Huayucachi', 'Huancayo', 'Junin'),
(2889, '120122', 'Ingenio', 'Huancayo', 'Junin'),
(2890, '120124', 'Pariahuanca', 'Huancayo', 'Junin'),
(2891, '120125', 'Pilcomayo', 'Huancayo', 'Junin'),
(2892, '120126', 'Pucara', 'Huancayo', 'Junin'),
(2893, '120127', 'Quichuay', 'Huancayo', 'Junin'),
(2894, '120128', 'Quilcas', 'Huancayo', 'Junin'),
(2895, '120129', 'San Agustin', 'Huancayo', 'Junin'),
(2896, '120130', 'San Jeronimo de Tunan', 'Huancayo', 'Junin'),
(2897, '120132', 'Sa?o', 'Huancayo', 'Junin'),
(2898, '120133', 'Sapallanga', 'Huancayo', 'Junin'),
(2899, '120134', 'Sicaya', 'Huancayo', 'Junin'),
(2900, '120135', 'Santo Domingo de Acobamba', 'Huancayo', 'Junin'),
(2901, '120136', 'Viques', 'Huancayo', 'Junin'),
(2902, '120201', 'Concepcion', 'Concepcion', 'Junin'),
(2903, '120202', 'Aco', 'Concepcion', 'Junin'),
(2904, '120203', 'Andamarca', 'Concepcion', 'Junin'),
(2905, '120204', 'Chambara', 'Concepcion', 'Junin'),
(2906, '120205', 'Cochas', 'Concepcion', 'Junin'),
(2907, '120206', 'Comas', 'Concepcion', 'Junin'),
(2908, '120207', 'Heroinas Toledo', 'Concepcion', 'Junin'),
(2909, '120208', 'Manzanares', 'Concepcion', 'Junin'),
(2910, '120209', 'Mariscal Castilla', 'Concepcion', 'Junin'),
(2911, '120210', 'Matahuasi', 'Concepcion', 'Junin'),
(2912, '120211', 'Mito', 'Concepcion', 'Junin'),
(2913, '120212', 'Nueve de Julio', 'Concepcion', 'Junin'),
(2914, '120213', 'Orcotuna', 'Concepcion', 'Junin'),
(2915, '120214', 'San Jose de Quero', 'Concepcion', 'Junin'),
(2916, '120215', 'Santa Rosa de Ocopa', 'Concepcion', 'Junin'),
(2917, '120301', 'Chanchamayo', 'Chanchamayo', 'Junin'),
(2918, '120302', 'Perene', 'Chanchamayo', 'Junin'),
(2919, '120303', 'Pichanaqui', 'Chanchamayo', 'Junin'),
(2920, '120304', 'San Luis de Shuaro', 'Chanchamayo', 'Junin'),
(2921, '120305', 'San Ramon', 'Chanchamayo', 'Junin'),
(2922, '120306', 'Vitoc', 'Chanchamayo', 'Junin'),
(2923, '120401', 'Jauja', 'Jauja', 'Junin'),
(2924, '120402', 'Acolla', 'Jauja', 'Junin'),
(2925, '120403', 'Apata', 'Jauja', 'Junin'),
(2926, '120404', 'Ataura', 'Jauja', 'Junin'),
(2927, '120405', 'Canchayllo', 'Jauja', 'Junin'),
(2928, '120406', 'Curicaca', 'Jauja', 'Junin'),
(2929, '120407', 'El Mantaro', 'Jauja', 'Junin'),
(2930, '120408', 'Huamali', 'Jauja', 'Junin'),
(2931, '120409', 'Huaripampa', 'Jauja', 'Junin'),
(2932, '120410', 'Huertas', 'Jauja', 'Junin'),
(2933, '120411', 'Janjaillo', 'Jauja', 'Junin'),
(2934, '120412', 'Julcan', 'Jauja', 'Junin'),
(2935, '120413', 'Leonor Ordo?ez', 'Jauja', 'Junin'),
(2936, '120414', 'Llocllapampa', 'Jauja', 'Junin'),
(2937, '120415', 'Marco', 'Jauja', 'Junin'),
(2938, '120416', 'Masma', 'Jauja', 'Junin'),
(2939, '120417', 'Masma Chicche', 'Jauja', 'Junin'),
(2940, '120418', 'Molinos', 'Jauja', 'Junin'),
(2941, '120419', 'Monobamba', 'Jauja', 'Junin'),
(2942, '120420', 'Muqui', 'Jauja', 'Junin'),
(2943, '120421', 'Muquiyauyo', 'Jauja', 'Junin'),
(2944, '120422', 'Paca', 'Jauja', 'Junin'),
(2945, '120423', 'Paccha', 'Jauja', 'Junin'),
(2946, '120424', 'Pancan', 'Jauja', 'Junin'),
(2947, '120425', 'Parco', 'Jauja', 'Junin'),
(2948, '120426', 'Pomacancha', 'Jauja', 'Junin'),
(2949, '120427', 'Ricran', 'Jauja', 'Junin'),
(2950, '120428', 'San Lorenzo', 'Jauja', 'Junin'),
(2951, '120429', 'San Pedro de Chunan', 'Jauja', 'Junin'),
(2952, '120430', 'Sausa', 'Jauja', 'Junin'),
(2953, '120431', 'Sincos', 'Jauja', 'Junin'),
(2954, '120432', 'Tunan Marca', 'Jauja', 'Junin'),
(2955, '120433', 'Yauli', 'Jauja', 'Junin'),
(2956, '120434', 'Yauyos', 'Jauja', 'Junin'),
(2957, '120501', 'Junin', 'Junin', 'Junin'),
(2958, '120502', 'Carhuamayo', 'Junin', 'Junin'),
(2959, '120503', 'Ondores', 'Junin', 'Junin'),
(2960, '120504', 'Ulcumayo', 'Junin', 'Junin'),
(2961, '120601', 'Satipo', 'Satipo', 'Junin'),
(2962, '120602', 'Coviriali', 'Satipo', 'Junin'),
(2963, '120603', 'Llaylla', 'Satipo', 'Junin'),
(2964, '120604', 'Mazamari', 'Satipo', 'Junin'),
(2965, '120605', 'Pampa Hermosa', 'Satipo', 'Junin'),
(2966, '120606', 'Pangoa', 'Satipo', 'Junin'),
(2967, '120607', 'Rio Negro', 'Satipo', 'Junin'),
(2968, '120608', 'Rio Tambo', 'Satipo', 'Junin'),
(2969, '120609', 'Vizcat?n del Ene', 'Satipo', 'Junin'),
(2970, '120701', 'Tarma', 'Tarma', 'Junin'),
(2971, '120702', 'Acobamba', 'Tarma', 'Junin'),
(2972, '120703', 'Huaricolca', 'Tarma', 'Junin'),
(2973, '120704', 'Huasahuasi', 'Tarma', 'Junin'),
(2974, '120705', 'La Union', 'Tarma', 'Junin'),
(2975, '120706', 'Palca', 'Tarma', 'Junin'),
(2976, '120707', 'Palcamayo', 'Tarma', 'Junin'),
(2977, '120708', 'San Pedro de Cajas', 'Tarma', 'Junin'),
(2978, '120709', 'Tapo', 'Tarma', 'Junin'),
(2979, '120801', 'La Oroya', 'Yauli', 'Junin'),
(2980, '120802', 'Chacapalpa', 'Yauli', 'Junin'),
(2981, '120803', 'Huay-Huay', 'Yauli', 'Junin'),
(2982, '120804', 'Marcapomacocha', 'Yauli', 'Junin'),
(2983, '120805', 'Morococha', 'Yauli', 'Junin'),
(2984, '120806', 'Paccha', 'Yauli', 'Junin'),
(2985, '120807', 'Santa Barbara de Carhuacayan', 'Yauli', 'Junin'),
(2986, '120808', 'Santa Rosa de Sacco', 'Yauli', 'Junin'),
(2987, '120809', 'Suitucancha', 'Yauli', 'Junin'),
(2988, '120810', 'Yauli', 'Yauli', 'Junin'),
(2989, '120901', 'Chupaca', 'Chupaca', 'Junin'),
(2990, '120902', 'Ahuac', 'Chupaca', 'Junin'),
(2991, '120903', 'Chongos Bajo', 'Chupaca', 'Junin'),
(2992, '120904', 'Huachac', 'Chupaca', 'Junin'),
(2993, '120905', 'Huamancaca Chico', 'Chupaca', 'Junin'),
(2994, '120906', 'San Juan de Yscos', 'Chupaca', 'Junin'),
(2995, '120907', 'San Juan de Jarpa', 'Chupaca', 'Junin'),
(2996, '120908', 'Tres de Diciembre', 'Chupaca', 'Junin'),
(2997, '120909', 'Yanacancha', 'Chupaca', 'Junin'),
(2998, '130101', 'Trujillo', 'Trujillo', 'La Libertad'),
(2999, '130102', 'El Porvenir', 'Trujillo', 'La Libertad'),
(3000, '130103', 'Florencia de Mora', 'Trujillo', 'La Libertad'),
(3001, '130104', 'Huanchaco', 'Trujillo', 'La Libertad'),
(3002, '130105', 'La Esperanza', 'Trujillo', 'La Libertad'),
(3003, '130106', 'Laredo', 'Trujillo', 'La Libertad'),
(3004, '130107', 'Moche', 'Trujillo', 'La Libertad'),
(3005, '130108', 'Poroto', 'Trujillo', 'La Libertad'),
(3006, '130109', 'Salaverry', 'Trujillo', 'La Libertad'),
(3007, '130110', 'Simbal', 'Trujillo', 'La Libertad'),
(3008, '130111', 'Victor Larco Herrera', 'Trujillo', 'La Libertad'),
(3009, '130201', 'Ascope', 'Ascope', 'La Libertad'),
(3010, '130202', 'Chicama', 'Ascope', 'La Libertad'),
(3011, '130203', 'Chocope', 'Ascope', 'La Libertad'),
(3012, '130204', 'Magdalena de Cao', 'Ascope', 'La Libertad'),
(3013, '130205', 'Paijan', 'Ascope', 'La Libertad'),
(3014, '130206', 'Razuri', 'Ascope', 'La Libertad'),
(3015, '130207', 'Santiago de Cao', 'Ascope', 'La Libertad'),
(3016, '130208', 'Casa Grande', 'Ascope', 'La Libertad'),
(3017, '130301', 'Bolivar', 'Bolivar', 'La Libertad'),
(3018, '130302', 'Bambamarca', 'Bolivar', 'La Libertad'),
(3019, '130303', 'Condormarca', 'Bolivar', 'La Libertad'),
(3020, '130304', 'Longotea', 'Bolivar', 'La Libertad'),
(3021, '130305', 'Uchumarca', 'Bolivar', 'La Libertad'),
(3022, '130306', 'Ucuncha', 'Bolivar', 'La Libertad'),
(3023, '130401', 'Chepen', 'Chepen', 'La Libertad'),
(3024, '130402', 'Pacanga', 'Chepen', 'La Libertad'),
(3025, '130403', 'Pueblo Nuevo', 'Chepen', 'La Libertad'),
(3026, '130501', 'Julcan', 'Julcan', 'La Libertad'),
(3027, '130502', 'Calamarca', 'Julcan', 'La Libertad'),
(3028, '130503', 'Carabamba', 'Julcan', 'La Libertad'),
(3029, '130504', 'Huaso', 'Julcan', 'La Libertad'),
(3030, '130601', 'Otuzco', 'Otuzco', 'La Libertad'),
(3031, '130602', 'Agallpampa', 'Otuzco', 'La Libertad'),
(3032, '130604', 'Charat', 'Otuzco', 'La Libertad'),
(3033, '130605', 'Huaranchal', 'Otuzco', 'La Libertad'),
(3034, '130606', 'La Cuesta', 'Otuzco', 'La Libertad'),
(3035, '130608', 'Mache', 'Otuzco', 'La Libertad'),
(3036, '130610', 'Paranday', 'Otuzco', 'La Libertad'),
(3037, '130611', 'Salpo', 'Otuzco', 'La Libertad'),
(3038, '130613', 'Sinsicap', 'Otuzco', 'La Libertad'),
(3039, '130614', 'Usquil', 'Otuzco', 'La Libertad'),
(3040, '130701', 'San Pedro de Lloc', 'Pacasmayo', 'La Libertad'),
(3041, '130702', 'Guadalupe', 'Pacasmayo', 'La Libertad'),
(3042, '130703', 'Jequetepeque', 'Pacasmayo', 'La Libertad'),
(3043, '130704', 'Pacasmayo', 'Pacasmayo', 'La Libertad'),
(3044, '130705', 'San Jose', 'Pacasmayo', 'La Libertad'),
(3045, '130801', 'Tayabamba', 'Pataz', 'La Libertad'),
(3046, '130802', 'Buldibuyo', 'Pataz', 'La Libertad'),
(3047, '130803', 'Chillia', 'Pataz', 'La Libertad'),
(3048, '130804', 'Huancaspata', 'Pataz', 'La Libertad'),
(3049, '130805', 'Huaylillas', 'Pataz', 'La Libertad'),
(3050, '130806', 'Huayo', 'Pataz', 'La Libertad'),
(3051, '130807', 'Ongon', 'Pataz', 'La Libertad'),
(3052, '130808', 'Parcoy', 'Pataz', 'La Libertad'),
(3053, '130809', 'Pataz', 'Pataz', 'La Libertad'),
(3054, '130810', 'Pias', 'Pataz', 'La Libertad'),
(3055, '130811', 'Santiago de Challas', 'Pataz', 'La Libertad'),
(3056, '130812', 'Taurija', 'Pataz', 'La Libertad'),
(3057, '130813', 'Urpay', 'Pataz', 'La Libertad'),
(3058, '130901', 'Huamachuco', 'Sanchez Carrion', 'La Libertad'),
(3059, '130902', 'Chugay', 'Sanchez Carrion', 'La Libertad'),
(3060, '130903', 'Cochorco', 'Sanchez Carrion', 'La Libertad'),
(3061, '130904', 'Curgos', 'Sanchez Carrion', 'La Libertad'),
(3062, '130905', 'Marcabal', 'Sanchez Carrion', 'La Libertad'),
(3063, '130906', 'Sanagoran', 'Sanchez Carrion', 'La Libertad'),
(3064, '130907', 'Sarin', 'Sanchez Carrion', 'La Libertad'),
(3065, '130908', 'Sartimbamba', 'Sanchez Carrion', 'La Libertad'),
(3066, '131001', 'Santiago de Chuco', 'Santiago de Chuco', 'La Libertad'),
(3067, '131002', 'Angasmarca', 'Santiago de Chuco', 'La Libertad'),
(3068, '131003', 'Cachicadan', 'Santiago de Chuco', 'La Libertad'),
(3069, '131004', 'Mollebamba', 'Santiago de Chuco', 'La Libertad'),
(3070, '131005', 'Mollepata', 'Santiago de Chuco', 'La Libertad'),
(3071, '131006', 'Quiruvilca', 'Santiago de Chuco', 'La Libertad'),
(3072, '131007', 'Santa Cruz de Chuca', 'Santiago de Chuco', 'La Libertad'),
(3073, '131008', 'Sitabamba', 'Santiago de Chuco', 'La Libertad'),
(3074, '131101', 'Cascas', 'Gran Chimu', 'La Libertad'),
(3075, '131102', 'Lucma', 'Gran Chimu', 'La Libertad'),
(3076, '131103', 'Compin', 'Gran Chimu', 'La Libertad'),
(3077, '131104', 'Sayapullo', 'Gran Chimu', 'La Libertad'),
(3078, '131201', 'Viru', 'Viru', 'La Libertad'),
(3079, '131202', 'Chao', 'Viru', 'La Libertad'),
(3080, '131203', 'Guadalupito', 'Viru', 'La Libertad'),
(3081, '140101', 'Chiclayo', 'Chiclayo', 'Lambayeque'),
(3082, '140102', 'Chongoyape', 'Chiclayo', 'Lambayeque'),
(3083, '140103', 'Eten', 'Chiclayo', 'Lambayeque'),
(3084, '140104', 'Eten Puerto', 'Chiclayo', 'Lambayeque'),
(3085, '140105', 'Jose Leonardo Ortiz', 'Chiclayo', 'Lambayeque'),
(3086, '140106', 'La Victoria', 'Chiclayo', 'Lambayeque'),
(3087, '140107', 'Lagunas', 'Chiclayo', 'Lambayeque'),
(3088, '140108', 'Monsefu', 'Chiclayo', 'Lambayeque'),
(3089, '140109', 'Nueva Arica', 'Chiclayo', 'Lambayeque'),
(3090, '140110', 'Oyotun', 'Chiclayo', 'Lambayeque'),
(3091, '140111', 'Picsi', 'Chiclayo', 'Lambayeque'),
(3092, '140112', 'Pimentel', 'Chiclayo', 'Lambayeque'),
(3093, '140113', 'Reque', 'Chiclayo', 'Lambayeque'),
(3094, '140114', 'Santa Rosa', 'Chiclayo', 'Lambayeque'),
(3095, '140115', 'Sa?a', 'Chiclayo', 'Lambayeque'),
(3096, '140116', 'Cayalti', 'Chiclayo', 'Lambayeque'),
(3097, '140117', 'Patapo', 'Chiclayo', 'Lambayeque'),
(3098, '140118', 'Pomalca', 'Chiclayo', 'Lambayeque'),
(3099, '140119', 'Pucala', 'Chiclayo', 'Lambayeque'),
(3100, '140120', 'Tuman', 'Chiclayo', 'Lambayeque'),
(3101, '140201', 'Ferre?afe', 'Ferre?afe', 'Lambayeque'),
(3102, '140202', 'Ca?aris', 'Ferre?afe', 'Lambayeque'),
(3103, '140203', 'Incahuasi', 'Ferre?afe', 'Lambayeque'),
(3104, '140204', 'Manuel Antonio Mesones Muro', 'Ferre?afe', 'Lambayeque'),
(3105, '140205', 'Pitipo', 'Ferre?afe', 'Lambayeque'),
(3106, '140206', 'Pueblo Nuevo', 'Ferre?afe', 'Lambayeque'),
(3107, '140301', 'Lambayeque', 'Lambayeque', 'Lambayeque'),
(3108, '140302', 'Chochope', 'Lambayeque', 'Lambayeque'),
(3109, '140303', 'Illimo', 'Lambayeque', 'Lambayeque'),
(3110, '140304', 'Jayanca', 'Lambayeque', 'Lambayeque'),
(3111, '140305', 'Mochumi', 'Lambayeque', 'Lambayeque'),
(3112, '140306', 'Morrope', 'Lambayeque', 'Lambayeque'),
(3113, '140307', 'Motupe', 'Lambayeque', 'Lambayeque'),
(3114, '140308', 'Olmos', 'Lambayeque', 'Lambayeque'),
(3115, '140309', 'Pacora', 'Lambayeque', 'Lambayeque'),
(3116, '140310', 'Salas', 'Lambayeque', 'Lambayeque'),
(3117, '140311', 'San Jose', 'Lambayeque', 'Lambayeque'),
(3118, '140312', 'Tucume', 'Lambayeque', 'Lambayeque'),
(3119, '150101', 'Lima', 'Lima', 'Lima'),
(3120, '150102', 'Ancon', 'Lima', 'Lima'),
(3121, '150103', 'Ate', 'Lima', 'Lima'),
(3122, '150104', 'Barranco', 'Lima', 'Lima'),
(3123, '150105', 'Bre?a', 'Lima', 'Lima'),
(3124, '150106', 'Carabayllo', 'Lima', 'Lima'),
(3125, '150107', 'Chaclacayo', 'Lima', 'Lima'),
(3126, '150108', 'Chorrillos', 'Lima', 'Lima'),
(3127, '150109', 'Cieneguilla', 'Lima', 'Lima'),
(3128, '150110', 'Comas', 'Lima', 'Lima'),
(3129, '150111', 'El Agustino', 'Lima', 'Lima'),
(3130, '150112', 'Independencia', 'Lima', 'Lima'),
(3131, '150113', 'Jesus Maria', 'Lima', 'Lima'),
(3132, '150114', 'La Molina', 'Lima', 'Lima'),
(3133, '150115', 'La Victoria', 'Lima', 'Lima'),
(3134, '150116', 'Lince', 'Lima', 'Lima'),
(3135, '150117', 'Los Olivos', 'Lima', 'Lima'),
(3136, '150118', 'Lurigancho', 'Lima', 'Lima'),
(3137, '150119', 'Lurin', 'Lima', 'Lima'),
(3138, '150120', 'Magdalena del Mar', 'Lima', 'Lima'),
(3139, '150121', 'Pueblo Libre', 'Lima', 'Lima'),
(3140, '150122', 'Miraflores', 'Lima', 'Lima'),
(3141, '150123', 'Pachacamac', 'Lima', 'Lima'),
(3142, '150124', 'Pucusana', 'Lima', 'Lima'),
(3143, '150125', 'Puente Piedra', 'Lima', 'Lima'),
(3144, '150126', 'Punta Hermosa', 'Lima', 'Lima'),
(3145, '150127', 'Punta Negra', 'Lima', 'Lima'),
(3146, '150128', 'Rimac', 'Lima', 'Lima'),
(3147, '150129', 'San Bartolo', 'Lima', 'Lima'),
(3148, '150130', 'San Borja', 'Lima', 'Lima'),
(3149, '150131', 'San Isidro', 'Lima', 'Lima'),
(3150, '150132', 'San Juan de Lurigancho', 'Lima', 'Lima'),
(3151, '150133', 'San Juan de Miraflores', 'Lima', 'Lima'),
(3152, '150134', 'San Luis', 'Lima', 'Lima'),
(3153, '150135', 'San Martin de Porres', 'Lima', 'Lima'),
(3154, '150136', 'San Miguel', 'Lima', 'Lima'),
(3155, '150137', 'Santa Anita', 'Lima', 'Lima'),
(3156, '150138', 'Santa Maria del Mar', 'Lima', 'Lima'),
(3157, '150139', 'Santa Rosa', 'Lima', 'Lima'),
(3158, '150140', 'Santiago de Surco', 'Lima', 'Lima'),
(3159, '150141', 'Surquillo', 'Lima', 'Lima'),
(3160, '150142', 'Villa El Salvador', 'Lima', 'Lima'),
(3161, '150143', 'Villa Maria del Triunfo', 'Lima', 'Lima'),
(3162, '150201', 'Barranca', 'Barranca', 'Lima'),
(3163, '150202', 'Paramonga', 'Barranca', 'Lima'),
(3164, '150203', 'Pativilca', 'Barranca', 'Lima'),
(3165, '150204', 'Supe', 'Barranca', 'Lima'),
(3166, '150205', 'Supe Puerto', 'Barranca', 'Lima'),
(3167, '150301', 'Cajatambo', 'Cajatambo', 'Lima'),
(3168, '150302', 'Copa', 'Cajatambo', 'Lima'),
(3169, '150303', 'Gorgor', 'Cajatambo', 'Lima'),
(3170, '150304', 'Huancapon', 'Cajatambo', 'Lima'),
(3171, '150305', 'Manas', 'Cajatambo', 'Lima'),
(3172, '150401', 'Canta', 'Canta', 'Lima'),
(3173, '150402', 'Arahuay', 'Canta', 'Lima'),
(3174, '150403', 'Huamantanga', 'Canta', 'Lima'),
(3175, '150404', 'Huaros', 'Canta', 'Lima'),
(3176, '150405', 'Lachaqui', 'Canta', 'Lima'),
(3177, '150406', 'San Buenaventura', 'Canta', 'Lima'),
(3178, '150407', 'Santa Rosa de Quives', 'Canta', 'Lima'),
(3179, '150501', 'San Vicente de Ca?ete', 'Ca?ete', 'Lima'),
(3180, '150502', 'Asia', 'Ca?ete', 'Lima'),
(3181, '150503', 'Calango', 'Ca?ete', 'Lima'),
(3182, '150504', 'Cerro Azul', 'Ca?ete', 'Lima'),
(3183, '150505', 'Chilca', 'Ca?ete', 'Lima'),
(3184, '150506', 'Coayllo', 'Ca?ete', 'Lima'),
(3185, '150507', 'Imperial', 'Ca?ete', 'Lima'),
(3186, '150508', 'Lunahuana', 'Ca?ete', 'Lima'),
(3187, '150509', 'Mala', 'Ca?ete', 'Lima'),
(3188, '150510', 'Nuevo Imperial', 'Ca?ete', 'Lima'),
(3189, '150511', 'Pacaran', 'Ca?ete', 'Lima'),
(3190, '150512', 'Quilmana', 'Ca?ete', 'Lima'),
(3191, '150513', 'San Antonio', 'Ca?ete', 'Lima'),
(3192, '150514', 'San Luis', 'Ca?ete', 'Lima'),
(3193, '150515', 'Santa Cruz de Flores', 'Ca?ete', 'Lima'),
(3194, '150516', 'Zu?iga', 'Ca?ete', 'Lima'),
(3195, '150601', 'Huaral', 'Huaral', 'Lima'),
(3196, '150602', 'Atavillos Alto', 'Huaral', 'Lima'),
(3197, '150603', 'Atavillos Bajo', 'Huaral', 'Lima'),
(3198, '150604', 'Aucallama', 'Huaral', 'Lima'),
(3199, '150605', 'Chancay', 'Huaral', 'Lima'),
(3200, '150606', 'Ihuari', 'Huaral', 'Lima'),
(3201, '150607', 'Lampian', 'Huaral', 'Lima'),
(3202, '150608', 'Pacaraos', 'Huaral', 'Lima'),
(3203, '150609', 'San Miguel de Acos', 'Huaral', 'Lima'),
(3204, '150610', 'Santa Cruz de Andamarca', 'Huaral', 'Lima'),
(3205, '150611', 'Sumbilca', 'Huaral', 'Lima'),
(3206, '150612', 'Veintisiete de Noviembre', 'Huaral', 'Lima'),
(3207, '150701', 'Matucana', 'Huarochiri', 'Lima'),
(3208, '150702', 'Antioquia', 'Huarochiri', 'Lima'),
(3209, '150703', 'Callahuanca', 'Huarochiri', 'Lima'),
(3210, '150704', 'Carampoma', 'Huarochiri', 'Lima'),
(3211, '150705', 'Chicla', 'Huarochiri', 'Lima'),
(3212, '150706', 'Cuenca', 'Huarochiri', 'Lima'),
(3213, '150707', 'Huachupampa', 'Huarochiri', 'Lima'),
(3214, '150708', 'Huanza', 'Huarochiri', 'Lima'),
(3215, '150709', 'Huarochiri', 'Huarochiri', 'Lima'),
(3216, '150710', 'Lahuaytambo', 'Huarochiri', 'Lima'),
(3217, '150711', 'Langa', 'Huarochiri', 'Lima'),
(3218, '150712', 'Laraos', 'Huarochiri', 'Lima'),
(3219, '150713', 'Mariatana', 'Huarochiri', 'Lima'),
(3220, '150714', 'Ricardo Palma', 'Huarochiri', 'Lima'),
(3221, '150715', 'San Andres de Tupicocha', 'Huarochiri', 'Lima'),
(3222, '150716', 'San Antonio', 'Huarochiri', 'Lima'),
(3223, '150717', 'San Bartolome', 'Huarochiri', 'Lima'),
(3224, '150718', 'San Damian', 'Huarochiri', 'Lima'),
(3225, '150719', 'San Juan de Iris', 'Huarochiri', 'Lima'),
(3226, '150720', 'San Juan de Tantaranche', 'Huarochiri', 'Lima'),
(3227, '150721', 'San Lorenzo de Quinti', 'Huarochiri', 'Lima'),
(3228, '150722', 'San Mateo', 'Huarochiri', 'Lima'),
(3229, '150723', 'San Mateo de Otao', 'Huarochiri', 'Lima'),
(3230, '150724', 'San Pedro de Casta', 'Huarochiri', 'Lima'),
(3231, '150725', 'San Pedro de Huancayre', 'Huarochiri', 'Lima'),
(3232, '150726', 'Sangallaya', 'Huarochiri', 'Lima'),
(3233, '150727', 'Santa Cruz de Cocachacra', 'Huarochiri', 'Lima'),
(3234, '150728', 'Santa Eulalia', 'Huarochiri', 'Lima'),
(3235, '150729', 'Santiago de Anchucaya', 'Huarochiri', 'Lima'),
(3236, '150730', 'Santiago de Tuna', 'Huarochiri', 'Lima'),
(3237, '150731', 'Santo Domingo de los Olleros', 'Huarochiri', 'Lima'),
(3238, '150732', 'Surco', 'Huarochiri', 'Lima'),
(3239, '150801', 'Huacho', 'Huaura', 'Lima'),
(3240, '150802', 'Ambar', 'Huaura', 'Lima'),
(3241, '150803', 'Caleta de Carquin', 'Huaura', 'Lima'),
(3242, '150804', 'Checras', 'Huaura', 'Lima'),
(3243, '150805', 'Hualmay', 'Huaura', 'Lima'),
(3244, '150806', 'Huaura', 'Huaura', 'Lima'),
(3245, '150807', 'Leoncio Prado', 'Huaura', 'Lima'),
(3246, '150808', 'Paccho', 'Huaura', 'Lima'),
(3247, '150809', 'Santa Leonor', 'Huaura', 'Lima'),
(3248, '150810', 'Santa Maria', 'Huaura', 'Lima'),
(3249, '150811', 'Sayan', 'Huaura', 'Lima'),
(3250, '150812', 'Vegueta', 'Huaura', 'Lima'),
(3251, '150901', 'Oyon', 'Oyon', 'Lima'),
(3252, '150902', 'Andajes', 'Oyon', 'Lima'),
(3253, '150903', 'Caujul', 'Oyon', 'Lima'),
(3254, '150904', 'Cochamarca', 'Oyon', 'Lima'),
(3255, '150905', 'Navan', 'Oyon', 'Lima'),
(3256, '150906', 'Pachangara', 'Oyon', 'Lima'),
(3257, '151001', 'Yauyos', 'Yauyos', 'Lima'),
(3258, '151002', 'Alis', 'Yauyos', 'Lima'),
(3259, '151003', 'Ayauca', 'Yauyos', 'Lima'),
(3260, '151004', 'Ayaviri', 'Yauyos', 'Lima'),
(3261, '151005', 'Azangaro', 'Yauyos', 'Lima'),
(3262, '151006', 'Cacra', 'Yauyos', 'Lima'),
(3263, '151007', 'Carania', 'Yauyos', 'Lima'),
(3264, '151008', 'Catahuasi', 'Yauyos', 'Lima'),
(3265, '151009', 'Chocos', 'Yauyos', 'Lima'),
(3266, '151010', 'Cochas', 'Yauyos', 'Lima'),
(3267, '151011', 'Colonia', 'Yauyos', 'Lima'),
(3268, '151012', 'Hongos', 'Yauyos', 'Lima'),
(3269, '151013', 'Huampara', 'Yauyos', 'Lima'),
(3270, '151014', 'Huancaya', 'Yauyos', 'Lima'),
(3271, '151015', 'Huangascar', 'Yauyos', 'Lima'),
(3272, '151016', 'Huantan', 'Yauyos', 'Lima'),
(3273, '151017', 'Hua?ec', 'Yauyos', 'Lima'),
(3274, '151018', 'Laraos', 'Yauyos', 'Lima'),
(3275, '151019', 'Lincha', 'Yauyos', 'Lima'),
(3276, '151020', 'Madean', 'Yauyos', 'Lima'),
(3277, '151021', 'Miraflores', 'Yauyos', 'Lima'),
(3278, '151022', 'Omas', 'Yauyos', 'Lima'),
(3279, '151023', 'Putinza', 'Yauyos', 'Lima'),
(3280, '151024', 'Quinches', 'Yauyos', 'Lima'),
(3281, '151025', 'Quinocay', 'Yauyos', 'Lima'),
(3282, '151026', 'San Joaquin', 'Yauyos', 'Lima'),
(3283, '151027', 'San Pedro de Pilas', 'Yauyos', 'Lima'),
(3284, '151028', 'Tanta', 'Yauyos', 'Lima'),
(3285, '151029', 'Tauripampa', 'Yauyos', 'Lima'),
(3286, '151030', 'Tomas', 'Yauyos', 'Lima'),
(3287, '151031', 'Tupe', 'Yauyos', 'Lima'),
(3288, '151032', 'Vi?ac', 'Yauyos', 'Lima'),
(3289, '151033', 'Vitis', 'Yauyos', 'Lima'),
(3290, '160101', 'Iquitos', 'Maynas', 'Loreto'),
(3291, '160102', 'Alto Nanay', 'Maynas', 'Loreto'),
(3292, '160103', 'Fernando Lores', 'Maynas', 'Loreto'),
(3293, '160104', 'Indiana', 'Maynas', 'Loreto'),
(3294, '160105', 'Las Amazonas', 'Maynas', 'Loreto'),
(3295, '160106', 'Mazan', 'Maynas', 'Loreto'),
(3296, '160107', 'Napo', 'Maynas', 'Loreto'),
(3297, '160108', 'Punchana', 'Maynas', 'Loreto'),
(3298, '160110', 'Torres Causana', 'Maynas', 'Loreto'),
(3299, '160112', 'Belen', 'Maynas', 'Loreto'),
(3300, '160113', 'San Juan Bautista', 'Maynas', 'Loreto'),
(3301, '160201', 'Yurimaguas', 'Alto Amazonas', 'Loreto'),
(3302, '160202', 'Balsapuerto', 'Alto Amazonas', 'Loreto'),
(3303, '160205', 'Jeberos', 'Alto Amazonas', 'Loreto'),
(3304, '160206', 'Lagunas', 'Alto Amazonas', 'Loreto'),
(3305, '160210', 'Santa Cruz', 'Alto Amazonas', 'Loreto'),
(3306, '160211', 'Teniente Cesar Lopez Rojas', 'Alto Amazonas', 'Loreto'),
(3307, '160301', 'Nauta', 'Loreto', 'Loreto'),
(3308, '160302', 'Parinari', 'Loreto', 'Loreto'),
(3309, '160303', 'Tigre', 'Loreto', 'Loreto'),
(3310, '160304', 'Trompeteros', 'Loreto', 'Loreto'),
(3311, '160305', 'Urarinas', 'Loreto', 'Loreto'),
(3312, '160401', 'Ramon Castilla', 'Mariscal Ramon Castilla', 'Loreto'),
(3313, '160402', 'Pebas', 'Mariscal Ramon Castilla', 'Loreto'),
(3314, '160403', 'Yavari', 'Mariscal Ramon Castilla', 'Loreto'),
(3315, '160404', 'San Pablo', 'Mariscal Ramon Castilla', 'Loreto'),
(3316, '160501', 'Requena', 'Requena', 'Loreto'),
(3317, '160502', 'Alto Tapiche', 'Requena', 'Loreto'),
(3318, '160503', 'Capelo', 'Requena', 'Loreto'),
(3319, '160504', 'Emilio San Martin', 'Requena', 'Loreto'),
(3320, '160505', 'Maquia', 'Requena', 'Loreto'),
(3321, '160506', 'Puinahua', 'Requena', 'Loreto'),
(3322, '160507', 'Saquena', 'Requena', 'Loreto'),
(3323, '160508', 'Soplin', 'Requena', 'Loreto'),
(3324, '160509', 'Tapiche', 'Requena', 'Loreto'),
(3325, '160510', 'Jenaro Herrera', 'Requena', 'Loreto'),
(3326, '160511', 'Yaquerana', 'Requena', 'Loreto'),
(3327, '160601', 'Contamana', 'Ucayali', 'Loreto'),
(3328, '160602', 'Inahuaya', 'Ucayali', 'Loreto'),
(3329, '160603', 'Padre Marquez', 'Ucayali', 'Loreto'),
(3330, '160604', 'Pampa Hermosa', 'Ucayali', 'Loreto'),
(3331, '160605', 'Sarayacu', 'Ucayali', 'Loreto'),
(3332, '160606', 'Vargas Guerra', 'Ucayali', 'Loreto'),
(3333, '160701', 'Barranca', 'Datem del Mara?on', 'Loreto'),
(3334, '160702', 'Cahuapanas', 'Datem del Mara?on', 'Loreto'),
(3335, '160703', 'Manseriche', 'Datem del Mara?on', 'Loreto'),
(3336, '160704', 'Morona', 'Datem del Mara?on', 'Loreto'),
(3337, '160705', 'Pastaza', 'Datem del Mara?on', 'Loreto'),
(3338, '160706', 'Andoas', 'Datem del Mara?on', 'Loreto'),
(3339, '160801', 'Putumayo', 'Maynas', 'Loreto'),
(3340, '160802', 'Rosa Panduro', 'Maynas', 'Loreto'),
(3341, '160803', 'Teniente Manuel Clavero', 'Maynas', 'Loreto'),
(3342, '160804', 'Yaguas', 'Maynas', 'Loreto'),
(3343, '170101', 'Tambopata', 'Tambopata', 'Madre de Dios'),
(3344, '170102', 'Inambari', 'Tambopata', 'Madre de Dios'),
(3345, '170103', 'Las Piedras', 'Tambopata', 'Madre de Dios'),
(3346, '170104', 'Laberinto', 'Tambopata', 'Madre de Dios'),
(3347, '170201', 'Manu', 'Manu', 'Madre de Dios'),
(3348, '170202', 'Fitzcarrald', 'Manu', 'Madre de Dios'),
(3349, '170203', 'Madre de Dios', 'Manu', 'Madre de Dios'),
(3350, '170204', 'Huepetuhe', 'Manu', 'Madre de Dios'),
(3351, '170301', 'I?apari', 'Tahuamanu', 'Madre de Dios'),
(3352, '170302', 'Iberia', 'Tahuamanu', 'Madre de Dios'),
(3353, '170303', 'Tahuamanu', 'Tahuamanu', 'Madre de Dios'),
(3354, '180101', 'Moquegua', 'Mariscal Nieto', 'Moquegua'),
(3355, '180102', 'Carumas', 'Mariscal Nieto', 'Moquegua'),
(3356, '180103', 'Cuchumbaya', 'Mariscal Nieto', 'Moquegua'),
(3357, '180104', 'Samegua', 'Mariscal Nieto', 'Moquegua'),
(3358, '180105', 'San Cristobal', 'Mariscal Nieto', 'Moquegua'),
(3359, '180106', 'Torata', 'Mariscal Nieto', 'Moquegua'),
(3360, '180201', 'Omate', 'General Sanchez Cerr', 'Moquegua'),
(3361, '180202', 'Chojata', 'General Sanchez Cerr', 'Moquegua'),
(3362, '180203', 'Coalaque', 'General Sanchez Cerr', 'Moquegua'),
(3363, '180204', 'Ichu?a', 'General Sanchez Cerr', 'Moquegua'),
(3364, '180205', 'La Capilla', 'General Sanchez Cerr', 'Moquegua'),
(3365, '180206', 'Lloque', 'General Sanchez Cerr', 'Moquegua'),
(3366, '180207', 'Matalaque', 'General Sanchez Cerr', 'Moquegua'),
(3367, '180208', 'Puquina', 'General Sanchez Cerr', 'Moquegua'),
(3368, '180209', 'Quinistaquillas', 'General Sanchez Cerr', 'Moquegua'),
(3369, '180210', 'Ubinas', 'General Sanchez Cerr', 'Moquegua'),
(3370, '180211', 'Yunga', 'General Sanchez Cerr', 'Moquegua'),
(3371, '180301', 'Ilo', 'Ilo', 'Moquegua'),
(3372, '180302', 'El Algarrobal', 'Ilo', 'Moquegua'),
(3373, '180303', 'Pacocha', 'Ilo', 'Moquegua'),
(3374, '190101', 'Chaupimarca', 'Pasco', 'Pasco'),
(3375, '190102', 'Huachon', 'Pasco', 'Pasco'),
(3376, '190103', 'Huariaca', 'Pasco', 'Pasco'),
(3377, '190104', 'Huayllay', 'Pasco', 'Pasco'),
(3378, '190105', 'Ninacaca', 'Pasco', 'Pasco'),
(3379, '190106', 'Pallanchacra', 'Pasco', 'Pasco'),
(3380, '190107', 'Paucartambo', 'Pasco', 'Pasco'),
(3381, '190108', 'San Francisco de Asis de Yarusyacan', 'Pasco', 'Pasco'),
(3382, '190109', 'Simon Bolivar', 'Pasco', 'Pasco'),
(3383, '190110', 'Ticlacayan', 'Pasco', 'Pasco'),
(3384, '190111', 'Tinyahuarco', 'Pasco', 'Pasco'),
(3385, '190112', 'Vicco', 'Pasco', 'Pasco'),
(3386, '190113', 'Yanacancha', 'Pasco', 'Pasco'),
(3387, '190201', 'Yanahuanca', 'Daniel Alcides Carri', 'Pasco'),
(3388, '190202', 'Chacayan', 'Daniel Alcides Carri', 'Pasco'),
(3389, '190203', 'Goyllarisquizga', 'Daniel Alcides Carri', 'Pasco'),
(3390, '190204', 'Paucar', 'Daniel Alcides Carri', 'Pasco'),
(3391, '190205', 'San Pedro de Pillao', 'Daniel Alcides Carri', 'Pasco'),
(3392, '190206', 'Santa Ana de Tusi', 'Daniel Alcides Carri', 'Pasco'),
(3393, '190207', 'Tapuc', 'Daniel Alcides Carri', 'Pasco'),
(3394, '190208', 'Vilcabamba', 'Daniel Alcides Carri', 'Pasco'),
(3395, '190301', 'Oxapampa', 'Oxapampa', 'Pasco'),
(3396, '190302', 'Chontabamba', 'Oxapampa', 'Pasco'),
(3397, '190303', 'Huancabamba', 'Oxapampa', 'Pasco'),
(3398, '190304', 'Palcazu', 'Oxapampa', 'Pasco'),
(3399, '190305', 'Pozuzo', 'Oxapampa', 'Pasco'),
(3400, '190306', 'Puerto Bermudez', 'Oxapampa', 'Pasco'),
(3401, '190307', 'Villa Rica', 'Oxapampa', 'Pasco'),
(3402, '190308', 'Constituci?n', 'Oxapampa', 'Pasco'),
(3403, '200101', 'Piura', 'Piura', 'Piura'),
(3404, '200104', 'Castilla', 'Piura', 'Piura'),
(3405, '200105', 'Catacaos', 'Piura', 'Piura'),
(3406, '200107', 'Cura Mori', 'Piura', 'Piura'),
(3407, '200108', 'El Tallan', 'Piura', 'Piura'),
(3408, '200109', 'La Arena', 'Piura', 'Piura'),
(3409, '200110', 'La Union', 'Piura', 'Piura'),
(3410, '200111', 'Las Lomas', 'Piura', 'Piura'),
(3411, '200114', 'Tambo Grande', 'Piura', 'Piura'),
(3412, '200115', '26 de Octubre', 'Piura', 'Piura'),
(3413, '200201', 'Ayabaca', 'Ayabaca', 'Piura'),
(3414, '200202', 'Frias', 'Ayabaca', 'Piura'),
(3415, '200203', 'Jilili', 'Ayabaca', 'Piura'),
(3416, '200204', 'Lagunas', 'Ayabaca', 'Piura'),
(3417, '200205', 'Montero', 'Ayabaca', 'Piura'),
(3418, '200206', 'Pacaipampa', 'Ayabaca', 'Piura'),
(3419, '200207', 'Paimas', 'Ayabaca', 'Piura'),
(3420, '200208', 'Sapillica', 'Ayabaca', 'Piura'),
(3421, '200209', 'Sicchez', 'Ayabaca', 'Piura'),
(3422, '200210', 'Suyo', 'Ayabaca', 'Piura'),
(3423, '200301', 'Huancabamba', 'Huancabamba', 'Piura'),
(3424, '200302', 'Canchaque', 'Huancabamba', 'Piura'),
(3425, '200303', 'El Carmen de La Frontera', 'Huancabamba', 'Piura'),
(3426, '200304', 'Huarmaca', 'Huancabamba', 'Piura'),
(3427, '200305', 'Lalaquiz', 'Huancabamba', 'Piura'),
(3428, '200306', 'San Miguel de El Faique', 'Huancabamba', 'Piura'),
(3429, '200307', 'Sondor', 'Huancabamba', 'Piura'),
(3430, '200308', 'Sondorillo', 'Huancabamba', 'Piura'),
(3431, '200401', 'Chulucanas', 'Morropon', 'Piura'),
(3432, '200402', 'Buenos Aires', 'Morropon', 'Piura'),
(3433, '200403', 'Chalaco', 'Morropon', 'Piura'),
(3434, '200404', 'La Matanza', 'Morropon', 'Piura'),
(3435, '200405', 'Morropon', 'Morropon', 'Piura'),
(3436, '200406', 'Salitral', 'Morropon', 'Piura'),
(3437, '200407', 'San Juan de Bigote', 'Morropon', 'Piura'),
(3438, '200408', 'Santa Catalina de Mossa', 'Morropon', 'Piura'),
(3439, '200409', 'Santo Domingo', 'Morropon', 'Piura'),
(3440, '200410', 'Yamango', 'Morropon', 'Piura'),
(3441, '200501', 'Paita', 'Paita', 'Piura'),
(3442, '200502', 'Amotape', 'Paita', 'Piura'),
(3443, '200503', 'Arenal', 'Paita', 'Piura'),
(3444, '200504', 'Colan', 'Paita', 'Piura'),
(3445, '200505', 'La Huaca', 'Paita', 'Piura'),
(3446, '200506', 'Tamarindo', 'Paita', 'Piura'),
(3447, '200507', 'Vichayal', 'Paita', 'Piura'),
(3448, '200601', 'Sullana', 'Sullana', 'Piura'),
(3449, '200602', 'Bellavista', 'Sullana', 'Piura'),
(3450, '200603', 'Ignacio Escudero', 'Sullana', 'Piura'),
(3451, '200604', 'Lancones', 'Sullana', 'Piura'),
(3452, '200605', 'Marcavelica', 'Sullana', 'Piura'),
(3453, '200606', 'Miguel Checa', 'Sullana', 'Piura'),
(3454, '200607', 'Querecotillo', 'Sullana', 'Piura'),
(3455, '200608', 'Salitral', 'Sullana', 'Piura'),
(3456, '200701', 'Pari?as', 'Talara', 'Piura'),
(3457, '200702', 'El Alto', 'Talara', 'Piura'),
(3458, '200703', 'La Brea', 'Talara', 'Piura'),
(3459, '200704', 'Lobitos', 'Talara', 'Piura'),
(3460, '200705', 'Los Organos', 'Talara', 'Piura'),
(3461, '200706', 'Mancora', 'Talara', 'Piura'),
(3462, '200801', 'Sechura', 'Sechura', 'Piura'),
(3463, '200802', 'Bellavista de La Union', 'Sechura', 'Piura'),
(3464, '200803', 'Bernal', 'Sechura', 'Piura'),
(3465, '200804', 'Cristo Nos Valga', 'Sechura', 'Piura'),
(3466, '200805', 'Vice', 'Sechura', 'Piura'),
(3467, '200806', 'Rinconada Llicuar', 'Sechura', 'Piura'),
(3468, '210101', 'Puno', 'Puno', 'Puno'),
(3469, '210102', 'Acora', 'Puno', 'Puno'),
(3470, '210103', 'Amantani', 'Puno', 'Puno'),
(3471, '210104', 'Atuncolla', 'Puno', 'Puno'),
(3472, '210105', 'Capachica', 'Puno', 'Puno'),
(3473, '210106', 'Chucuito', 'Puno', 'Puno'),
(3474, '210107', 'Coata', 'Puno', 'Puno'),
(3475, '210108', 'Huata', 'Puno', 'Puno'),
(3476, '210109', 'Ma?azo', 'Puno', 'Puno'),
(3477, '210110', 'Paucarcolla', 'Puno', 'Puno'),
(3478, '210111', 'Pichacani', 'Puno', 'Puno'),
(3479, '210112', 'Plateria', 'Puno', 'Puno'),
(3480, '210113', 'San Antonio', 'Puno', 'Puno'),
(3481, '210114', 'Tiquillaca', 'Puno', 'Puno'),
(3482, '210115', 'Vilque', 'Puno', 'Puno'),
(3483, '210201', 'Azangaro', 'Azangaro', 'Puno'),
(3484, '210202', 'Achaya', 'Azangaro', 'Puno'),
(3485, '210203', 'Arapa', 'Azangaro', 'Puno'),
(3486, '210204', 'Asillo', 'Azangaro', 'Puno'),
(3487, '210205', 'Caminaca', 'Azangaro', 'Puno'),
(3488, '210206', 'Chupa', 'Azangaro', 'Puno'),
(3489, '210207', 'Jose Domingo Choquehuanca', 'Azangaro', 'Puno'),
(3490, '210208', 'Mu?ani', 'Azangaro', 'Puno'),
(3491, '210209', 'Potoni', 'Azangaro', 'Puno'),
(3492, '210210', 'Saman', 'Azangaro', 'Puno'),
(3493, '210211', 'San Anton', 'Azangaro', 'Puno'),
(3494, '210212', 'San Jose', 'Azangaro', 'Puno'),
(3495, '210213', 'San Juan de Salinas', 'Azangaro', 'Puno'),
(3496, '210214', 'Santiago de Pupuja', 'Azangaro', 'Puno'),
(3497, '210215', 'Tirapata', 'Azangaro', 'Puno'),
(3498, '210301', 'Macusani', 'Carabaya', 'Puno'),
(3499, '210302', 'Ajoyani', 'Carabaya', 'Puno'),
(3500, '210303', 'Ayapata', 'Carabaya', 'Puno'),
(3501, '210304', 'Coasa', 'Carabaya', 'Puno'),
(3502, '210305', 'Corani', 'Carabaya', 'Puno'),
(3503, '210306', 'Crucero', 'Carabaya', 'Puno'),
(3504, '210307', 'Ituata', 'Carabaya', 'Puno'),
(3505, '210308', 'Ollachea', 'Carabaya', 'Puno'),
(3506, '210309', 'San Gaban', 'Carabaya', 'Puno'),
(3507, '210310', 'Usicayos', 'Carabaya', 'Puno'),
(3508, '210401', 'Juli', 'Chucuito', 'Puno'),
(3509, '210402', 'Desaguadero', 'Chucuito', 'Puno'),
(3510, '210403', 'Huacullani', 'Chucuito', 'Puno'),
(3511, '210404', 'Kelluyo', 'Chucuito', 'Puno'),
(3512, '210405', 'Pisacoma', 'Chucuito', 'Puno'),
(3513, '210406', 'Pomata', 'Chucuito', 'Puno'),
(3514, '210407', 'Zepita', 'Chucuito', 'Puno'),
(3515, '210501', 'Ilave', 'El Collao', 'Puno'),
(3516, '210502', 'Capazo', 'El Collao', 'Puno'),
(3517, '210503', 'Pilcuyo', 'El Collao', 'Puno'),
(3518, '210504', 'Santa Rosa', 'El Collao', 'Puno'),
(3519, '210505', 'Conduriri', 'El Collao', 'Puno'),
(3520, '210601', 'Huancane', 'Huancane', 'Puno'),
(3521, '210602', 'Cojata', 'Huancane', 'Puno'),
(3522, '210603', 'Huatasani', 'Huancane', 'Puno'),
(3523, '210604', 'Inchupalla', 'Huancane', 'Puno'),
(3524, '210605', 'Pusi', 'Huancane', 'Puno'),
(3525, '210606', 'Rosaspata', 'Huancane', 'Puno'),
(3526, '210607', 'Taraco', 'Huancane', 'Puno'),
(3527, '210608', 'Vilque Chico', 'Huancane', 'Puno'),
(3528, '210701', 'Lampa', 'Lampa', 'Puno'),
(3529, '210702', 'Cabanilla', 'Lampa', 'Puno'),
(3530, '210703', 'Calapuja', 'Lampa', 'Puno'),
(3531, '210704', 'Nicasio', 'Lampa', 'Puno'),
(3532, '210705', 'Ocuviri', 'Lampa', 'Puno'),
(3533, '210706', 'Palca', 'Lampa', 'Puno'),
(3534, '210707', 'Paratia', 'Lampa', 'Puno'),
(3535, '210708', 'Pucara', 'Lampa', 'Puno'),
(3536, '210709', 'Santa Lucia', 'Lampa', 'Puno'),
(3537, '210710', 'Vilavila', 'Lampa', 'Puno'),
(3538, '210801', 'Ayaviri', 'Melgar', 'Puno'),
(3539, '210802', 'Antauta', 'Melgar', 'Puno'),
(3540, '210803', 'Cupi', 'Melgar', 'Puno'),
(3541, '210804', 'Llalli', 'Melgar', 'Puno'),
(3542, '210805', 'Macari', 'Melgar', 'Puno'),
(3543, '210806', 'Nu?oa', 'Melgar', 'Puno'),
(3544, '210807', 'Orurillo', 'Melgar', 'Puno'),
(3545, '210808', 'Santa Rosa', 'Melgar', 'Puno'),
(3546, '210809', 'Umachiri', 'Melgar', 'Puno'),
(3547, '210901', 'Moho', 'Moho', 'Puno'),
(3548, '210902', 'Conima', 'Moho', 'Puno'),
(3549, '210903', 'Huayrapata', 'Moho', 'Puno'),
(3550, '210904', 'Tilali', 'Moho', 'Puno'),
(3551, '211001', 'Putina', 'San Antonio de Putin', 'Puno'),
(3552, '211002', 'Ananea', 'San Antonio de Putin', 'Puno'),
(3553, '211003', 'Pedro Vilca Apaza', 'San Antonio de Putin', 'Puno'),
(3554, '211004', 'Quilcapuncu', 'San Antonio de Putin', 'Puno'),
(3555, '211005', 'Sina', 'San Antonio de Putin', 'Puno'),
(3556, '211101', 'Juliaca', 'San Roman', 'Puno'),
(3557, '211102', 'Cabana', 'San Roman', 'Puno'),
(3558, '211103', 'Cabanillas', 'San Roman', 'Puno'),
(3559, '211104', 'Caracoto', 'San Roman', 'Puno'),
(3560, '211105', 'San Miguel', 'San Roman', 'Puno'),
(3561, '211201', 'Sandia', 'Sandia', 'Puno'),
(3562, '211202', 'Cuyocuyo', 'Sandia', 'Puno'),
(3563, '211203', 'Limbani', 'Sandia', 'Puno'),
(3564, '211204', 'Patambuco', 'Sandia', 'Puno'),
(3565, '211205', 'Phara', 'Sandia', 'Puno'),
(3566, '211206', 'Quiaca', 'Sandia', 'Puno'),
(3567, '211207', 'San Juan del Oro', 'Sandia', 'Puno'),
(3568, '211208', 'Yanahuaya', 'Sandia', 'Puno'),
(3569, '211209', 'Alto Inambari', 'Sandia', 'Puno'),
(3570, '211210', 'San Pedro de Putina Punco', 'Sandia', 'Puno'),
(3571, '211301', 'Yunguyo', 'Yunguyo', 'Puno'),
(3572, '211302', 'Anapia', 'Yunguyo', 'Puno'),
(3573, '211303', 'Copani', 'Yunguyo', 'Puno'),
(3574, '211304', 'Cuturapi', 'Yunguyo', 'Puno'),
(3575, '211305', 'Ollaraya', 'Yunguyo', 'Puno'),
(3576, '211306', 'Tinicachi', 'Yunguyo', 'Puno'),
(3577, '211307', 'Unicachi', 'Yunguyo', 'Puno'),
(3578, '220101', 'Moyobamba', 'Moyobamba', 'San Martin'),
(3579, '220102', 'Calzada', 'Moyobamba', 'San Martin'),
(3580, '220103', 'Habana', 'Moyobamba', 'San Martin'),
(3581, '220104', 'Jepelacio', 'Moyobamba', 'San Martin'),
(3582, '220105', 'Soritor', 'Moyobamba', 'San Martin'),
(3583, '220106', 'Yantalo', 'Moyobamba', 'San Martin'),
(3584, '220201', 'Bellavista', 'Bellavista', 'San Martin'),
(3585, '220202', 'Alto Biavo', 'Bellavista', 'San Martin'),
(3586, '220203', 'Bajo Biavo', 'Bellavista', 'San Martin'),
(3587, '220204', 'Huallaga', 'Bellavista', 'San Martin'),
(3588, '220205', 'San Pablo', 'Bellavista', 'San Martin'),
(3589, '220206', 'San Rafael', 'Bellavista', 'San Martin'),
(3590, '220301', 'San Jose de Sisa', 'El Dorado', 'San Martin'),
(3591, '220302', 'Agua Blanca', 'El Dorado', 'San Martin'),
(3592, '220303', 'San Martin', 'El Dorado', 'San Martin'),
(3593, '220304', 'Santa Rosa', 'El Dorado', 'San Martin'),
(3594, '220305', 'Shatoja', 'El Dorado', 'San Martin'),
(3595, '220401', 'Saposoa', 'Huallaga', 'San Martin'),
(3596, '220402', 'Alto Saposoa', 'Huallaga', 'San Martin'),
(3597, '220403', 'El Eslabon', 'Huallaga', 'San Martin'),
(3598, '220404', 'Piscoyacu', 'Huallaga', 'San Martin'),
(3599, '220405', 'Sacanche', 'Huallaga', 'San Martin'),
(3600, '220406', 'Tingo de Saposoa', 'Huallaga', 'San Martin'),
(3601, '220501', 'Lamas', 'Lamas', 'San Martin'),
(3602, '220502', 'Alonso de Alvarado', 'Lamas', 'San Martin'),
(3603, '220503', 'Barranquita', 'Lamas', 'San Martin'),
(3604, '220504', 'Caynarachi', 'Lamas', 'San Martin'),
(3605, '220505', 'Cu?umbuqui', 'Lamas', 'San Martin'),
(3606, '220506', 'Pinto Recodo', 'Lamas', 'San Martin'),
(3607, '220507', 'Rumisapa', 'Lamas', 'San Martin'),
(3608, '220508', 'San Roque de Cumbaza', 'Lamas', 'San Martin'),
(3609, '220509', 'Shanao', 'Lamas', 'San Martin'),
(3610, '220510', 'Tabalosos', 'Lamas', 'San Martin'),
(3611, '220511', 'Zapatero', 'Lamas', 'San Martin'),
(3612, '220601', 'Juanjui', 'Mariscal Caceres', 'San Martin'),
(3613, '220602', 'Campanilla', 'Mariscal Caceres', 'San Martin'),
(3614, '220603', 'Huicungo', 'Mariscal Caceres', 'San Martin'),
(3615, '220604', 'Pachiza', 'Mariscal Caceres', 'San Martin'),
(3616, '220605', 'Pajarillo', 'Mariscal Caceres', 'San Martin'),
(3617, '220701', 'Picota', 'Picota', 'San Martin'),
(3618, '220702', 'Buenos Aires', 'Picota', 'San Martin'),
(3619, '220703', 'Caspisapa', 'Picota', 'San Martin'),
(3620, '220704', 'Pilluana', 'Picota', 'San Martin'),
(3621, '220705', 'Pucacaca', 'Picota', 'San Martin'),
(3622, '220706', 'San Cristobal', 'Picota', 'San Martin'),
(3623, '220707', 'San Hilarion', 'Picota', 'San Martin'),
(3624, '220708', 'Shamboyacu', 'Picota', 'San Martin'),
(3625, '220709', 'Tingo de Ponasa', 'Picota', 'San Martin'),
(3626, '220710', 'Tres Unidos', 'Picota', 'San Martin'),
(3627, '220801', 'Rioja', 'Rioja', 'San Martin'),
(3628, '220802', 'Awajun', 'Rioja', 'San Martin'),
(3629, '220803', 'Elias Soplin Vargas', 'Rioja', 'San Martin'),
(3630, '220804', 'Nueva Cajamarca', 'Rioja', 'San Martin'),
(3631, '220805', 'Pardo Miguel', 'Rioja', 'San Martin'),
(3632, '220806', 'Posic', 'Rioja', 'San Martin'),
(3633, '220807', 'San Fernando', 'Rioja', 'San Martin'),
(3634, '220808', 'Yorongos', 'Rioja', 'San Martin'),
(3635, '220809', 'Yuracyacu', 'Rioja', 'San Martin'),
(3636, '220901', 'Tarapoto', 'San Martin', 'San Martin'),
(3637, '220902', 'Alberto Leveau', 'San Martin', 'San Martin'),
(3638, '220903', 'Cacatachi', 'San Martin', 'San Martin'),
(3639, '220904', 'Chazuta', 'San Martin', 'San Martin'),
(3640, '220905', 'Chipurana', 'San Martin', 'San Martin'),
(3641, '220906', 'El Porvenir', 'San Martin', 'San Martin'),
(3642, '220907', 'Huimbayoc', 'San Martin', 'San Martin'),
(3643, '220908', 'Juan Guerra', 'San Martin', 'San Martin'),
(3644, '220909', 'La Banda de Shilcayo', 'San Martin', 'San Martin'),
(3645, '220910', 'Morales', 'San Martin', 'San Martin'),
(3646, '220911', 'Papaplaya', 'San Martin', 'San Martin'),
(3647, '220912', 'San Antonio', 'San Martin', 'San Martin'),
(3648, '220913', 'Sauce', 'San Martin', 'San Martin'),
(3649, '220914', 'Shapaja', 'San Martin', 'San Martin'),
(3650, '221001', 'Tocache', 'Tocache', 'San Martin'),
(3651, '221002', 'Nuevo Progreso', 'Tocache', 'San Martin'),
(3652, '221003', 'Polvora', 'Tocache', 'San Martin'),
(3653, '221004', 'Shunte', 'Tocache', 'San Martin'),
(3654, '221005', 'Uchiza', 'Tocache', 'San Martin'),
(3655, '230101', 'Tacna', 'Tacna', 'Tacna'),
(3656, '230102', 'Alto de La Alianza', 'Tacna', 'Tacna'),
(3657, '230103', 'Calana', 'Tacna', 'Tacna'),
(3658, '230104', 'Ciudad Nueva', 'Tacna', 'Tacna'),
(3659, '230105', 'Inclan', 'Tacna', 'Tacna'),
(3660, '230106', 'Pachia', 'Tacna', 'Tacna'),
(3661, '230107', 'Palca', 'Tacna', 'Tacna'),
(3662, '230108', 'Pocollay', 'Tacna', 'Tacna'),
(3663, '230109', 'Sama', 'Tacna', 'Tacna'),
(3664, '230110', 'Coronel Gregorio Albarracin Lanchipa', 'Tacna', 'Tacna'),
(3665, '230111', 'La Yarada-Los Palos', 'Tacna', 'Tacna'),
(3666, '230201', 'Candarave', 'Candarave', 'Tacna'),
(3667, '230202', 'Cairani', 'Candarave', 'Tacna'),
(3668, '230203', 'Camilaca', 'Candarave', 'Tacna'),
(3669, '230204', 'Curibaya', 'Candarave', 'Tacna'),
(3670, '230205', 'Huanuara', 'Candarave', 'Tacna'),
(3671, '230206', 'Quilahuani', 'Candarave', 'Tacna'),
(3672, '230301', 'Locumba', 'Jorge Basadre', 'Tacna'),
(3673, '230302', 'Ilabaya', 'Jorge Basadre', 'Tacna'),
(3674, '230303', 'Ite', 'Jorge Basadre', 'Tacna'),
(3675, '230401', 'Tarata', 'Tarata', 'Tacna'),
(3676, '230402', 'Heroes Albarracin', 'Tarata', 'Tacna'),
(3677, '230403', 'Estique', 'Tarata', 'Tacna'),
(3678, '230404', 'Estique-Pampa', 'Tarata', 'Tacna'),
(3679, '230405', 'Sitajara', 'Tarata', 'Tacna'),
(3680, '230406', 'Susapaya', 'Tarata', 'Tacna'),
(3681, '230407', 'Tarucachi', 'Tarata', 'Tacna'),
(3682, '230408', 'Ticaco', 'Tarata', 'Tacna'),
(3683, '240101', 'Tumbes', 'Tumbes', 'Tumbes'),
(3684, '240102', 'Corrales', 'Tumbes', 'Tumbes'),
(3685, '240103', 'La Cruz', 'Tumbes', 'Tumbes'),
(3686, '240104', 'Pampas de Hospital', 'Tumbes', 'Tumbes'),
(3687, '240105', 'San Jacinto', 'Tumbes', 'Tumbes'),
(3688, '240106', 'San Juan de La Virgen', 'Tumbes', 'Tumbes'),
(3689, '240201', 'Zorritos', 'Contralmirante Villa', 'Tumbes'),
(3690, '240202', 'Casitas', 'Contralmirante Villa', 'Tumbes'),
(3691, '240203', 'Canoas de Punta Sal', 'Contralmirante Villa', 'Tumbes'),
(3692, '240301', 'Zarumilla', 'Zarumilla', 'Tumbes'),
(3693, '240302', 'Aguas Verdes', 'Zarumilla', 'Tumbes'),
(3694, '240303', 'Matapalo', 'Zarumilla', 'Tumbes'),
(3695, '240304', 'Papayal', 'Zarumilla', 'Tumbes'),
(3696, '250101', 'Calleria', 'Coronel Portillo', 'Ucayali'),
(3697, '250102', 'Campoverde', 'Coronel Portillo', 'Ucayali'),
(3698, '250103', 'Iparia', 'Coronel Portillo', 'Ucayali'),
(3699, '250104', 'Masisea', 'Coronel Portillo', 'Ucayali'),
(3700, '250105', 'Yarinacocha', 'Coronel Portillo', 'Ucayali'),
(3701, '250106', 'Nueva Requena', 'Coronel Portillo', 'Ucayali'),
(3702, '250107', 'Manantay', 'Coronel Portillo', 'Ucayali'),
(3703, '250201', 'Raymondi', 'Atalaya', 'Ucayali'),
(3704, '250202', 'Sepahua', 'Atalaya', 'Ucayali'),
(3705, '250203', 'Tahuania', 'Atalaya', 'Ucayali'),
(3706, '250204', 'Yurua', 'Atalaya', 'Ucayali'),
(3707, '250301', 'Padre Abad', 'Padre Abad', 'Ucayali'),
(3708, '250302', 'Irazola', 'Padre Abad', 'Ucayali'),
(3709, '250303', 'Curimana', 'Padre Abad', 'Ucayali'),
(3710, '250304', 'Neshuya', 'Padre Abad', 'Ucayali'),
(3711, '250305', 'Alexander von Humboldt', 'Padre Abad', 'Ucayali'),
(3712, '250401', 'Purus', 'Purus', 'Ucayali');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `idunidad_medida` int NOT NULL,
  `codigo_unidad` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `descr_unidad` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`idunidad_medida`, `codigo_unidad`, `descr_unidad`) VALUES
(1, 'BX', 'CAJA'),
(3, 'CY', 'CILINDRO'),
(4, 'KGM', 'KILOGRAMO'),
(7, 'MTR', 'METRO'),
(8, 'NIU', 'UNIDAD (BIENES)  '),
(9, 'ZZ', 'UNIDAD (SERVICIOS)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'TODODENUNO', 'RUC', '10775474888', '', '931742904', 'admin@GMAIL.COM', 'ADMINISTRADOR', 'TODOENUNO', '8ba0954591292fb3813412e4425ab2171db24e95436620e4a11eb6d3191a6891', '1701541971.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int NOT NULL,
  `idusuario` int NOT NULL,
  `idpermiso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(173, 1, 1),
(174, 1, 2),
(175, 1, 3),
(176, 1, 4),
(177, 1, 5),
(178, 1, 6),
(179, 1, 7),
(180, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int NOT NULL,
  `idcliente` int NOT NULL,
  `idtipo_documento` int DEFAULT NULL,
  `id_operacion` int DEFAULT NULL,
  `serie` varchar(7) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vemcimiento` date NOT NULL,
  `hora_emision` time NOT NULL,
  `id_forma_pago` int NOT NULL,
  `id_moneda` int NOT NULL,
  `total_gravada` decimal(11,2) NOT NULL,
  `total_igv` int NOT NULL,
  `total_gratuita` decimal(11,2) DEFAULT NULL,
  `total_exonerada` decimal(10,0) NOT NULL,
  `total_inafecta` int NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `nota` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `idusuario` int NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `nro_operacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idcliente`, `idtipo_documento`, `id_operacion`, `serie`, `numero`, `fecha_emision`, `fecha_vemcimiento`, `hora_emision`, `id_forma_pago`, `id_moneda`, `total_gravada`, `total_igv`, `total_gratuita`, `total_exonerada`, `total_inafecta`, `total_venta`, `nota`, `estado`, `idusuario`, `observaciones`, `nro_operacion`) VALUES
(29, 28, 20, 1, 'BE01', '00000000', '2023-12-02', '2023-12-02', '13:40:36', 2, 1, 146.61, 26, 0.00, 0, 0, 173.00, '', 'Aceptado', 1, '', ''),
(30, 29, 20, 1, 'BE01', '00000001', '2023-12-02', '2023-12-02', '13:58:08', 2, 1, 25.42, 5, 0.00, 0, 0, 30.00, '', 'Aceptado', 1, '', ''),
(31, 30, 20, 1, 'BE01', '00000002', '2023-12-02', '2023-12-02', '14:28:15', 2, 1, 25.42, 5, 0.00, 0, 0, 30.00, '', 'Aceptado', 1, '', ''),
(32, 30, 20, 1, 'BE01', '00000003', '2023-12-02', '2023-12-02', '14:59:03', 2, 1, 72.03, 13, 0.00, 0, 0, 85.00, '', 'Aceptado', 1, '', ''),
(34, 31, 19, 1, 'FE01', '00000001', '2023-12-02', '2023-12-02', '16:44:48', 2, 1, 116.95, 21, 0.00, 0, 0, 138.00, '', 'Aceptado', 1, '', ''),
(36, 30, 20, 1, 'BE01', '00000004', '2023-12-02', '2023-12-02', '16:50:25', 2, 1, 33.90, 6, 0.00, 0, 0, 40.00, '', 'Aceptado', 1, '', ''),
(37, 30, 20, 1, 'BE01', '00000005', '2023-12-02', '2023-12-02', '17:03:43', 2, 1, 243.22, 44, 0.00, 0, 0, 287.00, '', 'Aceptado', 1, '', ''),
(38, 30, 20, 1, 'BE01', '00000006', '2023-12-02', '2023-12-02', '17:18:41', 2, 1, 27.12, 5, 0.00, 0, 0, 32.00, '', 'Aceptado', 1, '', ''),
(39, 30, 20, 1, 'BE01', '00000007', '2023-12-02', '2023-12-02', '17:19:45', 2, 1, 14.41, 3, 0.00, 0, 0, 17.00, '', 'Aceptado', 1, '', ''),
(40, 30, 20, 1, 'BE01', '00000008', '2023-12-02', '2023-12-02', '17:23:57', 2, 1, 24.58, 4, 0.00, 0, 0, 29.00, '', 'Aceptado', 1, '', ''),
(41, 30, 20, 1, 'BE01', '00000009', '2023-12-02', '2023-12-02', '17:25:15', 2, 1, 16.10, 3, 0.00, 0, 0, 19.00, '', 'Aceptado', 1, '', ''),
(42, 30, 20, 1, 'BE01', '00000010', '2023-12-02', '2023-12-02', '17:48:35', 2, 1, 86.44, 16, 0.00, 0, 0, 102.00, '', 'Aceptado', 1, '', ''),
(43, 30, 20, 1, 'BE01', '00000011', '2023-12-02', '2023-12-02', '17:49:46', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(44, 30, 20, 1, 'BE01', '00000012', '2023-12-02', '2023-12-02', '17:51:23', 2, 1, 11.02, 2, 0.00, 0, 0, 13.00, '', 'Aceptado', 1, '', ''),
(46, 30, 20, 1, 'BE01', '00000014', '2023-12-02', '2023-12-02', '18:12:56', 2, 1, 34.75, 6, 0.00, 0, 0, 41.00, '', 'Aceptado', 1, '', ''),
(47, 30, 20, 1, 'BE01', '00000014', '2023-12-02', '2023-12-02', '18:39:48', 2, 1, 17.80, 3, 0.00, 0, 0, 21.00, '', 'Aceptado', 1, '', ''),
(48, 30, 20, 1, 'BE01', '00000015', '2023-12-02', '2023-12-02', '19:00:59', 2, 1, 7.63, 1, 0.00, 0, 0, 9.00, '', 'Aceptado', 1, '', ''),
(49, 30, 20, 1, 'BE01', '00000016', '2023-12-03', '2023-12-03', '18:33:07', 2, 1, 6.78, 1, 0.00, 0, 0, 8.00, '', 'Aceptado', 1, '', ''),
(50, 25, 20, 1, 'BE01', '00000017', '2023-12-03', '2023-12-03', '18:41:22', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(52, 30, 20, 1, 'BE01', '00000018', '2023-12-03', '2023-12-03', '18:47:41', 2, 1, 18.64, 3, 0.00, 0, 0, 22.00, '', 'Aceptado', 1, '', ''),
(53, 25, 20, 1, 'BE01', '00000019', '2023-12-03', '2023-12-03', '18:57:07', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(54, 29, 20, 1, 'BE01', '00000020', '2023-12-03', '2023-12-03', '21:41:13', 2, 1, 12.71, 2, 0.00, 0, 0, 15.00, '', 'Aceptado', 1, '', ''),
(55, 32, 20, 1, 'BE01', '00000021', '2023-12-03', '2023-12-03', '23:27:09', 2, 1, 25.42, 5, 0.00, 0, 0, 30.00, '', 'Aceptado', 1, '', ''),
(56, 32, 20, 1, 'BE01', '00000022', '2023-12-03', '2023-12-03', '23:32:54', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(57, 32, 20, 1, 'BE01', '00000023', '2023-12-03', '2023-12-03', '23:44:41', 2, 1, 81.36, 15, 0.00, 0, 0, 96.00, '', 'Aceptado', 1, '', ''),
(58, 30, 20, 1, 'BE01', '00000024', '2023-12-04', '2023-12-04', '12:02:28', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(59, 30, 20, 1, 'BE01', '00000025', '2023-12-04', '2023-12-04', '12:50:47', 2, 1, 11.02, 2, 0.00, 0, 0, 13.00, '', 'Aceptado', 1, '', ''),
(60, 25, 20, 1, 'BE01', '00000026', '2023-12-04', '2023-12-04', '14:35:39', 2, 1, 2.54, 0, 0.00, 0, 0, 3.00, '', 'Aceptado', 1, '', ''),
(62, 30, 20, 1, 'BE01', '00000027', '2023-12-04', '2023-12-04', '15:20:17', 2, 1, 2.54, 0, 0.00, 0, 0, 3.00, '', 'Aceptado', 1, '', ''),
(63, 30, 20, 1, 'BE01', '00000028', '2023-12-04', '2023-12-04', '20:54:43', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(64, 30, 20, 1, 'BE01', '00000029', '2023-12-05', '2023-12-05', '11:37:56', 5, 1, 22.03, 4, 0.00, 0, 0, 26.00, '', 'Aceptado', 1, '1O SOLES EN YAPE 16 EN EFECTIVO', '8784'),
(65, 31, 19, 1, 'FE01', '00000001', '2023-12-05', '2023-12-05', '11:54:31', 2, 1, 25.42, 5, 0.00, 0, 0, 30.00, '', 'Aceptado', 1, '', ''),
(66, 30, 20, 1, 'BE01', '00000030', '2023-12-05', '2023-12-05', '12:19:58', 2, 1, 5.93, 1, 0.00, 0, 0, 7.00, '', 'Anulado', 1, '', ''),
(67, 30, 20, 1, 'BE01', '00000031', '2023-12-05', '2023-12-05', '12:22:41', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(68, 30, 20, 1, 'BE01', '00000032', '2023-12-05', '2023-12-05', '12:23:51', 5, 1, 5.51, 1, 0.00, 0, 0, 6.50, '', 'Aceptado', 1, '', '1060'),
(69, 30, 20, 1, 'BE01', '00000033', '2023-12-05', '2023-12-05', '13:04:09', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(70, 30, 20, 1, 'BE01', '00000034', '2023-12-05', '2023-12-05', '13:08:36', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(71, 30, 20, 1, 'BE01', '00000035', '2023-12-05', '2023-12-05', '13:31:51', 2, 1, 29.66, 5, 0.00, 0, 0, 35.00, '', 'Aceptado', 1, '', ''),
(72, 30, 20, 1, 'BE01', '00000036', '2023-12-05', '2023-12-05', '14:07:56', 2, 1, 2.54, 0, 0.00, 0, 0, 3.00, '', 'Aceptado', 1, '', ''),
(73, 30, 20, 1, 'BE01', '00000037', '2023-12-05', '2023-12-05', '15:45:54', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(74, 30, 20, 1, 'BE01', '00000038', '2023-12-05', '2023-12-05', '15:55:06', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(75, 30, 20, 1, 'BE01', '00000039', '2023-12-05', '2023-12-05', '16:11:48', 5, 1, 14.41, 3, 0.00, 0, 0, 17.00, '', 'Aceptado', 1, '', '4564'),
(76, 30, 20, 1, 'BE01', '00000040', '2023-12-05', '2023-12-05', '16:26:12', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(77, 30, 20, 1, 'BE01', '00000041', '2023-12-05', '2023-12-05', '16:31:18', 5, 1, 71.19, 13, 0.00, 0, 0, 84.00, '', 'Aceptado', 1, '', '6079'),
(78, 30, 20, 1, 'BE01', '00000042', '2023-12-05', '2023-12-05', '16:35:06', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(79, 30, 20, 1, 'BE01', '00000043', '2023-12-05', '2023-12-05', '16:52:04', 5, 1, 117.80, 21, 0.00, 0, 0, 139.00, '', 'Aceptado', 1, '', '8675'),
(80, 30, 20, 1, 'BE01', '00000044', '2023-12-05', '2023-12-05', '16:52:37', 5, 1, 12.71, 2, 0.00, 0, 0, 15.00, '', 'Anulado', 1, '', ''),
(81, 30, 20, 1, 'BE01', '00000045', '2023-12-05', '2023-12-05', '16:53:42', 5, 1, 55.08, 10, 0.00, 0, 0, 65.00, '', 'Aceptado', 1, '', '9970'),
(82, 30, 20, 1, 'BE01', '00000046', '2023-12-05', '2023-12-05', '16:56:09', 5, 1, 35.59, 6, 0.00, 0, 0, 42.00, '', 'Aceptado', 1, '', '4353'),
(83, 30, 20, 1, 'BE01', '00000047', '2023-12-05', '2023-12-05', '16:56:42', 5, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', '8569'),
(84, 30, 20, 1, 'BE01', '00000048', '2023-12-05', '2023-12-05', '17:38:22', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(85, 30, 20, 1, 'BE01', '00000049', '2023-12-05', '2023-12-05', '17:45:59', 2, 1, 1.27, 0, 0.00, 0, 0, 1.50, '', 'Aceptado', 1, '', ''),
(86, 30, 20, 1, 'BE01', '00000050', '2023-12-05', '2023-12-05', '17:51:49', 5, 1, 33.90, 6, 0.00, 0, 0, 40.00, '', 'Aceptado', 1, '', '5fe7'),
(87, 30, 20, 1, 'BE01', '00000051', '2023-12-05', '2023-12-05', '18:37:32', 5, 1, 21.19, 4, 0.00, 0, 0, 25.00, '', 'Aceptado', 1, '', '0941'),
(88, 30, 20, 1, 'BE01', '00000052', '2023-12-05', '2023-12-05', '18:51:27', 2, 1, 3.39, 1, 0.00, 0, 0, 4.00, '', 'Aceptado', 1, '', ''),
(89, 30, 20, 1, 'BE01', '00000053', '2023-12-05', '2023-12-05', '19:10:31', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(90, 30, 20, 1, 'BE01', '00000054', '2023-12-05', '2023-12-05', '19:11:30', 5, 1, 37.29, 7, 0.00, 0, 0, 44.00, '', 'Aceptado', 1, '', '9030'),
(91, 30, 20, 1, 'BE01', '00000055', '2023-12-05', '2023-12-05', '19:19:11', 2, 1, 2.54, 0, 0.00, 0, 0, 3.00, '', 'Aceptado', 1, '', ''),
(92, 30, 20, 1, 'BE01', '00000056', '2023-12-05', '2023-12-05', '19:38:24', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(93, 30, 20, 1, 'BE01', '00000057', '2023-12-05', '2023-12-05', '21:01:24', 2, 1, 12.71, 2, 0.00, 0, 0, 15.00, '', 'Aceptado', 1, '', ''),
(94, 30, 20, 1, 'BE01', '00000058', '2023-12-05', '2023-12-05', '21:04:04', 2, 1, 1.27, 0, 0.00, 0, 0, 1.50, '', 'Aceptado', 1, '', ''),
(95, 30, 20, 1, 'BE01', '00000059', '2023-12-05', '2023-12-05', '21:15:05', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(97, 30, 20, 1, 'BE01', '00000060', '2023-12-05', '2023-12-05', '21:18:10', 2, 1, 1.27, 0, 0.00, 0, 0, 1.50, '', 'Aceptado', 1, '', ''),
(98, 30, 20, 1, 'BE01', '00000061', '2023-12-06', '2023-12-06', '13:09:16', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(99, 30, 20, 1, 'BE01', '00000062', '2023-12-06', '2023-12-06', '15:33:19', 2, 1, 3.81, 1, 0.00, 0, 0, 4.50, '', 'Aceptado', 1, '', ''),
(100, 30, 20, 1, 'BE01', '00000063', '2023-12-06', '2023-12-06', '15:43:49', 2, 1, 13.98, 3, 0.00, 0, 0, 16.50, '', 'Aceptado', 1, '', ''),
(101, 30, 20, 1, 'BE01', '00000064', '2023-12-06', '2023-12-06', '16:01:01', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(102, 30, 20, 1, 'BE01', '00000065', '2023-12-06', '2023-12-06', '16:09:16', 2, 1, 3.39, 1, 0.00, 0, 0, 4.00, '', 'Aceptado', 1, '', ''),
(104, 30, 20, 1, 'BE01', '00000066', '2023-12-06', '2023-12-06', '16:30:40', 2, 1, 2.54, 0, 0.00, 0, 0, 3.00, '', 'Aceptado', 1, '', ''),
(105, 30, 20, 1, 'BE01', '00000067', '2023-12-06', '2023-12-06', '17:08:40', 2, 1, 14.41, 3, 0.00, 0, 0, 17.00, '', 'Aceptado', 1, '', ''),
(106, 30, 20, 1, 'BE01', '00000068', '2023-12-06', '2023-12-06', '17:27:56', 2, 1, 11.02, 2, 0.00, 0, 0, 13.00, '', 'Aceptado', 1, '', ''),
(107, 30, 20, 1, 'BE01', '00000069', '2023-12-06', '2023-12-06', '17:35:46', 2, 1, 3.39, 1, 0.00, 0, 0, 4.00, '', 'Aceptado', 1, '', ''),
(108, 30, 20, 1, 'BE01', '00000070', '2023-12-06', '2023-12-06', '17:45:30', 2, 1, 12.71, 2, 0.00, 0, 0, 15.00, '', 'Aceptado', 1, '', ''),
(109, 30, 20, 1, 'BE01', '00000071', '2023-12-06', '2023-12-06', '18:53:25', 2, 1, 5.08, 1, 0.00, 0, 0, 6.00, '', 'Aceptado', 1, '', ''),
(110, 30, 20, 1, 'BE01', '00000072', '2023-12-06', '2023-12-06', '19:21:35', 2, 1, 3.81, 1, 0.00, 0, 0, 4.50, '', 'Aceptado', 1, '', ''),
(111, 30, 20, 1, 'BE01', '00000073', '2023-12-06', '2023-12-06', '19:32:53', 2, 1, 20.34, 4, 0.00, 0, 0, 24.00, '', 'Aceptado', 1, '', ''),
(112, 30, 20, 1, 'BE01', '00000074', '2023-12-06', '2023-12-06', '20:45:10', 5, 1, 302.12, 54, 0.00, 0, 0, 356.50, '', 'Aceptado', 1, '', ''),
(113, 30, 20, 1, 'BE01', '00000075', '2023-12-06', '2023-12-06', '21:19:19', 5, 1, 23.73, 4, 0.00, 0, 0, 28.00, '', 'Aceptado', 1, '', '5362'),
(114, 30, 20, 1, 'BE01', '00000076', '2023-12-07', '2023-12-07', '11:23:42', 5, 1, 73.73, 13, 0.00, 0, 0, 87.00, '', 'Aceptado', 1, '', '0095'),
(115, 30, 20, 1, 'BE01', '00000077', '2023-12-07', '2023-12-07', '13:10:25', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(116, 30, 20, 1, 'BE01', '00000078', '2023-12-07', '2023-12-07', '15:21:01', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(117, 33, 20, 1, 'BE01', '00000079', '2023-12-07', '2023-12-07', '16:01:02', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(118, 30, 20, 1, 'BE01', '00000080', '2023-12-07', '2023-12-07', '16:26:05', 2, 1, 14.41, 3, 0.00, 0, 0, 17.00, '', 'Aceptado', 1, '', ''),
(119, 30, 20, 1, 'BE01', '00000081', '2023-12-07', '2023-12-07', '18:03:06', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(120, 30, 20, 1, 'BE01', '00000082', '2023-12-07', '2023-12-07', '18:05:08', 5, 1, 25.42, 5, 0.00, 0, 0, 30.00, '', 'Aceptado', 1, '', '7300'),
(121, 30, 20, 1, 'BE01', '00000083', '2023-12-07', '2023-12-07', '18:08:06', 2, 1, 38.14, 7, 0.00, 0, 0, 45.00, '', 'Aceptado', 1, '', ''),
(122, 30, 20, 1, 'BE01', '00000084', '2023-12-07', '2023-12-07', '18:10:24', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(123, 30, 20, 1, 'BE01', '00000085', '2023-12-07', '2023-12-07', '18:11:49', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(124, 30, 20, 1, 'BE01', '00000086', '2023-12-07', '2023-12-07', '18:31:55', 2, 1, 8.47, 2, 0.00, 0, 0, 10.00, '', 'Aceptado', 1, '', ''),
(125, 30, 20, 1, 'BE01', '00000087', '2023-12-07', '2023-12-07', '20:23:58', 5, 1, 36.44, 7, 0.00, 0, 0, 43.00, '', 'Aceptado', 1, '', '8166'),
(126, 30, 20, 1, 'BE01', '00000088', '2023-12-07', '2023-12-07', '20:24:12', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(127, 30, 20, 1, 'BE01', '00000089', '2023-12-07', '2023-12-07', '20:40:32', 2, 1, 5.51, 1, 0.00, 0, 0, 6.50, '', 'Aceptado', 1, '', ''),
(128, 30, 20, 1, 'BE01', '00000090', '2023-12-08', '2023-12-08', '11:23:44', 2, 1, 4.24, 1, 0.00, 0, 0, 5.00, '', 'Aceptado', 1, '', ''),
(129, 30, 20, 1, 'BE01', '00000091', '2023-12-08', '2023-12-08', '15:31:30', 2, 1, 3.39, 1, 0.00, 0, 0, 4.00, '', 'Aceptado', 1, '', ''),
(130, 30, 20, 1, 'BE01', '00000092', '2023-12-08', '2023-12-08', '18:52:47', 2, 1, 21.19, 4, 0.00, 0, 0, 25.00, '', 'Aceptado', 1, '', ''),
(131, 30, 20, 1, 'BE01', '00000093', '2023-12-08', '2023-12-08', '19:05:51', 5, 1, 37.29, 7, 0.00, 0, 0, 44.00, '', 'Aceptado', 1, '', 'B2D4'),
(132, 30, 20, 1, 'BE01', '00000094', '2023-12-08', '2023-12-08', '19:22:17', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(133, 30, 20, 1, 'BE01', '00000095', '2023-12-09', '2023-12-09', '13:27:50', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(134, 30, 20, 1, 'BE01', '00000096', '2023-12-09', '2023-12-09', '14:01:36', 5, 1, 6.78, 1, 0.00, 0, 0, 8.00, '', 'Aceptado', 1, '', '3351'),
(135, 30, 20, 1, 'BE01', '00000097', '2023-12-09', '2023-12-09', '14:05:16', 2, 1, 5.08, 1, 0.00, 0, 0, 6.00, '', 'Aceptado', 1, '', ''),
(137, 30, 20, 1, 'BE01', '00000098', '2023-12-09', '2023-12-09', '14:15:14', 2, 1, 1.69, 0, 0.00, 0, 0, 2.00, '', 'Aceptado', 1, '', ''),
(139, 30, 20, 1, 'BE01', '00000099', '2023-12-09', '2023-12-09', '14:20:29', 2, 1, 16.95, 3, 0.00, 0, 0, 20.00, '', 'Aceptado', 1, '', ''),
(140, 30, 19, 1, 'FE01', '00000002', '2023-12-09', '2023-12-09', '14:26:40', 2, 1, 12.71, 2, 0.00, 0, 0, 15.00, '', 'Aceptado', 1, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`codigo_almacen`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `fk_articulo_categoria_idx` (`idcategoria`),
  ADD KEY `fk_articulo_marca` (`idmarca`),
  ADD KEY `fk_articulo_presentacion` (`idpresentacion`),
  ADD KEY `fk_articulo_unidad_medida` (`idunidad_medida`),
  ADD KEY `fk_articulo_almacen` (`codigo_almacen`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_venta_idx` (`idventa`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `forma_pagos`
--
ALTER TABLE `forma_pagos`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingreso_persona_idx` (`idproveedor`),
  ADD KEY `fk_ingreso_usuario_idx` (`idusuario`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`idpresentacion`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`),
  ADD KEY `fk_proveedor_tipo_doc` (`cod_tipo_doc`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`ID_SEDE`),
  ADD KEY `fk_sede_usuario` (`IDUSUARIO`),
  ADD KEY `fk_sede_almacen` (`CODIGO_ALMACEN`),
  ADD KEY `fk_sedes_ubigeo` (`id_ubigeo`);

--
-- Indices de la tabla `tipo_contribuyente`
--
ALTER TABLE `tipo_contribuyente`
  ADD PRIMARY KEY (`codigo_tipo_cont`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idtipo_documento`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idtipo_doc` (`idtipo_doc`);

--
-- Indices de la tabla `tipo_doc_contribuyente`
--
ALTER TABLE `tipo_doc_contribuyente`
  ADD PRIMARY KEY (`cod_tipo_doc`);

--
-- Indices de la tabla `tipo_operaciones`
--
ALTER TABLE `tipo_operaciones`
  ADD PRIMARY KEY (`id_operacion`);

--
-- Indices de la tabla `type_doc`
--
ALTER TABLE `type_doc`
  ADD PRIMARY KEY (`idtipo_doc`);

--
-- Indices de la tabla `ubigeo`
--
ALTER TABLE `ubigeo`
  ADD PRIMARY KEY (`id_ubigeo`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`idunidad_medida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_persona_idx` (`idcliente`),
  ADD KEY `fk_venta_usuario_idx` (`idusuario`),
  ADD KEY `fk_venta_operacion` (`id_operacion`),
  ADD KEY `fk_venta_moneda` (`id_moneda`),
  ADD KEY `fk_venta_formaPagos` (`id_forma_pago`),
  ADD KEY `fk_venta_tipodoc` (`idtipo_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `codigo_almacen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `forma_pagos`
--
ALTER TABLE `forma_pagos`
  MODIFY `id_forma_pago` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `idpresentacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `ID_SEDE` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idtipo_documento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tipo_operaciones`
--
ALTER TABLE `tipo_operaciones`
  MODIFY `id_operacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ubigeo`
--
ALTER TABLE `ubigeo`
  MODIFY `id_ubigeo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3713;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `idunidad_medida` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_almacen` FOREIGN KEY (`codigo_almacen`) REFERENCES `almacen` (`codigo_almacen`),
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `fk_articulo_marca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idMarca`),
  ADD CONSTRAINT `fk_articulo_presentacion` FOREIGN KEY (`idpresentacion`) REFERENCES `presentacion` (`idpresentacion`),
  ADD CONSTRAINT `fk_articulo_unidad_medida` FOREIGN KEY (`idunidad_medida`) REFERENCES `unidad_medida` (`idunidad_medida`);

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`),
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`),
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_prov` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `fk_ingreso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_tipo_doc` FOREIGN KEY (`cod_tipo_doc`) REFERENCES `tipo_doc_contribuyente` (`cod_tipo_doc`);

--
-- Filtros para la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `fk_sede_almacen` FOREIGN KEY (`CODIGO_ALMACEN`) REFERENCES `almacen` (`codigo_almacen`),
  ADD CONSTRAINT `fk_sede_usuario` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `fk_sedes_ubigeo` FOREIGN KEY (`id_ubigeo`) REFERENCES `ubigeo` (`id_ubigeo`);

--
-- Filtros para la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD CONSTRAINT `tipo_documento_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `tipo_documento_ibfk_2` FOREIGN KEY (`idtipo_doc`) REFERENCES `type_doc` (`idtipo_doc`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`),
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_formaPagos` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pagos` (`id_forma_pago`),
  ADD CONSTRAINT `fk_venta_moneda` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`),
  ADD CONSTRAINT `fk_venta_operacion` FOREIGN KEY (`id_operacion`) REFERENCES `tipo_operaciones` (`id_operacion`),
  ADD CONSTRAINT `fk_venta_persona` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `fk_venta_tipodoc` FOREIGN KEY (`idtipo_documento`) REFERENCES `tipo_documento` (`idtipo_documento`),
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
