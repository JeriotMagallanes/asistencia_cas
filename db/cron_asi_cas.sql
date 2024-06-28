-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-04-2023 a las 21:24:11
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
-- Estructura de tabla para la tabla `cron_asi_cas`
--

CREATE TABLE `cron_asi_cas` (
  `id_cron` int NOT NULL,
  `local_undc` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip_public` varchar(50) DEFAULT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cron_asi_cas`
--
ALTER TABLE `cron_asi_cas`
  ADD PRIMARY KEY (`id_cron`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cron_asi_cas`
--
ALTER TABLE `cron_asi_cas`
  MODIFY `id_cron` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475793;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
