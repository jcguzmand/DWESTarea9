-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-01-2022 a las 11:17:16
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18335293_libro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

USE id18335293_libro;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nacionalidad` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id`, `nombre`, `apellidos`, `nacionalidad`) VALUES
(0, 'J.R.R.', 'Tolkien', 'Inglaterra'),
(1, 'Isaac', 'Asimov', 'Rusia'),
(3, 'Stephen', 'King', 'EEUU'),
(4, 'Julio', 'Verne', 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `f_publicacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `f_publicacion`, `id_autor`) VALUES
(0, 'El Hobbit', '21/09/1937', 0),
(1, 'La Comunidad del Anillo', '29/07/1954', 0),
(2, 'Las dos torres', '11/11/1954', 0),
(3, 'El retorno del Rey', '20/10/1955', 0),
(4, 'Un guijarro en el cielo', '19/01/1950', 1),
(5, 'Fundación', '01/06/1951', 1),
(6, 'Yo, robot', '02/12/1950', 1),
(8, 'Carrie', '05/04/1974', 3),
(9, 'El resplandor', '28/01/1977', 3),
(10, 'Misery', '08/06/1987', 3),
(11, 'It', '15/09/1988', 3),
(12, 'La milla verde', '02/08/1996', 3),
(13, 'Viaje al centro de la Tierra', '12/08/1864', 4),
(14, 'La vuelta al mundo en ochenta días', '10/05/1872', 4),
(15, 'Veinte mil leguas de viaje submarino', '20/03/1869', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Libro_FK` (`id_autor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `Libro_FK` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
