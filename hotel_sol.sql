-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2020 at 10:17 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

-- Este archivo contiene la estructura completa de nuestra base de datos.
-- Este archivo se importa en la base de datos creada por el usuario y crea las tablas necesarias para que el sistema funcione.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_sol`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(156) NOT NULL,
  `cargo` varchar(256) NOT NULL,
  `documento` varchar(156) NOT NULL,
  `legajo` int(11) NOT NULL,
  `inicio_jornada` time NOT NULL,
  `final_jornada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` smallint(6) NOT NULL,
  `numero` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `habitaciones_temporadas`
--

CREATE TABLE `habitaciones_temporadas` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `periodo_st` date NOT NULL,
  `periodo_en` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `habitaciones_tipos`
--

CREATE TABLE `habitaciones_tipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasajeros`
--

CREATE TABLE `pasajeros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(156) NOT NULL,
  `apellido` varchar(156) NOT NULL,
  `edad` tinyint(3) UNSIGNED NOT NULL,
  `telefono` varchar(156) NOT NULL,
  `tipo_documento` varchar(24) NOT NULL,
  `documento` varchar(156) NOT NULL,
  `calle` varchar(156) NOT NULL,
  `piso` tinyint(4) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `barrio` varchar(156) DEFAULT NULL,
  `ciudad` varchar(156) NOT NULL,
  `pais` varchar(156) NOT NULL,
  `email` varchar(156) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` smallint(6) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 = Sin pagar\r\n1 = Confirmada',
  `cliente` tinyint(4) NOT NULL COMMENT 'ID del pasajero que realizó la reserva.',
  `entrada` timestamp NULL DEFAULT NULL,
  `salida` timestamp NULL DEFAULT NULL,
  `habitacion` varchar(126) NOT NULL COMMENT 'ID de la Habitación (o habitaciones) que pertenecen a esta reserva.',
  `pasajeros` int(11) NOT NULL COMMENT 'IDs de los pasajeros que están dentro de la reserva.',
  `pension` varchar(126) NOT NULL,
  `costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `habitaciones_temporadas`
--
ALTER TABLE `habitaciones_temporadas`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `habitaciones_tipos`
--
ALTER TABLE `habitaciones_tipos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pasajeros`
--
ALTER TABLE `pasajeros`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habitaciones_temporadas`
--
ALTER TABLE `habitaciones_temporadas`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habitaciones_tipos`
--
ALTER TABLE `habitaciones_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasajeros`
--
ALTER TABLE `pasajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
