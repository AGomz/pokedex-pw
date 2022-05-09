-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2022 a las 22:33:46
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokedex`
--
CREATE DATABASE IF NOT EXISTS pokedex;
USE pokedex;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imagen` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tipo1` int(11) NOT NULL,
  `tipo2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id`, `numero`, `nombre`, `descripcion`, `imagen`, `tipo1`, `tipo2`) VALUES
(1, 1, 'Bulbasaur', 'Este Pokémon nace con una semilla en el lomo, que brota con el paso del tiempo.', '1.webp', 12, 17),
(2, 2, 'Ivysaur', 'Cuando le crece bastante el bulbo del lomo, pierde la capacidad de erguirse sobre las patas traseras.', '2.webp', 12, 17),
(3, 3, 'Venusaur', 'La planta florece cuando absorbe energía solar, lo cual le obliga a buscar siempre la luz del sol.', '3.webp', 12, 17),
(4, 4, 'Charmander', 'Prefiere las cosas calientes. Dicen que cuando llueve le sale vapor de la punta de la cola.', '4.webp', 7, NULL),
(5, 5, 'Charmeleon', 'Este Pokémon de naturaleza agresiva ataca en combate con su cola llameante y hace trizas al rival con sus afiladas garras.', '5.webp', 7, NULL),
(6, 6, 'Charizard', 'Escupe un fuego tan caliente que funde las rocas. Causa incendios forestales sin querer.', '6.webp', 7, NULL),
(7, 7, 'Squirtle ', 'Cuando retrae su largo cuello en el caparazón, dispara agua a una presión increíble.', '7.webp', 2, NULL),
(8, 8, 'Wartortle', 'Se lo considera un símbolo de longevidad. Los ejemplares más ancianos tienen musgo sobre el caparazón.', '8.webp', 2, NULL),
(9, 9, 'Blastoise', 'Para acabar con su enemigo, lo aplasta con el peso de su cuerpo. En momentos de apuro, se esconde en el caparazón.', '9.webp', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `img` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`, `img`) VALUES
(1, 'Acero', 'Tipo_acero.webp'),
(2, 'Agua', 'Tipo_agua.webp'),
(3, 'Bicho', 'Tipo_bicho.webp'),
(4, 'Dragón', 'Tipo_dragon.webp'),
(5, 'Eléctrico', 'Tipo_electrico.webp'),
(6, 'Fantasma', 'Tipo_fantasma.webp'),
(7, 'Fuego', 'Tipo_fuego.webp'),
(8, 'Hada', './tipos/Tipo_hada.webp'),
(9, 'Hielo', 'Tipo_hielo.webp'),
(10, 'Lucha', 'Tipo_lucha.webp'),
(11, 'Normal', 'Tipo_normal.webp'),
(12, 'Planta', 'Tipo_planta.webp'),
(13, 'Psíquico', 'Tipo_psiquico.webp'),
(14, 'Roca', 'Tipo_roca.webp'),
(15, 'Siniestro', 'Tipo_siniestro.webp'),
(16, 'Tierra', 'Tipo_tierra.webp'),
(17, 'Veneno', 'Tipo_veneno.webp'),
(18, 'Volador', 'Tipo_volador.webp'),
(19, '???', 'Tipo_.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `email`) VALUES
(19, 'ADMIN', '$2y$10$Btnu0JvzbiI7bgY4iBXh2uGn4C.7uxoBI999J3sMjkukiedbcq8Fu', 'admin@mail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `tipo1` (`tipo1`),
  ADD KEY `tipo2` (`tipo2`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`tipo1`) REFERENCES `tipo` (`id`),
  ADD CONSTRAINT `pokemon_ibfk_2` FOREIGN KEY (`tipo2`) REFERENCES `tipo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
