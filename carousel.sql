-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-07-2024 a las 16:41:58
-- Versión del servidor: 8.0.36-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3-4ubuntu2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Estructura de tabla para la tabla `casino`
--

CREATE TABLE `casino` (
  `id` int NOT NULL,
  `casino` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casino`
--

INSERT INTO `casino` (`id`, `casino`) VALUES
(1, 'Iquique'),
(2, 'Coyhaique'),
(3, 'Monticello'),
(8, 'punta arenas'),
(9, 'Puerto Varas'),
(10, 'Valdivia'),
(12, 'Temuco'),
(13, 'Talca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `casino_id` int DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`id`, `casino_id`, `folder`, `src`, `created_at`, `fecha`) VALUES
(288, 2, 'uploads/', 'img_fc974344612e1e6199327781ca20887a.jpg', '2024-07-15 16:26:27', '1969-12-31'),
(289, 2, 'uploads/', 'img_619c74d88773f1a2eea9cc21ac6a0c59.jpg', '2024-07-15 16:26:27', '1969-12-31'),
(290, 2, 'uploads/', 'img_bfe97f4caac8acc12d70be651ac1da13.jpg', '2024-07-15 16:26:29', '1969-12-31'),
(291, 2, 'uploads/', 'img_3d19e45eea7349f3f71c5656dd84c21c.jpg', '2024-07-15 16:26:30', '1969-12-31'),
(292, 2, 'uploads/', 'img_973af23b66714601d33cc96840ef5f60.png', '2024-07-15 16:26:31', '1969-12-31'),
(293, 2, 'uploads/', 'img_f2302aa844ccd27af3223f11aa8e8bac.png', '2024-07-15 16:26:32', '1969-12-31'),
(294, 2, 'uploads/', 'img_9d6311bed28c8c96d8358cdd553ed0d4.jpg', '2024-07-15 16:26:32', '1969-12-31'),
(295, 2, 'uploads/', 'img_d0592f54575e2706194546f33036cb6f.png', '2024-07-15 16:26:33', '1969-12-31'),
(296, 2, 'uploads/', 'img_6c4d8117b0c72e975bb6b091ee8d2bab.jpg', '2024-07-15 16:26:33', '1969-12-31'),
(297, 2, 'uploads/', 'img_791f1148a1daf4cca0e64868d583d37a.jpg', '2024-07-15 16:26:33', '1969-12-31'),
(298, 2, 'uploads/', 'img_8c1007e8a6893f4078250251df1facad.jpeg', '2024-07-15 16:26:33', '1969-12-31'),
(300, 2, 'uploads/', 'img_9a342f3728eae57717faf7e882038902.jpg', '2024-07-15 16:26:34', '1969-12-31'),
(301, 2, 'uploads/', 'img_acd214843a10b8d5a66ef4046bc873d3.jpg', '2024-07-15 16:26:35', '1969-12-31'),
(302, 2, 'uploads/', 'img_a6d389adb1ff0e339320efee87f88695.jpg', '2024-07-15 16:26:35', '1969-12-31'),
(303, 2, 'uploads/', 'img_4d5853e0636d775fc1a3ba11784c2a89.jpg', '2024-07-15 16:26:35', '1969-12-31'),
(304, 2, 'uploads/', 'img_09d2698298c097f26ff88f0f924a84a8.jpg', '2024-07-15 16:26:36', '1969-12-31'),
(305, 2, 'uploads/', 'img_cc10ce6873688db4d29a1032404dee8b.jpg', '2024-07-15 16:26:36', '1969-12-31'),
(306, 2, 'uploads/', 'img_90a0924c44bbec40992b9fc1008ab63c.jpg', '2024-07-15 16:26:36', '1969-12-31'),
(307, 2, 'uploads/', 'img_5454d4bb89c8d0b65eb23133196bcaf3.jpg', '2024-07-15 16:26:37', '1969-12-31'),
(308, 2, 'uploads/', 'img_b1b3a6174b591021e4517ba834602890.jpg', '2024-07-15 16:26:37', '1969-12-31'),
(309, 2, 'uploads/', 'img_3f66c44e1f9c161c0080311f2a23c7dd.jpg', '2024-07-15 16:26:38', '1969-12-31'),
(310, 2, 'uploads/', 'img_0572ded73aaa973435bf722a330234ca.jpg', '2024-07-15 16:26:38', '1969-12-31'),
(311, 2, 'uploads/', 'img_b47b0eadbfca500fa1a5d84b53b12ba9.jpg', '2024-07-15 16:26:38', '1969-12-31'),
(312, 2, 'uploads/', 'img_4d28c58096469e2aa8a37fdcae2fdd70.jpg', '2024-07-15 16:26:38', '1969-12-31'),
(313, 1, 'uploads/', 'img_3827431e1c108c1eb746ef94b7651610.jpg', '2024-07-15 16:45:44', '1969-12-31'),
(316, 1, 'uploads/', 'img_d85e11caef86f11944f6c8183246ff94.jpg', '2024-07-15 16:45:45', '1969-12-31'),
(318, 1, 'uploads/', 'img_5894d4386e21c1daed763f2b4b91bfe5.jpg', '2024-07-15 16:45:45', '1969-12-31'),
(320, 1, 'uploads/', 'img_e5ced572493fc320c65c255b7deced6b.jpg', '2024-07-15 16:45:45', '1969-12-31'),
(336, 1, 'uploads/', 'img_a3b60c6df00b205c80aee735501ff1fc.jpg', '2024-07-17 17:50:33', '1969-12-31'),
(337, 1, 'uploads/', 'img_4550ff63b27b77085b427b5dc1d351ea.jpg', '2024-07-17 17:50:33', '1969-12-31'),
(345, 3, 'uploads/', 'img_6d27b5826b87d6cfc77677f37469079f.jpg', '2024-07-17 18:00:43', '1969-12-31'),
(346, 3, 'uploads/', 'img_afd1428482e46fad0d5f4954761a7e7f.jpg', '2024-07-17 18:00:43', '1969-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) DEFAULT 'user',
  `casino_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `role`, `casino_id`) VALUES
