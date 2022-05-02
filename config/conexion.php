<?php
// Script de conexion a la base de datos

// Se necesita una base de datos con nombre pokedex en mysql
// con la siguiente tabla
/*
CREATE TABLE `usuario` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
   `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
   `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci
*/

$config = parse_ini_file('db.ini');
$conexion = new mysqli($config['hostname'], $config['user'], $config['pass'], $config['db']);

?>