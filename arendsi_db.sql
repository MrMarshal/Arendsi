-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2024 a las 02:33:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arendsi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `branch_id`, `section_id`, `name`, `description`, `status`) VALUES
(1, 1, 1, 'Huevos', '', 1),
(2, 1, 1, 'Alimentos', '', 1),
(3, 1, 1, 'Repostería', '', 1),
(4, 1, 1, 'Bebidas calientes', '', 1),
(5, 1, 1, 'Infusiones', '', 1),
(6, 1, 1, 'Bebidas frías', '', 1),
(7, 1, 1, 'Bebidas con alcohol', '', 1),
(8, 1, 1, 'Extras', '', 1),
(9, 1, 1, 'Prueba 1', '', 1),
(10, 1, 1, 'Prueba', '', 1),
(11, 1, 1, 'Prueba3', '', 1),
(12, 1, 1, 'Prueba 3', '', 1),
(13, 1, 1, 'Prueba 4', '', 1),
(14, 1, 1, 'Prueba 6', '', 1),
(15, 1, 2, 'Chocolates', '', 1),
(16, 1, 2, 'Regalitos', '', 1),
(17, 1, 1, 'Prueba 10', '', 1),
(18, 1, 2, 'Tazas', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_locations`
--

CREATE TABLE `cat_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cat_locations`
--

INSERT INTO `cat_locations` (`id`, `name`, `description`, `status`) VALUES
(1, 'Interior', '', 1),
(2, 'Exterior', '', 1),
(3, 'A domicilio', '', 1),
(4, 'En la barra', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_roles`
--

CREATE TABLE `cat_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cat_roles`
--

INSERT INTO `cat_roles` (`id`, `name`, `description`, `status`) VALUES
(1, 'Súper Admin', '', 1),
(2, 'Administrador', '', 1),
(3, 'Cajero', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_sections`
--

CREATE TABLE `cat_sections` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cat_sections`
--

INSERT INTO `cat_sections` (`id`, `name`) VALUES
(1, 'Cafetería'),
(2, 'Boutique');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `product_id`, `url`, `type`, `status`) VALUES
(1, 8, '661dce4799250.png', 1, 0),
(2, 9, '661dce7c19603.png', 1, 0),
(3, 10, '661dcedf0e982.png', 1, 1),
(4, 11, '662320c12ae07.jpg', 1, 1),
(5, 12, '6623219bf1824.png', 1, 1),
(6, 13, '662321eca2110.png', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `branch_id`, `section_id`, `category_id`, `subcategory_id`, `name`, `description`, `cost`, `price`, `stock`, `stock_min`, `code`, `status`) VALUES
(1, 1, 1, 4, 2, 'Capuchino Cream', 'Cremado con leche evaporada', 40.00, 60.00, 0, 0, '', 1),
(2, 0, 0, 0, 0, 'Primero', 'Un café', 10.00, 20.00, 10, 0, '', 1),
(3, 0, 0, 0, 0, 'Primero', 'Café', 10.00, 20.00, 10, 0, '', 1),
(4, 0, 0, 0, 0, 'Primero', 'Un café', 10.00, 20.00, 10, 0, '', 1),
(5, 0, 0, 0, 0, '', '', 0.00, 0.00, 0, 0, '', 1),
(6, 0, 0, 0, 0, '', '', 0.00, 0.00, 0, 0, '', 1),
(7, 0, 0, 0, 0, 'Primero', 'Un café', 10.00, 20.00, 10, 0, '', 1),
(8, 0, 0, 0, 0, '', '', 0.00, 0.00, 0, 0, '', 1),
(9, 1, 1, 1, 0, 'Primero', 'Cafecito', 10.00, 10.00, 10, 0, '', 1),
(10, 1, 1, 4, 2, 'Segundo', 'Capuchino', 10.00, 20.00, 10, 0, '', 1),
(11, 1, 2, 16, 14, 'Primero con QR', 'UNa desc', 10.00, 100.00, 10, 0, '431', 1),
(12, 1, 2, 16, 14, 'Segundo QR', 'DEsc 2', 10.00, 100.00, 100, 10, '', 1),
(13, 1, 2, 15, 12, 'Tercer QR', 'Asd', 10.00, 100.00, 10, 0, '432', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `branch_id`, `section_id`, `category_id`, `name`, `description`, `status`) VALUES
(1, 1, 1, 4, 'Café', '', 1),
(2, 1, 1, 4, 'Capuccino', '', 1),
(3, 1, 1, 4, 'Chocolates', '', 1),
(4, 1, 1, 6, 'Frappés', '', 1),
(5, 1, 1, 6, 'Malteadas', '', 1),
(6, 1, 1, 6, 'Soda italiana', '', 1),
(7, 1, 1, 6, 'Aguas', '', 1),
(8, 1, 1, 6, 'Refrescos', '', 1),
(9, 1, 1, 7, 'Vinos', '', 1),
(10, 1, 1, 7, 'Cerveza artesanal', '', 1),
(11, 1, 1, 1, 'A la plancha', '', 1),
(12, 1, 2, 15, 'Amargos', '', 1),
(13, 1, 2, 15, 'Semiamargos', '', 1),
(14, 1, 2, 16, '10 de Mayo', '', 1),
(15, 1, 2, 16, 'Día del padre', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `account_status` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `branch_id`, `location_id`, `name`, `account_status`, `status`) VALUES
(1, 1, 1, 'Mesa I1', 0, 1),
(2, 1, 1, 'Mesa I2', 0, 1),
(3, 1, 1, 'Mesa I3', 0, 1),
(4, 1, 4, 'Cliente 2', 0, 1),
(5, 1, 2, 'Mesa E2', 0, 1),
(6, 1, 3, 'Domi 1', 0, 1),
(7, 1, 4, 'Barra 1', 0, 1),
(8, 1, 4, 'Barra 2', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `cat_locations`
--
ALTER TABLE `cat_locations`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `cat_roles`
--
ALTER TABLE `cat_roles`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `cat_sections`
--
ALTER TABLE `cat_sections`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cat_locations`
--
ALTER TABLE `cat_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cat_roles`
--
ALTER TABLE `cat_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cat_sections`
--
ALTER TABLE `cat_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