(1, 'Hlaurel', '$2y$10$DKrwyE6Uz3fBEje.bqd98.ySupbEQa8mtafDSfEDjRKenTkh3e/R2', '2023-11-28 17:57:51', 'user', 2),
(4, 'admin', '$2y$10$rDNGlODPz0dh4rxR/0K0YujVemjyMb4ddgzZ5SiQ9oN8IRzBM3DNW', '2023-11-30 15:06:33', 'admin', 0),
(18, 'Coyhaique', '$2y$10$29k6ozs9daYVOawr2yVkl.9WS04.GFDTQvM5ADWPufZC5VPWLL/2C', '2023-12-12 23:07:41', 'user', 2),
(21, 'ajeldres', '$2y$10$uci9P9OBkHeVkmUU78tMi.FDqGV9L6YJ.o165y2sCtjMMxb3SuElC', '2024-03-24 17:06:19', 'prev', 2),
(23, 'ccardenasi', '$2y$10$5aXwkN4hB.uIneTN5NVEmesNhIpbYmyoo/s2f9wzUM7A5skFJahvS', '2024-06-12 09:55:34', 'user', 2),
(24, 'cosoto', '$2y$10$RXyvUlqIg43RctqAMkwjhO4sakcudQ1qL87BrPY6arPoKvcTzU.eO', '2024-06-19 16:39:41', 'user', 2),
(25, '654321', '$2y$10$FldoibLdLV2icsMIiKJtUeaKUmFO.14YK4QY2VlRgylAJS7JQeXnW', '2024-07-15 16:43:58', 'user', 1),
(26, 'monticello', '$2y$10$etiBvQ5qu6M7Rl6nk.o7Yu/OAMFbfDRIk5QdYlMq4wc1/wxKZgCtC', '2024-07-17 18:00:18', 'user', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `folder` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `src` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `casino_id` int DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`id`, `created_at`, `folder`, `src`, `casino_id`, `fecha`) VALUES
(56, '2024-07-17 17:01:39', 'uploads/', 'vid_66983132b345a.mp4', 1, '2024-07-18'),
(57, '2024-07-17 18:07:06', 'uploads/', 'vid_66984089e7fcb.mp4', 3, '1969-12-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casino`
--
ALTER TABLE `casino`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `casino_id` (`casino_id`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casino`
--
ALTER TABLE `casino`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
