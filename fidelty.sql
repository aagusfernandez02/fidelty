-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2022 a las 04:18:25
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
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id` int(5) NOT NULL,
  `saldo` int(10) NOT NULL,
  `stock` int(6) DEFAULT 0,
  `punto_reposicion` int(6) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `premios`
--

INSERT INTO `premios` (`id`, `saldo`, `stock`, `punto_reposicion`, `img`, `nombre`, `descripcion`, `proveedor`) VALUES
(17, 350, 109, 100, 'https://www.unicenter.com.ar/files/get/691', '2x1 entradas Hoyts', 'Promoción 2x1 en entradas para cualquier cine y función de la cadena Hoyts de miercoles a sabados.', 'La Distribuidora SA'),
(20, 1200, 998, 1000, 'https://www.scdn.co/i/_global/open-graph-default.png', 'Subscripción Spotify premium por 6 meses', 'Subscripción a Spotify premium por un lapso de 6 meses.', 'Spotify LATAM'),
(21, 1200, 58, NULL, 'https://i0.wp.com/hipertextual.com/wp-content/uploads/2014/06/Tuenti-Internacional.jpg?resize=1024%2C555&quality=50&strip=all&ssl=1', 'Saldo Tuenti', 'Saldo para recarga de Tuenti de $1500 aplicable del 1 al 15 de cada mes.', 'La Distribuidora SA'),
(22, 300, 125, 120, 'https://www.cronista.com/files/image/316/316383/5ffe4d17004d8.jpg', 'Descuento PedidosYa $300', 'Descuento en PedidosYa de $1000 en compras superiores a $2500 de Lunes a Viernes.', 'La Distribuidora SA'),
(23, 2600, 396, 10, 'http://res.cloudinary.com/hdsqazxtw/image/upload/v1570710978/coderhouse.jpg', 'Beca CoderHouse', 'Descuento en la plataforma CoderHouse en cualquier curso a elección cuyo valor sea menor a $10000 del 50%', 'La Distribuidora SA'),
(24, 750, 4996, 50, 'https://empresas.blogthinkbig.com/wp-content/uploads/2019/06/Cinema-tickets-and-popcorn-illustration.jpg', 'Entrada cine Hoyts', 'Entrada al cine a cualquier función de martes a viernes en cadena Hoyts.', 'La Distribuidora SA'),
(26, 100000, 7, 1, 'https://assets.adidas.com/images/w_600,f_auto,q_auto/7c77215c679a4388842ba97d0110c93a_9366/Rinonera_Essential_(UNISEX)_Negro_DV2400_01_standard.jpg', 'Riñonera', 'Riñonera Adidas canjeable en cualquier local Adidas de CABA y GBA', 'La Distribuidora SA'),
(32, 1800, 200, 300, 'https://media.vivieloeste.com.ar/p/87d297cdbb6a46864a714528af0f0863/adjuntos/320/imagenes/000/064/0000064588/1200x675/smart/la-perla-haedo1-editadopng.png', 'Descuento 60% en desayuno La Perla Haedo', 'Descuento de 60% en desayunos con un tope de reintegro de $5000 los días domingos en la sucursal de La Perla de Haedo.', 'La Aldea'),
(34, 150000, 4, 5, 'https://www.bbva.com/wp-content/uploads/2022/01/BadBunny-1080x1080_opt-e1643384470829.jpg', 'Entrada show Bad Bunny 4/11/2022', 'Entrada campo general para el show de Bad Bunny el 4/11/2022 en el estadio Velez Sarfield.', 'Rami'),
(36, 240000, 10, 10, 'https://http2.mlstatic.com/D_NQ_NP_793841-MLA45658507914_042021-O.jpg', 'Samsung Galaxy A32 Movistar', 'Vale por Samsung Galaxy A32 x64GB de la empresa Movistar', 'Rami'),
(37, 2000, 100, 10, 'https://media.ambito.com/p/23fcf4962bb763b45876db93c1d732e6/adjuntos/239/imagenes/037/343/0037343878/1200x675/smart/logo-despegarjpg.jpg', '100 millas Despegar', 'Vale por 100 millas en vuelos para Despegar dentro de Argentina', 'La Aldea'),
(39, 50000, 50, 100, 'https://d1.awsstatic.com/case-studies/LATAM/fravega_video.723dc6058cdd86fe5d2bd480e25745a69093f99c.png', 'Descuento 50% en Fravega', 'Descuento del 50% en compras mayores a $5000 con un tope de reintegro de $15000 en locales Fravega', 'Fravega'),
(41, 4000, 10, 15, 'https://www.baenegocios.com/export/sites/cronica/img/2020/08/18/sportclubapertura.jpg_634809101.jpg', '3 meses de cuota en gimnasios SportClub', 'Vale por 3 meses consecutivos de cuota en gimnasios de la cadena SportClub ubicados en las zonas de Morón, Ituzaingó y Padua.', 'Sport Club'),
(46, 50000, 5, 10, 'https://electroluxar.vtexassets.com/arquivos/ids/156325/elaf8.jpg?v=636754715606270000', 'Lavarropas Atma en Fravega', 'Vale por un lavarropas marca Atma, canjeable en cualquier tienda Fravega', 'Fravega'),
(47, 600, 15, 20, 'http://www.espaciorelax.cl/wp-content/uploads/2018/04/masajes-con-ventosas-chinas.jpg', 'Sesion de masajes c/ventoterapia ReflexMasajes', 'Vale por sesion de masajes de 45min con uso de ventoterapia en ReflexMasajes, valido de lunes a miercoles', 'La Distribuidora SA'),
(49, 100, 16, 25, 'https://tienda.pago24.com.ar/media/catalog/product/cache/8bba2abe6d282ec93669d82aeb928040/l/f/lf28.jpeg', 'Alfajor Pepitos triple x65g', 'Canjeable por un descuento del 100% en Alfajor Pepito triple x65g en Wabi. Aplicable en compras superiores a $700 de lunes a jueves.', 'Wabi'),
(51, 10000, 5, NULL, 'https://media.tycsports.com/files/2022/11/07/502549/hasbulla-con-la-camiseta-de-boca_w416.webp', 'Entrada Show Hasbulla Gran Rex 8/11', 'Vale por entrada al show de Hasbulla en el Gran Rex el dia 8/11 en campo vip.', 'Rami');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
