-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2023 a las 23:44:45
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `h_inicio` datetime NOT NULL,
  `h_fin` datetime NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `nombre`, `h_inicio`, `h_fin`, `id_docente`) VALUES
(2, 'fisica', '2023-06-12 16:31:00', '2023-06-12 17:32:00', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `previo_1` float DEFAULT NULL,
  `previo_2` float DEFAULT NULL,
  `nota_3` float DEFAULT NULL,
  `examen` float DEFAULT NULL,
  `id_materia` int(20) NOT NULL,
  `id_estudiante` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id`, `previo_1`, `previo_2`, `nota_3`, `examen`, `id_materia`, `id_estudiante`) VALUES
(9, 1, 3, 2, 3, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `rol` enum('coordinador','docente','estudiante') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `documento`, `nombre`, `apellido`, `correo`, `clave`, `rol`) VALUES
(2, '123', 'daniel', 'velandia', 'velandiad02@gmail.com', '$2y$10$0oOlsVsD51J7k2nPfiNRCuEJRegozarwjCxTbG6RIaccNroPQtppm', 'estudiante'),
(10, '123123', 'thekosky', 'gonzalez', 'kosky@gmail.com', '$2y$10$hGbhCtwXlFwMB2cJpkTlduTa92fZkrsbjLIDZRoA5jfueufOQcrxK', 'docente'),
(12, '1234567890', 'coordi', 'coordi', 'coordi@gmail.com', '$2y$10$Qp1il94fwesJNaMDc/WArugm8KPo0Xd12wQtcjvFTlR9AjrZwmLl.', 'coordinador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
