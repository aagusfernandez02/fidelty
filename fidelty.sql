-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2022 a las 20:33:07
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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
  `id_premio` int(5) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `canjes`
--

INSERT INTO `canjes` (`id_canje`, `dni_socio`, `id_premio`, `fecha`) VALUES
(1, 44006022, 151, '2022-10-27'),
(2, 44006022, 17, '2022-10-27'),
(3, 44006022, 18, '2022-10-27'),
(4, 44006022, 24, '2022-10-27'),
(5, 44006022, 17, '2022-10-28'),
(6, 44006022, 17, '2022-10-28'),
(7, 44006022, 18, '2022-10-28'),
(8, 43506845, 18, '2022-10-29'),
(9, 43506845, 23, '2022-10-29'),
(10, 43506845, 24, '2022-10-29'),
(11, 44006022, 17, '2022-10-29'),
(12, 40123123, 24, '2022-10-29');

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
(17, 350, 197, 10, 'https://www.unicenter.com.ar/files/get/691', '2x1 entradas Hoyts', 'Promoción 2x1 en entradas para cualquier cine y función de la cadena Hoyts de miercoles a sabados.'),
(18, 1520, 109, NULL, 'https://media.glassdoor.com/l/d5/88/3d/f1/ypf.jpg', 'Descuento 12% YPF', 'Descuento de un 12% en cargas de combustible en cadena YPF. Máximo $5000 de reintegro'),
(20, 1200, 999, NULL, 'https://www.scdn.co/i/_global/open-graph-default.png', 'Subscripción Spotify premium por 6 meses', 'Subscripción a Spotify premium por un lapso de 6 meses.'),
(21, 1200, 50, NULL, 'https://i0.wp.com/hipertextual.com/wp-content/uploads/2014/06/Tuenti-Internacional.jpg?resize=1024%2C555&quality=50&strip=all&ssl=1', 'Saldo Tuenti', 'Saldo para recarga de Tuenti de $1500 aplicable del 1 al 15 de cada mes.'),
(22, 300, 100, NULL, 'https://www.cronista.com/files/image/316/316383/5ffe4d17004d8.jpg', 'Descuento PedidosYa $300', 'Descuento en PedidosYa de $1000 en compras superiores a $2500 de Lunes a Viernes.'),
(23, 2600, 399, 10, 'http://res.cloudinary.com/hdsqazxtw/image/upload/v1570710978/coderhouse.jpg', 'Beca CoderHouse', 'Descuento en la plataforma CoderHouse en cualquier curso a elección cuyo valor sea menor a $10000 del 50%'),
(24, 750, 4997, 50, 'https://empresas.blogthinkbig.com/wp-content/uploads/2019/06/Cinema-tickets-and-popcorn-illustration.jpg', 'Entrada cine Hoyts', 'Entrada al cine a cualquier función de martes a viernes en cadena Hoyts.'),
(26, 100000, 5, 1, 'https://assets.adidas.com/images/w_600,f_auto,q_auto/7c77215c679a4388842ba97d0110c93a_9366/Rinonera_Essential_(UNISEX)_Negro_DV2400_01_standard.jpg', 'Riñonera', 'Riñonera Adidas canjeable en cualquier local Adidas de CABA y GBA'),
(32, 1800, 200, 5, 'https://media.vivieloeste.com.ar/p/87d297cdbb6a46864a714528af0f0863/adjuntos/320/imagenes/000/064/0000064588/1200x675/smart/la-perla-haedo1-editadopng.png', 'Descuento 60% en desayuno La Perla Haedo', 'Descuento de 60% en desayunos con un tope de reintegro de $5000 los días domingos en la sucursal de La Perla de Haedo.'),
(34, 150000, 2, NULL, 'https://www.bbva.com/wp-content/uploads/2022/01/BadBunny-1080x1080_opt-e1643384470829.jpg', 'Entrada show Bad Bunny 4/11/2022', 'Entrada campo general para el show de Bad Bunny el 4/11/2022 en el estadio Velez Sarfield.'),
(36, 240000, 5, 1, 'https://http2.mlstatic.com/D_NQ_NP_793841-MLA45658507914_042021-O.jpg', 'Samsung Galaxy A32 Movistar', 'Vale por Samsung Galaxy A32 x64GB de la empresa Movistar'),
(37, 2000, 0, NULL, 'https://media.ambito.com/p/23fcf4962bb763b45876db93c1d732e6/adjuntos/239/imagenes/037/343/0037343878/1200x675/smart/logo-despegarjpg.jpg', '100 millas Despegar', 'Vale por 100 millas en vuelos para Despegar dentro de Argentina');

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
('43506845', 'Ramiro', 'Palacios', '2001-07-15', 'rampon34@gmail.com', '09cc5048735d1dd66af51e6c9aed8710', 6631),
('44006022', 'Agustín', 'Fernandez', '2002-01-17', 'af.agusfernandez02@gmail.com', 'd006a21a31dcb74a9531c14adef78621', 10550);

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
  MODIFY `id_canje` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comercios`
--
ALTER TABLE `comercios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
