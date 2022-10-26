-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2022 a las 03:58:29
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fidelty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canjes`
--

CREATE TABLE `canjes` (
  `id_canje` int(5) NOT NULL,
  `dni_socio` int(8) NOT NULL,
  `id_premio` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `canjes`
--

INSERT INTO `canjes` (`id_canje`, `dni_socio`, `id_premio`) VALUES
(1, 44006022, 151),
(2, 44006022, 17),
(3, 44006022, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercios`
--

CREATE TABLE `comercios` (
  `id` int(5) NOT NULL,
  `cuit` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comercios`
--

INSERT INTO `comercios` (`id`, `cuit`, `direccion`, `email`, `password`) VALUES
(4, '20-44006022-7', 'Mariano Escalada 2397, Haedo, Buenos Aires', 'af.agusfernandez02@gmail.com', 'd006a21a31dcb74a9531c14adef78621');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id` int(5) NOT NULL,
  `saldo` int(10) NOT NULL,
  `stock` int(6) DEFAULT 0,
  `punto_reposicion` int(6) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `premios`
--

INSERT INTO `premios` (`id`, `saldo`, `stock`, `punto_reposicion`, `img`, `nombre`, `descripcion`) VALUES
(17, 300, 2, NULL, 'https://www.unicenter.com.ar/files/get/691', '2x1 entradas cine Hoyts', 'Promoción 2x1 en entradas para cualquier cine y función de la cadena Hoyts de jueves a domingo.'),
(18, 1520, 110, NULL, 'https://media.glassdoor.com/l/d5/88/3d/f1/ypf.jpg', 'Descuento 12% YPF', 'Descuento de un 12% en cargas de combustible en cadena YPF. Máximo $5000 de reintegro'),
(20, 1200, 999, NULL, 'https://www.scdn.co/i/_global/open-graph-default.png', 'Subscripción Spotify premium por 6 meses', 'Subscripción a Spotify premium por un lapso de 6 meses.'),
(21, 120, 0, NULL, 'https://i0.wp.com/hipertextual.com/wp-content/uploads/2014/06/Tuenti-Internacional.jpg?resize=1024%2C555&quality=50&strip=all&ssl=1', 'Saldo Tuenti x $1500', 'Saldo para recarga de Tuenti de $1500 aplicable del 1 al 15 de cada mes.'),
(22, 300, 0, NULL, 'https://www.cronista.com/files/image/316/316383/5ffe4d17004d8.jpg', 'Descuento PedidosYa $300', 'Descuento en PedidosYa de $1000 en compras superiores a $2500 de Lunes a Viernes.'),
(23, 2600, 0, NULL, 'http://res.cloudinary.com/hdsqazxtw/image/upload/v1570710978/coderhouse.jpg', 'Beca CoderHouse al 50%', 'Descuento en la plataforma CoderHouse en cualquier curso a elección cuyo valor sea menor a $50000 del 50%'),
(24, 750, 5000, 50, 'https://empresas.blogthinkbig.com/wp-content/uploads/2019/06/Cinema-tickets-and-popcorn-illustration.jpg', 'Entrada al cine Hoyts', 'Entrada al cine a cualquier función de martes a jueves en cadena Hoyts.'),
(25, 2100, 0, NULL, 'https://www.ilacad.com/bo/_images/9529/Tienda_Minimercado_PE_fachada2.png', 'Descuento 60% mercados Puma', 'Descuento del 60% en estaciones de servicio de la línea Puma con un tope de reintegro de $4000'),
(26, 100000, 5, 1, 'https://assets.adidas.com/images/w_600,f_auto,q_auto/7c77215c679a4388842ba97d0110c93a_9366/Rinonera_Essential_(UNISEX)_Negro_DV2400_01_standard.jpg', 'Riñonera Adidas', 'Riñonera Adidas canjeable en cualquier local Adidas de CABA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `dni` char(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` int(10) DEFAULT 0 CHECK (`saldo` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`, `email`, `password`, `saldo`) VALUES
('21674930', 'Guillermo', 'Fernandez', '1975-12-08', 'gfernandez@gmail.com', '9f4ba1c5bea18ae08c4e05f7475350f9', 0),
('24459978', 'Natalia', 'Gilli', '1975-03-08', 'ngilli@hotmail.com', '19b0a57bc4b92d2698c610a0f8500f30', 0),
('43006111', 'Ramiro', 'Palacios', '2002-01-17', 'ramapalacios@yahoo.com', '7d8147553bff16fdbb0825a57911887b', 0),
('44006021', 'Cosntanza', 'Fernandez', '2006-12-12', 'cfernandez@gmail.com', '7d12e58323ca45e66e074c34e73c7acb', 0),
('44006022', 'Agustín', 'Fernandez', '2002-01-17', 'af.agusfernandez02@gmail.com', 'd006a21a31dcb74a9531c14adef78621', 2000),
('46262592', 'Lautaro', 'Ayala', '2001-08-28', 'lalo.exe@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `canjes`
--
ALTER TABLE `canjes`
  ADD PRIMARY KEY (`id_canje`);

--
-- Indices de la tabla `comercios`
--
ALTER TABLE `comercios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuit` (`cuit`);

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `canjes`
--
ALTER TABLE `canjes`
  MODIFY `id_canje` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comercios`
--
ALTER TABLE `comercios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
