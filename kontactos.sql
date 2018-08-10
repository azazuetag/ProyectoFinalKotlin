-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2018 a las 19:28:52
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kontactos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `Correo` varchar(128) NOT NULL,
  `idContacto` int(11) NOT NULL,
  `NomContacto` varchar(128) DEFAULT NULL,
  `DomContacto` varchar(128) DEFAULT NULL,
  `Cp` varchar(5) DEFAULT NULL,
  `CorContacto` varchar(128) DEFAULT NULL,
  `TelCasa` varchar(40) DEFAULT NULL,
  `TelCelular` varchar(40) DEFAULT NULL,
  `Estado` varchar(10) DEFAULT NULL,
  `FechaAlta` date DEFAULT NULL,
  `RecFecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`Correo`, `idContacto`, `NomContacto`, `DomContacto`, `Cp`, `CorContacto`, `TelCasa`, `TelCelular`, `Estado`, `FechaAlta`, `RecFecha`) VALUES
('a_zazuetag@hotmail.com', 2, 'Ma. Teresa Cardenas M.', 'Privada Mata# 105', '37180', 'matere@hotmail.com', '4616182783', '4611098520', 'G', '0000-00-00', '0000-00-00'),
('a_zazuetag@hotmail.com', 3, 'Abraham A Guzman C.', 'Prolongacion x #229', '{Cp}', 'abraham@hotmail.com', '4616158768', '4611086765', 'G', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `correo` varchar(128) NOT NULL,
  `nomRegistro` varchar(128) DEFAULT NULL,
  `contrasena` varchar(128) DEFAULT NULL,
  `fechaAlta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`correo`, `nomRegistro`, `contrasena`, `fechaAlta`) VALUES
('a_zazuetag@hotmail.com', 'Alejandro Guzman Z.', 'hola', '2018-08-10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`Correo`,`idContacto`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`correo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
