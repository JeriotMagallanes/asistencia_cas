-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-04-2023 a las 21:25:00
-- Versión del servidor: 8.0.30-0ubuntu0.20.04.2
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_asicas`
--

CREATE TABLE `usuarios_asicas` (
  `id_usu` int NOT NULL,
  `ape_pat` varchar(50)  DEFAULT NULL,
  `ape_mat` varchar(50)  DEFAULT NULL,
  `nom_usu` varchar(100)  DEFAULT NULL,
  `cor_per` varchar(100) CHARACTER SET utf8mb4  DEFAULT NULL COMMENT 'Correo Personal',
  `cor_inst` varchar(100)  NOT NULL COMMENT 'Correo Institucional',
  `estado` char(1)  NOT NULL DEFAULT 'A' COMMENT 'A:activo,I:inactivo',
  `rol` char(1)  NOT NULL DEFAULT 'A' COMMENT 'A:administrador'
);

--
-- Volcado de datos para la tabla `usuarios_asicas`
--

INSERT INTO `usuarios_asicas` (`id_usu`, `ape_pat`, `ape_mat`, `nom_usu`, `cor_per`, `cor_inst`, `estado`, `rol`) VALUES

(12, 'UURR', 'UURR', 'UURR', '', 'urecursoshumanos@undc.edu.pe', 'A', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios_asicas`
--
ALTER TABLE `usuarios_asicas`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios_asicas`
--
ALTER TABLE `usuarios_asicas`
  MODIFY `id_usu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
