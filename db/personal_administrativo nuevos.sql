-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-04-2023 a las 21:22:25
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
-- Estructura de tabla para la tabla `personal_administrativo`
--

CREATE TABLE `personal_administrativo2` (
  `id_personal` int NOT NULL,
  `apaterno` varchar(50) DEFAULT NULL COMMENT 'Apellido paterno',
  `amaterno` varchar(50) DEFAULT NULL COMMENT 'Apellido materno',
  `nombres` varchar(80) DEFAULT NULL COMMENT 'Nombres completos del personal',
  `dni_pa` varchar(10) DEFAULT NULL COMMENT 'Dni del personal',
  `cel_pa` int DEFAULT NULL COMMENT 'Celular del personal',
  `cor_inst` varchar(30) DEFAULT NULL COMMENT 'Correo Institucional del personal',
  `cor_per` varchar(50) DEFAULT NULL COMMENT 'Correo de uso personal',
  `puesto` varchar(200) DEFAULT NULL,
  `dependencia` varchar(300) DEFAULT NULL,
  `estado` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A:activo,I:inactivo'
);

--
-- Volcado de datos para la tabla `personal_administrativo`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personal_administrativo`
--
ALTER TABLE `personal_administrativo_nuevos`
  ADD PRIMARY KEY (`id_personal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personal_administrativo`
--
ALTER TABLE `personal_administrativo`
  MODIFY `id_personal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
