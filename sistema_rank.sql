-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 17-02-2025 a las 21:24:32
-- Versión del servidor: 11.3.2-MariaDB
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_rank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actuaciones`
--

DROP TABLE IF EXISTS `actuaciones`;
CREATE TABLE IF NOT EXISTS `actuaciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_Evento` int(11) DEFAULT NULL,
  `codigo_Modalidad` int(11) DEFAULT NULL,
  `codigo_categoriaxPeso` int(11) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `id_deportista` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_Evento` (`codigo_Evento`),
  KEY `fk_codigo_Modalidad` (`codigo_Modalidad`),
  KEY `fk_codigo_categoriaxPeso` (`codigo_categoriaxPeso`),
  KEY `fk_id_depor` (`id_deportista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `id_deportista` bigint(20) DEFAULT NULL,
  `codigo_sesion` int(11) DEFAULT NULL,
  `codigo_estimulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_id_deportista` (`id_deportista`),
  KEY `fk_codigo_estimulo` (`codigo_estimulo`),
  KEY `fk_codigo_sesion` (`codigo_sesion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaxpeso`
--

DROP TABLE IF EXISTS `categoriaxpeso`;
CREATE TABLE IF NOT EXISTS `categoriaxpeso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaxPeso` int(11) NOT NULL,
  `id_ce` int(11) NOT NULL,
  `id_mod` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `categoriaxPeso` (`categoriaxPeso`),
  UNIQUE KEY `categoriaxPeso_2` (`categoriaxPeso`),
  UNIQUE KEY `categoriaxPeso_3` (`categoriaxPeso`),
  KEY `fk_id_ce` (`id_ce`),
  KEY `fk_id_mod` (`id_mod`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoriaxpeso`
--

INSERT INTO `categoriaxpeso` (`codigo`, `categoriaxPeso`, `id_ce`, `id_mod`) VALUES
(19, 60, 1, 1),
(20, 63, 1, 1),
(21, 67, 1, 1),
(22, 72, 1, 1),
(23, 77, 1, 1),
(24, 82, 1, 1),
(25, 87, 1, 1),
(26, 92, 1, 1),
(27, 97, 1, 1),
(28, 130, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_edad`
--

DROP TABLE IF EXISTS `categoria_edad`;
CREATE TABLE IF NOT EXISTS `categoria_edad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_Categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre_Categoria` (`nombre_Categoria`),
  UNIQUE KEY `nombre_Categoria_2` (`nombre_Categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria_edad`
--

INSERT INTO `categoria_edad` (`codigo`, `nombre_Categoria`) VALUES
(4, 'Cadetes'),
(5, 'Infantil A'),
(9, 'Infantil B'),
(3, 'Junior'),
(1, 'Mayores'),
(11, 'Mini Baby'),
(2, 'U23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(20) DEFAULT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_id_departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`codigo`, `ciudad`, `id_departamento`) VALUES
(10, 'Ibagué', 2),
(11, 'Espinal', 2),
(12, 'Venadillo', 2),
(13, 'Chaparral', 2),
(14, 'Venadillo', 2),
(15, 'Honda', 2),
(16, 'Alvarado', 2),
(17, 'Cajamarca', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clubes`
--

DROP TABLE IF EXISTS `clubes`;
CREATE TABLE IF NOT EXISTS `clubes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `id_representante` bigint(20) DEFAULT NULL,
  `fecha_conformacion` date DEFAULT NULL,
  `nombreClub` varchar(80) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombreClub` (`nombreClub`),
  KEY `fk_id_representante` (`id_representante`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clubes`
--

INSERT INTO `clubes` (`codigo`, `id_representante`, `fecha_conformacion`, `nombreClub`) VALUES
(1, 13, '2025-02-07', 'Fierce fighters ones'),
(3, 12, '2025-02-28', 'Los feroces del Wrestling'),
(4, 16, '2024-10-10', 'Luchadores de Hannibal Barca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `autor` varchar(80) NOT NULL,
  `fecha_hora` timestamp NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_autor` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `autor`, `fecha_hora`, `likes`) VALUES
(10, 'Buenas tardes, carlosgminer nuevamente en el chat del LTL', 'carlosgminer', '2025-02-08 23:54:07', 1),
(12, 'Nuevamente en el chat LTL wrestling...nueva prueba...', 'carlosgminer', '2025-02-09 17:07:16', 1),
(17, 'Buenos días compañeros del chal LTL wrestling...', 'carlosgminer', '2025-02-14 06:55:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dando_like`
--

DROP TABLE IF EXISTS `dando_like`;
CREATE TABLE IF NOT EXISTS `dando_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liker` varchar(80) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_comentario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_liker` (`liker`),
  KEY `fk_id_comentario` (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `dando_like`
--

INSERT INTO `dando_like` (`id`, `liker`, `fecha`, `hora`, `id_comentario`) VALUES
(12, 'nilsonh', '2025-02-16', '17:10:39', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `departamento` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departamento` (`departamento`),
  KEY `fk_id_pais` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `id_pais`, `departamento`) VALUES
(1, 1, 'Cundinamarca'),
(2, 1, 'Tolima'),
(3, 1, 'Valle del Cauca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista`
--

DROP TABLE IF EXISTS `deportista`;
CREATE TABLE IF NOT EXISTS `deportista` (
  `codigo_tipodoc` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `codigo_club` int(11) DEFAULT NULL,
  `codigo_genero` int(11) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `id` bigint(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `direccion` text DEFAULT 'Coliseo de deportes de Combate',
  `foto` varchar(255) DEFAULT NULL,
  `modalidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_codigo_club` (`codigo_club`),
  KEY `fk_codigo_tipodoc` (`codigo_tipodoc`),
  KEY `fk_codigo_genero` (`codigo_genero`),
  KEY `fk_pais` (`id_pais`),
  KEY `fk_dpto` (`id_departamento`),
  KEY `fk_ciudad` (`id_ciudad`),
  KEY `fk_id_modalidad` (`modalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deportista`
--

INSERT INTO `deportista` (`codigo_tipodoc`, `fecha_nacimiento`, `codigo_club`, `codigo_genero`, `nombres`, `apellidos`, `email`, `id`, `telefono`, `id_pais`, `id_departamento`, `id_ciudad`, `direccion`, `foto`, `modalidad`) VALUES
(6, '1997-03-17', 1, 2, 'Carlos Julio', 'García Torres', 'cajugato76@hotmail.com', 93399263, 3167994100, 1, 2, 10, 'Calle 147 No.16Sur-02. (Barrio Picaleña).', 'foto8.jpg', 1),
(6, '1985-10-17', 3, 2, 'Kaplox Tulio', 'Kaplox Tharxa', 'carlosgminer@gmail.com', 998887774, 32546879, 1, 2, 10, 'Calle 3a. No 20-33 /Barrio \"El Muladar\".', 'foto9.jpg', 1),
(7, '1995-05-17', 3, 2, 'Guillermin Indalecio', 'Le Conquer', 'GuillermoleConquer@hotmail.com', 999923666, 333458, 1, 2, 10, 'Barrio el Chamizal', 'foto2.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

DROP TABLE IF EXISTS `entrenadores`;
CREATE TABLE IF NOT EXISTS `entrenadores` (
  `nombres` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `id` bigint(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `codigo_genero` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `codigo_club` int(11) DEFAULT NULL,
  `codigo_tipodoc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  KEY `fk_id_gen` (`codigo_genero`),
  KEY `fk_cod_clubE` (`codigo_club`),
  KEY `fk_id_paisE` (`id_pais`),
  KEY `fk_id_dtoE` (`id_departamento`),
  KEY `fk_id_ciudadE` (`id_ciudad`),
  KEY `fk_cod_tipodocE` (`codigo_tipodoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`nombres`, `apellidos`, `id`, `email`, `fecha_nacimiento`, `codigo_genero`, `foto`, `telefono`, `direccion`, `id_pais`, `id_departamento`, `id_ciudad`, `codigo_club`, `codigo_tipodoc`) VALUES
('Wihelmina Agustina', 'Delgado Gordo', 62654789, 'wihelminadelgo62@hotmail.com', '1962-07-18', 1, 'foto13.jpg', 322145698, 'Barrio el Muladar', 1, 2, 13, 3, 6),
('Carlos Julio', 'García Torres', 93399263, 'cajugato76@hotmail.com', '2024-08-04', 2, 'foto16.jpg', 3167994100, 'Calle 147 No.16Sur-02. (Barrio Picaleña).', 1, 2, 10, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estimulos`
--

DROP TABLE IF EXISTS `estimulos`;
CREATE TABLE IF NOT EXISTS `estimulos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_estimulo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estimulos`
--

INSERT INTO `estimulos` (`codigo`, `tipo_estimulo`) VALUES
(1, 'actuación destacada'),
(2, 'actuación muy destacada'),
(3, 'actuación excepcional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_tipoE` int(11) DEFAULT NULL,
  `nombre_Evento` varchar(100) DEFAULT NULL,
  `fecha_Evento` date DEFAULT NULL,
  `codigo_ciudad` int(11) DEFAULT NULL,
  `codigo_categoriaxEdad` int(11) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre_Evento` (`nombre_Evento`),
  KEY `fk_codigo_tipoE` (`codigo_tipoE`),
  KEY `fk_codigo_ciudad` (`codigo_ciudad`),
  KEY `fk_codigo_categoriaxEdad` (`codigo_categoriaxEdad`),
  KEY `fk_id_paisEv` (`id_pais`),
  KEY `fk_id_dptoEv` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`codigo`, `codigo_tipoE`, `nombre_Evento`, `fecha_Evento`, `codigo_ciudad`, `codigo_categoriaxEdad`, `id_pais`, `id_departamento`) VALUES
(1, 9, 'XXVI Campeonato Nacional de Mayores -Ciudad de Ibagué-', '2025-02-03', 10, 1, 1, 2),
(4, 8, 'XXVI Canpeonato Departamental JUNIOR', '2024-06-12', 10, 3, 1, 2),
(5, 9, 'IX Canpeonato Nacional de U23', '2024-05-22', 10, 2, 1, 2),
(6, 7, 'IV Campeonato municipal -Ciudad de Venadillo-', '2025-01-29', 12, 2, 1, 2),
(7, 7, 'VI Campeonato departamental U23 -Cacique Calarcá-', '2025-02-26', 10, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`codigo`, `genero`) VALUES
(1, 'femenino'),
(2, 'maculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_entrenamiento`
--

DROP TABLE IF EXISTS `lugar_entrenamiento`;
CREATE TABLE IF NOT EXISTS `lugar_entrenamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lugar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `lugar_entrenamiento`
--

INSERT INTO `lugar_entrenamiento` (`id`, `lugar`) VALUES
(1, 'Coliseo de Combate- Ibagué'),
(2, 'Polideportivo-Venadillo'),
(3, 'Gimnasio de Lucha-Alvarado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

DROP TABLE IF EXISTS `modalidad`;
CREATE TABLE IF NOT EXISTS `modalidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modalidad` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modalidad` (`modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id`, `modalidad`) VALUES
(1, 'GRECORROMANA'),
(2, 'LIBRE'),
(3, 'LIBRE FEMENINO'),
(5, 'Lucha Playa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE IF NOT EXISTS `modalidades` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modalidad` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `modalidad` (`modalidad`),
  UNIQUE KEY `modalidad_2` (`modalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_de_perfil`
--

DROP TABLE IF EXISTS `opciones_de_perfil`;
CREATE TABLE IF NOT EXISTS `opciones_de_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` varchar(50) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `opciones_de_perfil`
--

INSERT INTO `opciones_de_perfil` (`id`, `valor`, `texto`, `id_perfil`) VALUES
(1, 'logout', 'Salir', 0),
(2, 'my_performance', 'My performances', 1),
(3, 'trainer_manage', 'Sesiones de Entrenamiento', 2),
(4, 'sport_manage', 'Deportistas y Entrenadores', 3),
(5, 'club_manage', 'Gestion de Clubes', 4),
(6, 'elements_manage', 'Gestor de Elementos', 3),
(7, 'event_manage', 'Competencias y Calendario', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pais` (`pais`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`) VALUES
(7, 'ARGENTINA'),
(5, 'BRASIL'),
(1, 'COLOMBIA'),
(3, 'ECUADOR'),
(4, 'ESTADOS UNIDOS'),
(8, 'MEXICO'),
(6, 'PERU'),
(2, 'VENEZUELA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `email` varchar(100) NOT NULL,
  `perfil` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`email`, `perfil`) VALUES
('cajugato76@hotmail.com', 10),
('carlosgminer@gmail.com', 11111),
('GuillermoleConquer@hotmail.com', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante_club`
--

DROP TABLE IF EXISTS `representante_club`;
CREATE TABLE IF NOT EXISTS `representante_club` (
  `nombres` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `codigo_tipodoc` int(11) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `num_docum` bigint(20) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefono` bigint(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_docum` (`num_docum`),
  UNIQUE KEY `num_docum_2` (`num_docum`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_codigo_tipodoc2` (`codigo_tipodoc`),
  KEY `fk_id_genero` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `representante_club`
--

INSERT INTO `representante_club` (`nombres`, `apellidos`, `email`, `codigo_tipodoc`, `genero`, `num_docum`, `id`, `telefono`, `foto`) VALUES
('Xiomara Andrea', 'Treviso Larota', 'xiomilarota@hotmail.com', 6, 1, 9999999999999, 12, 3167994100, 'foto4.jpg'),
('Fabricio Andre', 'Coloccini', 'fabricioU@hotmail.com', 9, 2, 987654, 13, 55554444444, 'foto6.jpg'),
('WILLINTONG CHAYANNE', 'Ocoro Arará', 'willlintongChayanneO@hotmail.com', 6, 2, 1107986762, 14, 3254668899, 'foto8.jpg'),
('Federico ', 'Barbarrosa', 'federicobarbarroja@gmail.com', 9, 2, 1579466310, 15, 318555444777, 'foto15.jpg'),
('Dionisio Estanislao', 'Nerón Navarrete', 'dionistaonavete@hotmail.com', 6, 2, 5434678908, 16, 3013356589, 'foto2.jpg'),
('Fulgencio Armando', 'Batista Perez', 'fulgenciobati@gmail.com', 6, 2, 1109885447, 29, 3167994100, 'foto9.jpg'),
('Emeterio ', 'Piraquive', 'emeeriopiraquive46@gmail.com', 6, 2, 2568974, 30, 569320000000, 'foto15.jpg'),
('nilson henan', 'Velasquez', 'nilsonh@hotmail.com', 6, 2, 93399263, 34, 3167994100, 'foto6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
CREATE TABLE IF NOT EXISTS `sesiones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `id_entrenador` bigint(20) DEFAULT NULL,
  `id_lugar` int(11) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_id_entrenador` (`id_entrenador`),
  KEY `fk_id_lugar` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_docum`
--

DROP TABLE IF EXISTS `tipo_docum`;
CREATE TABLE IF NOT EXISTS `tipo_docum` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_docum` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_docum`
--

INSERT INTO `tipo_docum` (`codigo`, `tipo_docum`) VALUES
(6, 'C.C.'),
(7, 'T.I.'),
(8, 'REG.C.'),
(9, 'CED.EXT.'),
(10, 'PASSAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

DROP TABLE IF EXISTS `tipo_evento`;
CREATE TABLE IF NOT EXISTS `tipo_evento` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_evento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`codigo`, `tipo_evento`) VALUES
(7, 'Campeonato Municipal'),
(8, 'Campeonato Departamental'),
(9, 'Campeonato Nacional'),
(10, 'Campeonato Internacional'),
(11, 'Copa Colombia'),
(12, 'Intercambio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `passw` varchar(100) NOT NULL,
  `id_perfil` int(11) DEFAULT 1,
  `mail_verified` tinyint(4) DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_id_perfil` (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `email`, `passw`, `id_perfil`, `mail_verified`, `token`) VALUES
('carlosgminer', 'carlosgminer@gmail.com', '$2y$10$Kxuvo/.H6n69zwBVYjBEpe751a3MbpUBDQrccBvFCEW311oxobXLW', 5, 1, 'IKElL9n695mCjDpjIvuq'),
('carlosju76', 'cajugato76@hotmail.com', '$2y$10$rlehUdRwlI2fTQXnaz68wOI2fPG.vJhIolyAX37S5OegQbw8A8LBK', 1, 1, 'n5bhbRnDPtVh3PkcoG5C'),
('ElgatoFelix', 'gatoFelix@gmail.com', '$2y$10$l78Vq1DCY.2BgExoL2PxIeOqmVWiA8fGXfTh8eeYdrNQAtTiWZwiC', 1, 0, 'mLeXETqzPzMBaH5EDzOZ'),
('nilsonh', 'nilsonh@hotmail.com', '$2y$10$p4m3f0VhWvC6W9HoQW9oD.4eFwROO7aSd/z6KZ4FIb6RctAskyDC2', 1, 1, 'HHntsiqjlFkO8TQdNp0M');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actuaciones`
--
ALTER TABLE `actuaciones`
  ADD CONSTRAINT `fk_codigo_Evento` FOREIGN KEY (`codigo_Evento`) REFERENCES `eventos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_Modalidad` FOREIGN KEY (`codigo_Modalidad`) REFERENCES `modalidades` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_categoriaxPeso` FOREIGN KEY (`codigo_categoriaxPeso`) REFERENCES `categoriaxpeso` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_depor` FOREIGN KEY (`id_deportista`) REFERENCES `deportista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_codigo_estimulo` FOREIGN KEY (`codigo_estimulo`) REFERENCES `estimulos` (`codigo`),
  ADD CONSTRAINT `fk_codigo_sesion` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_deportista` FOREIGN KEY (`id_deportista`) REFERENCES `deportista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoriaxpeso`
--
ALTER TABLE `categoriaxpeso`
  ADD CONSTRAINT `fk_id_ce` FOREIGN KEY (`id_ce`) REFERENCES `categoria_edad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_mod` FOREIGN KEY (`id_mod`) REFERENCES `modalidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_sutor` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dando_like`
--
ALTER TABLE `dando_like`
  ADD CONSTRAINT `fk_id_comentario` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_liker` FOREIGN KEY (`liker`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_id_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deportista`
--
ALTER TABLE `deportista`
  ADD CONSTRAINT `fk_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_genero` FOREIGN KEY (`codigo_genero`) REFERENCES `genero` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_tipodoc` FOREIGN KEY (`codigo_tipodoc`) REFERENCES `tipo_docum` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dpto` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_modalidad` FOREIGN KEY (`modalidad`) REFERENCES `modalidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD CONSTRAINT `fk_cod_clubE` FOREIGN KEY (`codigo_club`) REFERENCES `clubes` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cod_tipodocE` FOREIGN KEY (`codigo_tipodoc`) REFERENCES `tipo_docum` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_ciudadE` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_dtoE` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_gen` FOREIGN KEY (`codigo_genero`) REFERENCES `genero` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_paisE` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_codigo_categoriaxEdad` FOREIGN KEY (`codigo_categoriaxEdad`) REFERENCES `categoria_edad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_ciudad` FOREIGN KEY (`codigo_ciudad`) REFERENCES `ciudad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_tipoE` FOREIGN KEY (`codigo_tipoE`) REFERENCES `tipo_evento` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_dptoEv` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_paisEv` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `representante_club`
--
ALTER TABLE `representante_club`
  ADD CONSTRAINT `fk_codigo_tipodoc2` FOREIGN KEY (`codigo_tipodoc`) REFERENCES `tipo_docum` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_genero` FOREIGN KEY (`genero`) REFERENCES `genero` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `fk_id_entrenador` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugar_entrenamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
