-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2022 a las 18:54:02
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carousel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`id`, `title`, `folder`, `src`, `created_at`) VALUES
(50, '', 'uploads/', '01_Basurero_1920x1080-01.jpg', '2022-05-10 12:48:38'),
(51, '', 'uploads/', '02_Distanciamiento_FiYsico_1920x1080-01.jpg', '2022-05-10 12:48:43'),
(52, '', 'uploads/', '03_Lavate_las_manos_1920x1080-01.jpg', '2022-05-10 12:48:49'),
(53, '', 'uploads/', '04_Mascarilla_1920_X1080_-_copia.jpg', '2022-05-10 12:48:57'),
(54, '', 'uploads/', '05_thumbnail_transf_mi_cash_COY_pta_a_1920x1080.jpg', '2022-05-10 12:49:03'),
(55, '', 'uploads/', '06_pasos_pasos_dreams_1920x1080.jpg', '2022-05-10 12:49:09'),
(56, '', 'uploads/', '19_AlmuerzosEjecutivos-TV-Horizontal.jpg', '2022-05-10 12:49:15'),
(57, '', 'uploads/', '25_mutual_1920x1080_mutual.jpg', '2022-05-10 12:49:20'),
(58, '', 'uploads/', '26_mutual_1920x1080_SGS.jpg', '2022-05-10 12:49:27'),
(59, '', 'uploads/', '27_Prohibido_Pararse_detras_1920x1080-01.jpg', '2022-05-10 12:49:34'),
(60, '', 'uploads/', '28_Senaletica_TV_hor_1920x1089.jpg', '2022-05-10 12:49:40'),
(61, '', 'uploads/', '29_Recomendaciones_de_autocuidado_1080x1920.jpg', '2022-05-10 12:49:52'),
(62, '', 'uploads/', '1920x1080.jpg', '2022-05-10 12:49:59'),
(63, '', 'uploads/', '1920x1080-COY.jpg', '2022-05-10 12:50:06'),
(64, '', 'uploads/', '1920x1080-mesas-recargadas-dreams.jpg', '2022-05-10 12:50:12'),
(65, '', 'uploads/', '1920x1080-mg-ZS-v2-coy.jpg', '2022-05-10 12:50:18'),
(66, '', 'uploads/', '1920x1080-platinumpass.jpg', '2022-05-10 12:50:26'),
(68, '', 'uploads/', '1920x1080-tu-posicion-ganadoraDREAMS.jpg', '2022-05-10 12:50:44'),
(69, '', 'uploads/', 'AlmuerzosPatagonicos-TV-Horizontal.jpg', '2022-05-10 12:51:05'),
(70, '', 'uploads/', 'campanYa-dreams-club--1920x1080-d.jpg', '2022-05-10 12:51:12'),
(71, '', 'uploads/', 'CONSUMO-DE-ALIMENTOS-1920x1080-dreams.jpg', '2022-05-10 12:51:23'),
(72, '', 'uploads/', 'DREAMS-weekend-music--2022-1920X1080.jpg', '2022-05-10 12:51:30'),
(73, '', 'uploads/', 'Juega-y-Gira-1920x1080-COY.jpg', '2022-05-10 12:51:40'),
(74, '', 'uploads/', 'liquidaciones-1920x1080-coy.jpg', '2022-05-10 12:51:48'),
(75, '', 'uploads/', 'martes-vip-1920X1080-COY.jpg', '2022-05-10 12:51:55'),
(76, '', 'uploads/', 'ok_Entrada_Gratis_AM_horizontal.jpg', '2022-05-10 12:52:03'),
(77, '', 'uploads/', 'Poker-Progresivo-COY-1920x1080.jpg', '2022-05-10 12:52:11'),
(78, '', 'uploads/', 'TOCA-EXPLOTA-1920x1080-COY.jpg', '2022-05-10 12:52:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
